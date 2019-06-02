<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 */
class CustomersController extends AppController {

	public $components = array('Paginator','Encryption');


	public function index() {
		$this->layout = "my_layout";
		$Encryption=$this->Encryption;
		$customerLists = $this->Customer->query('SELECT c1.*,c2.id,c2.name,c2.mobile FROM
		customers c1 LEFT JOIN customers c2 ON c2.id = c1.reference_id');
		$this->set(compact('customerLists','Encryption'));
		// $this->set('customerLists',$customerLists);
	}


	public function view($id = null) {
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
		$this->set('customer', $this->Customer->find('first', $options));
	}


	public function add() {
		$this->layout = "my_layout";
		$customerLists = $this->Customer->find('all',array('fields'=>array('id','name','mobile')));
		if ($this->request->is('post')) {
			unset($this->request->data['search_param']);
			unset($this->request->data['Customer']['referenceBy']);
			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->SetFlash('The Customer could not be saved. Please, try again.', 'error');
			}
		}
	}

	public function check_unique_mobile() {
		$this->autoRender = false;
		$customerMobile = trim($_POST['data']);
		$chk_email = $this->Customer->find('all',array('conditions'=>array('mobile LIKE'=>$customerMobile)));
		if ($chk_email) {
		  echo 0;
		} else {
	   		echo 1;
		} die;
	}


	public function edit($id = null) {
		$this->layout = "my_layout";
		if (!$this->Customer->exists($id)) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Customer->save($this->request->data)) {
				$this->Session->SetFlash('The customer has been saved', 'success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->SetFlash('The customer could not be saved. Please, try again', 'error');
			}
		} else {
			$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
			$this->request->data = $this->Customer->find('first', $options);
		}
	}


	public function delete($id = null) {
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Customer->delete()) {
			$this->Flash->success(__('The customer has been deleted.'));
		} else {
			$this->Flash->error(__('The customer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function check_email_unique() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			if (isset($this->request->data['get_customerId']) && $this->request->data['get_customerId'] !='' ) {
				$customer_email = trim($this->request->data['get_customerEmail']);
				$chk_email = $this->Customer->find('first',array('conditions'=>array('email LIKE'=>$customer_email,'id !='=>$this->request->data['get_customerId'])));
			} else {
				$customer_email = trim($this->request->data);
				$chk_email = $this->Customer->find('first',array('conditions'=>array('email LIKE'=>$customer_email)));
			}
			if ($chk_email) {
			  echo 0;
			} else {
				echo 1;
			}
		}
	}

	public function check_customer() {
		$this->autoRender = false;
		$this->Customer->recursive = -1;
		if ($this->request->is('post')) {
			//pr($this->request->data);
			if ($this->request->data['searchParam'] == 'name') {
				$results = $this->Customer->find('all', array('conditions' => array('Customer.name LIKE ' => '%'.$this->request->data['searchData'] . '%')));
				$customerRef = '<select name="data[Customer][reference]" >';
				if (!empty($results)) {
					$customerRef .='<option value="">' . '---Select refered by customer---' . '</option>';
					foreach ($results as $result) {
						$customerRef .='<option value="' . $result['Customer']['id'] . '">' . $result['Customer']['name'] .' (' . $result['Customer']['mobile'] . ')' . '</option>';
					}
					$customerRef .='</select>';
				}  else {
					$customerRef .='<option value="">' . 'No record found' . '</option>';
				}
			} else {
				$results = $this->Customer->find('all', array('conditions' => array('Customer.mobile LIKE' => '%'.$this->request->data['searchData'] . '%')));
				$customerRef = '<select name="data[Customer][reference]" >';
				if (!empty($results)) {
					$customerRef .='<option value="">' . '---Select refered by customer---' . '</option>';
					foreach ($results as $result) {
						$customerRef .='<option value="' . $result['Customer']['id'] . '">' . $result['Customer']['name'] .' (' . $result['Customer']['mobile'] . ')' . '</option>';
					}
					$customerRef .='</select>';
				} else {
					$customerRef .='<option value="">' . 'No record found' . '</option>';
				}
			}
			echo $customerRef;
		}
	}

}
