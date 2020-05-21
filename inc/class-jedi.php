<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Wpit_Jedy class.
 */
class Wol_Jedy {

	private $options;

	/**
	 * Wpit_Jedy::__construct()
	 * Locked down the constructor, therefore the class cannot be externally instantiated
	 *
	 * @param array $args various params some overidden by default
	 *
	 * @return
	 */
	public function __construct() {


		$this->options = get_option( 'wpit-funny-name-generator' );
		add_shortcode( 'jedi-calc', array( $this, 'jedi_calculator' ) );

	}

	
	/**
	 * jedi_calculator function.
	 *
	 * @access public
	 * @return void
	 */
	public function jedi_calculator(){

	//check nonce for security reason
	if ( isset( $_POST['_wpit_jedi'] ) &&  wp_verify_nonce( $_POST['_wpit_jedi'], '_wpit_jedi' ) ){

		if ( ( isset( $_POST['done'] ) ) && ( $_POST['done'] == 'y' ) ) {
		
			/**
			 * nome
			 * 
			 * (default value: sanitize_text_field( $_POST['nome'] ))
			 * 
			 * @var string
			 * @access public
			 */
			$nome = sanitize_text_field( $_POST['nome'] );
			
			/**
			 * cognome
			 * 
			 * (default value: sanitize_text_field( $_POST['cognome'] ))
			 * 
			 * @var string
			 * @access public
			 */
			$cognome = sanitize_text_field( $_POST['cognome'] );
			
			/**
			 * mamma
			 * 
			 * (default value: sanitize_text_field( $_POST['mamma'] ))
			 * 
			 * @var string
			 * @access public
			 */
			$mamma = sanitize_text_field( $_POST['mamma'] );
			
			/**
			 * citta
			 * 
			 * (default value: sanitize_text_field( $_POST['citta'] ))
			 * 
			 * @var string
			 * @access public
			 */
			$citta = sanitize_text_field( $_POST['citta'] );
			
			//Calcolo il nome prendendo le prime tre lettere del cognome e le prime due del nome
			
			/**
			 * jedinome
			 * 
			 * (default value: '')
			 * 
			 * @var string
			 * @access public
			 */
			$jedinome = '';
			
			/**
			 * jedinome
			 * 
			 * @var mixed
			 * @access public
			 */
			$jedinome .= substr( $cognome, 0, 3 );
			
			/**
			 * jedinome
			 * 
			 * @var mixed
			 * @access public
			 */
			$jedinome .= substr( $nome, 0, 2 );
			//Calcolo il cognome prendendo le prime due lettere del cognome della madre e le prime tre della città di nascita
			
			/**
			 * jedisurname
			 * 
			 * (default value: '')
			 * 
			 * @var string
			 * @access public
			 */
			$jedisurname = '';
			
			/**
			 * jedisurname
			 * 
			 * @var mixed
			 * @access public
			 */
			$jedisurname .= substr( $mamma, 0, 2 );
			
			/**
			 * jedisurname
			 * 
			 * @var mixed
			 * @access public
			 */
			$jedisurname .= substr( $citta, 0, 3 );
			
			//Creo il nome jedi mettendo in maiuscolo la prima lettera del nome e del cognome e tutto il resto in minuscolo
			
			/**
			 * jediname
			 * 
			 * (default value: '')
			 * 
			 * @var string
			 * @access public
			 */
			$jediname = '';
			
			/**
			 * jediname
			 * 
			 * @var mixed
			 * @access public
			 */
			$jediname .= sanitize_text_field( ucfirst(strtolower( $jedinome ) ) );
			
			/**
			 * jediname
			 * 
			 * @var mixed
			 * @access public
			 */
			$jediname .= ' ';
			
			/**
			 * jediname
			 * 
			 * @var mixed
			 * @access public
			 */
			$jediname .= sanitize_text_field( ucfirst(strtolower( $jedisurname ) ) );
		}

	}
	
	/**
	 * html
	 * 
	 * (default value: '')
	 * 
	 * @var string
	 * @access public
	 */
	$html = '';

	if ( array_key_exists( '_submit_check', $_POST ) 
		&& ! empty( $_POST['nome'] ) 
		&& ! empty( $_POST['cognome'] ) 
		&& ! empty( $_POST['mamma'] ) 
		&& ! empty( $_POST['citta'] ) ){

		$html .= '<h2>' . __( 'Your Jedi Name is:', 'wpit-funny-name-generator' ) . '</h2>';
		$html .= '<h2>' . $jediname . '</h2>';
		$primaparte 	= __( 'My Jedi name is', 'wpit-funny-name-generator' ) . ' ';
		$secondaparte 	= __( 'find', 'wpit-funny-name-generator' ) . ' ';
		$terzaparte 	= __( 'your on', 'wpit-funny-name-generator' ) . ' ';
		$shorturl 		= get_permalink();

		if ( ! empty( $this->options['twitter'] ) ){

			$twitter_username = sanitize_text_field( ( $this->options['twitter'] ) );

		} else {

			$twitter_username = '';
		}

		$share = $primaparte . $jediname . ' ' . $secondaparte . $terzaparte;

		$twitter_args = array(
			'url'		=> $shorturl,
			'text'		=> $share,
			'username'	=> $twitter_username,
			'hashtags' 	=> 'YourJediName',
			'type'		=> __( 'Jedi name', 'wpit-funny-name-generator' ),
		);
		$html .= get_twitter_button( $twitter_args );
		} else {

			//define variable
			$nome 		= '';
			$cognome 	= '';
			$mamma 		= '';
			$citta 		= '';

			$html .= '<p class="wol-funny-name"><i class="fas fa-exclamation-circle"></i> ' . __( 'All fields are required!', 'wpit-funny-name-generator' ) . '</p>';
			
				$html .= '<form id="form1" method="post">';
				$html .= wp_nonce_field( '_wpit_jedi', '_wpit_jedi', true, false );
				
					$html .= '<div class="row">';
						$html .= '<div class="column left">';
							$html .= __( 'Name ', 'wpit-funny-name-generator' );
						$html .='</div>';
						
						$html .= '<div class="column right">';
							$html .= '<input name="nome" type="text" id="nome" value=""  required/>';
						$html .='</div>';
					$html .='</div>';
					
					$html .= '<div class="row">';
						$html .= '<div class="column left">';
							$html .= __( 'Last Name ', 'wpit-funny-name-generator' );
						$html .='</div>';
						
						$html .= '<div class="column right">';	
							$html .= '<input name="cognome" type="text" id="cognome" value="" required />';
						$html .='</div>';
					$html .='</div>';
					
					$html .= '<div class="row">';
						$html .= '<div class="column left">';
							$html .= __( 'Your mother surname ', 'wpit-funny-name-generator' );
						$html .='</div>';
						
						$html .= '<div class="column right">';
							$html .= '<input name="mamma" type="text" id="mamma" value="" required />';
						$html .='</div>';
					$html .='</div>';

					$html .= '<div class="row">';
						$html .= '<div class="column left">';
							$html .= __( 'City where you were born ', 'wpit-funny-name-generator' );
						$html .='</div>';
						
						$html .= '<div class="column right">';
							$html .= '<input name="citta" type="text" id="citta" value="" required/>';
						$html .='</div>';
					$html .='</div>';
					
				
				
					$html .= '<input type="hidden" name="_submit_check" value="1"/>';
					$html .='<div class="submit-name"><input type="submit" name="Submit" value="' . __( 'Your Jedi name is … ', 'wpit-funny-name-generator' ) . '" /><div>';
					$html .= '<input name="done" type="hidden" value="y" />';
					$html .= '</p>';
					$html .= '</form>';
					
		}

	return $html;

	}


}// chiudo la classe
