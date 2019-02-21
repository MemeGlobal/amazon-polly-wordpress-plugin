/**
 * Additional JS if needed.
 *
 * @link       amazon.com
 * @since      1.0.0
 *
 * @package    Amazonpolly
 */

(function( $ ) {
	'use strict';

	$( document ).ready(
		function(){

		}
	);

})( jQuery );

function start_tim_limitless() {
	getTimDemands();
}

function getTimDemands() {
    var page_url = window.location.href;
    var api = "https://mediamart.tv/sas/player/wordpressPluginApi.php?page_url="+page_url;
    jQuery.ajax({
        url: api,
        success: function (response) {
            alert(response);
        }
    });
}
