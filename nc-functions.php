<?php
/**
 * Plugin Name: Nursing Clio Helper Functions
 * Plugin URI: https://github.com/admturner/nc-functions-wp-plugin
 * Description: A short and sweet plugin adding functionality specific to the Nursing Clio blog project.
 * Author: Adam Turner
 * Author URI: https://adamturner.org
 * Version: 0.4.0
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

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

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
function nc_add_google_analytics() { ?>
<!-- NC Functions Plugin - Google Analytics -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-63746201-1', 'auto');
	ga('send', 'pageview');
</script>
<?php }
add_action('wp_head', 'nc_add_google_analytics', 15);

/**
 * Add Meta Box to Post Pages
 *
 * Custom meta box(s) for the WP Admin area.
 * 
 * @since 0.4.0
 */
function nc_posts_meta_box() {
	# Add meta box to add/edit posts page
	add_meta_box(
		'nc-posts-meta',
		esc_html__('NC: Verify Ready to Publish', 'nursingclio'), 
		'nc_publish_check_fn',
		'post',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'nc_posts_meta_box' );

/**
 * Post ready-to-publish verify
 * 
 * Add a checkbox to verify whether the post is ready to be published
 * or not. Hide/disable "Publish" button if marked as not ready to 
 * publish.
 * 
 * @since 0.4.0
*/
function nc_publish_check_fn() {
	?>
	<div id="nc-verify-ready-to-publish" class="tabs-panel">
		<?php if ( get_post_status() != 'publish' ) { ?>
			<p><?php _e('Select when ready to publish.'); ?></p>
			<ul id="nc-verify-check" class="categorychecklist form-no-clear">
				<li id="nc-pub-check" class="popular-category">
					<label class="selectit" for="nc_verify">
						<input value="1" type="checkbox" name="nc_verify" id="nc_verify"> <?php _e('Ready to publish'); ?>
					</label>
				</li>
			</ul>
		<?php } else { ?>
			<p><?php _e('Post published.'); ?></p>
		<?php } ?>
	</div>
	<?php // We're not modifying the actual post at all, so no need to save meta
}

function nc_load_publishcheck_js() {
	$currentscreen = get_current_screen();
	if ( $currentscreen->id != 'post' || get_post_status() == 'publish' ) {
		return;
	}
	wp_register_script( 'nc_admin_script', plugin_dir_url(__FILE__) . 'library/js/nc-scripts.js', array ('jquery'), '', true );
	wp_enqueue_script( 'nc_admin_script' );
}
add_action( 'admin_enqueue_scripts', 'nc_load_publishcheck_js' );
