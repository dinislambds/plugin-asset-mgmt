<?php
/*
Plugin Name: Plugin Assets Management
Plugin URI: https://github.com/dinislambds/
Description: Plugin Assets Management is just a assets management procedures as a learning purpose of plugin development course.
Version: 1.0
Author: Md Din Islam
Author URI: https://dinislambds.com/
License: GPLv2 or later
Text Domain: assets-mgmt
Domain Path: /languages/
 */

define("PAM_ASSETS_PUBLIC", plugin_dir_url(__FILE__) . "assets/public/");
define("PAM_ASSETS_ADMIN", plugin_dir_url(__FILE__) . "assets/admin/");

class AssestsManagement
{

    // functions in class is called "Method" and default they are public

    public function __construct()
    {
        // $this->version = time(); // for cache busting

        add_action("wp_enqueue_scripts", array($this, "front_assets"));
        add_action("admin_enqueue_scripts", array($this, "admin_assets"));
        add_action("plugins_loaded", array($this, "pam_text_domain"));
    }

    /**
     * Load plugin text domain
     */
    public function pam_text_domain()
    {
        load_plugin_textdomain("assets-mgmt", false, plugin_dir_url(__FILE__) . "/languages");
    }

    /**
     * Load Assests
     */

    // Front display assets
    public function front_assets()
    {
        wp_enqueue_script("pam-main-js", PAM_ASSETS_PUBLIC . "js/main.js", array("jquery"), "1.0", true);
        wp_enqueue_script("pam-style-css", PAM_ASSETS_PUBLIC . "css/style.js", null, "1.0", true);

        // Send data from PHP to JavaScript using wp_localize_script
        $extra = array(
            "name" => "babul",
            "age" => 12,
        );

        wp_localize_script( "pam-main-js", "extra", $extra );
    }

    // Admin display assets
    public function admin_assets($screen)
    {
        $_screen = get_current_screen();
        /*echo "<pre>";
        print_r($_screen);
        echo "<pre>";
        die();*/

        /**
         * Show assets on specific page as below example
         */
        // if ("edit.php"==$screen && "page"==$_screen->post_type){

        wp_enqueue_script("pam-admin-js", PAM_ASSETS_ADMIN . "js/admin.js", array("jquery"), "1.0", true);
        wp_enqueue_script("pam-admin-css", PAM_ASSETS_ADMIN . "css/style.js", null, "1.0", true);

        // }

    }

}

new AssestsManagement();
