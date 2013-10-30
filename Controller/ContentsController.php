<?php

/**
 * Provides controll logic for managing content
 *
 * Parbake (http://jasonsnider.com/parbake)
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package       Users
 */
App::uses('ContentsAppController', 'Contents.Controller');

/**
 * Provides controll logic for managing content
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package app/Users
 */
class ContentsController extends ContentsAppController {

    /**
     * Holds the name of the controller
     *
     * @var string
     */
    public $name = 'Contents';

    /**
     * Call the components to be used by this controller
     *
     * @var array
     */
    //public $components = array();

    /**
     * Called before action
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
        $this->Authorize->allow();
    }

    /**
     * The models used by the controller
     *
     * @var array
     */
    public $uses = array(
        'Contents.Content',
    );

    /**
     * Displays an index of all content
     * @return void
     */
    public function index() {

        $this->paginate = array(
            'conditions' => array(),
            'limit' => 30
        );

        $data = $this->paginate('Content');
        $this->set(compact('data'));
    }

    /**
     * A method for creating a new content
     * @return void
     */
    public function create() {
        if(!empty($this->request->data)){
            if($this->Content->save($this->request->data)){
                $this->Session->setFlash('Saved');
            }else{
                $this->Session->setFlash('Failed');
            }
        }
        
        $contentTypes = $this->Content->contentTypes();
        
        $this->set(compact(
            'contentTypes' 
        ));
    }

    /**
     * Displays content; a single page or post, etc.
     * @param string $token
     * @return void
     */
    public function view($token) {
        $content = $this->Content->find(
            'first',
            array(
                'conditions'=>array(
                    'or'=>array(
                        'Content.id',
                        'Content.slug'
                    )
                ),
                'contain'=>array()
            )
        );
        
        $this->set(compact(
            'content'
        ));
    }

    /**
     * Allows a content to be updated
     * @param string $token
     * @return void
     */
    public function edit($token) {
        $content = $this->Content->find(
            'first',
            array(
                'conditions'=>array(
                    'or'=>array(
                        'Content.id'=>$token,
                        'Content.slug'=>$token
                    )
                ),
                'contain'=>array()
            )
        );
        
        if(!empty($this->request->data)){
            
        }else{
            $this->request->data = $content;
        }
        
        $this->set(compact(
            'content'
        ));
        
    }
    
    /**
     * Removes content from the database
     * @param $id string
     * @return void 
     */
    public function delete($id){
        
        if($this->Content->delete($id)){
            $this->Session->setFlash(__('The selected content has been deleted!'), 'error');
            $this->redirect('/contents');
        }
        
    }

}