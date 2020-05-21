<?php
	
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
	}

if ( ! class_exists( 'Wol_Fng_Utility' ) ){
	
	class Wol_Fng_Utility{
		
		public static function twitter( $args = array() ){
			
			
			
			$html = '';
			
			$html .= '
				<script>window.twttr = (function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0],
					  t = window.twttr || {};
					if (d.getElementById(id)) return t;
					js = d.createElement(s);
					js.id = id;
					js.src = "https://platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js, fjs);
					
					t._e = [];
					t.ready = function(f) {
					  t._e.push(f);
					};
					
					return t;
					}(document, "script", "twitter-wjs"));</script>';
			
							
			$html .= '<a class="twitter-share-button" data-url="' . $args['url'] . '" data-text="' . $args['text'] . '" data-via="' . $args['username'] . '" data-hashtags="' . $args['hashtags'] . '" data-size="large" >' . __( 'Tweet your', 'wpit-funny-name-generator' ) . ' ' . $args['type'] . '</a>';
					
			return $html;
			
			
		}
	}
}
