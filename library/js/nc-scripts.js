/*
 * Nursing Clio Admin Helper Functions Scripts File
 * Author: Adam Turner
 *
 * This file should contain any js scripts for Nursing Clio's admin
 * area.
 *
 * Dependencies: jQuery
 * @since NC Functions 0.4.0
 */

/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  /*
   * Publish Checker
   * 
   * Disable the "Publish" button on add/edit post pages unless the
   * "confirm" box is checked. Meant to help prevent accidental
   * publishing without mucking around with the actual save/publish
   * functions.
   * 
   * @since NC Functions 0.4.0
   */
  var pb = $("#publish");
  pb.prop("disabled", true);
  $("#nc_verify").change(function() {
    if(document.getElementById('nc_verify').checked) {
      pb.prop("disabled", false);
    } else {
      pb.prop("disabled", true);
    }
  })

}); /* end of as page load scripts */
