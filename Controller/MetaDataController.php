<?php
/**
 * MetaData controller
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
 * @package Users
 */
App::uses('ContentsAppController', 'Contents.Controller');

/**
 * MetaData controller
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package MetaDatas
 */
class MetaDataController extends ContentsAppController {

    /**
     * Called before action
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * The models used by the controller
     * @var array
     */
    public $uses = array(
        'Contents.MetaData',
    );

    /**
     * Allows a user to create MetaData against a controller and action
	 * @param string $plugin If the plugin is empty set this to 0 when passing it into the url
     * @param string $controller
     * @param string $action
	 * @param string $token
     * @return void
     */
    public function admin_add($plugin, $controller, $action, $token=null) {
		
		if(empty($plugin)){
			$plugin = null;
		}
		
        if(!empty($this->request->data)){
            
            if($this->MetaData->save($this->request->data)){
				$this->request->data['MetaData']['slug'] = $this->MetaData->slug($this->request->data);
			
                $this->Session->setFlash(__('The meta data has been created'), 'success');
                $this->redirect("/admin/contents/meta_data/edit/{$this->MetaData->id}");
            }else{
                $this->Session->setFlash(__('Please correct the errors below'), 'error');
            }
        }else{
			$this->request->data['MetaData']['title'] = Inflector::humanize($action);
		}
		

		
        $this->set(compact(
			'action',
            'controller',
			'plugin',
			'token'
        ));
    }
    
    /**
     * Allows a user to edit MetaData against a controller and action
     * @param string $token
     * @return void
     */
    public function admin_edit($token) {

        //Look for the requested
        $meta_data = $this->MetaData->fetch($token);
                
        //Save the user submitted data
        if(!empty($this->request->data)){
            
            if($this->MetaData->save($this->request->data)){
                $this->Session->setFlash(__('The meta data has been updated'), 'success');
                $this->redirect("/admin/contents/meta_data/edit/{$token}/");
            }else{
                $this->Session->setFlash(__('Please correct the errors below'), 'error');
            }
            
        }else{
            $this->request->data = $meta_data;
        }
		
		$this->request->hasEditor = true;
    }
}