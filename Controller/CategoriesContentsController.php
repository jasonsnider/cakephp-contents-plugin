<?php
App::uses('ContentsAppController', 'Contents.Controller');
/**
 * CategoriesContents Controller
 *
 * @property CategoriesContent $CategoriesContent
 */
class CategoriesContentsController extends ContentsAppController {
	
/**
 * Called before action
 * @return void
 */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('_none');
        $this->Authorize->allow();
    }
	
/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->CategoriesContent->id = $id;
		if (!$this->CategoriesContent->exists()) {
			throw new NotFoundException(__('Invalid categories content'));
		}
		
		if ($this->CategoriesContent->delete()) {
			$this->Session->setFlash(__('The categories content has been deleted.'));
		} else {
			$this->Session->setFlash(__('The categories content could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}