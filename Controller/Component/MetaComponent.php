<?php
/**
 * Returns meta data based on a controller action
 * @package Contents
 */
App::uses('AppController', 'Controller');

/**
 * Returns meta data based on a controller action
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package Contents
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
	 * Content model object
	 * @var object
	 */
	public $Content;
	
    /**
     * Main execution method.
     *
     * @param Controller $controller A reference to the instantiating controller object
     */
    public function initialize(Controller $controller) {
        $this->request = $controller->request;
        $this->response = $controller->response;

        $this->controller = $controller;
        $this->Content = ClassRegistry::init('Contents.Content');
    }
	
    /**
     * Main execution method.
     *
     * @param Controller $controller A reference to the instantiating controller object
     */
    public function startup(Controller $controller) {

        $this->request = $controller->request;
        $this->response = $controller->response;

        $this->controller = $controller;
        $this->Content = ClassRegistry::init('Contents.Content');
		
		
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