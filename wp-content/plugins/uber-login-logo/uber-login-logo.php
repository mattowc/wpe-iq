<?php

/**
 * Uber Login Logo
 *
 * @link http://www.uberweb.com.au/uber-login-logo-wordpress-plugin/
 *
 * @author Alex Rogers
 * @version 0.5
 * @package Uber_Login_Logo
 */

/*
Plugin Name: Uber Login Logo
Plugin URI: http://www.uberweb.com.au/uber-login-logo-wordpress-plugin/
Description: Change login logo.
Version: 0.5
Author: UberWeb
Author URI: http://www.uberweb.com.au/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

//Enable the plugin for the init hook, but only if WP is loaded. Calling this php file directly will do nothing.
if(defined('ABSPATH') && defined('WPINC')) {
    add_action("init",array("UberLoginLogo","init"),1000,0);
}

/**
 * Main class for Uber Login Logo, does it all.
 *
 * @package Uber_Login_Logo
 * @todo Uninstall plugin hook
 * @todo I18n Support
 */

class UberLoginLogo
{
    /**
     * @const VERSION The current plugin version
     */
    const VERSION = '0.5';

    /**
     * @const UBERURL Link to uberweb site
     */
    const UBERURL = 'http://www.uberweb.com.au';

    /**
     * Fire up the plugin and register them hooks
     */
    public static function init()
    {
        add_action('admin_menu', array('UberLoginLogo', 'registerAdminMenu'));
        add_filter('plugin_action_links', array('UberLoginLogo', 'registerPluginSettingsLink'),10,2);
        add_action('wp_ajax_getImageData', array('UberLoginLogo', 'getImageData'));
        add_action('wp_ajax_displayPreviewImg', array('UberLoginLogo', 'displayPreviewImg'));
        add_action('login_head', array('UberLoginLogo', 'replaceLoginLogo'));
        add_filter('login_headerurl', array('UberLoginLogo', 'replaceLoginUrl'));
        add_filter("login_headertitle", array('UberLoginLogo', 'replaceLoginTitle'));

        //Load only on plugin admin page
        if (isset($_GET['page']) && $_GET['page'] == self::getBaseName()) {
            add_action('admin_print_scripts', array('UberLoginLogo', 'myAdminScripts'));
            add_action('admin_print_styles', array('UberLoginLogo', 'myAdminStyles'));
        }
    }
    /**
     * Load scripts for plugin admin page
     */
    public static function myAdminScripts()
    {
        wp_enqueue_media();
        wp_register_script('uber-login-logo', self::getPluginDir() . '/uber-login-logo-min.js', array('jquery','media-upload','thickbox'), self::VERSION);
        wp_enqueue_script('uber-login-logo');
    }

    /**
     * Load styles for plugin admin mpage
     */
    public static function myAdminStyles()
    {
        wp_enqueue_style('thickbox');
        wp_register_style('uber-login-logo', self::getPluginDir() . '/uber-login-logo-min.css', array(), self::VERSION);
        wp_enqueue_style('uber-login-logo');
    }

    /**
     * Setup admin menu and add options page
     */
    public static function registerAdminMenu()
    {
        if (function_exists('add_options_page')) {
            $page_title = 'Uber Login Logo Settings';
            $menu_title = 'Uber Login Logo';
            $capability = 'manage_options';
            $menu_slug = self::getBaseName();
            $function = array('UberLoginLogo','showOptionsPage');

            add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
        }
    }

    /**
     * Add settings link to plugin page
     *
     * @param array $links Array of plugin option links
     * @param string $file Handle to plugin filename
     * @return array Modified list of plugin option links
     */
    public static function registerPluginSettingsLink($links, $file)
    {
        $this_plugin = self::getBaseName();

        if ($file == $this_plugin) {
            $settings_link = '<a href="' . admin_url() . 'options-general.php?page=' . $this_plugin . '">Settings</a>';
            array_unshift($links, $settings_link);
        }

        return $links;
    }

    /**
     * Generate the HTML to display the plugin settings page
     */
    public static function showOptionsPage()
    {
        ?>

        <div class="wrap uber-login-logo">
            <?php screen_icon('edit-pages'); ?>
            <h2>Uber Login Logo</h2>

            <div class="updated fade update-status">
                <p><strong>Settings Saved</strong></p>
            </div>

            <p>by <strong>Alex Rogers</strong> from <strong><a href="http://www.uberweb.com.au" title="uberweb web design and development">uberweb.com.au</a></strong></p>

            <h3>How it Works</h3>
            <ol>
                <li>Use the WordPress media uploader to upload an image, or select one from the media library.</li>
                <li>It is highly recommended that you select an image with a width less than 320px.</li>
                <li>Select "Full Size" and click "insert into post".</li>
                <li>Finished!</li>
            </ol>
            <form class="inputfields">
                <input id="upload-input" type="text" size="36" name="upload image" class="upload-image" value="" />
                <input id="upload-button" type="button" value="Upload Image" class="upload-image" />
                <?php wp_nonce_field('uber_login_logo_action','uber_login_logo_nonce'); ?>
            </form>
            <div class="img-holder">
                <p>Here is a preview of your selected image at actual size</p>
                <div class="img-preview"></div>
            </div>
        </div>

        <?php
    }

    /**
     * Replace the login logo on wp-admin
     */
    public static function replaceLoginLogo()
    {
        $img_data = get_option('uber_login_logo');
        if ($img_data) {
            $style = '<style type="text/css">';
            $style .= sprintf('.login h1 a { background: transparent url("%s") no-repeat center top; background-size:%spx %spx; height: %spx;}', $img_data['src'], $img_data['width'], $img_data['height'], $img_data['height']);
			$style .= '</style>';
            $style .= "\r\n" . '<!-- Uber Login Logo ' . self::VERSION . ' ' . self::UBERURL . ' -->' . "\r\n";
            echo $style;
        }
    }

    /**
     * Retrieve the img data via AJAX and save as wordpress option
     */
    public static function getImageData()
    {
        if (!empty($_POST) && check_admin_referer('uber_login_logo_action','uber_login_logo_nonce')) {
            if (current_user_can('manage_options')) {
                $img_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $img_src = filter_input(INPUT_POST, 'src', FILTER_SANITIZE_URL);
                $img_meta = wp_get_attachment_metadata($img_id, false);

                $img_data['id'] = $img_id;
                $img_data['src'] = $img_src;
                $img_data['height'] = $img_meta['height'];
                $img_data['width'] = $img_meta['width'];

                update_option(uber_login_logo, $img_data);

                //$returnval = $img_data['src'];
                $returnval = json_encode(array('src' => $img_data['src'], 'id' => $img_data['id']));
                die($returnval);
            }
        }
    }

    /**
     * Display the currently set login logo img
     */
    public static function displayPreviewImg()
    {
        if (!empty($_POST) && check_admin_referer('uber_login_logo_action','uber_login_logo_nonce')) {
            if (current_user_can('manage_options')) {
                $img_data = get_option('uber_login_logo');
                if ($img_data) {
                    //$returnval = $img_data['src'];
                    $returnval = json_encode(array('src' => $img_data['src'], 'id' => $img_data['id']));
                }
                else {
                    $returnval = false;
                }
                die($returnval);
            }
        }
    }

    /**
     * Retrieve the Home URL
     *
     * @return string Home URL
     */
    public static function replaceLoginUrl()
    {
        return home_url();
    }

    /**
     * Retrieve the Site Description
     *
     * @return string Site Description
     */
    public static function replaceLoginTitle()
    {
        return get_bloginfo('description');
    }

    /**
     * Retrieve the unique plugin basename
     *
     * @return string Plugin basename
     */
    public static function getBaseName()
    {
        return plugin_basename(__FILE__);
    }

    /**
     * Retrieve the URL to the plugin basename
     *
     * @return string Plugin basename URL
     */
    public static function getPluginDir()
    {
        return WP_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__));
    }
}

?>