<?php
/**
 * Plugin Name: Nursing Clio Helper Functions
 * Plugin URI: https://github.com/admturner/nc-functions-wp-plugin
 * Description: A short and sweet plugin adding functionality specific to the Nursing Clio blog project.
 * Author: Adam Turner
 * Author URI: http://adamturner.org
 * Version: 0.2
 * 
 * CONTENTS
 * 	- Initialize
 *  - Role Capabilities
 * 	- Google Analytics
 *
 * @package WordPress
 * @package NursingClioHelperFunctions
 * @version 0.2
 * @author  Adam Turner
 * @copyright Copyright (c) 2015, Adam Turner, GPL 2.0+
 * @link https://github.com/admturner/nc-functions-wp-plugin
 * @license http://www.gnu.org/licenses/gpl.html

 * 
 * @todo Add function_exists() wrappers
 * @todo Make more robust (see http://solislab.com/blog/plugin-activation-checklist/)
 */

/**** INITIALIZE ****/
function nc_helper_functions_activate() {

    // This only needs to run once per site to work, so let's do that.
    nc_edit_author_caps();

}
register_activation_hook( __FILE__, 'nc_helper_functions_activate' );

/**
 * Remove some capabilities from author role
 * 
 * Remove the cabaility 'publish_posts' from the Author
 * role, to prevent accidently publishing before approval
 * from a Nursing Clio Editor.
 *
 * @uses WP_Role::remove_cap()
 * @since 0.1
 */
function nc_edit_author_caps() {
	$role = get_role( 'author' );
	$role->remove_cap( 'publish_posts' );
}

/**
 * Add Google Analytics script to head
 * 
 * Hook into wp_head() to insert Google Analytics
 * script for tracking and data.
 *
 * @uses wp_head()
 * @since 0.2
 */
function nc_add_google_analytics() {
    echo '<!-- Google Analytics code here -->';
}
add_action('wp_head', 'nc_add_google_analytics');

/* DON'T DELETE THIS CLOSING TAG */ ?>