/**
 * Provides Discussion functionality
 * @class Discussion
 */
var Discussion = (function(){

    return {
        /**
         * Loads a specified URL into a target element.
         * @param {string} target The action into which we will load the URL.
         * @param {string} url The URL from which the elements content will be loaded.
         * @returns {void}
         */
        load: function(target, url){
			 
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'html',
                cache: false,

                beforeSend:function(){
                    $(target).html('Loading...');
                },

                success:function(html){
                    $(target).html(html);
                }
            });
        },
        /**
         * Submits a form and reloads a target element.
         * @param {string} id The id of the submitted form
         * @param {string} formTarget The element that contains the chat node message forn
		 * @param {string} streamTarget The element that contains the chat node messages
		 * @param {string} spinnerTarget The element into whcih we will load a spinner
		 * @param {string} formUrl The URL to which the chat node message will be submitted
		 * @param {string} streamUrl The URL from which the updated chat node message stream will be pulled
         * @returns {void}
         */
        submit: function(id, formTarget, streamTarget, spinnerTarget, formUrl, streamUrl){
			
            var $formFields = $("#" + id).serialize();
            
            $.ajax({
                url: formUrl,
                type: 'POST',
                dataType: 'html',
                cache: false,
                data: $formFields,

                beforeSend:function(){
                    //Just a spinner
                    $(spinnerTarget).html('Loading...');
                },

                success:function(html){
                    //On success we will echo the word success straight from the controller
                    if(html === 'success'){
                        //The post request was successful, reload the stream
						Discussion.load(formTarget, formUrl);
						Discussion.load(streamTarget, streamUrl);
						
                    }else{
                        //The post request failed, reload the form with the appropriate errors.
                        $(formTarget).html(html);
                    }
                }
            });
        }
    }

})();

/**
 * Provides all of the listeners needed for interactiing with the chat class
 * Events are set against data-* attributes to create a listener 
 * 
 * Attribue, Event, Description
 * -data-ajax-link, click, Treats hrefs as ajax requests.
 * -data-submit-chat-node-message, keydown|submit, Keydown inside a text area or pressing the submit button will send a 
 * form via Ajax.
 * -data-close-tpm-chat-node, click, Closes an element 2 parents up from the element holding the attribute.
 * 
 */
(function($){

    "use strict"; /*jslint browser:true*/

	$(function(){

        var $streams =  $('[data-stream]');
        $.each($streams, function(){
            var $id = $(this).attr('id'),
                $target = $('#' + $id).attr('data-target'),
                $url = $('#' + $id).attr('data-url');
            Discussion.load($target, $url);
        });

        //Listen for a new dialog window to be requested
        $(document).on('click', '[data-ajax-link]', function (event) {
            event.preventDefault();

			var $id = $(this).attr('id'),
				$target = $('#' + $id).attr('data-target'),
				$url = $('#' + $id).attr('href');

            Discussion.load($target, $url);
        });
		
        //Listen for a chat node message to be submitted press pressing the clicking a submit button
        $(document).on('submit', '[data-ajax-form]', function (event) {
            event.preventDefault();

            var $id = $(this).attr('id'),
                $formTarget = $('#' + $id).attr('data-form-target'),
                $streamTarget = $('#' + $id).attr('data-stream-target'),
                $spinnerTarget = $('#' + $id).attr('data-spinner-target'),
                $formUrl = $('#' + $id).attr('action'),
                $streamUrl = $('#' + $id).attr('data-stream-url');

            Discussion.submit($id, $formTarget, $streamTarget, $spinnerTarget, $formUrl, $streamUrl);
		});
	
    });
    
}(jQuery));