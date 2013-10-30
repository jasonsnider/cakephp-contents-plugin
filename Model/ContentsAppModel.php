<?php

App::uses('AppModel', 'Model');

class ContentsAppModel extends AppModel {

    /**
     * Specifies the behaviors invoked by all models
     * @var array 
     */
    public $actsAs = array(
        'Containable'
    );
}