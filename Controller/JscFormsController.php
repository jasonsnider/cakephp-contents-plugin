<?php
App::uses('ContentsAppController', 'Contents.Controller');
/**
 * JscForms Controller
 *
 * @property JscForm $JscForm
 */
class JscFormsController extends ContentsAppController {

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
