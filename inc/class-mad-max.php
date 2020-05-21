<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Wpit_Mad_Max class.
 */
class Wol_Mad_Max {

	var $lettera;
	var $mad_max_name;
	var $mad_max_last_name;
	private $options;



	/**
	 * Wpit_Mad_Max::__construct()
	 * Locked down the constructor, therefore the class cannot be externally instantiated
	 *
	 * @param array $args various params some overidden by default
	 *
	 * @return
	 */

	public function __construct() {

		$this->options = get_option( 'wpit-funny-name-generator' );
		add_shortcode( 'madmax_calc', array( $this, 'mad_max_generator' ) );


	}

	public function mad_max_generator(){

	// Calcolo il Nome Mad Max

	//check nonce for security reason
	if ( isset( $_POST['_wpit_mad_max'] ) &&  wp_verify_nonce( $_POST['_wpit_mad_max'], '_wpit_mad_max' ) ){

		if ( (isset($_POST['done'] ) ) && ( $_POST['done'] == 'y' ) ) {
		//name
		$name = strtolower( sanitize_text_field ( $_POST['nome'] ) );


		$this->lettera = substr( $name, 0, 1 );

		$this->name();

		$madmaxname ='';
		$madmaxname = $this->mad_max_name;

		$cognome = strtolower( sanitize_text_field( $_POST['cognome'] ) );

		$this->lettera = substr( $cognome, 0, 1 );

		$this->last_name();

		$madmaxlastname ='';

   		$madmaxlastname = $this->mad_max_last_name;

   		$mad_max = $madmaxname . ' ' . $madmaxlastname;

	}
	}
	//Inizializzo l'html finale dello shortcode
	$html = '';

	if ( array_key_exists( '_submit_check', $_POST ) && ! empty( $_POST['nome'] ) && ! empty( $_POST['cognome'] ) ) {


		$html .= '<h2>' . __( 'Your Mad Max name is:', 'wpit-funny-name-generator' ) . '</h2>';
		$html .= '<h2>' . $mad_max . '</h2>';
		
		$primaparte 	= __( 'My Mad Max name is', 'wpit-funny-name-generator' ) . ' ';
		$secondaparte 	= __( 'find', 'wpit-funny-name-generator' ) . ' ';
		$terzaparte 	= __( 'your on', 'wpit-funny-name-generator' ) . ' ';
		$shorturl 		= get_permalink();

		$share = $primaparte . $mad_max . ' ' . $secondaparte . $terzaparte ;

		if ( ! empty( $this->options['twitter'] ) ){

			$twitter_username = sanitize_text_field( $this->options['twitter'] );

		} else {

			$twitter_username = '';
		}
		
		$twitter_args = array(
			'url'		=> $shorturl,
			'text'		=> $share,
			'username'	=> $twitter_username,
			'hashtags' 	=> 'YourMadMaxName',
			'type'		=> __( 'Mad Max name', 'wpit-funny-name-generator' ),
		);
		$html .= get_twitter_button( $twitter_args );

			} else {

	//define variable
	$nome = '';
	$cognome = '';

	$html .= '<p class="wol-funny-name"><i class="fas fa-exclamation-circle"></i> ' . __( 'All fields are required!', 'wpit-funny-name-generator' ) . '</p>';
	
		$html .= '<form id="form1" method="post">';
		$html .= wp_nonce_field( '_wpit_mad_max', '_wpit_mad_max', true, false );
	
			$html .= '<div class="row">';
				$html .= '<div class="column left">';
					$html .= __( 'Name ', 'wpit-funny-name-generator' );
				$html .='</div>';
						
				$html .= '<div class="column right">';
					$html .='<input name="nome" type="text" id="nome" value=""  required/>';
				$html .='</div>';
			$html .='</div>';
			
			$html .= '<div class="row">';
				$html .= '<div class="column left">';
					$html .= __( 'Last Name ', 'wpit-funny-name-generator' );
				$html .='</div>';
						
				$html .= '<div class="column right">';
					$html .='<input name="cognome" type="text" id="nome" value="" required/>';
				$html .='</div>';
			$html .='</div>';
			
			$html .='<input type="hidden" name="_submit_check" value="1"/>';
			$html .='<div class="submit-name"><input type="submit" name="Submit" value="' . __( 'Your Mad Max name is… ', 'wpit-funny-name-generator' ) . '" /></div>';
			$html .='<input name="done" type="hidden" value="y" />';
	
	$html .='</form>';
	
	$html .='<hr />';
	}
	return $html;
	}

	private function name() {

		switch( $this->lettera ){
			case 'a':
				$this->mad_max_name = 'MASTER';
				break;
			case 'b':
				$this->mad_max_name = 'GENERAL';
				break;
			case 'c':
				$this->mad_max_name = 'THE BIG';
				break;
			case 'd':
				$this->mad_max_name = 'JOHNNY';
				break;
			case 'e':
				$this->mad_max_name = 'CUTTER';
				break;
			case 'f':
				$this->mad_max_name = 'MISSES';
				break;
			case 'g':
				$this->mad_max_name = 'THE YOUTH';
				break;
			case 'h':
				$this->mad_max_name = 'JEDEDIAH';
				break;
			case 'i':
				$this->mad_max_name = 'MECHANIC';
				break;
			case 'j':
				$this->mad_max_name = 'THE SPLENDID';
				break;
			case 'k':
				$this->mad_max_name = 'DAG';
				break;
			case 'l':
				$this->mad_max_name = 'AUNTY';
				break;
			case 'm':
				$this->mad_max_name = 'GYRO';
				break;
			case 'n':
				$this->mad_max_name = 'FERESA';
				break;
			case 'o':
				$this->mad_max_name = 'PIG';
				break;
			case 'p':
				$this->mad_max_name = 'BLASTER';
				break;
			case 'q':
				$this->mad_max_name = 'TOADIE';
				break;
			case 'r':
				$this->mad_max_name = 'LORD';
				break;
			case 's':
				$this->mad_max_name = 'FERAL';
				break;
			case 't':
				$this->mad_max_name = 'CAPABLE';
				break;
			case 'u':
				$this->mad_max_name = 'BUBBA';
				break;
			case 'v':
				$this->mad_max_name = 'IMPERATOR';
				break;
			case 'w':
				$this->mad_max_name = 'DOCTOR';
				break;
			case 'x':
				$this->mad_max_name = 'CLUNK';
				break;
			case 'y':
				$this->mad_max_name = 'METALLIC';
				break;
			case 'z':
				$this->mad_max_name = 'LEGION';
				break;
		}


	}

	private function last_name() {

		switch( $this->lettera ){
			case 'a':
				$this->mad_max_last_name = 'BUCKLE';
				break;
			case 'b':
				$this->mad_max_last_name = 'LOCK';
				break;
			case 'c':
				$this->mad_max_last_name = 'BULLET';
				break;
			case 'd':
				$this->mad_max_last_name = 'KILLER';
				break;
			case 'e':
				$this->mad_max_last_name = 'COLT';
				break;
			case 'f':
				$this->mad_max_last_name = 'SLIT';
				break;
			case 'g':
				$this->mad_max_last_name = 'THE WARRIOR';
				break;
			case 'h':
				$this->mad_max_last_name = 'DEALGOOD';
				break;
			case 'i':
				$this->mad_max_last_name = 'CHROME';
				break;
			case 'j':
				$this->mad_max_last_name = 'NIX';
				break;
			case 'k':
				$this->mad_max_last_name = 'ENTITY';
				break;
			case 'l':
				$this->mad_max_last_name = 'ERECTUS';
				break;
			case 'm':
				$this->mad_max_last_name = 'AMAZON';
				break;
			case 'n':
				$this->mad_max_last_name = 'THE BOY';
				break;
			case 'o':
				$this->mad_max_last_name = 'VICIOUS';
				break;
			case 'p':
				$this->mad_max_last_name = 'STORM';
				break;
			case 'q':
				$this->mad_max_last_name = 'MOHAWK';
				break;
			case 'r':
				$this->mad_max_last_name = 'PROTON';
				break;
			case 's':
				$this->mad_max_last_name = 'COMA';
				break;
			case 't':
				$this->mad_max_last_name = 'THE KEEPER';
				break;
			case 'u':
				$this->mad_max_last_name = 'KNUCKLESS';
				break;
			case 'v':
				$this->mad_max_last_name = 'NIGHTRIDER';
				break;
			case 'w':
				$this->mad_max_last_name = 'IRONBAR';
				break;
			case 'x':
				$this->mad_max_last_name = 'BLACKFINGER';
				break;
			case 'y':
				$this->mad_max_last_name = 'DOG';
				break;
			case 'z':
				$this->mad_max_last_name = 'JOE';
				break;
		}

	}


}// chiudo la classe


