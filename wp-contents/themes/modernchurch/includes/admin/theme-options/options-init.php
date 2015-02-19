<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('admin_folder_Redux_Framework_config')) {

    class admin_folder_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'cpt_remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }


        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function cpt_remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            //Global Settings
            $this->sections[] = array(
                'title'     => __('Global', 'cpt_theme'),
                'icon'      => 'el-icon-globe',
                'fields'    => array(

                    array(
                        'id'        => 'body-bg',
                        'type'      => 'color',
                        'title'     => __('Body Background Color', 'cpt_theme'),
                        'subtitle'  => __('Pick a background color for the body', 'cpt_theme'),
                        'output'    => array('body'),
                        'default'   => '',
                        'mode'      =>  'background',
                        'validate'  => 'color',

                    ),


                ),
            );

            //Header Settings
            $this->sections[] = array(
                'title'     => __('Header', 'cpt_theme'),
                'icon'      => 'el-icon-website',
                'fields'    => array(

                    array(
                        'id'        => 'header-logo-section',
                        'type'      => 'section',
                        'title'     => __('Header Logo Options', 'cpt_theme'),
                        'subtitle'  => __('Within this section you will find the options for the header logo.'),
                        'indent'    => true
                    ),

                    array(
                        'id'        => 'header-logo',
                        'type'      => 'media',
                        'url'       => false,
                        'title'     => __('Upload Logo', 'cpt_theme'),
                        'compiler'  => 'true',
                        'subtitle'  => __('Upload the logo you would like in the header.', 'cpt_theme'),
                        'default'   => array('url' => 'http://cpthemes.dev/wp-content/themes/modernchurch/includes/front/img/global/img-logo.png'),
                    ),


                ),
            );

            //Home Page Settings
            $this->sections[] = array(
                'title'     => __('Home Page', 'cpt_theme'),
                'icon'      => 'el-icon-home',
                'fields'    => array(

                    array(
                        'id'        => 'hero-start',
                        'type'      => 'section',
                        'title'     => __('Hero Banner Options', 'cpt_theme'),
                        'subtitle'  => __('Within this section you will find the options for the hero banner on the home page.', 'cpt_theme'),
                        'indent'    => true
                    ),

                    array(
                        'id'        => 'hero-switch',
                        'type'      => 'switch',
                        'title'     => __('Hero', 'cpt_theme'),
                        'subtitle'  => __('Select status of hero banner on home page.', 'cpt_theme'),
                        'default'   =>  1,
                        'on'        =>  'Show',
                        'off'       =>  'Hide'
                    ),

                    array(
                        'id'        => 'cta-row-start',
                        'type'      => 'section',
                        'title'     => __('Call to Action Row Options', 'cpt_theme'),
                        'subtitle'  => __('Within this section you will find the options for the call to action row on the home page.', 'cpt_theme'),
                        'indent'    => true
                    ),

                    array(
                        'id'        => 'cta-switch',
                        'type'      => 'switch',
                        'title'     => __('Home Page Call to Actions (CTA)', 'cpt_theme'),
                        'subtitle'  => __('Select status of home page call to actions row.', 'cpt_theme'),
                        'default'   =>  1,
                        'on'        =>  'Show',
                        'off'       =>  'Hide'
                    ),

                    array(
                        'id'                => 'cta-col-one-title',
                        'type'              => 'text',
                        'title'             => __('Column 1 CTA Section Title'),
                        'subtitle'          => __('Insert the title', 'cpt_theme'),
                        'desc'              => __('', 'cpt_theme'),
                        'default'           => 'New Here?',
                        'validate'          => 'no_html',
                        'required'          => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'cta-col-one-desc',
                        'type'      => 'textarea',
                        'title'     => __('Column 1 CTA Summary'),
                        'subtitle'  => __('Insert the summary', 'cpt_theme'),
                        'desc'      => __('Please note HTML is not allowed in this textarea. We recommend you keep the character count below 50.', 'cpt_theme'),
                        'validate'  => 'no_html',
                        'default'   => 'Find out what we are about.',
                        'required'          => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'                => 'cta-col-one-txt',
                        'type'              => 'text',
                        'title'             => __('Column 1 CTA Link Text'),
                        'subtitle'          => __('Insert the text', 'cpt_theme'),
                        'desc'              => __('', 'cpt_theme'),
                        'default'           => 'Learn More',
                        'validate'          => 'no_html',
                        'required'          => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'                => 'cta-col-one-link',
                        'type'              => 'text',
                        'title'             => __('Column 1 CTA URL'),
                        'subtitle'          => __('Insert the URL', 'cpt_theme'),
                        'desc'              => __('Insert the URL you would like the site to go when the user clicks on the link in column 1.', 'cpt_theme'),
                        'default'           => '',
                        'validate'          => 'url',
                        'required'          => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'                => 'cta-col-two-title',
                        'type'              => 'text',
                        'title'             => __('Column 2 CTA Sermon Section Title'),
                        'subtitle'          => __('Insert the title', 'cpt_theme'),
                        'desc'              => __('', 'cpt_theme'),
                        'default'           => 'Latest Sermon',
                        'validate'          => 'no_html',
                        'required'          => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'                => 'cta-col-two-txt',
                        'type'              => 'text',
                        'title'             => __('Column 2 CTA Link Text'),
                        'subtitle'          => __('Insert the text', 'cpt_theme'),
                        'desc'              => __('', 'cpt_theme'),
                        'default'           => 'More Audio/Video',
                        'validate'          => 'no_html',
                        'required'          => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'                => 'cta-col-three-title',
                        'type'              => 'text',
                        'title'             => __('Column 3 CTA Section Title'),
                        'subtitle'          => __('Insert the title', 'cpt_theme'),
                        'desc'              => __('', 'cpt_theme'),
                        'default'           => 'Online Giving',
                        'validate'          => 'no_html',
                        'required'          => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'cta-col-three-desc',
                        'type'      => 'textarea',
                        'title'     => __('Column 3 CTA Summary'),
                        'subtitle'  => __('Insert the summary', 'cpt_theme'),
                        'desc'      => __('Please note HTML is not allowed in this textarea. We recommend you keep the character count below 50.', 'cpt_theme'),
                        'validate'  => 'html',
                        'default'   => 'Safe and Secure.<br>Click to give online.',
                        'required'  => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'                => 'cta-col-three-txt',
                        'type'              => 'text',
                        'title'             => __('Column 3 CTA Link Text'),
                        'subtitle'          => __('Insert the text', 'cpt_theme'),
                        'desc'              => __('', 'cpt_theme'),
                        'default'           => 'Give Now',
                        'validate'          => 'no_html',
                        'required'          => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'                => 'cta-col-three-link',
                        'type'              => 'text',
                        'title'             => __('Column 3 CTA URL'),
                        'subtitle'          => __('Insert the URL', 'cpt_theme'),
                        'desc'              => __('Insert the URL you would like the site to go when the user clicks on the link in column 3.', 'cpt_theme'),
                        'default'           => '',
                        'validate'          => 'url',
                        'required'          => array('cta-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'connect-row',
                        'type'      => 'section',
                        'title'     => __('Connect Row Options', 'cpt_theme'),
                        'subtitle'  => __('Within this section you will find the options for the connect row found at the bottom of the home page.', 'cpt_theme'),
                        'indent'    => true
                    ),

                    array(
                        'id'        => 'connect-switch',
                        'type'      => 'switch',
                        'title'     => __('Home Page Connect', 'cpt_theme'),
                        'subtitle'  => __('Select the status of the connect message on home page.', 'cpt_theme'),
                        'default'   =>  1,
                        'on'        =>  'Show',
                        'off'       =>  'Hide'
                    ),

                    array(
                        'id'                => 'connect-title',
                        'type'              => 'text',
                        'title'             => __('Connect Title'),
                        'subtitle'          => __('Insert the title', 'cpt_theme'),
                        'desc'              => __('', 'cpt_theme'),
                        'default'           => 'Looking to Connect?',
                        'validate'          => 'no_html',
                        'required'          => array('connect-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'connect-desc',
                        'type'      => 'textarea',
                        'title'     => __('Connect Summary'),
                        'subtitle'  => __('Insert the summary', 'cpt_theme'),
                        'desc'      => __('Please note HTML is not allowed in this textarea. We recommend you keep the character count below 50.', 'cpt_theme'),
                        'validate'  => 'html',
                        'default'   => 'Connect with us today to find out more about our community.',
                        'required'  => array('connect-switch', '=', '1'),
                    ),

                    array(
                        'id'                => 'connect-btn-txt',
                        'type'              => 'text',
                        'title'             => __('Connect Button Text'),
                        'subtitle'          => __('Insert the button text', 'cpt_theme'),
                        'desc'              => __('', 'cpt_theme'),
                        'default'           => 'Connect Now',
                        'validate'          => 'no_html',
                        'required'          => array('connect-switch', '=', '1'),
                    ),

                    array(
                        'id'                => 'connect-btn-link',
                        'type'              => 'text',
                        'title'             => __('Connect Button URL'),
                        'subtitle'          => __('Insert the URL', 'cpt_theme'),
                        'desc'              => __('Insert the URL you would like the site to go when the user clicks on the connect button.', 'cpt_theme'),
                        'default'           => '',
                        'validate'          => 'url',
                        'required'          => array('connect-switch', '=', '1'),
                    ),
                ),
            );

            //Footer Settings
            $this->sections[] = array(
                'title'     => __('Footer', 'cpt_theme'),
                'icon'      => 'el-icon-website',
                'fields'    => array(

                    array(
                        'id'        => 'footer-logo-section',
                        'type'      => 'section',
                        'title'     => __('Footer Logo Options', 'cpt_theme'),
                        'subtitle'  => __('Within this section you will find the options for the footer logo.'),
                        'indent'    => true
                    ),

                    array(
                        'id'        => 'footer-logo',
                        'type'      => 'media',
                        'url'       => false,
                        'title'     => __('Upload Logo', 'cpt_theme'),
                        'compiler'  => 'true',
                        'subtitle'  => __('Upload the logo you would like in the footer.', 'cpt_theme'),
                        'default'   => array('url' => 'http://cpthemes.dev/wp-content/themes/modernchurch/includes/front/img/global/img-logo.png'),
                    ),

                    array(
                        'id'        => 'social-networking-section',
                        'type'      => 'section',
                        'title'     => __('Social Networking Options', 'cpt_theme'),
                        'subtitle'  => __('Within this section you will find the options for the social networking icons in the footer.'),
                        'indent'    => true
                    ),

                    array(
                        'id'        => 'sn-switch',
                        'type'      => 'switch',
                        'title'     => __('Social Networking', 'cpt_theme'),
                        'subtitle'  => __('Select the status of the social networking icons in the footer', 'cpt_theme'),
                        'default'   =>  1,
                        'on'        =>  'Show',
                        'off'       =>  'Hide'
                    ),

                    array(
                        'id'        => 'fb-switch',
                        'type'      => 'switch',
                        'title'     => __('Facebook', 'cpt_theme'),
                        'subtitle'  => __('Select the status of the facebook icon', 'cpt_theme'),
                        'default'   =>  1,
                        'on'        =>  'Show',
                        'off'       =>  'Hide',
                        'required'  => array('sn-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'fb-link',
                        'type'      => 'text',
                        'title'     => __('Facebook URL'),
                        'subtitle'  => __('Insert your Facebook URL', 'cpt_theme'),
                        'default'   => '',
                        'validate'  => 'url',
                        'required'  => array('fb-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'twit-switch',
                        'type'      => 'switch',
                        'title'     => __('Twitter', 'cpt_theme'),
                        'subtitle'  => __('Select the status of the Twitter icon', 'cpt_theme'),
                        'default'   =>  1,
                        'on'        =>  'Show',
                        'off'       =>  'Hide',
                        'required'  => array('sn-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'twit-link',
                        'type'      => 'text',
                        'title'     => __('Twitter URL'),
                        'subtitle'  => __('Insert your Twitter URL', 'cpt_theme'),
                        'default'   => '',
                        'validate'  => 'url',
                        'required'  => array('twit-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'vm-switch',
                        'type'      => 'switch',
                        'title'     => __('Vimeo', 'cpt_theme'),
                        'subtitle'  => __('Select the status of the Vimeo icon', 'cpt_theme'),
                        'default'   =>  1,
                        'on'        =>  'Show',
                        'off'       =>  'Hide',
                        'required'  => array('sn-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'vm-link',
                        'type'      => 'text',
                        'title'     => __('Vimeo URL'),
                        'subtitle'  => __('Insert your Vimeo URL', 'cpt_theme'),
                        'default'   => '',
                        'validate'  => 'url',
                        'required'  => array('vm-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'insta-switch',
                        'type'      => 'switch',
                        'title'     => __('Instagram', 'cpt_theme'),
                        'subtitle'  => __('Select the status of the Instagram icon', 'cpt_theme'),
                        'default'   =>  1,
                        'on'        =>  'Show',
                        'off'       =>  'Hide',
                        'required'  => array('sn-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'insta-link',
                        'type'      => 'text',
                        'title'     => __('Instragram URL'),
                        'subtitle'  => __('Insert your Instagram URL', 'cpt_theme'),
                        'default'   => '',
                        'validate'  => 'url',
                        'required'  => array('insta-switch', '=', '1'),
                    ),

                    array(
                        'id'        => 'copyright-section',
                        'type'      => 'section',
                        'title'     => __('Copyright Options', 'cpt_theme'),
                        'subtitle'  => __('Within this section you will find the options for the copyright message within the footer.'),
                        'indent'    => true
                    ),

                    array(
                        'id'        => 'copyright',
                        'type'      => 'text',
                        'title'     => __('Copyright'),
                        'subtitle'  => __('Insert the copyright for your website.', 'cpt_theme'),
                        'default'   => 'Copyright Modern Church 2015',
                    ),
                ),
            );
        }

        public function setArguments() {

            $theme = wp_get_theme();

            $this->args = array(
                'opt_name' => 'cpthemes',
                'display_name' => 'CPThemes',
                'display_version' => '1.0.0-alpha',
                'page_slug' => 'cpthemes_options',
                'page_title' => 'Theme Options',
                'update_notice' => true,
                'intro_text' => '<p>This is the theme options for CPThemes. Within the following tabs you will find different options that control your template.</p>',
                'footer_text' => '',
                'admin_bar' => true,
                'menu_type' => 'menu',
                'menu_title' => 'CPThemes Options',
                'allow_sub_menu' => true,
                'page_parent_post_type' => 'your_post_type',
                'customizer' => true,
                'default_mark' => '*',
                'hints' => 
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' => 
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' => 
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' => 
                  array(
                    'show' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'output_tag' => true,
                'compiler' => true,
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => true,
                'database' => 'options',
                'transient_time' => '3600',
                'network_sites' => false,
                'hide_reset' => false,
                'dev_mode' => false
              );

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new admin_folder_Redux_Framework_config();
}