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
     * A list of content types
     * @return array()
     */
    public $contentTypes = array(
		'post'=>'Post',
		'page'=>'Page',
		'meta_data'=>'MetaData'
	);

    /**
     * A list of content statuses
     * @return array()
     */
    public $contentStatuses = array(
		'archive'=>'Archive',
		'draft'=>'Draft',
		'published'=>'Published'
	);
	
    /**
     * A recursive function for creating unique slugs against user submited data ({$this->alias}.title)
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
	
	/**
	 * Pulls a list of content categories
	 * @param string $categoryId
	 * @param integer $limit
	 * @param string $contentType
	 * @return boolean
	 */
	public function listContentsByCategory($categoryId, $limit=10, $contentType = 'post'){
		
		if(empty($categoryId)){
			return false;
		}
		
		return $this->find(
			'all',
			array(
				'conditions'=>array(
					"{$this->alias}.category_id"=>$categoryId,
					"{$this->alias}.content_type"=>$contentType
				),
				'fields'=>array(
					"{$this->alias}.content_type",
					"{$this->alias}.slug",
					"{$this->alias}.title"
				),
				'contain'=>array(
					'Category'=>array(
						'fields'=>array(
							'Category.title'
						)
					)
				),
				'order'=>array(
					"{$this->alias}.created DESC"
				),
				'limit'=>$limit
			)
		);
	}
}