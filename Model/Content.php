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
        'Search.Searchable',
        'Tags.Taggable',
        'Utilities.Loggable',
        'Utilities.Scrubable' => array(
            'Filters' => array(
                'trim' => '*',
                'noHtml' => array(
                    'id',
                    'title',
                    'slug',
                    'description',
                    'keywords',
                    'tags',
                    'canonical',
                    'content_type',	
                    'controller',
                    'action',	
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
     * Content has and belongs to many 
     * -Tag
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Tag' => array(
            'with' => 'Tagged'
        )
    );
    
    /**
     * Sets filtering rules for the Content model
     * @var array
     */
    public $filterArgs = array(
        'title' => array('type' => 'like'),
        //'status' => array('type' => 'value'),
        //'blog_id' => array('type' => 'value'),
        'search' => array('type' => 'like', 'field' => 'Content.body'),
        //'range' => array('type' => 'expression', 'method' => 'makeRangeCondition', 'field' => 'Content.views BETWEEN ? AND ?'),
        //'username' => array('type' => 'like', 'field' => array('User.username', 'UserInfo.first_name')),
        'tags' => array('type' => 'subquery', 'method' => 'findByTags', 'field' => 'Content.id'),
        'filter' => array('type' => 'query', 'method' => 'orConditions'),
        'enhanced_search' => array('type' => 'like', 'encode' => true, 'before' => false, 'after' => false, 'field' => array('ThisModel.name', 'OtherModel.name')),
    );

    /**
     * Provides logic for searching tags
     * @param type $data
     * @return type
     */
    public function findByTags($data = array()) {
        $this->Tagged->Behaviors->attach('Containable', array('autoFields' => false));
        $this->Tagged->Behaviors->attach('Search.Searchable');
        $query = $this->Tagged->getQuery('all', array(
            'conditions' => array('Tag.name'  => $data['tags']),
            'fields' => array('foreign_key'),
            'contain' => array('Tag')
        ));
        return $query;
    }

    /**
     * Provides standard or search logic
     * @param type $data
     * @return array
     */
    public function orConditions($data = array()) {
        $filter = $data['filter'];
        $cond = array(
            'OR' => array(
                "{$this->alias}.title LIKE" => "%{$filter}%",
                "{$this->alias}.body LIKE" => "%{$filter}%",
            ));
        return $cond;
    }
    
    /**
     * Defines the validation to be used by this model
     * @var array
     */
    public $validate = array(
        'body' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => "Say something!",
                'last' => true
            )
        ),
    );
    
    
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
     * - page
     * - post
     * @return array()
     */
    public function contentTypes(){
        return array(
            'post'=>'Post',
            'page'=>'Page',
            'meta_data'=>'MetaData',
            //'discussion'=>'Disscussion'
        );
    }
    

    /**
     * Returns a list of content statuses
     * - draft
     * - published
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