<?php
/**
 * A class for determinig if a user is authorized for a particular actions.
 *
 * Parbake (http://jasonsnider.com/parbake)
 * Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2012, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-licensephp)
 */
App::uses('AppController', 'Controller');

/**
 * A class for determinig if a user is authorized for a particular actions.
 * 
 * Some parts adapted from
 * @link https://github.com/cakephp/cakephp/blob/master/lib/Cake/Controller/Component/AuthComponent.php
 * 
 * @author Jaso D Snider <jason@jasonsnider.com>
 * @package	Users
 */
class MetaComponent extends Component {

    /**
     * Request object
     *
     * @var CakeRequest
     */
    public $request;

    /**
     * Response object
     *
     * @var CakeResponse
     */
    public $response;

    /**
     * Controller object
     *
     * @var object
     */
    public $controller;

    /**
     * Main execution method.  Handles redirecting of invalid users, and processing
     * of login form data.
     *
     * @param Controller $controller A reference to the instantiating controller object
     * @todo Decide the best course of action to take after a Authorization Fails
     * @return mixed redirects a failed authorization attempt
     */
    public function startup(Controller $controller) {

        $this->request = $controller->request;
        $this->response = $controller->response;

        $this->controller = $controller;
        $this->UserPrivilege = ClassRegistry::init('UserPrivilege');
    }

    /**
     * Retrives and set's the meta data for the current controller/action
     * @return void
     */
    public function data(){
        
        // 1) If the action is requesting a check for meta data
        if(isset($this->request->checkForMeta)){
            
            // 2) Try and find the meta data
            $metaData = $this->Content->find(
                'first',
                array(
                    'conditions'=>array(
                        'Content.controller'=>$this->request->controller,
                        'Content.action'=>$this->request->action
                    ),
                    'fields'=>array(
                        'title',
                        'description',
                        'keywords'
                    ),
                    'contain'=>array()
                )
            );
            
            // 3) Then set the variable accordingly
            if(!empty($metaData)){
                $this->request->title = $metaData['Content']['title'];
                $this->request->keywords  = $metaData['Content']['keywords'];
                $this->request->description  = $metaData['Content']['description'];
            }

        }
    }

}