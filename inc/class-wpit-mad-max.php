<?php

/**
 * Wpit_Mad_Max class.
 */
class Wpit_Mad_Max {

	//A static member variable representing the class instance
	private static $_instance = null;

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

	private function __construct() {

		$this->options = get_option( 'wpit-funny-name-generator' );
		add_shortcode( 'madmax_calc', array( $this, 'mad_max_generator' ) );


	}

	/**
	 * Wpit_Mad_Max::__clone()
	 * Prevent any object or instance of that class to be cloned
	 *
	 * @return
	 */
	public function __clone() {
		trigger_error( "Cannot clone instance of Singleton pattern ...", E_USER_ERROR );
	}

	/**
	 * Wpit_Mad_Max::__wakeup()
	 * Prevent any object or instance to be deserialized
	 *
	 * @return
	 */
	public function __wakeup() {
		trigger_error( 'Cannot deserialize instance of Singleton pattern ...', E_USER_ERROR );
	}

	/**
	 * Wpit_Mad_Max::getInstance()
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

	public function mad_max_generator(){

	// Calcolo il Nome Mad Max

	//check nonce for security reason
	if ( isset( $_POST['_wpit_mad_max'] ) &&  wp_verify_nonce( $_POST['_wpit_mad_max'], '_wpit_mad_max' ) ){

		if ( (isset($_POST['done'] ) ) && ( $_POST['done'] == 'y' ) ) {
		//name
		$name = strtolower($_POST['nome']);


		$this->lettera = substr( $name, 0, 1 );

		$this->name();

		$madmaxname ='';
		$madmaxname = $this->mad_max_name;

		$cognome = strtolower($_POST['cognome']);
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


		$html .='<strong><h2>' . __( 'Your Mad Max name is: ', 'wpit-funny-name-generator' ) . ' ' . $mad_max . '</h2></strong>';
		$html .="<br />\n";

		$primaparte = __( 'My Mad Max name is ', 'wpit-funny-name-generator' );
		$secondaparte = __( ' find ', 'wpit-funny-name-generator' );
		$terzaparte = __( '&#35;yourMadMaxname on ', 'wpit-funny-name-generator' );
		$shorturl = get_permalink();

		$share = $primaparte . $mad_max . $secondaparte . $terzaparte ;

		if ( ! empty( $this->options['twitter'] ) ){

			$twitter_username = $this->options['twitter'];

		} else {

			$twitter_username = '';
		}


		$html .='<p id="share_links">' . __( 'Share on: ', 'wpit-funny-name-generator' ) . ' ';

		$html .= "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-url=\"$shorturl\" data-text=\"$share\" data-via=\"$twitter_username\" data-hashtags=\"\">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";

		$html .="</p>\n";
	} else {

	//define variable
	$nome = '';
	$cognome = '';

	$html .= __( 'All fields are required!', 'wpit-funny-name-generator' );
	$html .= "<div align=\"left\">\n";
	$html .= "<form id=\"form1\" method=\"post\">\n";
	$html .= wp_nonce_field( '_wpit_mad_max', '_wpit_mad_max', true, false );
	$html .="<p>\n";
	$html .="<label><br />\n";
	$html .= __( 'Name ', 'wpit-funny-name-generator' );
	$html .="<input name=\"nome\" type=\"text\" id=\"nome\" value=\"$nome\" size=\"20\" maxlength=\"50\" />\n";
	$html .="</label>\n";
	$html .="</p>\n";
	$html .="<p>\n";
	$html .="<label><br />\n";
	$html .= __( 'Last Name ', 'wpit-funny-name-generator' );
	$html .="<input name=\"cognome\" type=\"text\" id=\"nome\" value=\"$cognome\" size=\"20\" maxlength=\"50\" />\n";
	$html .="</label>\n";
	$html .="</p>\n";
	$html .="<p>\n";
	$html .="<input type=\"hidden\" name=\"_submit_check\" value=\"1\"/>\n";
	$html .='<input type="submit" name="Submit" value="' . __( 'Your Mad Max name is … ', 'wpit-funny-name-generator' ) . '" />';
	$html .="<input name=\"done\" type=\"hidden\" value=\"y\" />\n";
	$html .="</p>\n";
	$html .="</form>\n";
	$html .="</div>\n";
	$html .="<hr />\n";
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

//istanzio la classe

$wpit_mad_max = Wpit_Mad_Max::getInstance();







