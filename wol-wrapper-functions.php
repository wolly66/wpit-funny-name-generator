<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
	}

if ( ! function_exists( 'get_twitter_button' ) ){
	
	function get_twitter_button( $args = array() ){
		
		return funnyname()->utility->twitter( $args );
	}
}