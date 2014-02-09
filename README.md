# CakePHP Content Plugin

Provides management for 

* Standard Web Pages
* Blog Posts

Dependencies 

* [CakePHP Utilities Plugin](https://github.com/jasonsnider/cakephp-utilities-plugin)
* [HTML Purifier](http://htmlpurifier.org/)

Request Object Variables

````
$this->request->hasEditor = true;
````

When set to true in a given action request::hasEditor will apply a WYSIWYG editor to any text area with the class of
editor. The requires either the Parbake theme or TinyMCE with the following code snippet.

Note: Adjust the JS path accordingly.

````
<?php if(isset($this->request->hasEditor)): ?>
    <script src="/theme/parbake/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: ".editor"
        });
    </script>
<?php endif; ?>
````

## Using Discussions

Discussions provides a native AJAX UI for allowing [for example] comments on blog posts or the ability to create a 
discussion against any piece of data in the system. Usage is as follows. The variables $model and $modelId are used 
to connect the discussion to a single piece of system data.

````
<h2>Discussion</h2>
<div 
    id="<?php echo "DiscussionStream{$modelId}"; ?>"
    data-stream
    data-url="<?php echo "/ajax/contents/discussions/index/{$modelId}/{$model}"; ?>"
    data-target="#<?php echo "DiscussionStream{$modelId}"; ?>"></div>
````