<?php

class WalletsController extends AppController {
    
    public $components = array('Paginator','Encryption');


    public function index($customerId=null) {
        $this->layout = "my_layout";
        $customerId=$this->Encryption->decode($customerId);
        $this->Wallet->recursive = -1;
        //$walletDetails = $this->Wallet->find('all',array('conditions' => array('Wallet.customer_id' => $customerId),'order' => array('Wallet.id' => 'DESC'),'limit' => 20));
        $this->set(compact('walletDetails','customerId'));

        $this->Paginator->settings = array('conditions' =>  array('Wallet.customer_id' => $customerId),'order'=>'Wallet.id DESC','limit'=>10);
        $this->set('walletDetails', $this->Paginator->paginate());
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