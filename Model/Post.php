<?php
/**
 * Content Post
 *
 * Copyright 2014, Jason D Snider. (http://jasonsnider.com)
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
 * Content Post
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Contents
 */
class Post extends ContentsAppModel {

/**
 * The static name this model
 * @var string
 */
    public $name = 'Post';

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
        'Jsc.Loggable',
        'Jsc.Scrubable' => array(
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
 * hasAndBelongsToMany associations
 * @var array
 */
    public $hasAndBelongsToMany = array(
        'Tag' => array(
            'with' => 'Tagged'
        )
    );
	
/**
 * Defines the validation rules for user input
 * @var array
 */
    public $validate = array(
        'title' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => "Please enter a title",
                'last' => true
            )
        ),
    );
	
/**
 * Forces all saves from this model to save with a post content_type
 * @param array $options
 * @return boolean
 */
    public function beforeSave($options = array()) {
        $this->data[$this->alias]['content_type'] = 'post';
        return true;
	}
	
/**
 * Forces all finds against the Post model to look for a content_type of post
 * @param array $queryData
 * @return boolean
 */
	public function beforeFind($queryData) {
		if (!isset($queryData['conditions'][$this->alias.'.content_type'])) {
			// Force all finds to only find stuff which is live
			$queryData['conditions'][$this->alias.'.content_type'] = 'post';
		}
		return $queryData;
	}
	
/**
 * Returns a post by a given id or slug
 * @param string $token
 * @return array
 */
	public function fetch($token){
		return $this->find(
            'first',
            array(
                'conditions'=>array(
                    'or'=>array(
                        "{$this->alias}.id"=>$token,
                        "{$this->alias}.slug"=>$token
                    )
                ),
                'contain'=>array(
                    'CreatedUser'=>array(
                        'UserProfile'=>array()
                    ),
                    'Tag'=>array(
                        'Tagged'=>array()
                    )
                )
            )
        );						
	}
	
/**
 * Returns the latest post with a status of published
 * @param string $field The field by which we want to sort (created, modified)
 * @return array()
 */
    public function fetchLatest($field = 'created'){
		
		if (!in_array($field, array('created', 'modified'))) {
			throw new NotFoundException("Expecting created or modified recieved {$field}");
		}
		
        return $this->find(
			'first',
			array(
				'conditions'=>array(
					"{$this->alias}.content_type"=>'post',
					"{$this->alias}.content_status"=>'published'
				),
				'contain'=>array(),
				'order'=>"{$this->alias}.{$field} DESC"
			)
		);
    }
}
