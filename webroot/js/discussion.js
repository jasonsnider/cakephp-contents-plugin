/**
 * Provides the UI functionality for dicussions
 * @type Todo
 */
var Discussion = (function(){
    "use strict"; /*jslint browser:true*/
    return {
        /**
         * Loads the form for creating a comment into a target element
         * @param {string} modelId The id row of data to which we are attaching this comment
         * @param {string} model The model to which we are attaching this model
         * @returns {void}
         */
        loadCreate: function(modelId, model){
            
            var $modelId = modelId,
                $model = model;
            
            $.ajax({
                url: '/ajax/contents/discussions/create/'
                    + $modelId + '/'
                    + $model + '/',
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
         * @param {string} modelId The id row of data to which we are attaching this comment
         * @param {string} model The model to which we are attaching this model
         * @returns {void}
         */
        sendToCreate: function(modelId, model){
            
            var $modelId = modelId,
                $model = model,
                $formFields = $("#NewCommentForm").serialize();
            
            $.ajax({
                url: '/ajax/contents/discussions/create/'
                    + $modelId + '/'
                    + $model + '/',
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
         * @param {string} modelId The id row of data to which we are attaching this comment
         * @param {string} model The model to which we are attaching this model
         * @returns {void}
         */
        fetchIndex: function(modelId, model){
            
            var $modelId = modelId,
                $model = model;
            
            $.ajax({
                url: '/ajax/contents/discussions/index/' 
                    + $modelId + '/'
                    + $model + '/',
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
    "use strict"; /*jslint browser:true*/
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
    "use strict"; /*jslint browser:true*/
    $(function () {
        var $modelId = $('#LoadIndex').attr('data-model-id'),
            $model = $('#LoadIndex').attr('data-model');

        Discussion.fetchIndex($modelId, $model);
        
    });
}(jQuery));

