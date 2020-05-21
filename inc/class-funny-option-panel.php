<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}	

/**
 * Wpit_Funny_Name_Options_Page class.
 */
class Wol_Funny_Name_Options_Page
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            __( 'Funny Name Generator Settings', 'wpit-funny-name-generator' ),
            __( 'Funny Name Generator Settings', 'wpit-funny-name-generator' ),
            'manage_options',
            'wpit-funny-name-generator',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'wpit-funny-name-generator' );
        ?>
        <div class="wrap">
            <h2><?php _e( 'Funny Name Generator Settings', 'wpit-funny-name-generator' ); ?></h2>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'wpit-funny-name-generator_option_group' ); //option group
                do_settings_sections( 'wpit-funny-name-generator-setting-admin' ); //my settings admin
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'wpit-funny-name-generator_option_group', // Option group
            'wpit-funny-name-generator', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_1', // ID
            __( 'Funny name generator custom settings', 'wpit-funny-name-generator' ), // Title
            array( $this, 'print_section_info' ), // Callback
            'wpit-funny-name-generator-setting-admin' // Page
        );

        add_settings_field(
            'twitter', // ID
            __( 'Your Twitter username', 'wpit-funny-name-generator' ), // Title
            array( $this, 'twitter' ), // Callback
            'wpit-funny-name-generator-setting-admin', // Page
            'setting_section_1' // Section
        );

		add_settings_section(
            'setting_section_2', // ID
            __( 'Funny name generator How To', 'wpit-funny-name-generator' ), // Title
            array( $this, 'print_section_how_to' ), // Callback
            'wpit-funny-name-generator-setting-admin' // Page
        );

        add_settings_field(
            'shortcodes', // ID
            __( 'Available  Shortcodes', 'wpit-funny-name-generator' ), // Title
            array( $this, 'shortcodes' ), // Callback
            'wpit-funny-name-generator-setting-admin', // Page
            'setting_section_2' // Section
        );


    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['twitter'] ) )
            $new_input['twitter'] = sanitize_text_field( $input['twitter'] );


        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print _e( 'Enter your settings below:', 'wpit-funny-name-generator' ) ;
    }

    /**
     * Print the Section text
     */
    public function print_section_how_to()
    {
        print _e( 'How to use the funny name generator', 'wpit-funny-name-generator' ) ;
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function twitter()
    {
        printf(
            '<input type="text" id="twitter" name="wpit-funny-name-generator[twitter]" value="%s" />',
            isset( $this->options['twitter'] ) ? esc_attr( $this->options['twitter']) : ''
        );

    }

    public function shortcodes()
    {

        print _e( 'Insert one shortcode in a page, post or custom post type.<br /> You can only use one shortcode in each page, post or custom post type.<br />', 'wpit-funny-name-generator' );

        print _e( 'In order to generate ninja name use <code>[ninja_calc]</code> shortcode, Jedi name use <code>[jedi-calc]</code> shortcode, Mad Max name use <code>[madmax_calc]</code> shortcode and Unicorn name use <code>[unicorn_calc]</code> shortcode.)', 'wpit-funny-name-generator' );

    }

   }
