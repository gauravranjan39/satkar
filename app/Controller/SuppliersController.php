<?php
App::uses('AppController', 'Controller');
/**
 * Suppliers Controller
 *
 * @property Supplier $Supplier
 * @property PaginatorComponent $Paginator
 */
class SuppliersController extends AppController {


	public function index() {
		$this->layout = "my_layout";
		$supplierLists = $this->Supplier->find('all');
		$this->set('supplierLists',$supplierLists);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
		$this->set('supplier', $this->Supplier->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = "my_layout";
		if ($this->request->is('post')) {
			$this->Supplier->create();
			if ($this->Supplier->save($this->request->data)) {
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->SetFlash('The supplier could not be saved. Please, try again.', 'error');
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
		//$id = base64_decode($id);
		$this->layout = "my_layout";
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid Supplier'));
		}
		if ($this->request->is(array('post', 'put'))) {
				//$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['hash_token']);
			if ($this->Supplier->save($this->request->data)) {
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->SetFlash('The Supplier could not be saved. Please, try again.', 'error');
			}
		} else {
			$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
			$this->request->data = $this->Supplier->find('first', $options);
		}
	}

	public function check_email_unique() {
		$this->autoRender = false;
		$user_email = $_POST['data'];
		$chk_email = $this->Supplier->find('first',array('conditions'=>array('email LIKE'=>$user_email)));
		if ($chk_email) {
		  echo 0;
		} else {
	   		echo 1;
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
		$this->Supplier->id = $id;
		if (!$this->Supplier->exists()) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Supplier->delete()) {
			$this->Flash->success(__('The supplier has been deleted.'));
		} else {
			$this->Flash->error(__('The supplier could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Supplier->recursive = 0;
		$this->set('suppliers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
		$this->set('supplier', $this->Supplier->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Supplier->create();
			if ($this->Supplier->save($this->request->data)) {
				$this->Flash->success(__('The supplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The supplier could not be saved. Please, try again.'));
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
	// public function admin_edit($id = null) {
	// 	if (!$this->Supplier->exists($id)) {
	// 		throw new NotFoundException(__('Invalid supplier'));
	// 	}
	// 	if ($this->request->is(array('post', 'put'))) {
	// 		if ($this->Supplier->save($this->request->data)) {
	// 			$this->Flash->success(__('The supplier has been saved.'));
	// 			return $this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Flash->error(__('The supplier could not be saved. Please, try again.'));
	// 		}
	// 	} else {
	// 		$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
	// 		$this->request->data = $this->Supplier->find('first', $options);
	// 	}
	// }

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Supplier->id = $id;
		if (!$this->Supplier->exists()) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Supplier->delete()) {
			$this->Flash->success(__('The supplier has been deleted.'));
		} else {
			$this->Flash->error(__('The supplier could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
