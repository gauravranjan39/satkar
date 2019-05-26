<?php

class WalletsController extends AppController {
    
    //public $helpers = array('Html', 'Form', 'Session', 'Paginator'); 
    public $components = array('Paginator','Encryption');

    private function redirectToIndexPage($criteria){
        /* Storing the search value in session, in order to show the search results after redirection. */
        $enocedCustomerId = $criteria['Wallet']['customer_id'];
        $customerId=$this->Encryption->decode($enocedCustomerId);
        $criteria['Wallet']['customer_id'] = $customerId;
        $this->Session->write('criteria', $criteria);
        $this->redirect(array(
        'action' => 'index',$enocedCustomerId
        ));
    }

    private function isClickedOnSearch($criteria){
        /* Verifying search button is clicked and redirecting to first page. */
        if (isset($this->request->data['Wallet'])) {
            $this->redirectToIndexPage($criteria);
        }
        
        /* Doing this to show the search results when search happened in other than page 1. */
        if (!empty($this->Session->read('criteria'))) {
            $criteria = $this->Session->read('criteria');
            $this->Session->delete('criteria');
        }
        return $criteria;
    }


    public function index($customerId=null) {
        $this->layout = "my_layout";
        $Encryption=$this->Encryption;
        $customerId=$this->Encryption->decode($customerId);
        $this->Wallet->recursive = -1;
        $this->set(compact('customerId','Encryption'));
        $criteria = "";
        
        if ($this->request->is(array('post','put'))) {
            $criteria = $this->request->data;
        }
        $criteria = $this->isClickedOnSearch($criteria);
        
        
        /* Verifies whether any search key exist in the URL */
        if (!empty($this->params->params['named']['criteria'])) {
            $criteria = $this->params->params['named']['criteria'];
        } else if (!empty($this->request->data['criteria'])) {
        /* For normal search operation */
        $criteria = $this->request->data['criteria'];
        }

        // pr($criteria);
        
        $conditions = array('Wallet.customer_id' => $customerId);

        if(!empty($criteria['Wallet']['start_date']) && !empty($criteria['Wallet']['end_date'])) {
            $dateTo = $criteria['Wallet']['start_date'];
            $dateFrom = $criteria['Wallet']['end_date'].' 23:59:59';
            $conditions = array_merge($conditions,array('Wallet.transaction_date BETWEEN ? AND ?'=>array($dateTo,$dateFrom)));  
        }
        // pr($conditions);die;
        $this->paginate = array('conditions' =>  $conditions,'order'=>'Wallet.id DESC','limit'=>20);
        $walletDetails = $this->Paginator->paginate();
        $this->set('criteria', $criteria);
        $this->set(compact('walletDetails'));

        // $this->Paginator->settings = array('conditions' =>  array('Wallet.customer_id' => $customerId),'order'=>'Wallet.id DESC','limit'=>10);
        // $this->set('walletDetails', $this->Paginator->paginate());
    }


    public function customer_wallet_money($customerId=null) {
        $this->layout = false;
        $this->autoRender = false;
        $this->Wallet->recursive = -1;
        $walletBal = $this->Wallet->find('first',array('conditions' => array('Wallet.customer_id' =>$customerId),'fields'=>array('balance'),'order' => array('Wallet.id' => 'DESC')));
        if (!empty($walletBal)) {
            $walletMoney = $walletBal['Wallet']['balance'];
        } else {
            $walletMoney = '0.00';
        }
        echo $walletMoney;
    }

    public function wallet_transaction() {
        $this->layout = false;
        $this->autoRender = false;
        if ($this->request->is(array('post','put'))) {
            $this->Wallet->recursive = -1;
            $walletBal = $this->Wallet->find('first',array('conditions' => array('Wallet.customer_id' => $this->request->data['Wallet']['customer_id']),'fields'=>array('Wallet.balance'),'order' => array('Wallet.id' => 'DESC')));
            
            if (empty($walletBal)) {
                $walletBal['Wallet']['balance'] = '0.00';
            } 
            
            $transactionType = $this->request->data['Wallet']['transaction_type'];
            if ($transactionType == 'credit') {
                unset($this->request->data['Wallet']['transaction_type']);
                $this->request->data['Wallet']['credit'] = $this->request->data['Wallet']['amount_paid'];
                $this->request->data['Wallet']['balance'] = $this->request->data['Wallet']['amount_paid'] + $walletBal['Wallet']['balance'];
                if (!empty($this->request->data['Wallet']['cheque_bank_name'])) {
                    $this->request->data['Wallet']['bank_name'] = $this->request->data['Wallet']['cheque_bank_name'];
                }
                if (!empty($this->request->data['Wallet']['bank_name'])) {
                    $this->request->data['Wallet']['bank_name'] = $this->request->data['Wallet']['bank_name'];
                }
                if (!empty($this->request->data['Wallet']['cheque_transaction_date'])) {
                    $this->request->data['Wallet']['transaction_date'] = $this->request->data['Wallet']['cheque_transaction_date'];
                }
                if (!empty($this->request->data['Wallet']['transaction_date'])) {
                    $this->request->data['Wallet']['transaction_date'] = $this->request->data['Wallet']['transaction_date'];
                }
                if (empty($this->request->data['Wallet']['transaction_date']) && empty($this->request->data['Wallet']['cheque_transaction_date'])) {
                    $this->request->data['Wallet']['transaction_date'] = date('Y-m-d H:i:s');
                }
                $this->Wallet->create();
                $this->Wallet->save($this->request->data);
                echo '1';
            } else {
                // pr($this->request->data);die;
                unset($this->request->data['Wallet']['transaction_type']);
                $this->request->data['Wallet']['debit'] = $this->request->data['Wallet']['amount_paid'];
                $this->request->data['Wallet']['balance'] = ($walletBal['Wallet']['balance'] - $this->request->data['Wallet']['amount_paid']);
                if (!empty($this->request->data['Wallet']['cheque_bank_name'])) {
                    $this->request->data['Wallet']['bank_name'] = $this->request->data['Wallet']['cheque_bank_name'];
                }
                if (!empty($this->request->data['Wallet']['bank_name'])) {
                    $this->request->data['Wallet']['bank_name'] = $this->request->data['Wallet']['bank_name'];
                }
                if (!empty($this->request->data['Wallet']['cheque_transaction_date'])) {
                    $this->request->data['Wallet']['transaction_date'] = $this->request->data['Wallet']['cheque_transaction_date'];
                }
                if (!empty($this->request->data['Wallet']['transaction_date'])) {
                    $this->request->data['Wallet']['transaction_date'] = $this->request->data['Wallet']['transaction_date'];
                }
                if (empty($this->request->data['Wallet']['transaction_date']) && empty($this->request->data['Wallet']['cheque_transaction_date'])) {
                    $this->request->data['Wallet']['transaction_date'] = date('Y-m-d H:i:s');
                }
                $this->Wallet->create();
                $this->Wallet->save($this->request->data);
                echo '1';
            }
        }
    }

}

?>