<?php
/**
 * Provides a discussion-centric controller for contents
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
class DiscussionsController extends ContentsAppController {

    /**
     * Holds the name of the controller
     *
     * @var string
     */
    public $name = 'Discussions';

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
        $this->Auth->allow('__none');
        $this->Authorize->allow();
        $this->Security->unlockedActions = array('ajax_create', 'ajax_index');
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
     * Allows a user to make a comment
     * @param string $modelId
     * @return void
     */
    public function ajax_create($modelId, $model='Evolution'){
        $saved = false;
        $this->layout = 'ajax';

        if(!empty($this->request->data)){
            
            if($this->Content->save($this->request->data)){
                $saved = true;
            }else{
                $ajaxMessage = __('Please correct the errors below.');
            }
            
        }else{
            $this->request->data = array(
                'Content'=>array(
                    'model'=>$model,
                    'model_id'=>$modelId
                )
            );
        }
        
        //$this->request->hasEditor = true;
        $this->set(compact('modelId', 'saved', 'ajaxMessage'));
    }
    
    /**
     * Returns all comments created against a given  model_id
     * @param string $modelId
     * @return void
     */
    public function ajax_index($modelId){
        
        $this->layout = 'ajax';
        
        $comments = $this->Content->find(
            'all',
            array(
                'conditions'=>array(
                    'Content.model_id'=>$modelId
                ),
                'contain'=>array(
                    'CreatedUser'=>array(
                        'UserProfile'
                    )
                ),
                
                'order'=>'Content.created DESC'
            )
        );
        
        $this->set(compact('comments', 'modelId'));
    }
    
}