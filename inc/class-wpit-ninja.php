<?php

/**
 * Wpit_Ninja class.
 */
class Wpit_Ninja {

	//A static member variable representing the class instance
	private static $_instance = null;
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

	private function __construct() {

		$this->options = get_option( 'wpit-funny-name-generator' );

		add_shortcode( 'ninja_calc', array( $this,  'ninja_generator' ) );


	}

	/**
	 * Wpit_Ninja::__clone()
	 * Prevent any object or instance of that class to be cloned
	 *
	 * @return
	 */
	public function __clone() {
		trigger_error( "Cannot clone instance of Singleton pattern ...", E_USER_ERROR );
	}

	/**
	 * Wpit_Ninja::__wakeup()
	 * Prevent any object or instance to be deserialized
	 *
	 * @return
	 */
	public function __wakeup() {
		trigger_error( 'Cannot deserialize instance of Singleton pattern ...', E_USER_ERROR );
	}

	/**
	 * Wpit_Ninja::getInstance()
	 * Have a single globally accessible static method
	 *
	 * @param mixed $args
	 *
	 * @return
	 */
	public static function getInstance( $args = array() ) {
		if ( ! is_object( self::$_instance ) )
			self::$_instance = new self( $args );

		return self::$_instance;


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

	$html .='<strong><h2>' . __( 'Your Ninja name is ', 'wpit-funny-name-generator' ) . ' ' . $ninjaname . '</h2></strong>';
	$html .="<br />\n";

	$primaparte = __( 'My Ninja name is ', 'wpit-funny-name-generator' );
	$secondaparte = __( ' find ', 'wpit-funny-name-generator' );
	$terzaparte = __( '&#35;YourNinjaName on ', 'wpit-funny-name-generator' );
	$shorturl = get_permalink();
	$share = $primaparte . $ninjaname . $secondaparte . $terzaparte ;


		if ( ! empty( $this->options['twitter'] ) ){

			$twitter_username = sanitize_text_field( $this->options['twitter'] );

		} else {

			$twitter_username = '';
		}

	$html .='<p id="share_links">' . __( 'Share on: ', 'wpit-funny-name-generator' ) . ' ';

	$html .= "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-url=\"$shorturl\" data-text=\"$share\" data-via=\"$twitter_username\" data-hashtags=\"\">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";


	//$html .="<a id=\"share_tw\" href=\"http://twitter.com/home?status=$share\" title=\"Tweet this!\" \">Twitter</a>\n";
	//$html .="<a id=\"share_ff\" href=\"http://friendfeed.com/share/bookmarklet/frame#title=$share\" title=\"Share on Friendfeed\"\">FriendFeed</a>\n";
	$html .="</p>\n";

	} else {

	//define variable
	$nome = '';
	$html .= __( 'All fields are required!', 'wpit-funny-name-generator' );
	$html .= "<div align=\"left\">\n";
	$html .= "<form id=\"form1\" method=\"post\">\n";
	$html .= wp_nonce_field( '_wpit_ninja', '_wpit_ninja', true, false );
	$html .="<p>\n";
	$html .="<label><br />\n";
	$html .= __( 'Name ', 'wpit-funny-name-generator' );
	$html .="<input name=\"nome\" type=\"text\" id=\"nome\" value=\"$nome\" size=\"20\" maxlength=\"50\" />\n";
	$html .="</label>\n";
	$html .="</p>\n";
	$html .="<p>\n";
	$html .="<input type=\"hidden\" name=\"_submit_check\" value=\"1\"/>\n";
	$html .='<input type="submit" name="Submit" value="' . __( 'Your Ninja name is … ', 'wpit-funny-name-generator' ) . '" />';
	$html .="<input name=\"done\" type=\"hidden\" value=\"y\" />\n";
	$html .="</p>\n";
	$html .="</form>\n";
	$html .="</div>\n";
	$html .="<hr />\n";
	}
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

//istanzio la classe

$wpit_ninja = Wpit_Ninja::getInstance();



