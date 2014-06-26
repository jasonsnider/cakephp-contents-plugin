<?php
/**
 * Returns meta data based on a controller action
 * @package Contents
 */
App::uses('JscAppController', 'Jsc.Controller');
App::uses('MetaData', 'Contents.Model');

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
	public $MetaData;
	
    /**
     * Main execution method.
     *
     * @param Controller $controller A reference to the instantiating controller object
     */
    public function initialize(Controller $controller) {
        $this->request = $controller->request;
        $this->response = $controller->response;

        $this->controller = $controller;
        $this->MetaData = ClassRegistry::init('Contents.MetaData');
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
        $this->MetaData = ClassRegistry::init('Contents.MetaData');
		
		
    }

    /**
     * Retrives and set's the meta data for the current controller/action
     * @return void
     */
    public function data(){ 
		$this->request->MetaData = array();
        // 1) If the action is requesting a check for meta data
        //if(isset($this->request->checkForMeta)){
            
            // 2) Try and find the meta data
            $metaData = $this->MetaData->fetchMetaDataForControllerAction(
				$this->request->controller,
				$this->request->action
			);

            // 3) Then set the variable accordingly
            if(!empty($metaData)){
                $this->request->title = $metaData['MetaData']['title'];
				$this->request->showTitle  = true;
                $this->request->keywords  = $metaData['MetaData']['keywords'];
                $this->request->description  = $metaData['MetaData']['description'];
				$this->request->MetaData = $metaData['MetaData'];
            }

		//} 
    }

}