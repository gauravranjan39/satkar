<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'PDF', array('file' => 'mpdf/vendor/autoload.php'));

class OrdersController extends AppController {

    public function index() {
        $this->layout = "my_layout";
        $this->loadModel('Order');
        $this->Order->unbindModel(array('hasMany' => array('OrderItem')),true);
        $orderLists = $this->Order->find('all', array('order'=>array('Order.id'=>'desc')));
        // pr($orderLists);die;
        $this->set('orderLists',$orderLists);
    }

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

    public function change_payment_status($orderId=null) {
        $this->layout = false;
        $this->autoRender = false;
        // echo "order ID-->>" .$orderId;die;
        $this->loadModel('Order');
        $this->Order->updateAll(array('Order.payment_status' =>0),array('Order.id'=>$orderId));
        echo '1';
    }

    public function details($orderId=null) {
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
        // pr($orderDetails);die;
        $this->set('orderDetails',$orderDetails);
    }

    public function pay_dues($orderId=null,$payment=null,$dues=null) {
        $this->layout = false;
        $this->autoRender = false;
        $this->loadModel('OrderTransaction');
        $invoiceNumber =  rand() .$orderId . time();
        $duesPayment['OrderTransaction']['order_id'] = $orderId;
        $duesPayment['OrderTransaction']['amount_paid'] = $payment;
        $duesPayment['OrderTransaction']['invoice_number'] = $invoiceNumber;
        $this->OrderTransaction->create();
        if ($this->OrderTransaction->save($duesPayment)) {
            if ($payment == $dues) {
                $this->loadModel('Order');
                $this->Order->updateAll(array('Order.payment_status' =>0),array('Order.id'=>$orderId));
            }
            echo '1';
        }
    }

    public function generatePaymentHistory($orderId=null,$customerId=null,$grandTotal=null,$orderNumber=null) {
        $this->layout = "ajax";
        $this->autoRender = false;
        $this->set('title_for_layout','payment History');
        error_reporting(0);
        $this->loadModel('OrderTransaction');
        $this->loadModel('Customer');
        $view = new View($this, false);
        $this->Customer->unbindModel(array('hasMany' => array('Order')),true);
        $customerDetails = $this->Customer->find('first',array('conditions'=>array('Customer.id'=>$customerId),'fields'=>array('name','address','mobile')));

        $this->OrderTransaction->unbindModel(array('belongsTo' => array('Order')),true);
        $paymentLists = $this->OrderTransaction->find('all',array('conditions'=>array('OrderTransaction.order_id'=>$orderId)) ,array('order'=>array('OrderTransaction.id'=>'desc')));
        $filename =  "order". '-'. date("m-d-y");
        $view->set(compact('paymentLists','customerDetails','grandTotal','orderNumber'));
        $html = $view->render('payment_history_pdf');
        $pdf= new mPDF('utf-8', 'A4-L');
        // Define a Landscape page size/format by name
        //$mpdf=new mPDF('utf-8', 'A4-L');

        $pdf->WriteHTML($html);
        // $pdf->Output($filename.".pdf", "D");
        $pdf->Output($filename.".pdf", "I");
    }

    public function cancel_order($orderId=null) {
        $this->autoRender = false;
        $this->layout = false;
        $this->loadModel('Order');
        $this->loadModel('OrderItem');
        $this->OrderItem->updateAll(array('OrderItem.status' =>1),array('OrderItem.order_id'=>$orderId));
        $this->Order->updateAll(array('Order.status' =>2),array('Order.id'=>$orderId));
        echo "1";
    }



}
