<?php
/**
 * Content Model
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
 * Content Model
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
        'q' => array('type' => 'query', 'method' => 'orConditions'),
        'tags' => array('type' => 'subquery', 'method' => 'findByTags', 'field' => 'Content.id'),
    );

    /**
     * Provides logic for searching tags
     * @param array $data
     * @return array
     */
    public function findByTags($data = array()) {
		
        $this->Tagged->Behaviors->attach(
			'Containable', 
			array(
				'autoFields' => false
			)
		);
		
        $this->Tagged->Behaviors->attach('Search.Searchable');
		
        $query = $this->Tagged->getQuery(
			'all', 
			array(
				'conditions' => array(
					'Tag.name'  => $data['tags']
				),
				'fields' => array('foreign_key'),
				'contain' => array('Tag')
			)
		);
		
        return $query;
    }
	
    /**
     * Provides standard or search logic
     * @param array $data
     * @return array
     */
    public function orConditions($data = array()) {
		
        if(empty($data['q'])) { // q is the name of my search field
            return array();
        }
		
        $query = "%{$data['q']}%";
		
        return array(
            'OR' => array(
                "{$this->alias}.title LIKE" => $query,
                "{$this->alias}.body LIKE" => $query,
            )
        );
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
        if(!empty($this->data[$this->alias]['title']) && !isset($this->data[$this->alias]['id'])) {
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
     * Returns the latest post with a status of published
	 * @param string $field The field by which we want to sort (created, modified)
     * @return array()
     */
    public function fetchLatestPost($field = 'modified'){
		
		if (!in_array($field, array('created', 'modified'))) {
			throw new NotFoundException("Expecting created or modified recieved {$field}");
		}
		
        return $this->find(
			'first',
			array(
				'conditions'=>array(
					'Content.content_type'=>'post',
					'Content.content_status'=>'published'
				),
				'contain'=>array(),
				'order'=>"Content.{$field} DESC"
			)
		);
    }
		
}
