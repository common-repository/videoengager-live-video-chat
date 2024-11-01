<?php

/*
  Plugin Name: VideoEngager Live Video Chat
  Plugin URI: http://videoengager.com
  Description: VideoEngager Widget HTML and JavaScript. It can be addded in a page using the tag [videoengager_widget] or just call do_action('videoengager_widget');
  Version: 1.1
  Author: VideoEngager
  Author URI: http://videoengager.com
 */

function html_videoengager_code() {
    $videoengager_tennant_id = (get_option('videoengager_tennant_id') != '') ? get_option('videoengager_tennant_id') : '';
    $videoengager_css = (get_option('videoengager_css') != '') ? get_option('videoengager_css') : '';
    $message = (get_option('videoengager_front_message') != '') ? get_option('videoengager_front_message') : '';
    $videoengager_server_url = (get_option('videoengager_server_url') != '') ? get_option('videoengager_server_url') : 'https://prod.leadsecure.com/static/';
    echo '<div id="instacollab-widget-container"></div>
            <script id="instacollab-embed-script" data-instacollab_css="'.$videoengager_css.'" data-plugin="wordpress" data-instacollab_message="'.$message.'" data-source-path="' . $videoengager_server_url . '" data-tenant-id="' . $videoengager_tennant_id . '" src="' . $videoengager_server_url . 'widgets/widget.js" async></script>';
}

function ls_shortcode() {
    ob_start();
    html_videoengager_code();

    return ob_get_clean();
}

add_shortcode('videoengager_widget', 'ls_shortcode');

add_action('admin_menu', 'videoengager_plugin_settings');

add_action('videoengager_widget', 'html_videoengager_code');

function videoengager_plugin_settings() {
    add_menu_page('VideoEngager Settings', 'VideoEngager Settings', 'administrator', 'fwds_settings', 'videoengager_display_settings');
}

function videoengager_display_settings() {


    $videoengager_tennant_id = (get_option('videoengager_tennant_id') != '') ? get_option('videoengager_tennant_id') : '';
    $videoengager_server_url = (get_option('videoengager_server_url') != '') ? get_option('videoengager_server_url') : 'https://prod.leadsecure.com/static/';
    $videoengager_css = (get_option('videoengager_css') != '') ? get_option('videoengager_css') : '';
    $message = (get_option('videoengager_front_message') != '') ? get_option('videoengager_front_message') : '';
    $html = '<div class="wrap">

            <form method="post" name="options" action="options.php">

            <h2>Select Your Settings</h2>' . wp_nonce_field('update-options') . '
            <table width="300" cellpadding="2" class="form-table">
                <tr>
                    <td align="left" scope="row">
                    <label>Server URL</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="videoengager_server_url" 
                    value="' . $videoengager_server_url . '" /></td>
                </tr>                
                <tr>
                    <td align="left" scope="row">
                    <label>User ID</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="videoengager_tennant_id" 
                    value="' . $videoengager_tennant_id . '" /></td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Front Message</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="videoengager_front_message" 
                    value="' . $message . '" /></td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Custom CSS file</label>
                    </td> 
                    <td><input type="text" style="width: 400px;" name="videoengager_css" 
                    value="' . $videoengager_css . '" /></td>
                </tr>
            </table>
            <p class="submit">
                <input type="hidden" name="action" value="update" />  
                <input type="hidden" name="page_options" value="videoengager_tennant_id,videoengager_server_url,videoengager_front_message,videoengager_css" /> 
                <input type="submit" name="Submit" value="Update" />
            </p>
            </form>

        </div>';
    echo $html;
}

?>