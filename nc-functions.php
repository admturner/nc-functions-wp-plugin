<?php
/**
 * Plugin Name: Nursing Clio Helper Functions
 * Plugin URI: https://github.com/admturner/nc-functions-wp-plugin
 * Description: A short and sweet plugin adding functionality specific to the Nursing Clio blog project.
 * Author: Adam Turner
 * Author URI: http://adamturner.org
 * Version: 0.1
 * 
 * CONTENTS
 *  - Role Capabilities
 *
 * @package WordPress
 * @package NursingClioHelperFunctions
 * @version 0.1
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

    // This only needs to run once per site to work, so let's do that
    nc_edit_author_caps();

}
register_activation_hook( __FILE__, 'nc_helper_functions_activate' );


/************* ROLE CAPABILITIES ******************/
/**
 * Remove some capabilities from author role
 * 
 * Removing the cabaility 'publish_posts' from the Author
 * role, to prevent accidently publishing before approval
 * from a Nursing Clio Editor.
 *
 * @since v0.5
 * @uses WP_Role::remove_cap()
 * @todo Make sure init is the best hook to use.
 */
function nc_edit_author_caps() {
	$role = get_role( 'author' );
	$role->remove_cap( 'publish_posts' );
}

/* DON'T DELETE THIS CLOSING TAG */ ?>