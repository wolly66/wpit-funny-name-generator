<?php


/**
 * Wpit_Jedy class.
 */
class Wpit_Jedy {

	//A static member variable representing the class instance
	private static $_instance = null;

	private $options;

	/**
	 * Wpit_Jedy::__construct()
	 * Locked down the constructor, therefore the class cannot be externally instantiated
	 *
	 * @param array $args various params some overidden by default
	 *
	 * @return
	 */
	private function __construct() {


		$this->options = get_option( 'wpit-funny-name-generator' );
		add_shortcode( 'jedi-calc', array( $this, 'jedi_calculator' ) );

	}

	/**
	 * Wpit_Jedy::__clone()
	 * Prevent any object or instance of that class to be cloned
	 *
	 * @return
	 */
	public function __clone() {
		trigger_error( 'Cannot clone instance of Singleton pattern ...', E_USER_ERROR );
	}

	/**
	 * Wpit_Jedy::__wakeup()
	 * Prevent any object or instance to be deserialized
	 *
	 * @return
	 */
	public function __wakeup() {
		trigger_error( 'Cannot deserialize instance of Singleton pattern ...', E_USER_ERROR );
	}

	/**
	 * Wpit_Jedy::getInstance()
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

			$nome = $_POST['nome'];
			$cognome = $_POST['cognome'];
			$mamma = $_POST['mamma'];
			$citta = $_POST['citta'];
				//Calcolo il nome prendendo le prime tre lettere del cognome e le prime due del nome
				$jedinome = '';
				$jedinome .= substr($cognome, 0, 3);
				$jedinome .= substr($nome, 0, 2);
				//Calcolo il cognome prendendo le prime due lettere del cognome della madre e le prime tre della città di nascita
				$jedisurname = '';
				$jedisurname .= substr($mamma, 0, 2);
				$jedisurname .= substr($citta, 0, 3);
					//Creo il nome jedi mettendo in maiuscolo la prima lettera del nome e del cognome e tutto il resto in minuscolo
					$jediname = '';
					$jediname .= ucfirst(strtolower($jedinome));
					$jediname .= ' ';
					$jediname .= ucfirst(strtolower($jedisurname));
		}

	}
	//Inizializzo l'html finale dello shortcode
	$html = '';

	if ( array_key_exists( '_submit_check', $_POST ) && ! empty( $_POST['nome'] ) && ! empty( $_POST['cognome'] ) && ! empty( $_POST['mamma'] ) && ! empty( $_POST['citta'] ) ){

		$html .="<strong><h2>" . __( 'Your Jedi Name is ', 'wpit-funny-name-generator' ) . " $jediname </h2></strong>\n";
		$html .="<br />\n";

		$primaparte = __( 'My Jedi name is ', 'wpit-funny-name-generator' );
		$secondaparte = __( ' find ', 'wpit-funny-name-generator' );
		$terzaparte = __( '&#35;yourjediname on ', 'wpit-funny-name-generator' );
		$shorturl = get_permalink();

		if ( ! empty( $this->options['twitter'] ) ){

			$twitter_username = $this->options['twitter'];

		} else {

			$twitter_username = '';
		}

		$share = $primaparte . $jediname . $secondaparte . $terzaparte;


		$html .='<p id="share_links">' . __( 'Share on: ', 'wpit-funny-name-generator' ) . ' ';

		$html .= "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-url=\"$shorturl\" data-text=\"$share\" data-via=\"$twitter_username\" data-hashtags=\"\">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";

		$html .="</p>\n";

		} else {

			//define variable
			$nome = '';
			$cognome = '';
			$mamma = '';
			$citta = '';

			$html .= __( 'All fields are required!', 'wpit-funny-name-generator' );
			$html .= "<div align=\"left\">\n";
				$html .= "<form id=\"form1\" method=\"post\">\n";
				$html .= wp_nonce_field( '_wpit_jedi', '_wpit_jedi', true, false );
				$html .= "<p>\n";
					$html .= "<label><br />\n";
					$html .= __( 'Name ', 'wpit-funny-name-generator' );
					$html .= "<input name=\"nome\" type=\"text\" id=\"nome\" value=\"$nome\" size=\"20\" maxlength=\"50\" />\n";
					$html .= "</label>\n";
					$html .= "<br />\n";
					$html .= "<label>\n";
					$html .= "<br />\n";
					$html .= __( 'Last Name ', 'wpit-funny-name-generator' );
					$html .= "<input name=\"cognome\" type=\"text\" id=\"cognome\" value=\"$cognome\" size=\"20\" maxlength=\"50\" />\n";
					$html .= "<br />\n";
					$html .= "</label>\n";
					$html .= "<br />\n";
					$html .= "<label>";
					$html .= __( 'Your mother surname ', 'wpit-funny-name-generator' );
					$html .= "<input name=\"mamma\" type=\"text\" id=\"mamma\" value=\"$mamma\" size=\"20\" maxlength=\"50\" />\n";
					$html .= "<br />\n";
					$html .= "</label>\n";
					$html .= "<br />\n";
					$html .= "<label>";
					$html .= __( 'City where you were born ', 'wpit-funny-name-generator' );
					$html .= "<input name=\"citta\" type=\"text\" id=\"citta\" value=\"$citta\" size=\"20\" maxlength=\"50\" />\n";
					$html .= "<br />\n";
					$html .= "</label>\n";
				$html .= "</p>\n";
				$html .= "<p>\n";
					$html .= "<input type=\"hidden\" name=\"_submit_check\" value=\"1\"/>\n";
					$html .='<input type="submit" name="Submit" value="' . __( 'Your Jedi name is … ', 'wpit-funny-name-generator' ) . '" />';
					$html .= "<input name=\"done\" type=\"hidden\" value=\"y\" />\n";
					$html .= "</p>\n";
					$html .= "</form>\n";
					$html .= "</div>\n";
				$html .= "<hr />\n";
		}

	return $html;

	}


}// chiudo la classe

//istanzio la classe

$wpit_jedy = Wpit_Jedy::getInstance();