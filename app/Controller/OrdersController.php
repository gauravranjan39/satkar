<?php
App::uses('AppController', 'Controller');
/**
 * OrderItems Controller
 */
class OrdersController extends AppController {

	public function add($customerId=null) {
		$this->layout = "my_layout";
		if (empty($customerId)) {
			$this->redirect(array('controller'=>'customers','action'=>'index'));
        }
		$this->set('customerId',$customerId);
		$this->loadModel('Category');
		$categoryLists = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>0)));
		$this->set('categoryLists',$categoryLists);
		
		if ($this->request->is('post')) {
            $customerId = base64_decode($customerId);
            $orderNumber = 'OD' .$customerId. rand() . time();
            $this->loadModel('Order');
            $this->loadModel('OrderItem');
            $this->loadModel('OrderTransaction');
            $this->Order->create();
            $this->request->data['Order']['customer_id'] = $customerId;
            $this->request->data['Order']['order_number'] = $orderNumber;

            $grandTotal = floatval($this->request->data['Order']['grand_total']);
            $orderPayment = floatval($this->request->data['OrderTransaction']['amount_paid']);
            $dues = ($grandTotal - $orderPayment);
            if (empty($dues)) {
                $this->request->data['Order']['payment_status'] = 0;
            } else {
                $this->request->data['Order']['payment_status'] = 1;
            }

            $this->Order->save($this->request->data['Order']);
            $orderId = $this->Order->getLastInsertID();
            
            $orderItems = $this->request->data['OrderItem'];
            foreach ($orderItems as $orderItem) {
                $orderItem['order_id'] = $orderId;
                $this->OrderItem->create();
                $this->OrderItem->save($orderItem);
            }

            $this->OrderTransaction->create();
            $this->request->data['OrderTransaction']['order_id'] = $orderId;
            $invoiceNumber =  rand() .$orderId . time();
            $this->request->data['OrderTransaction']['invoice_number'] = $invoiceNumber;
            $this->OrderTransaction->save($this->request->data['OrderTransaction']);
            $this->redirect(array('controller'=>'Orders','action'=>'summary',$orderId));
		}
    }
    
    public function summary($orderId=null) {
        $this->layout = "my_layout";
        $this->loadModel('Order');
        $this->loadModel('OrderItem');
        $this->loadModel('Customer');
        $this->loadModel('OrderTransaction');
        $this->Order->recursive = 2;
        $this->Order->unbindModel(array('belongsTo' => array('Customer')),true);
        $this->OrderTransaction->unbindModel(array('belongsTo' => array('Order')),true);
        $this->OrderItem->unbindModel(array('belongsTo' => array('Order')),true);
        $orderDetails = $this->Order->find('first',array('conditions'=>array('Order.id'=>$orderId)));
        $this->set('orderDetails',$orderDetails);
    }


    public function delete_order($orderId=null) {
        $this->layout = false;
        $this->autoRender = false;
        //echo "order ID-->>" .$orderId;die;
        $this->loadModel('Order');
        $this->Order->deleteAll(array('Order.id'=>$orderId));
        echo '1';
    }



}
