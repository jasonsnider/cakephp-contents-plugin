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
 * @package Contents
 */
class ContentsController extends ContentsAppController {

    /**
     * Holds the name of the controller
     * @var string
     */
    public $name = 'Contents';

    /**
     * Components used by this controller are
     * -Prg
     * @var array
     */
    public $components = array(
        'Paginator',
        'Search.Prg'
    );

    /**
     * Called before action
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
        $this->Authorize->allow();
    }

    /**
     * The models used by the controller
     * @var array
     */
    public $uses = array(
        'Contents.Content',
        'Tags.Tag'
    );
    
    /**
     * Presets the variables for search
     * @var type 
     */
    public $presetVars = true; // using the model configuration

    /**
     * Provides basic search functionality
     * @return void
     */
    public function search() {
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Content->parseCriteria($this->Prg->parsedParams());
        
        //$contents = $this->Paginator->paginate();
        
        $this->paginate = array(
            'conditions' => array(
                'Content.content_type NOT'=>'meta_data'
            ),
            'contain'=>array(),
            'limit' => 10
        );
        $contents = $this->paginate('Content');
        $this->set(compact('contents'));
    }
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
        $title_for_layout = 'Site Map';
        $this->set(compact(
            'data',
            'title_for_layout'
        ));
    }

    /**
     * Displays an index of all content
     * @return void
     */
    public function admin_index() {

        $this->paginate = array(
            'conditions' => array(),
            'contain'=>array(),
            'limit' => 30,
            'order'=>'Content.created DESC'
        );

        $data = $this->paginate('Content');
        $title_for_layout = 'Site Map :: CMS Admin Panel';
        $this->set(compact(
            'data',
            'title_for_layout'
        ));
    }
    
    /**
     * A method for creating a new content
     * @return void
     */
    public function admin_create() {
        if(!empty($this->request->data)){

            if($this->Content->save($this->request->data)){
                $this->Session->setFlash(
                    __('Content saved.'), 
                    'success'
                );
                $this->redirect("/admin/contents/contents/edit/{$this->Content->id}");
            }else{
                $this->Session->setFlash(
                    __('Please correct the errors below.'), 
                    'error'
                );
            }
        }
        
        $contentTypes = $this->Content->contentTypes();
        $contentStatuses = $this->Content->contentStatuses();
        
        $this->request->hasEditor = true;
        $title_for_layout = 'Create Content :: CMS Admin Panel';
        $this->set(compact(
            'contentTypes',
            'contentStatuses',
            'title_for_layout'
        ));
    }

    /**
     * Displays content; a single page or post, etc.
     * @param string $token
     * @return void
     */
    public function admin_view($token) {
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
        
        $title_for_layout = "{$content['Content']['title']} :: CMS Admin Panel";
        $this->set(compact(
            'content',
            'title_for_layout'
        ));
    }

    /**
     * Allows a content to be updated
     * @param string $token
     * @return void
     */
    public function admin_edit($token) {
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
            if($this->Content->save($this->request->data['Content'])){
                $this->Session->setFlash('Update saved!', 'success');
            }else{
                $this->Session->setFlash('Please correct the errors below!', 'error');
            }
        }else{
            $this->request->data = $content;
        }
        
        $contentTypes = $this->Content->contentTypes();
        $contentStatuses = $this->Content->contentStatuses();
        $title_for_layout = "{$content['Content']['title']} :: CMS Admin Panel";
        
        $this->request->hasEditor = true;
        
        $this->set(compact(
            'content',
            'contentTypes',
            'contentStatuses',
            'title_for_layout'
        ));
        
    }
    
    /**
     * Removes content from the database
     * @param $id string
     * @return void 
     */
    public function admin_delete($id){
        
        if($this->Content->delete($id)){
            $this->Session->setFlash(__('The selected content has been deleted!'), 'success');
            $this->redirect('/admin/contents');
        }
        
    }

}