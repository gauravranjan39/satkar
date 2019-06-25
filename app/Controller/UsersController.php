<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public $components = array(
		'Auth' => array(
			'loginRedirect' => array('controller' => 'Customers', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->loginRedirect = array('controller' => 'Customers', 'action' => 'index');
            $this->Auth->logoutRedirect = array('controller'=> 'users' , 'action'=> 'login');
            $this->Auth->authenticate = array('Form'=>array('fields' => array(
                                                                'username' => 'username',
                                                                'password' => 'password'),
                                                                'userModel'=>'User' 
                                                            )                                  
            );
		$this->Auth->allow('login');
		// if(!isset($_SERVER['HTTP_REFERER'])){
		// 	$this->redirect(array('controller'=>'Customers','action'=>'index'));
		// 	exit;
		// }
	}

	// public function register() {
	//     if (!empty($this->request->data)) {
	// 		$this->request->data['User']['status'] = 1;
	// 		$this->request->data['User']['role'] = 1;
	// 		$username = $this->data['User']['username'];
	// 		$password = $this->data['User']['password'];
	// 		$confirmPassword = $this->data['User']['confirm_passowrd'];
	// 		$isUserExist = $this->User->find('first',array('conditions'=>array('User.username'=>$username)));
	// 		if(!empty($isUserExist)) {
	// 			$this->Session->SetFlash('User already exists!!', 'error');
	// 		}
	// 		else if($password != $confirmPassword){
	// 			$this->Session->SetFlash('Password does not match', 'error');
	// 		} else {
	// 			unset($this->request->data['User']['confirm_passowrd']);
	// 			$this->request->data['User']['password'] = AuthComponent::password($password);
	// 			if($this->User->save($this->request->data)) {
	// 				$this->redirect(array('controller'=>'users','action'=>'login'));
	// 			}
	// 		}
	// 	}
	// }
	
	public function login() {
		if ($this->request->is('post')) {
			$userStatus = $this->User->find('first',array('conditions'=>array('User.username'=>$this->request->data['User']['username']),'fields'=>array('status')));
			if (empty($userStatus)) {
				$this->Session->SetFlash('No accocunt found!!', 'error');
			} else if ($userStatus['User']['status'] == 0) {
				$this->Session->SetFlash('Account Deactivated!!', 'error');
			} else {
				if ($this->Auth->login()) {
					$this->redirect($this->Auth->redirect());
				} else {
					$this->Session->SetFlash('Invalid username or password, please try again!!', 'error');
					$this->request->data = array();
				}
			}
		}
	}

	public function changePassword() {
		$this->autoRender = false;
		$this->layout = false;
		$userId = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$userSavedPassword = $this->User->find('first',array('conditions'=>array('User.id'=>$userId),'fields'=>array('password')));
			$userSavedPassword = $userSavedPassword['User']['password'];
			// pr($userSavedPassword);echo "<br/>";
			// pr($this->request->data);echo "<br/>";
			$postDataPassword = $this->request->data['User']['current_password'];
			$newPassword = $this->request->data['User']['new_password'];
			$confirmPassword = $this->request->data['User']['confirm_password'];
			// echo $postDataPassword;echo "<br/>";
			$userPassword = AuthComponent::password($postDataPassword);
			
			if ($userSavedPassword == $userPassword) {
				if ($newPassword == $confirmPassword) {
					$userNewPassword = AuthComponent::password($newPassword);
					
					$this->User->id=$userId;
					$this->User->saveField("password",$userNewPassword);

					//$this->User->updateAll(array('User.password' =>$userNewPassword),array('User.id'=>$userId));
					echo '2';
					exit;
				} else {
					echo '1';
					exit;
				}
			} else {
				echo '0';
				exit;
			}
			
		}
	}
	  
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function admin_index() {
		$this->layout = "admin_layout";
		$userLists = $this->User->find('all');
		$this->set('userLists',$userLists);
	}

	public function admin_add() {
		$this->layout = "admin_layout";
		if ($this->request->is('post')) {
			$this->request->data['User']['status'] = 1;
			$this->request->data['User']['role'] = 1;
			$this->request->data['User']['hash_token'] = time();
			$userPassword = time();
			$this->request->data['User']['password'] = AuthComponent::password($userPassword);
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->SetFlash('The user has been saved', 'success');
				return $this->redirect(array('action' => 'admin_index'));
			} else {
				$this->Session->SetFlash('The user could not be saved. Please, try again.', 'error');
			}
		}
	}

	public function admin_edit($id = null) {
		//$id = base64_decode($id);
		$this->layout = "admin_layout";
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
				$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['hash_token']);
			if ($this->User->save($this->request->data)) {
				return $this->redirect(array('action' => 'admin_index'));
			} else {
				$this->Session->SetFlash('The user could not be saved. Please, try again.', 'error');
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function check_email_unique() {
		$this->autoRender = false;
		$user_email = $_POST['data'];
		$chk_email = $this->User->find('first',array('conditions'=>array('email LIKE'=>$user_email)));
		if ($chk_email) {
		  echo 0;
		} else {
	   		echo 1;
		}
	}

	public function change_status ($id) {
		$this->autoRender = false;
		$status = $this->User->find('first',array('recursive'=>-1,'conditions'=>array('User.id'=>$id),'fields'=>array('User.id','User.status')));
		if ($status['User']['status'] == 1) {
			$status['User']['status'] = 0;
			$data = 0;
	    } else {
			$status['User']['status'] = 1;
			$data = 1;
	    }
		$this->User->save($status);
		return $data;
	}

	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	public function admin_changeUserType() {
		$this->autoRender = false;
		$this->layout = false;
		if ($this->request->is(array('post', 'put'))) {
			$this->loadModel('User');
			$userType = $this->request->data['userType'];
			$userId = $this->request->data['userId'];
			$this->User->id=$userId;
			if ($userType == 'admin') {
				$this->User->saveField("type","user");
				echo 'user';
			} else {
				$this->User->saveField("type","admin");
				echo 'admin';
			}
		}
	}
}
