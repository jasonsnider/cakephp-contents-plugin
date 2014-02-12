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
        $this->metaData();
    }
    
    /**
     * Retrives and set's the meta data for the current controller/action
     * @return void
     */
    public function metaData(){
        
        // 1) If the action is requesting a check for meta data
        if(isset($this->request->checkForMeta)){
            
            // 2) Try and find the meta data
            $metaData = $this->Content->find(
                'first',
                array(
                    'conditions'=>array(
                        'Content.controller'=>$this->request->controller,
                        'Content.action'=>$this->request->action
                    ),
                    'fields'=>array(
                        'title',
                        'description',
                        'keywords'
                    ),
                    'contain'=>array()
                )
            );
            
            // 3) Then set the variable accordingly
            if(!empty($metaData)){
                $this->request->title = $metaData['Content']['title'];
                $this->request->keywords  = $metaData['Content']['keywords'];
                $this->request->description  = $metaData['Content']['description'];
            }

        }
    }
        

}