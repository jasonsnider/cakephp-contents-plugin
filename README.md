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