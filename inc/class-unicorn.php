<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Wpit_Unicorn class.
 */
class Wol_Unicorn {

	
	var $mont_nr;
	var $unicorn_name;
	var $unicorn_mont;
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
		add_shortcode( 'unicorn_calc', array( $this, 'unicorn_generator' ) );


	}

	
	public function unicorn_generator(){

	// Calcolo il Nome Mad Max

	//check nonce for security reason
	if ( isset( $_POST['_wpit_unicorn'] ) &&  wp_verify_nonce( $_POST['_wpit_unicorn'], '_wpit_unicorn' ) ){

		if ( (isset($_POST['done'] ) ) && ( $_POST['done'] == 'y' ) ) {
		//name
		$name = strtolower( sanitize_text_field ( $_POST['nome'] ) );


		$this->lettera = substr( $name, 0, 1 );

		$this->name();

		$unicornname ='';
		$unicornname = $this->unicorn_name;
		
		
		$unicornlastname = $this->month( $_POST['mese'] );
		

   		$unicorn = $unicornname . ' ' . $unicornlastname;

	}
	}
	//Inizializzo l'html finale dello shortcode
	$html = '';

	if ( array_key_exists( '_submit_check', $_POST ) && ! empty( $_POST['nome'] ) && ! empty ( $_POST['mese'] ) ) {


		$html .= '<h2>' . __( 'Your Unicorn name is: ', 'wpit-funny-name-generator' ) . '</h2>';
		$html .= '<h2>' . $unicorn . '</h2>';

		$primaparte = __( 'My Unicorn name is', 'wpit-funny-name-generator' ) . ' ';
		$secondaparte = __( 'find', 'wpit-funny-name-generator' ) . ' ';
		$terzaparte = __( 'your on', 'wpit-funny-name-generator' ) . ' ';
		$shorturl = get_permalink();

		$share = $primaparte . $unicorn . ' ' . $secondaparte . $terzaparte ;

		if ( ! empty( $this->options['twitter'] ) ){

			$twitter_username = sanitize_text_field( $this->options['twitter'] );

		} else {

			$twitter_username = '';
		}


		$twitter_args = array(
			'url'		=> $shorturl,
			'text'		=> $share,
			'username'	=> $twitter_username,
			'hashtags' 	=> 'YourUnicornName',
			'type'		=> __( 'Unicorn name', 'wpit-funny-name-generator' ),
		);
		$html .= get_twitter_button( $twitter_args );
		
	} else {

	//define variable
	$nome = '';
	$cognome = '';

	$html .= '<p class="wol-funny-name"><i class="fas fa-exclamation-circle"></i> ' . __( 'All fields are required!', 'wpit-funny-name-generator' ) . '</p>';
	
		$html .= '<form id="form1" method="post">';
		$html .= wp_nonce_field( '_wpit_unicorn', '_wpit_unicorn', true, false );
		
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
					$html .=__( 'Your month born ', 'wpit-funny-name-generator' );				
				$html .='</div>';
				
				$html .= '<div class="column right">';
					$html .= '<select name="mese" id="mese" required>';
						$html .= '<option value="">' . __( 'Select your month born', 'wpit-funny-name-generator' ) . '</option>';
						foreach ( $this->month_array() as $key => $m ){
							$html .= '<option value="' . $key . '">' . $m . '</option>';
						}
					$html .= '</select>';
				$html .='</div>';
			$html .='</div>';	
		
			$html .='<input type="hidden" name="_submit_check" value="1"/>';
			$html .='<div class="submit-name"><input type="submit" name="Submit" value="' . __( 'Your Unicorn name is… ', 'wpit-funny-name-generator' ) . '" /></div>';
			$html .='<input name="done" type="hidden" value="y" />';
			
		$html .='</form>';
	
	$html .='<hr />';
	
	}
	return $html;
	}

	private function name() {

		switch( $this->lettera ){
			case 'a':
				$this->unicorn_name = 'Perky';
				break;
			case 'b':
				$this->unicorn_name = 'Bubbles';
				break;
			case 'c':
				$this->unicorn_name = 'Sugar';
				break;
			case 'd':
				$this->unicorn_name = 'Shiny';
				break;
			case 'e':
				$this->unicorn_name = 'Sunshine';
				break;
			case 'f':
				$this->unicorn_name = 'Twinkle';
				break;
			case 'g':
				$this->unicorn_name = 'Chipper';
				break;
			case 'h':
				$this->unicorn_name = 'Sunny';
				break;
			case 'i':
				$this->unicorn_name = 'Tubular';
				break;
			case 'j':
				$this->unicorn_name = 'Jolly';
				break;
			case 'k':
				$this->unicorn_name = 'Colourful';
				break;
			case 'l':
				$this->unicorn_name = 'Happy';
				break;
			case 'm':
				$this->unicorn_name = 'Merry';
				break;
			case 'n':
				$this->unicorn_name = 'Crazy';
				break;
			case 'o':
				$this->unicorn_name = 'Awesome';
				break;
			case 'p':
				$this->unicorn_name = 'Silly';
				break;
			case 'q':
				$this->unicorn_name = 'Rainbow';
				break;
			case 'r':
				$this->unicorn_name = 'Dashing';
				break;
			case 's':
				$this->unicorn_name = 'Sassy';
				break;
			case 't':
				$this->unicorn_name = 'Glamourous';
				break;
			case 'u':
				$this->unicorn_name = 'Giddy';
				break;
			case 'v':
				$this->unicorn_name = 'Lively';
				break;
			case 'w':
				$this->unicorn_name = 'Lovely';
				break;
			case 'x':
				$this->unicorn_name = 'Magnificent';
				break;
			case 'y':
				$this->unicorn_name = 'Whacky';
				break;
			case 'z':
				$this->unicorn_name = 'Zany';
				break;
		}


	}

	private function month( $mese ) {
		
		$mese_name = '';
		
		switch( $mese ){
			case '1':
				$mese_name = 'Twinkle Toes';
				break;
			case '2':
				$mese_name = 'Sugar Socks';
				break;
			case '3':
				$mese_name = 'Tickled Pink';
				break;
			case '4':
				$mese_name = 'Happy Feet';
				break;
			case '5':
				$mese_name = 'Yellow Banana';
				break;
			case '6':
				$mese_name = 'Floating Bubbles';
				break;
			case '7':
				$mese_name = 'Prancing Unicorn';
				break;
			case '8':
				$mese_name = 'Blue Berry';
				break;
			case '9':
				$mese_name = 'Orange Creamsicle';
				break;
			case '10':
				$mese_name = 'Fluffy Tutu';
				break;
			case '11':
				$mese_name = 'Fancy Feet';
				break;
			case '12':
				$mese_name = 'Oompa Loompa';
				break;
				
			
		}
		return $mese_name;

	}
	
	private function month_array(){
		
		$months = array(
			'1' 	=> __( 'Jan', 'wpit-funny-name-generator' ), 
			'2' 	=> __( 'Feb', 'wpit-funny-name-generator' ), 
			'3' 	=> __( 'Mar', 'wpit-funny-name-generator' ), 
			'4' 	=> __( 'Apr', 'wpit-funny-name-generator' ), 
			'5'		=> __( 'May', 'wpit-funny-name-generator' ), 
			'6' 	=> __( 'Jun', 'wpit-funny-name-generator' ), 
			'7' 	=> __( 'Jul', 'wpit-funny-name-generator' ), 
			'8' 	=> __( 'Aug', 'wpit-funny-name-generator' ), 
			'9' 	=> __( 'Sep', 'wpit-funny-name-generator' ), 
			'10' 	=> __( 'Oct', 'wpit-funny-name-generator' ), 
			'11' 	=> __( 'Nov', 'wpit-funny-name-generator' ), 
			'12' 	=> __( 'Dec', 'wpit-funny-name-generator' )
			);
			
		return $months;
	}
	


}// chiudo la classe






