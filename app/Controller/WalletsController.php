<?php

class WalletsController extends AppController {
    
    public $components = array('Paginator','Encryption');


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

}

?>