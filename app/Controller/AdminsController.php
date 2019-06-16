<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class AdminsController extends AppController {

	public $components = array(
		'Auth' => array(
			'loginRedirect' => array('controller' => 'Admins', 'action' => 'admin_dashboard'),
			'logoutRedirect' => array('controller' => 'Admins', 'action' => 'login'),
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->loginRedirect = array('controller' => 'Admins', 'action' => 'admin_dashboard');
            $this->Auth->logoutRedirect = array('controller'=> 'Admins' , 'action'=> 'admin_login');
            $this->Auth->authenticate = array('Form'=>array('fields' => array(
                                                                'username' => 'username',
                                                                'password' => 'password'),
                                                                'userModel'=>'Admin' 
                                                            )                                  
            );
            $this->Auth->allow('admin_login','admin_register','admin_reset');
        // $this->Auth->loginAction = array('controller'=>'Admins','action'=>'admin_login');
		// $this->Auth->loginRedirect = array('controller'=>'Admins','action'=>'admin_dashboard');
		// $this->Auth->logoutRedirect = array('controller'=>'Admins','action'=>'admin_login');
		//$this->Auth->allow('admin_login','admin_register');
		// if(!isset($_SERVER['HTTP_REFERER'])){
		// 	$this->redirect(array('controller'=>'Customers','action'=>'index'));
		// 	exit;
		// }
	}

	public function admin_register() {
	    if (!empty($this->request->data)) {
			$this->request->data['Admin']['status'] = 1;
			$this->request->data['Admin']['role'] = 1;
			$username = $this->data['Admin']['username'];
			$password = $this->data['Admin']['password'];
			$confirmPassword = $this->data['Admin']['confirm_passowrd'];
			$isUserExist = $this->Admin->find('first',array('conditions'=>array('Admin.username'=>$username)));
			if(!empty($isUserExist)) {
				$this->Session->SetFlash('User already exists!!', 'error');
			}
			else if($password != $confirmPassword){
				$this->Session->SetFlash('Password does not match', 'error');
			} else {
				unset($this->request->data['Admin']['confirm_passowrd']);
				$this->request->data['Admin']['password'] = AuthComponent::password($password);
				if($this->Admin->save($this->request->data)) {
					$this->redirect(array('controller'=>'Admins','action'=>'login'));
				}
			}
		}
	}

	
	
	public function admin_login() {
		if ($this->request->is('post')) {
			$adminStatus = $this->Admin->find('first',array('conditions'=>array('Admin.username'=>$this->request->data['Admin']['username']),'fields'=>array('status')));
			if (empty($adminStatus)) {
				$this->Session->SetFlash('No accocunt found!!', 'error');
			} else if ($adminStatus['Admin']['status'] == 0) {
				$this->Session->SetFlash('Account Deactivated!!', 'error');
			} else {
				if ($this->Auth->login()) {
					return $this->redirect($this->Auth->redirect());
				} else {
					$this->Session->SetFlash('Invalid username or password, please try again!!', 'error');
					$this->request->data = array();
				}
			}
		}
	}

	public function admin_dashboard() {
		$this->layout = "admin_layout";
		$this->loadModel('Customer');
		$this->loadModel('Order');
		$this->Customer->recursive = -1;
		$this->Order->recursive = -1;
		$totalCustomers = $this->Customer->find('count');
		$first_day_this_month = date('Y-m-01');
		$last_day_this_month  = date('Y-m-t');
		$conditions = array();
		$dateTo = $first_day_this_month;
		$dateFrom = $last_day_this_month;
		$conditions = array_merge($conditions,array('Order.created BETWEEN ? AND ?'=>array($dateTo,$dateFrom)));  
		$grand_total = $this->Order->find('first', array('conditions' => array($conditions),'fields' => array('sum(Order.grand_total) as total_sum')));
		$grand_total = $grand_total[0]['total_sum'];
		$this->set(compact('totalCustomers','grand_total'));
	}
	  
	public function admin_logout() {
		$this->redirect($this->Auth->logout());
	}

	
}
