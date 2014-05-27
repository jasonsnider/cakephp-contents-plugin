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
 */
App::uses('ContentsAppModel', 'Contents.Model');

/**
 * Content Model
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Contents
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
        'Category' => array(
            'className' => 'Contents.Category',
            'foreignKey' => 'category_id',
            'dependent' => true
        ),
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
 * hasAndBelongsToMany associations
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
                'message' => "The content's body cannot be empty.",
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
	
	public function listContentsByCategory($categoryId, $limit=10, $contentType = 'post'){
		if(empty($categoryId)){
			return false;
		}
		
		return $this->find(
			'all',
			array(
				'conditions'=>array(
					'Content.category_id'=>$categoryId,
					'Content.content_type'=>$contentType
				),
				'fields'=>array(
					'Content.content_type',
					'Content.slug',
					'Content.title'
				),
				'contain'=>array(
					'Category'=>array(
						'fields'=>array(
							'Category.title'
						)
					)
				),
				'order'=>array(
					'Content.created DESC'
				),
				'limit'=>$limit
			)
		);
	}
	
}