<?php
/**
 * MetaData controller
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
 * MetaData controller
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package Contents
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
        'Contents.Content',
    );

    /**
     * Allows a user to create MetaData against a controller and action
     * @param string $controller
     * @param string $action
     * @return void
     */
    public function admin_create($controller, $action) {

        if(!empty($this->request->data)){
            
            if($this->Content->save($this->request->data)){
                $this->Session->setFlash(__('The meta data has been created'),'success');
                $this->redirect(
                    array(
                        'admin'=>true,
                        'controller'=>'meta_data',
                        'action'=>'admin_edit',
                        $controller,
                        $action
                    )
                );
            }else{
                $this->Session->setFlash(__('Please correct the errors below'),'error');
            }
        }

        $this->set(compact(
            'controller',
            'action'
        ));
    }
    
    /**
     * Allows a user to edit MetaData against a controller and action
     * @param string $controller
     * @param string $action
     * @return void
     */
    public function admin_edit($controller, $action) {

        //1. Look for the requested
        $content = $this->Content->find(
            'first',
            array(
                'conditions'=>array(
                    'Content.controller'=>$controller,
                    'Content.action'=>$action
                ),
                'contain'=>array()
            )
        );
        
        //2. If no meta data can be found for the requested controller action, redirect to admin_create
        if(empty($content)){
            $this->redirect(
                array(
                    'admin'=>true,
                    'controller'=>'meta_data',
                    'action'=>'admin_create',
                    $controller,
                    $action
                )
            );
        }
        
        
        if(!empty($this->request->data)){
            
            if($this->Content->save($this->request->data)){
                $this->Session->setFlash(__('The meta data has been updated'),'success');
                $this->redirect(
                    array(
                        'admin'=>true,
                        'controller'=>'meta_data',
                        'action'=>'admin_edit',
                        $controller,
                        $action
                    )
                );
            }else{
                $this->Session->setFlash(__('Please correct the errors below'),'error');
            }
            
        }else{
            $this->request->data = $content;
        }

        $this->set(compact(
            'controller',
            'action'
        ));
    }

    
}