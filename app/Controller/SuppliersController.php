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

	public function view($id = null) {
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid supplier'));
		}
		$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
		$this->set('supplier', $this->Supplier->find('first', $options));
	}

	public function admin_add() {
		// $this->layout = "my_layout";
		$this->layout = "admin_layout";
		if ($this->request->is('post')) {
			$this->Supplier->create();
			if ($this->Supplier->save($this->request->data)) {
				return $this->redirect(array('action' => 'admin_index'));
			} else {
				$this->Session->SetFlash('The supplier could not be saved. Please, try again.', 'error');
			}
		}
	}

	public function admin_edit($id = null) {
		// $this->layout = "my_layout";
		$this->layout = "admin_layout";
		if (!$this->Supplier->exists($id)) {
			throw new NotFoundException(__('Invalid Supplier'));
		}
		if ($this->request->is(array('post', 'put'))) {
				//$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['hash_token']);
			if ($this->Supplier->save($this->request->data)) {
				return $this->redirect(array('action' => 'admin_index'));
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
		if ($this->request->is('post')) {
			if (isset($this->request->data['get_supplierId']) && $this->request->data['get_supplierId'] !='' ) {
				$supplier_email = trim($this->request->data['get_supplierEmail']);
				$chk_email = $this->Supplier->find('first',array('conditions'=>array('email LIKE'=>$supplier_email,'id !='=>$this->request->data['get_supplierId'])));
			}  else {
				$supplier_email = trim($this->request->data);
				$chk_email = $this->Supplier->find('first',array('conditions'=>array('email LIKE'=>$supplier_email)));
			}
			if ($chk_email) {
			  	echo 0;
			} else {
				echo 1;
			}
		}
	}

	public function change_status ($id) {
		$this->autoRender = false;
		$status = $this->Supplier->find('first',array('recursive'=>-1,'conditions'=>array('Supplier.id'=>$id),'fields'=>array('Supplier.id','Supplier.status')));
		if ($status['Supplier']['status'] == 1) {
			$status['Supplier']['status'] = 0;
			$data = 0;
	    } else {
			$status['Supplier']['status'] = 1;
			$data = 1;
	    }
		$this->Supplier->save($status);
		return $data;
	}

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

	public function check_unique_mobile() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			if (isset($this->request->data['get_supplierId']) && $this->request->data['get_supplierId'] !='' ) {
				$supplierMobile = trim($this->request->data['get_supplierMobile']);
				$checkMobile = $this->Supplier->find('first',array('conditions'=>array('mobile LIKE'=>$supplierMobile,'id !='=>$this->request->data['get_supplierId'])));
			} else {
				$supplierMobile = trim($this->request->data);
				$checkMobile = $this->Supplier->find('first',array('conditions'=>array('mobile LIKE'=>$supplierMobile)));
			}
			if ($checkMobile) {
			  echo 0;
			} else {
				echo 1;
			}
		}
	}

	public function admin_index() {
		$this->layout = "admin_layout";
		$supplierLists = $this->Supplier->find('all');
		$this->set('supplierLists',$supplierLists);
	}

}
