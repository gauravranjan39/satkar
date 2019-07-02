<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('Sanitize', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helpers = array('Html', 'Form');
    public $components = array('Session','Auth');
    
  
  public function beforeFilter() {
	// $this->Auth->allow('admin_login','admin_register','login');

	$userDetails = $this->Auth->user();
	
	if (isset($this->request->params['prefix']) && !empty($this->request->params['prefix'])) {
		$urlPrefix = $this->request->params['prefix'];
	}
	if (isset($userDetails) && $userDetails['type'] != 'super_admin') {
		if (isset($urlPrefix) && !empty($urlPrefix)) {
			if ($urlPrefix == 'admin') {
				$this->Session->destroy();
				$this->redirect(array('controller'=>'Users','action'=>'login','admin'=>false));
			}
		}
	}
    
   }


	function beforeRender(){
		$this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
	}
	  
  // public function appError($error) {
  //   echo "@@@@@@@@@@@@@@@@@@@@@@";
  //   // custom logic goes here. Here I am redirecting to a custom page
  //     header("Location : /pages/error");
  // $this->redirect('/');
  // }
}
