<?php
/*
Plugin Name: Contact Form 7 Lead info with country
Plugin URI: http://www.wpshore.com/plugins/contact-form-7-leads-tracking/
Description: Adds tracking info to contact form 7 outgoing emails when pasting the [tracking-info] shortcode in the Message body. The lead tracking info includes: Form Page URL, Original Referrer, Landing Page, User IP, Country of the User IP and Browser. In order to display the Country it needs the "GeoIP Detection" plugin that can be found in the WordPress plugin repository.
Author: Apasionados
Author URI: http://apasionados.es/
Version: 1.4.3
Text Domain: wpshore_cf7_lead_tracking
*/

/*  Copyright 2013 Nablasol
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

$plugin_header_translate = array( __('Contact Form 7 Leads Tracking', 'wpshore_cf7_lead_tracking'), __('Contact Form 7 Leads Tracking Enhanced', 'wpshore_cf7_lead_tracking'), __('Adds tracking info to contact form 7 outgoing emails when pasting the [tracking-info] shortcode in the Message body. The lead tracking info includes: Form Page URL, Original Referrer, Landing Page, User IP, Country of the User IP and Browser. In order to display the Country it needs the "GeoIP Detection" plugin that can be found in the WordPress plugin repository.', 'wpshore_cf7_lead_tracking') );

if ( ! function_exists('is_plugin_active')) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

if ( !is_plugin_active( 'contact-form-7-leads-tracking/wpshore_cf7_lead_tracking.php' ) ) {
	add_action( 'init', 'wpshore_cf7_lead_tracking_load_language', 1 );
	function wpshore_cf7_lead_tracking_load_language() {
		load_plugin_textdomain( 'wpshore_cf7_lead_tracking', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' ); 
	}	
	add_action('init', 'wpshore_set_session_values', 10);
	function wpshore_set_session_values() {
		if (!session_id()) {
			session_start();
		}
		if (!isset($_SESSION['OriginalRef'])) {
			if(isset($_SERVER['HTTP_REFERER'])) {
				$_SESSION['OriginalRef'] = $_SERVER["HTTP_REFERER"];
			} else {
				$_SESSION['OriginalRef'] = __('not set','wpshore_cf7_lead_tracking');
			}
		}
		if( $_SESSION['OriginalRef'] == 'not set' ) {
			$_SESSION['OriginalRef'] = __('not set','wpshore_cf7_lead_tracking');
		}
		if (!isset($_SESSION['LandingPage'])) {
			$cf7ltisSecure = false;
			// if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') || $_SERVER['SERVER_PORT'] == 443 {
			// The server port check is an extra for sheetty servers, best to remove it if it is not needed. Nb: port 443 does not guarantee connection is encrypted.
			if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
				$cf7ltisSecure = true;
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
				$cf7ltisSecure = true;
			}
			$CF7LT_REQUEST_PROTOCOL = $cf7ltisSecure ? 'https://' : 'http://';
			$_SESSION['LandingPage'] = $CF7LT_REQUEST_PROTOCOL . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; 
		}
	}
	
	function wpshore_wpcf7_before_send_mail($array, $number, $instance) {
		global $wpdb;
		if(wpautop($array['body']) == $array['body']) // The email is of HTML type
			$lineBreak = "<br/>";
		else
			$lineBreak = "\n";

		$trackingInfo = '';
		$trackingInfo .= $lineBreak . __('-- Tracking Info --','wpshore_cf7_lead_tracking') . $lineBreak;
		$trackingInfo .= __('The user filled the form on:','wpshore_cf7_lead_tracking') . ' ' . $_SERVER['HTTP_REFERER'] . $lineBreak;
		if (isset ($_SESSION['OriginalRef']) )
			$trackingInfo .= __('The user came to your website from:','wpshore_cf7_lead_tracking') . ' ' . $_SESSION['OriginalRef'] . $lineBreak;
		if (isset ($_SESSION['LandingPage']) )
			$trackingInfo .= __('Landing page on your website:','wpshore_cf7_lead_tracking') . ' ' . $_SESSION['LandingPage'] . $lineBreak;
		if ( isset ($_SERVER["REMOTE_ADDR"]) )
			$trackingInfo .= __('IP:','wpshore_cf7_lead_tracking') . ' ' . $_SERVER["REMOTE_ADDR"] . $lineBreak;
		if ( is_plugin_active( 'geoip-detect/geoip-detect.php' ) ) {
			$trackingCountry = geoip_detect_get_info_from_current_ip();
			$trackingInfo .= __('Country:','wpshore_cf7_lead_tracking') . ' ' . $trackingCountry->country_name . ' (' . $trackingCountry->country_code . ' - ' . $trackingCountry->continent_code . ')';
			if (!empty($trackingCountry->region_name)) {
				$trackingInfo .= ' - ' . __('Region:','wpshore_cf7_lead_tracking') . ' ' . $trackingCountry->region_name . '(' . $trackingCountry->region . ')';
			}
			if (!empty($trackingCountry->city)) {			
				$trackingInfo .= ' - ' . __('Postal Code + City:','wpshore_cf7_lead_tracking') . ' ' . $trackingCountry->postal_code . ' ' . $trackingCountry->city;		
			}
			$trackingInfo .= $lineBreak;
		}
		if ( isset ($_SERVER["HTTP_X_FORWARDED_FOR"]) ) {
			$trackingInfo .= __('Proxy Server IP:','wpshore_cf7_lead_tracking') . ' ' . $_SERVER["HTTP_X_FORWARDED_FOR"] . $lineBreak;
			if ( is_plugin_active( 'geoip-detect/geoip-detect.php' ) ) {
				$trackingcountryproxy = geoip_detect_get_info_from_ip($_SERVER["HTTP_X_FORWARDED_FOR"]);
				$trackingInfo .= __('Country:','wpshore_cf7_lead_tracking') . ' ' . $trackingcountryproxy->country_name . ' (' . $trackingcountryproxy->country_code . ' - ' . $trackingcountryproxy->continent_code . ')';
				if (!empty($trackingcountryproxy->region_name)) {
					$trackingInfo .= ' - ' . __('Region:','wpshore_cf7_lead_tracking') . ' ' . $trackingcountryproxy->region_name . '(' . $trackingcountryproxy->region . ')';
				}
				if (!empty($trackingcountryproxy->city)) {			
					$trackingInfo .= ' - ' . __('Postal Code + City:','wpshore_cf7_lead_tracking') . ' ' . $trackingcountryproxy->postal_code . ' ' . $trackingcountryproxy->city;		
				}
				$trackingInfo .= $lineBreak;
			}
		}
		if ( isset ($_SERVER["HTTP_USER_AGENT"]) )
			$trackingInfo .= __('Browser is:','wpshore_cf7_lead_tracking') . ' ' . $_SERVER["HTTP_USER_AGENT"] . $lineBreak;
		$array['body'] = str_replace('[tracking-info]', $trackingInfo, $array['body']);
		return $array;
	}
	add_filter('wpcf7_mail_components', 'wpshore_wpcf7_before_send_mail', 10, 3);
}
?>