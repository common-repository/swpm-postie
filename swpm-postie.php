<?php
/*
Plugin Name: SWPM Postie Integration
Version: 1.1
Author: gcb7, wp.insider
Author URI: https://simple-membership-plugin.com/
Description: Adds Postie plugin integration to the Simple Membership plugin.
*/

//Direct access to this file is not permitted
if (!defined('ABSPATH')){
    exit; //Exit if accessed directly
}

define('SWPM_POSTIE_VER', '1.1');
define('SWPM_POSTIE_SITE_HOME_URL', home_url());
define('SWPM_POSTIE_PATH', dirname(__FILE__) . '/');
define('SWPM_POSTIE_URL', plugins_url('',__FILE__));
define('SWPM_POSTIE_DIRNAME', dirname(plugin_basename(__FILE__)));
require_once ('classes/class.swpm-postie.php');

add_action('plugins_loaded', "swpm_postie_plugins_loaded");
function swpm_postie_plugins_loaded(){
    new SwpmPostie();
}