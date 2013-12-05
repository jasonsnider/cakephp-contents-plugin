<?php
/**
 * Provides a model for mananging users
 *
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @copyright Copyright 2012, Jason D Snider
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package app/User
 */
App::uses('ContentsAppModel', 'Contents.Model');

/**
 * Provides a model for mananging users
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Users
 */
class Content extends ContentsAppModel {

    /**
     * The static name this model
     * @var string
     */
    public $name = 'Content';

    /**
     * The table to be used by this model
     * @var string
     */
    public $useTable = 'contents';

    /**
     * Specifies the behaviors invoked by the model
     * @var array 
     */
    public $actsAs = array(
        'Utilities.Loggable',
        'Utilities.Scrubable' => array(
            'Filters' => array(
                'trim' => '*',
                'noHtml' => array(
                    'id',
                    'title',
                    'slug',
                    'description',
                    'keyword',
                    'canonical',
                    'content_type',	
                    'model',
                    'model_id',	
                    'created_user_id',	
                    'created',
                    'modified_user_id',	
                    'modified'
                ),
                'html'=>array('body')
            )
        )
    );
    
    /**
     * Defines belongs to relationships this model
     * @var array
     */
    public $belongsTo = array(
        'CreatedUser' => array(
            'className' => 'Users.User',
            'foreignKey' => 'created_user_id',
            'dependent' => true
        )
    );
    
    /**
     * Defines has many relationships this model
     * @var array
     */
    public $hasMany = array();
    
    /**
     * Execute prior to validation
     * - Creates a slug from a content title
     * @param array $options
     * @return boolean
     */
    public function beforeValidate($options = array()) {
        if (!empty($this->data[$this->alias]['title'])) {
            $this->data[$this->alias]['slug'] = $this->slug($this->data);
        }
        return true;
    }

    /**
     * Returns a list of content types
     * @return array()
     */
    public function contentTypes(){
        return array(
            'page'=>'Page',
            'post'=>'Post'
        );
    }
    

    /**
     * Returns a list of content types
     * @return array()
     */
    public function contentStatuses(){
        return array(
            'draft'=>'Draft',
            'published'=>'Published'
        );
    }
    
    /**
     * A recursive function for creating unique slugs against user submited data (Content.title)
     * @param array $data
     * @param interger $counter
     */
    public function slug($data, $counter = 0){
                    
        //Create the slug from user created data
        if(empty($counter)){
            $slug = Inflector::slug(strtolower($data[$this->alias]['title']), '-');
        }else{
            $slug = Inflector::slug(strtolower("{$data[$this->alias]['title']} {$counter}"), '-');
        }

        //Does the slug already exists
        $checkCollision = $this->find(
            'first',
            array(
                'conditions'=>array(
                    "{$this->alias}.slug"=>$slug
                ),
                'contain'=>array()
            )
        );
             
        if(!empty($checkCollision)){
            //The slug already exists, recursivly pass the counter into the slug method
            $counter = $counter + 1;
            $slug = $this->slug($data, $counter);
        }
        
        return $slug;          
    }
}