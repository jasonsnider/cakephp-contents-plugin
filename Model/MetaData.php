<?php
/**
 * Content MetaData
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
 * Content MetaData
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package	Contents
 */
class MetaData extends ContentsAppModel {

/**
 * The static name this model
 * @var string
 */
    public $name = 'MetaData';

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
        'CreatedUser' => array(
            'className' => 'Users.User',
            'foreignKey' => 'created_user_id',
            'dependent' => true
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
 * Execute prior to validation
 * - Forces all saves from this model to save with a meta_data content_type
 * @param array $options
 * @return boolean
 */
    public function beforeSave($options = array()) {
        $this->data[$this->alias]['content_type'] = 'meta_data';
		$this->data[$this->alias]['content_status'] = 'published';
        return true;
	}
	
/**
 * Returns meta data by a given id or slug
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
 * Returns meta data based on a given controller action
 * @param string $controller
 * @param string $action
 */
	public function fetchMetaDataForControllerAction($controller, $action){
		return $this->find(
			'first',
			array(
				'conditions'=>array(
					"{$this->alias}.controller"=>$controller,
					"{$this->alias}.action"=>$action
				),
				'fields'=>array(
					'id',
					'title',
					'description',
					'keywords'
				),
				'contain'=>array()
			)
		);
	}
}
