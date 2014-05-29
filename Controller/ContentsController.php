<?php
/**
 * Provides controll logic for managing content
 *
 * JSC (http://jasonsnider.com/jsc)
 * Copyright 2013-2014, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013-2014, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package Contents
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
        $this->Auth->allow(
            'index',
            'search'
        );
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
        
        $conditions = $this->Content->parseCriteria($this->Prg->parsedParams());
        $conditions['Content.content_type NOT']='meta_data';
		$conditions['Content.content_status']='published';
        
        $this->paginate = array(
            'conditions' => $conditions,
            'contain'=>array(),
            'limit' => 10
        );
        
        $this->request->title = 'Search';
        $this->request->checkForMeta = true;
        $contents = $this->paginate('Content');
        $this->set(compact('contents'));
    }
    /**
     * Displays an index of all content
	 * @param string $category
     * @return void
     */
    public function index($category=null) {

		$conditions = array();
		$conditions['Content.category_id'] = $category;
		
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => 30
        );

        $data = $this->paginate('Content');
        $this->request->title = 'Contents';
        $this->request->checkForMeta = true;
        $this->set(compact(
            'data'
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
        $title_for_layout = 'Content';
        $this->set(compact(
            'data',
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