<?php
/**
 * Provides a page-centric controler for contents
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
 * Provides a page-centric controler for contents
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package Contents
 */
class PagesController extends ContentsAppController {

    /**
     * Holds the name of the controller
     *
     * @var string
     */
    public $name = 'Pages';

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
        $this->Auth->allow(
            'index',
            'view',
            'home'
        );
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
            'conditions' => array(
                'Content.content_type'=>'page'
            ),
            'contain'=>array(),
            'order'=>'Content.created DESC',
            'limit' => 30
        );

        $this->request->checkForMeta = true;
        $data = $this->paginate('Content');
        $this->set(compact('data'));
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
                        'Content.id'=>$token,
                        'Content.slug'=>$token
                    )
                ),
                'contain'=>array()
            )
        );
        
        //Send the id back to the view
        $id = $content['Content']['id'];
        $this->request->title = $content['Content']['title'];
        
        $this->set(compact(
            'content',
            'id'
        ));
    }
    
    /**
     * Displays the home page
     * @param string $token
     * @return void
     */
    public function home() {
        $this->request->checkForMeta = true;
        $this->set(compact(
            'content'
        ));
    }
    
    /**
     * An entry point for the admin portal.
     */
    public function admin_admin(){
        
    }
}