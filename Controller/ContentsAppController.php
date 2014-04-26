<?php

/**
 * Settings required for the users controller
 *
 * Parbake (http://jasonsnider.com)
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @package	Contents
 */
App::uses('AppController', 'Controller');

/**
 * Application wide controller settings, properties and functionality
 *
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package app
 */
class ContentsAppController extends AppController {
    
    /**
     * The Contents plugin useses the following helpers
     * -TagCloud
     */
    public $helpers = array(
        'Tags.TagCloud'
    );
	
	/**
     * Components used by this controller are
     * -Meta
     * @var array
     */
    public $components = array(
        'Contents.Meta'
    );
	
    /**
     * Called before action
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    /**
     * Called after the action
     * Returns the any meta data that has been created for static pages
     * @return void
     */
    public function beforerender() {
        parent::beforeRender();
        $this->Meta->data();
    }
}