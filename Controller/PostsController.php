<?php
/**
 * Provides a post-centric controler for contents
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
 * Provides a post-centric controler for contents
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package Contents
 */
class PostsController extends ContentsAppController {

    /**
     * Holds the name of the controller
     *
     * @var string
     */
    public $name = 'Posts';

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
            'view'
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
                'Content.content_type'=>'post'
            ),
            'contain'=>array(
                'CreatedUser'=>array(),
                'Discussion'=>array(
                    'order'=>'Discussion.created DESC',
                    'CreatedUser'=>array(
                        'UserProfile'=>array()
                    ),
                )
            ),
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
        
        if(Configure::check('Parbake.Blog.comment_engine')):
            if(Configure::read('Parbake.Blog.comment_engine') === true):
                if(!empty($this->request->data)){
                    if($this->Content->Discussion->save($this->request->data['Discussion'])){
                        $this->Content->Discussion->create();
                        $this->Session->setFlash(__('Your comment has been saved.'), 'success');   
                        //Since we are not reloading the page, clear out the request data on success
                        $this->request->data = array();
                    }else{
                        $this->Session->setFlash(__('Your comment could not be saved.'), 'error');
                    }
                }
            endif; 
        endif;
        
        $content = $this->Content->find(
            'first',
            array(
                'conditions'=>array(
                    'or'=>array(
                        'Content.id'=>$token,
                        'Content.slug'=>$token
                    )
                ),
                'contain'=>array(
                    'CreatedUser'=>array(
                        'UserProfile'=>array()
                    ),
                    'Discussion'=>array(
                        'order'=>'Discussion.created DESC',
                        'CreatedUser'=>array(
                            'UserProfile'=>array()
                        ),
                    )
                )
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

}