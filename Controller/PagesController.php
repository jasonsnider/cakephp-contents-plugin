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
 * @package Pages
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
        'Contents.Page',
    );

    /**
     * Displays an index of all content
     * @return void
     */
    public function index() {

        $this->paginate = array(
            'conditions' => array(
                'Page.content_type'=>'page',
                'Page.content_status'=>'published',
            ),
            'contain'=>array(),
            'order'=>'Page.created DESC',
            'limit' => 30
        );

        $this->request->title = 'Pages';
        $this->request->checkForMeta = true;
        $data = $this->paginate('Page');
        $this->set(compact('data'));
    }
    
    /**
     * Displays content; a single page or page, etc.
     * @param string $token
     * @return void
     */
    public function view($token) {
        
        $page = $this->Page->fetch($token);
        
        if(empty($page)){
            throw new NotFoundException();
        }
        
        //Send the id back to the view
        $id = $page['Page']['id'];
        $this->request->title = $page['Page']['title'];
        
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
    public function admin_admin(){}
	
    /**
     * A method for creating a new content
     * @return void
     */
    public function admin_create() {
        if(!empty($this->request->data)){
				$this->request->data['Page']['slug'] = $this->Page->slug($this->request->data);
            if($this->Page->save($this->request->data)){
                $this->Session->setFlash(__('Page saved.'), 'success');
                $this->redirect("/admin/contents/pages/edit/{$this->Page->id}");
            }else{
                $this->Session->setFlash(__('Please correct the errors below.'), 'error');
            }
        }
        
        $this->request->hasEditor = true;
        $title_for_layout = 'Create a Page';
        $this->set(compact(
            'title_for_layout'
        ));
    }
	
    /**
     * Allows a content to be updated
     * @param string $token
     * @return void
     */
    public function admin_edit($token) {
		
		
		
		if (!$this->Page->exists($token)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Page->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved.'), 'success');
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Page->fetch($token);
		}
		
		$categories = $this->Page->Category->find('list');
        $this->set(compact(
			'categories',
            'title_for_layout'
        )); 
		
        $this->request->title = $this->request->data['Page']['title'];
        $this->request->hasEditor = true;
    }
}