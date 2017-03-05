<?php
/**
 * WordPress Widget Boilerplate
 *
 * The WordPress Widget Boilerplate is an organized, maintainable boilerplate for building widgets using WordPress best practices.
 *
 * @package   Widget_Test_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 *
 * @wordpress-plugin
 * Plugin Name:       pluginwidgetname_bananas
 * Plugin URI:        pluginwidgetname_bananas
 * Description:       pluginwidgetname_bananas_description
 * Version:           1.0.0
 * Author:            NOAH_SHUTTY
 * Author URI:        @TODO
 * Text Domain:       widgetname
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /lang
 * GitHub Plugin URI: https://github.com/<owner>/<repo>
 */

 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
    exit;
}


// Can change 'Widget_Test_Name' to the name of your plugin
class Widget_Test_Name_bananas extends WP_Widget {

    /**
     * @TODO - Rename "widget-name" to the name your your widget
     *
     * Unique identifier for your widget.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * widget file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $widget_slug = 'widgetname_bananas';

    /*--------------------------------------------------*/
    /* Constructor
    /*--------------------------------------------------*/

    /**
     * Specifies the classname and description, instantiates the widget,
     * loads localization files, and includes necessary stylesheets and JavaScript.
     */
    public function __construct() {

        // load plugin text domain
        add_action( 'init', array( $this, 'widget_textdomain' ) );

        // Hooks fired when the Widget is activated and deactivated
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        // TODO: update description
        parent::__construct(
            $this->get_widget_slug(),
            __( 'BananaNotifyWidget_bananas', $this->get_widget_slug() ),
            array(
                'classname'  => $this->get_widget_slug().'-class',
                'description' => __( 'Short description of the widget goes here.', $this->get_widget_slug() )
            )
        );

        // Register admin styles and scripts
        add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

        // Register site styles and scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

        // Refreshing the widget's cached output with each new post
        add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
        add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

    } // end constructor


    /**
     * Return the widget slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_widget_slug() {
        return $this->widget_slug;
    }

    /*--------------------------------------------------*/
    /* Widget API Functions
    /*--------------------------------------------------*/

    /**
     * Outputs the content of the widget.
     *
     * @param array args  The array of form elements
     * @param array instance The current instance of the widget
     */
    public function widget( $args, $instance ) {


        // Check if there is a cached output
        $cache = wp_cache_get( $this->get_widget_slug(), 'widget' );

        if ( !is_array( $cache ) )
            $cache = array();

        if ( ! isset ( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset ( $cache[ $args['widget_id'] ] ) )
            return print $cache[ $args['widget_id'] ];

        // go on with your widget logic, put everything into a string and …


        extract( $args, EXTR_SKIP );

        $widget_string = $before_widget;

        // TODO: Here is where you manipulate your widget's values based on their input fields
        ob_start();
        include( plugin_dir_path( __FILE__ ) . 'views/widget.php' );
        $widget_string .= ob_get_clean();
        $widget_string .= $after_widget;


        $cache[ $args['widget_id'] ] = $widget_string;

        wp_cache_set( $this->get_widget_slug(), $cache, 'widget' );

        print $widget_string;

    } // end widget


    public function flush_widget_cache()
    {
        wp_cache_delete( $this->get_widget_slug(), 'widget' );
    }
    /**
     * Processes the widget's options to be saved.
     *
     * @param array new_instance The new instance of values to be generated via the update.
     * @param array old_instance The previous instance of values before the update.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        // TODO: Here is where you update your widget's old values with the new, incoming values

        return $instance;

    } // end widget

    /**
     * Generates the administration form for the widget.
     *
     * @param array instance The array of keys and values for the widget.
     */
    public function form( $instance ) {

        // TODO: Define default values for your variables
        $instance = wp_parse_args(
            (array) $instance
        );

        // TODO: Store the values of the widget in their own variable

        // Display the admin form
        include( plugin_dir_path(__FILE__) . 'views/admin.php' );

    } // end form

    /*--------------------------------------------------*/
    /* Public Functions
    /*--------------------------------------------------*/

    /**
     * Loads the Widget's text domain for localization and translation.
     */
    public function widget_textdomain() {

        // TODO be sure to change 'widget-name' to the name of *your* plugin
        load_plugin_textdomain( $this->get_widget_slug(), false, plugin_dir_path( __FILE__ ) . 'lang/' );

    } // end widget_textdomain

    /**
     * Fired when the plugin is activated.
     *
     * @param  boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
     */
    public function activate( $network_wide ) {
        // TODO define activation functionality here
    } // end activate

    /**
     * Fired when the plugin is deactivated.
     *
     * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
     */
    public function deactivate( $network_wide ) {
        // TODO define deactivation functionality here
    } // end deactivate

    /**
     * Registers and enqueues admin-specific styles.
     */
    public function register_admin_styles() {

        wp_enqueue_style( $this->get_widget_slug().'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ) );

    } // end register_admin_styles

    /**
     * Registers and enqueues admin-specific JavaScript.
     */
    public function register_admin_scripts() {

        wp_enqueue_script( $this->get_widget_slug().'-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array('jquery') );

    } // end register_admin_scripts

    /**
     * Registers and enqueues widget-specific styles.
     */
    public function register_widget_styles() {

        wp_enqueue_style( $this->get_widget_slug().'-widget-styles', plugins_url( 'css/widget.css', __FILE__ ) );

    } // end register_widget_styles

    /**
     * Registers and enqueues widget-specific scripts.
     */
    public function register_widget_scripts() {

        wp_enqueue_script( $this->get_widget_slug().'-script', plugins_url( 'js/widget.js', __FILE__ ), array('jquery') );

    } // end register_widget_scripts

} // end class

// TODO: Remember to change 'Widget_Test_Name' to match the class name definition
add_action( 'widgets_init', create_function( '', 'register_widget("Widget_Test_Name_bananas");' ) );

// backend long-running cron jobs
define('ALTERNATE_WP_CRON', true);

// boilerplate to add smaller time intervals
function my_cron_schedules($schedules){
    if(!isset($schedules["1min"])){
        $schedules["1min"] = array(
            'interval' => 1*60,
            'display' => __('Once every 1 minutes'));
    }
    if(!isset($schedules["5min"])){
        $schedules["5min"] = array(
            'interval' => 5*60,
            'display' => __('Once every 5 minutes'));
    }
    if(!isset($schedules["30min"])){
        $schedules["30min"] = array(
            'interval' => 30*60,
            'display' => __('Once every 30 minutes'));
    }
    return $schedules;
}
add_filter('cron_schedules','my_cron_schedules');
register_activation_hook(__FILE__, 'banana_activation');

global $banana_db_version;
$banana_db_version = '1.0';

function banana_activation() {
    if (! wp_next_scheduled ( 'banana_recurring_event' )) {
        wp_schedule_event(time(), '1min', 'banana_recurring_event');
    }

    $args = array(
        'number_to' => '+12485203071',
        'message' => 'WP banana plugin activated',
    );
    twl_send_sms($args);

    global $wpdb;
    $installed_ver = get_option( "banana_db_version" );

    //TODO: Change back to version checking
    // if ( $installed_ver != $banana_db_version ) {
    if ( true ) {

        $appointment = $wpdb->prefix . 'appointment';
        $counselor = $wpdb->prefix . 'counselor';
        $document = $wpdb->prefix . 'document';
        $appointment_document = $wpdb->prefix . 'appointment_document';
        $message = $wpdb->prefix . 'message';

        $sql = "CREATE TABLE $appointment (
            id mediumint(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            first_name VARCHAR(32) NOT NULL,
            last_name VARCHAR(32) NOT NULL,
            email VARCHAR(255),
            phone VARCHAR(40),
            language VARCHAR(40) NOT NULL,
            counselor SMALLINT UNSIGNED NOT NULL REFERENCES $counselor(id),
            CONSTRAINT chk_contact CHECK (phone IS NOT NULL OR email IS NOT NULL)
            );
            ALTER TABLE $appointment ADD INDEX phone_index (phone);

            CREATE TABLE $counselor (
            id mediumint(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(32) NOT NULL,
            last_name VARCHAR(32) NOT NULL,
            email VARCHAR(128) NOT NULL,
            phone VARCHAR(40) NOT NULL
            );

            CREATE TABLE $document (
            id mediumint(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(40) NOT NULL,
            description VARCHAR(255) NOT NULL
            );

            CREATE TABLE $appointment_document (
            appointment_id int(10) NOT NULL,
            document_id int(10) NOT NULL,
            PRIMARY KEY (`appointment_id`,`document_id`)
            );

            CREATE TABLE $message (
            days_before SMALLINT NOT NULL,
            title VARCHAR(40) NOT NULL,
            text VARCHAR(1000) NOT NULL
            );";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        update_option( "banana_db_version", $banana_db_version );
    }
}

add_action('banana_recurring_event', 'do_this_on_event');

function do_this_on_event() {
    // do something every time the recurring event hits
    // IMPORTANT // IMPORTANT // IMPORTANT // IMPORTANT
    // this is the actual thing that will happen every interval

    // Use the twilio client to send a text to Noah
    $args = array(
        'number_to' => '+12485203071',
        'message' => 'Notify every 1 min',
    );
    twl_send_sms($args);

    // IMPORTANT // IMPORTANT // IMPORTANT // IMPORTANT
}

// these clean up the loop when this plug in is deregistered
register_deactivation_hook(__FILE__, 'my_deactivation');
function my_deactivation() {
    wp_clear_scheduled_hook('banana_recurring_event');
    $args = array(
        'number_to' => '+12485203071',
        'message' => 'WP banana plugin deactivated',
    );
    twl_send_sms($args);
}
