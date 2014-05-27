<?php
/**
 * All models in the Contents plugin SHOULD inheirit from this model
 */
App::uses('AppModel', 'Model');

/**
 * All models in the Contents plugin SHOULD inheirit from this model
 * @package Contents
 */
class ContentsAppModel extends AppModel {

    /**
     * Specifies the behaviors invoked by all models
     * @var array 
     */
    public $actsAs = array(
        'Containable'
    );
	
    /**
     * Returns a list of content types
     * - page
     * - post
	 * -meta_data
     * @return array()
     */
    public function contentTypes(){
        return array(
            'post'=>'Post',
            'page'=>'Page',
            'meta_data'=>'MetaData'
        );
    }

    /**
     * Returns a list of content statuses
     * - draft
     * - published
     * @return array()
     */
    public function contentStatuses(){
        return array(
            'draft'=>'Draft',
            'published'=>'Published'
        );
    }
	
    /**
     * A recursive function for creating unique slugs against user submited data (Content.title)
     * @param array $data
     * @param interger $counter
     * @return string
     */
    public function slug($data, $counter = 0){
                    
        //Create the slug from user created data
        if(empty($counter)){
            $slug = Inflector::slug(strtolower($data[$this->alias]['title']), '-');
        }else{
            $slug = Inflector::slug(strtolower("{$data[$this->alias]['title']} {$counter}"), '-');
        }

        //Does the slug already exists
        $checkCollision = $this->find(
            'first',
            array(
                'conditions'=>array(
                    "{$this->alias}.slug"=>$slug
                ),
                'contain'=>array()
            )
        );
             
        if(!empty($checkCollision)){
            //The slug already exists, recursivly pass the counter into the slug method
            $counter = $counter + 1;
            $slug = $this->slug($data, $counter);
        }
        
        return $slug;          
    }
}