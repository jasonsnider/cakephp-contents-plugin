/**
 * Provides the UI functionality for dicussions
 * @type Todo
 */
var Discussion = (function(){
    "use strict"; /*jslint browser:true */
    return {
        /**
         * Loads the form for creating a comment into a target element
         * @param {string} modelId
         * @returns {void}
         */
        loadCreate: function(modelId){
            
            var $modelId = modelId;
            
            $.ajax({
                url: '/ajax/contents/discussions/create/' + $modelId + '/',
                cache: false,
                type: 'POST',

                beforeSend:function(){
                    $('#NewComment' + $modelId).html('Loading...');
                },

                success:function(html){
                    $('#NewComment' + $modelId).html(html);
                }
            });
        },
        /**
         * Sends an AJAX post request
         * @param {string} updateElementId
         * @returns {void}
         */
        sendToCreate: function(modelId){
            
            var $modelId = modelId,
                $formFields = $("#NewCommentForm").serialize();
            
            $.ajax({
                url: '/ajax/contents/discussions/create/' + $modelId + '/',
                type: 'POST',
                dataType: 'html',
                cache: false,
                data: $formFields,

                beforeSend:function(){
                    $('#NewComment' + $modelId).html('Loading...');
                },

                success:function(html){
                    $('#NewComment' + $modelId).html(html);
                    var $modelId = $('#LoadIndex').attr('data-model-id');
                    Discussion.fetchIndex($modelId);
                }
            });
        },
        /**
         * Retrives an index of comments (a disucssion) against a target model_id
         * @param {string} modelId
         * @returns {void}
         */
        fetchIndex: function(modelId){
            
            var $modelId = modelId;
            
            $.ajax({
                url: '/ajax/contents/discussions/index/' + $modelId + '/',
                type: 'POST',
                dataType: 'html',
                cache: false,

                beforeSend:function(){
                    $('#LoadIndex').html('Loading...');
                },

                success:function(html){
                    $('#LoadIndex').html(html);
                }
            });
        }
    }
    
})();

//Sends a new comment to the server
(function ($){
    "use strict"; /*jslint browser:true */
    $(function () {
        $(document).on('click', '[data-ajaxifiable="true"]', function (event) {
            event.preventDefault();
            var $this = $(this),
                $target = $this.attr('data-ajaxifiable-target');
                    
            Discussion.sendToCreate($target);
        });
    });
}(jQuery));

//Loads an index of all comments created against a target modelId
(function ($){
    "use strict"; /*jslint browser:true */
    $(function () {
        var $modelId = $('#LoadIndex').attr('data-model-id');
        Discussion.fetchIndex($modelId);
        
    });
}(jQuery));

