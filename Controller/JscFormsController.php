<?php
App::uses('ContentsAppController', 'Contents.Controller');
/**
 * JscForms Controller
 *
 * @property JscForm $JscForm
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class JscFormsController extends ContentsAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->JscForm->recursive = 0;
		$this->set('jscForms', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JscForm->exists($id)) {
			throw new NotFoundException(__('Invalid jsc form'));
		}
		$options = array('conditions' => array('JscForm.' . $this->JscForm->primaryKey => $id));
		$this->set('jscForm', $this->JscForm->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JscForm->create();
			if ($this->JscForm->save($this->request->data)) {
				$this->Session->setFlash(__('The jsc form has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jsc form could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JscForm->exists($id)) {
			throw new NotFoundException(__('Invalid jsc form'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JscForm->save($this->request->data)) {
				$this->Session->setFlash(__('The jsc form has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jsc form could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('JscForm.' . $this->JscForm->primaryKey => $id));
			$this->request->data = $this->JscForm->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JscForm->id = $id;
		if (!$this->JscForm->exists()) {
			throw new NotFoundException(__('Invalid jsc form'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JscForm->delete()) {
			$this->Session->setFlash(__('The jsc form has been deleted.'));
		} else {
			$this->Session->setFlash(__('The jsc form could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->JscForm->recursive = 0;
		$this->set('jscForms', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->JscForm->exists($id)) {
			throw new NotFoundException(__('Invalid jsc form'));
		}
		$options = array('conditions' => array('JscForm.' . $this->JscForm->primaryKey => $id));
		$this->set('jscForm', $this->JscForm->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->JscForm->create();
			if ($this->JscForm->save($this->request->data)) {
				$this->Session->setFlash(__('The jsc form has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jsc form could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->JscForm->exists($id)) {
			throw new NotFoundException(__('Invalid jsc form'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JscForm->save($this->request->data)) {
				$this->Session->setFlash(__('The jsc form has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jsc form could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('JscForm.' . $this->JscForm->primaryKey => $id));
			$this->request->data = $this->JscForm->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->JscForm->id = $id;
		if (!$this->JscForm->exists()) {
			throw new NotFoundException(__('Invalid jsc form'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JscForm->delete()) {
			$this->Session->setFlash(__('The jsc form has been deleted.'));
		} else {
			$this->Session->setFlash(__('The jsc form could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
