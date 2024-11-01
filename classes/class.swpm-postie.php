<?php

/**
 * SwpmPostie class
 */
class SwpmPostie {

    public function __construct() {
        if (class_exists('SimpleWpMembership')) {
            add_action('swpm_addon_settings_section', array(&$this, 'settings_ui'));
            add_action('swpm_addon_settings_save', array(&$this, 'settings_save'));
            add_filter('postie_filter_email', array(&$this, 'user_by_email'));
            add_filter('postie_post_before', array(&$this, 'update_post_protection'));
        }
    }

    public function user_by_email($email) {

        // load user data if needed.
        return $email;
    }

    public function update_post_protection($post) {
        $settings = SwpmSettings::get_instance();
        $enable_postie = $settings->get_value('swpm-addon-enable-postie');
        $postie_level = $settings->get_value('swpm-addon-postie-level');
        $post_status = $post['post_status'];
        if (!empty($enable_postie) && $post_status == 'publish') {
            $post_type = $post['post_type'];
            $post_id = $post['ID'];
            SwpmProtection::get_instance()->apply(array($post_id), $post_type)->save();
            SwpmPermission::get_instance($postie_level)->apply(array($post_id), $post_type)->save();
        }
        return $post;
    }

    public function settings_ui() {
        $settings = SwpmSettings::get_instance();
        $enable_postie = $settings->get_value('swpm-addon-enable-postie');
        $postie_level = $settings->get_value('swpm-addon-postie-level');
        require_once (SWPM_POSTIE_PATH . 'views/settings.php');
    }

    public function settings_save() {
        $message = array('succeeded' => true, 'message' => SwpmUtils::_('Updated! '));
        SwpmTransfer::get_instance()->set('status', $message);
        $enable_postie = filter_input(INPUT_POST, 'swpm-addon-enable-postie');
        $postie_level = filter_input(INPUT_POST, 'swpm-addon-postie-level');
        $settings = SwpmSettings::get_instance();
        $settings->set_value('swpm-addon-enable-postie', empty($enable_postie) ? "" : $enable_postie);
        $settings->set_value('swpm-addon-postie-level', absint($postie_level));
        $settings->save();
    }

}
