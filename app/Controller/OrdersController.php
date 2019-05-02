<?php
App::uses('AppController', 'Controller');
/**
 * OrderItems Controller
 */
class OrdersController extends AppController {

	public function add($customerId=null) {
		$this->layout = "my_layout";
		// if (empty($customerId)) {
		// 	$this->redirect(array('controller'=>'customers','action'=>'index'));
        // }
        
		$this->set('customerId',$customerId);
		$this->loadModel('Category');
		$categoryLists = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>0)));
		$this->set('categoryLists',$categoryLists);
		
		if ($this->request->is('post')) {
            $orderNumber = 'OD' .$customerId. rand() . time();
			
            $this->loadModel('Order');
            $this->loadModel('OrderItem');
            $this->loadModel('OrderTransaction');
            $this->Order->create();
            $this->request->data['Order']['customer_id'] = $customerId;
            $this->request->data['Order']['order_number'] = $orderNumber;
            
            if (empty(floatval($this->request->data['OrderTransaction']['dues']))) {
                $this->request->data['Order']['payment_status'] = 0;
            } else {
                $this->request->data['Order']['payment_status'] = 1;
            }

            pr($this->request->data);
			pr($this->request->data['OrderItem']);die;
		}
		
		
	}



}
