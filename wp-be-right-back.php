<?php
/**
* Plugin Name: WP Be Right Back
* Plugin URI: http://www.creare.co.uk
* Description: WP Be Right Back is a lightweight plugin which can add a holding page to your website enabling logged in users to browse the site as normal/make changes, whilst non-logged in users access a holding page. With easy customisation of your holding page and an SEO friendly 503 status option, WP Be Right Back is ideal for all. 
* Version: 0.1
* Author: Creare Group
* Author URI: http://www.creare.co.uk
* License: GPL2
*
 	Copyright 2014  Daniel Long  (email : dan@creare.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$wp_brb = new wp_brb();
 
//define plugin paths
define( 'WP_BRB_DIR',plugin_dir_path( __FILE__ ) ); 
define( 'WP_BRB_URL',plugin_dir_url( __FILE__ ) ); 

require_once( 'inc/settings-page.php' );

class wp_brb {
	
	public function __construct() {
		if ( is_admin() ){ 
			add_action( 'admin_menu', array( $this, 'wp_brb_admin_actions' ) );   
			add_action( 'admin_init', array( $this, 'wp_brb_setting' ) ); 
		}
		add_action( 'template_redirect', array( $this, 'wp_brb_template_redirect' ) );
		add_filter( 'plugin_action_links', array( $this, 'wp_brb_settings_link' ), 10, 2 );
		add_action( 'admin_notices', array( $this, 'wp_brb_admin_notification' ) );
	}
	
	public function wp_brb_admin_actions() {
		$page = add_options_page( __( 'WP Be Right Back', 'mytextdomain' ), __( 'WP Be Right Back', 'mytextdomain' ), 'edit_theme_options', 'wp_brb_options', 'wp_brb_do_page' );
	    add_action( 'admin_print_styles-' . $page, array( $this, 'wp_brb_enqueue_admin_styles' ) );	
	}
	
	public function wp_brb_enqueue_admin_styles() {
		wp_enqueue_script( 'jquery-ui-datepicker' );
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		
		wp_register_style( 'wp_brbadminstyles', plugins_url( '/theme/css/wp_brb-admin.css', __FILE__ ),'',null, 'screen' );
		wp_enqueue_style( 'wp_brbadminstyles' );
		
		wp_register_style( 'wp_brb-jquery-ui-datepicker', plugins_url( '/inc/datepicker/smoothness.css', __FILE__ ),'','', 'screen' );
		wp_enqueue_style( 'wp_brb-jquery-ui-datepicker' );
	    
	    wp_enqueue_media();
	    wp_register_script('wp_brb-admin', plugins_url( '/theme/js/wp_brb-scripts.js', __FILE__ ), array('jquery'), null );
	    wp_enqueue_script('wp_brb-admin');
		
	}
	
	public function wp_brb_setting(){
		register_setting( 'wp_brb_options', 'wp_brb_activate');
	    register_setting( 'wp_brb_options', 'wp_brb_holding_title');
		register_setting( 'wp_brb_options', 'wp_brb_holding_content');
		register_setting( 'wp_brb_options', 'wp_brb_return_date');
		register_setting( 'wp_brb_options', 'wp_brb_return_date_format');
		register_setting( 'wp_brb_options', 'wp_brb_show_date');
		register_setting( 'wp_brb_options', 'wp_brb_email');
		register_setting( 'wp_brb_options', 'wp_brb_telephone');
		register_setting( 'wp_brb_options', 'wp_brb_logo_image');
		register_setting( 'wp_brb_options', 'wp_brb_background_image');
		register_setting( 'wp_brb_options', 'wp_brb_background_colour');
	}
		
	public function wp_brb_settings_link( $links, $file ) {
	
	    $plugin_file = basename(__FILE__);
	    if ( basename( $file ) == $plugin_file ) {
	        $settings_link = '<a href="options-general.php?page=wp_brb_options">Settings</a>';
	        array_unshift( $links, $settings_link );
	    }
	    return $links;
	}
	
	public function wp_brb_load_template( $template ) {		
		$returndate = get_option( 'wp_brb_return_date' );
	    header( 'HTTP/1.1 503 Service Temporarily Unavailable' );
		if( $returndate ) {
			header( 'Retry-After: '.$returndate.' 23:59:59 GMT' );
		}
	    //load our template
	    include( $template );
	    exit;
	}
	 
	public function wp_brb_template_redirect() {
		$activate = get_option( 'wp_brb_activate' );
		$date = get_option( 'wp_brb_return_date_format' );
		$show_date = get_option( 'wp_brb_show_date' );
		$date = strtotime( $date );
		$now = strtotime( 'now' );
		if( $date >= $now || $show_date == '' ) {
			if( !is_user_logged_in() && !empty( $activate ) ) {
				$this->wp_brb_load_template( WP_BRB_DIR . 'holding.php' );
	    	}
		} else {
			update_option( 'wp_brb_activate', 0 );
		} 
	}
	
	public function wp_brb_admin_notification() {
    
		$activate = get_option( 'wp_brb_activate' );
		if( $activate == 1 ) {
			$message = '<div class="error">
				<p>Your WP Be Right Back holding page is currently active! <a href="options-general.php?page=wp_brb_options">Click here</a> to amend your settings.</p>
			</div>';
			echo $message;	
		}
    
    }

}