<?php

namespace Leadin\auth;

use Leadin\data\User;
use Leadin\data\Portal_Options;
use Leadin\client\Access_Token_Api_Client;
use Leadin\auth\OAuthCrypto;
use Leadin\admin\Routing;
use Leadin\admin\MenuConstants;

/**
 * Class managing OAuth2 authorization
 */
class OAuth {

	/**
	 * Return the flag checking if we're connected with OAuth.
	 *
	 * @return bool True if the OAuth version of the plugin is enabled or not.
	 */
	public static function is_enabled() {
		return ! empty( Portal_Options::get_access_token() );
	}

	/**
	 * Authorizes the plugin with given oauth credentials by storing them in the options DB.
	 *
	 * @param string $access_token OAuth access token to store.
	 * @param string $refresh_token OAuth refresh token to store.
	 * @param string $expires_in Time left in seconds till access token expires.
	 */
	public static function authorize( $access_token, $refresh_token, $expires_in ) {
		$encrypted_refresh_token = OAuthCrypto::encrypt( $refresh_token );
		Portal_Options::set_access_token( $access_token );
		Portal_Options::set_refresh_token( $encrypted_refresh_token );
		Portal_Options::set_expiry_time( time() + $expires_in );
	}

	/**
	 * Deauthorizes the plugin by deleting OAuth credentials from the options DB.
	 */
	public static function deauthorize() {
		Portal_Options::delete_access_token();
		Portal_Options::delete_refresh_token();
		Portal_Options::delete_expiry_time();
	}

	/**
	 * Returns the access token currently stored in the options table.
	 * If the token has expired, attempt to refresh it before returning it.
	 *
	 * @return string The access token in the Options table.
	 *
	 * @throws Exception If the token is expired, and refreshing the token fails.
	 */
	public static function get_access_token() {
		if ( self::is_access_token_expired() ) {
			self::refresh_access_token();
		}

		return Portal_Options::get_access_token();
	}

	/**
	 * Returns the refresh token stored in the options table.
	 *
	 * @return string The stored refresh token in the Options table.
	 *
	 * @throws \Exception If no refresh token is available.
	 */
	public static function get_refresh_token() {
		$encrypted_refresh_token = Portal_Options::get_refresh_token();

		if ( '' === $encrypted_refresh_token ) {
			throw new \Exception( 'Refresh token is empty' );
		}

		return OAuthCrypto::decrypt( $encrypted_refresh_token );
	}

	/**
	 * Returns the unix time in seconds for when the access token will expire.
	 *
	 * @return string time in unix seconds when refresh token will expire.
	 */
	private static function get_expiry_time() {
		return Portal_Options::get_expiry_time();
	}

	/**
	 * Check if we need to refresh the access token.
	 * Times are in unix seconds.
	 *
	 * @return bool Return true if the access token is within 10 minutes of expiring or has expired.
	 */
	public static function is_access_token_expired() {
		$current_time = time();
		$expiry_time  = self::get_expiry_time();
		return $expiry_time - $current_time < 600; // 10 minutes.
	}

	/**
	 * Refreshes the stored access token by posting to HubSpot's OAuth api.
	 *
	 * @throws \Exception On any HTTP request errors when attempting to refresh the access token.
	 */
	public static function refresh_access_token() {
		try {
			$client                = new Access_Token_Api_Client();
			$refreshed_credentials = $client->refresh_access_token( self::get_refresh_token() );
			self::authorize(
				$refreshed_credentials->access_token,
				$refreshed_credentials->refresh_token,
				$refreshed_credentials->expires_in
			);
		} catch ( \Exception $e ) {
			self::deauthorize();
			throw new \Exception( \json_encode( $e->getMessage() ), 401 );
		}
	}
}
