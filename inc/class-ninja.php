<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Wpit_Ninja class.
 */
class Wol_Ninja {

	//A static member variable representing the class instance
	
	var $character;
	var $ninja_letter;
	private $options;



	/**
	 * Wpit_Ninja::__construct()
	 * Locked down the constructor, therefore the class cannot be externally instantiated
	 *
	 * @param array $args various params some overidden by default
	 *
	 * @return
	 */

	public function __construct() {

		$this->options = get_option( 'wpit-funny-name-generator' );

		add_shortcode( 'ninja_calc', array( $this,  'ninja_generator' ) );


	}


	public function ninja_generator(){

	// Calcolo il Nome Jedi
	if ( isset( $_POST['_wpit_ninja'] ) &&  wp_verify_nonce( $_POST['_wpit_ninja'], '_wpit_ninja' ) ){

	 	if ((isset($_POST['done'])) && ($_POST['done'] == 'y')) {

			$nome = strtolower( sanitize_text_field( $_POST['nome'] ) );
			$ninjaname ='';


			for( $i=0; $i < strlen( $nome ); $i++ ){

				$this->character = $nome[$i];

				$this->letter();

				$ninjaname .= $this->ninja_letter;

	 		}
		}

	//Metto in Maiuscolo la prima lettera
	$ninjaname = ucfirst(strtolower( sanitize_text_field( $ninjaname ) ) );

	}

	//Inizializzo l'html finale dello shortcode
	$html = '';

	if ( array_key_exists('_submit_check', $_POST ) && ! empty( $_POST['nome'] ) ) {

	$html .='<h2>' . __( 'Your Ninja name is ', 'wpit-funny-name-generator' ) . '</h2>';
	$html .='<h2>' . $ninjaname . '</h2>';
	$primaparte 	= __( 'My Ninja name is', 'wpit-funny-name-generator' ) . ' ';
	$secondaparte 	= __( 'find', 'wpit-funny-name-generator' ) . ' ';
	$terzaparte 	= __( 'your on', 'wpit-funny-name-generator' ) . ' ';
	$shorturl 		= get_permalink();
	$share 			= $primaparte . $ninjaname . ' ' . $secondaparte . $terzaparte ;


		if ( ! empty( $this->options['twitter'] ) ){

			$twitter_username = sanitize_text_field( $this->options['twitter'] );

		} else {

			$twitter_username = '';
		}

	$twitter_args = array(
			'url'		=> $shorturl,
			'text'		=> $share,
			'username'	=> $twitter_username,
			'hashtags' 	=> 'YourNinjaName',
			'type'		=> __( 'Ninja name', 'wpit-funny-name-generator' ),
		);
		$html .= get_twitter_button( $twitter_args );

	} else {

	//define variable
	$nome = '';
	$html .= '<p class="wol-funny-name"><i class="fas fa-exclamation-circle"></i> ' . __( 'All fields are required!', 'wpit-funny-name-generator' ) . '</p>';
	
		$html .= '<form id="form1" method="post">';
		$html .= wp_nonce_field( '_wpit_ninja', '_wpit_ninja', true, false );
	
			$html .= '<div class="row">';
				$html .= '<div class="column left">';
					$html .= __( 'Name ', 'wpit-funny-name-generator' );
				$html .='</div>';	
				
				$html .= '<div class="column right">';	
					$html .= '<input name="nome" type="text" id="nome" value=""  required/>';
				$html .='</div>';
			$html .='</div>';
			
	$html .= '<input type="hidden" name="_submit_check" value="1"/>';
	$html .= '<div class="submit-name"><input type="submit" name="Submit" value="' . __( 'Your Ninja name is… ', 'wpit-funny-name-generator' ) . '" /></div>';
	$html .= '<input name="done" type="hidden" value="y" />';
	
	$html .= '</form>';
	
	$html .= '<hr />';	}
	return $html;
	}

	private function letter() {

		switch( $this->character ){
			case 'a':
				$this->ninja_letter = 'ka';
			case 'b':
				$this->ninja_letter = 'zu';
				break;
			case 'c':
				$this->ninja_letter = 'mi';
				break;
			case 'd':
				$this->ninja_letter = 'te';
				break;
			case 'e':
				$this->ninja_letter = 'ku';
				break;
			case 'f':
				$this->ninja_letter = 'lu';
				break;
			case 'g':
				$this->ninja_letter = 'ji';
				break;
			case 'h':
				$this->ninja_letter = 'ri';
				break;
			case 'i':
				$this->ninja_letter = 'ki';
				break;
			case 'j':
				$this->ninja_letter = 'zus';
				break;
			case 'k':
				$this->ninja_letter = 'me';
				break;
			case 'l':
				$this->ninja_letter = 'ta';
				break;
			case 'm':
				$this->ninja_letter = 'rin';
				break;
			case 'n':
				$this->ninja_letter = 'to';
				break;
			case 'o':
				$this->ninja_letter = 'mo';
				break;
			case 'p':
				$this->ninja_letter = 'no';
				break;
			case 'q':
				$this->ninja_letter = 'ke';
				break;
			case 'r':
				$this->ninja_letter = 'shi';
				break;
			case 's':
				$this->ninja_letter = 'Fari';
				break;
			case 't':
				$this->ninja_letter = 'chi';
				break;
			case 'u':
				$this->ninja_letter = 'do';
				break;
			case 'v':
				$this->ninja_letter = 'ru';
				break;
			case 'w':
				$this->ninja_letter = 'mei';
				break;
			case 'x':
				$this->ninja_letter = 'na';
				break;
			case 'y':
				$this->ninja_letter = 'fu';
				break;
			case 'z':
				$this->ninja_letter = 'zi';
				break;
		}

	}



}// chiudo la classe


