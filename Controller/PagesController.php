<?php
/**
 * Provides a page-centric controler for contents
 *
 * JSC (http://jasonsnider.com/jsc)
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
App::uses('CakeEmail', 'Network/Email');
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
     * The models used by the controller
     *
     * @var array
     */
    public $uses = array(
		'Contents.Content',
        'Contents.Page'
    );

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
     * Displays an index of all content
     * @return void
     */
    public function index($category=null) {

		$conditions = array();
		if(!empty($category)){
			$conditions['Page.category_id'] = $category;
		}
		
		$conditions['Page.content_status'] = array(
			'archive',
			'published'
		);

        $this->paginate = array(
			'conditions' => $conditions,
            'contain'=>array(),
            'order'=>'Page.created DESC',
            'limit' => 30
        );

        $this->request->title = 'Pages';
        $data = $this->paginate('Page');
        $this->set(compact('data'));
    }
    
    /**
     * Displays content; a single page or page, etc.
     * @param string $token
     * @return void
     */
    public function view($token) {
        
		$content = $this->Page->fetch($token);
		
		//Extract the form data
		
		if(!empty($content['JscForm'])){
			$form = json_decode($content['JscForm']['form'], true);
		}
		
		//Set the validation rules
		if(isset($form['Validate'])){
			$this->Page->JscForm->validate = $form['Validate'];
		}

		//Check for a form submission
        if(!empty($this->request->data)){
			
			//Validate the fomr submission
            if($this->Page->JscForm->saveAll($this->request->data, array('validate' => 'only'))){
				
				//Build the email's content by writing each key=>value pair as a line
				$content = null;
				
				foreach($this->request->data['JscForm'] as $key => $value){
					if($key != 'redirect'){
						$key = Inflector::humanize($key);
						$content .= "{$key}: {$value}\n";
					}
				}
				
				//Build and send the email
				$email = new CakeEmail('contact');
				$email->from($this->request->data['JscForm']['email'])
					->replyTo($this->request->data['JscForm']['email'])
					->viewVars(
						array(
							'content' => $content
						)
					)
					->send();
				
				if(isset($this->request->data['JscForm']['redirect'])){
					$this->redirect($this->request->data['JscForm']['redirect']);
				}
            }

        }
		
        if(empty($content)){
            throw new NotFoundException();
        }

        //Send the id back to the view
        $id = $content['Page']['id'];
        
        $this->request->title = $content['Page']['title'];
		$this->request->categoryId = $content['Page']['category_id'];
		
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
        $this->set(compact(
            'content'
        ));
    }
    
    /**
     * An entry point for the admin portal.
     * @return void
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
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved.'), 'success');
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Page->fetch($token);
		}
		
		$contentStatuses = $this->Page->contentStatuses;
		
		$categories = $this->Page->Category->find('list');
		
		$jscForms = $this->Page->JscForm->find('list');
		
        $this->set(compact(
			'categories',
			'contentStatuses',
			'jscForms',
            'title_for_layout'
        )); 
		
        $this->request->title = $this->request->data['Page']['title'];
        $this->request->hasEditor = true;
    }
}