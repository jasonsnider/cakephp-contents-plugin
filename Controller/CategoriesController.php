<?php
App::uses('ContentsAppController', 'Contents.Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriesController extends ContentsAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	
/**
 * Called before action
 * @return void
 */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
        $this->Authorize->allow();
    }
	
/**
 * admin_index method
 *
 * @return void
 */
	public function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->Paginator->paginate());
		
		$this->request->title = __('Categories');
		$this->request->showTitle = true;
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array(
			'conditions' => array('Category.' . $this->Category->primaryKey => $id),
			'contain'=>array(
				'Content'=>array()
			),
			'order'=>array('Content.created DESC')
		);
		$category = $this->Category->find('first', $options);
		$this->set('category', $category);
		
		$this->request->title = $category['Category']['title'];
		$this->request->showTitle = true;
	}
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->Paginator->paginate());
		
		$this->request->title = __('Categories');
		$this->request->showTitle = true;
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$category = $this->Category->find('first', $options);
		$this->set('category', $category);
		
		$this->request->title = $category['Category']['title'];
		$this->request->showTitle = true;
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			$this->request->data['Category']['slug'] = $this->Category->slug($this->request->data);
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
		$contents = $this->Category->Content->find('list');
		$this->set(compact('contents'));
		
		$this->request->title = __('Add a Category');
		$this->request->showTitle = true;
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$contents = $this->Category->Content->find('list');
		$this->set(compact('contents'));
		
		$this->request->title = $this->request->data['Category']['title'];
		$this->request->showTitle = true;
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
