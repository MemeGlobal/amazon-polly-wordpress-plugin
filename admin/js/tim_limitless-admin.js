(function( $ ) {
	'use strict';
    function showLoader(show) {
        var loaderDiv = document.getElementById("loaderDiv");
        if(show){
            loaderDiv.style.display="block";
        }else{
            loaderDiv.style.display="none";
        }
    }

    function showButton(show) {
        var button = document.getElementById("tim_limitless_update_all");
        if(button){
            if(show){
                button.style.display = "block";
            }else{
                button.style.display = "none";
            }
		}

    }

    function addLoaderToPage() {
        var div = document.createElement("div");
        div.id="loaderDiv";
        div.style.display="none";
        div.style.position="absolute";
        div.style.width="60px";
        div.style.height="60px";
        div.style.zIndex="10000";
        //div.style.backgroundColor="white";
        div.innerHTML = '<svg style="width: 59px;position: absolute;z-index: 10000;" id="loader" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M75.4 126.63a11.43 11.43 0 0 1-2.1-22.65 40.9 40.9 0 0 0 30.5-30.6 11.4 11.4 0 1 1 22.27 4.87h.02a63.77 63.77 0 0 1-47.8 48.05v-.02a11.38 11.38 0 0 1-2.93.37z"  fill-opacity="1"/><animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1800ms" repeatCount="indefinite"></animateTransform></g></svg></div>';
        var timDiv = document.getElementById('tim_limitless_update_all_div');
        timDiv.insertBefore(div, timDiv.childNodes[0]);
    }

    function updateAllPosts() {

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'tim_limitless_bulk_update',
            },
            dataType: "json",
            beforeSend: function() {
                showLoader(true);
                showButton(false);
            },
            complete: function() {
            },
            success: function( response ) {
				 showLoader(false);
                 var label = document.getElementById("successLabel");
                 if(response.status=="success"){
                    label.innerText="All posts were updated successfully.";
                 }else{
                    label.innerText="Update finished. Some posts failed to update.";
                 }
            }
        }).fail(function (response) {
            if ( window.console && window.console.log ) {
                console.log( response );
            }
            showLoader(false);
            var label = document.getElementById("successLabel");
            label.innerText="A problem occurred while updating posts. try again later.";
        });
    };

	$( document ).ready(
		function(){

            $( '#tim_limitless_update_all' ).click(
                function(){
                    addLoaderToPage();
                    updateAllPosts();
                }
            );


		}
	);

})( jQuery );
