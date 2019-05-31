<?php echo $this->Html->css('bootstrap-datetimepicker.min');?>
<?php echo $this->Html->script('bootstrap-datetimepicker.min');?>

<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">
                <div class="col-md-12">
                    <div class="col-md-6">
                    <div style="font-size:15px;"><b>Customer Name:</b>

                        <?php $encodedCustomerId = $Encryption->encode($orderDetails['Order']['customer_id']);?>
                        <?php echo $customerDetails['Customer']['name']; ?></div>
                        <div style="font-size:15px;"><b>Address:  </b><?php echo $customerDetails['Customer']['address']; ?></div>
                        <div style="font-size:15px;"><b>Mb:  </b><?php echo $customerDetails['Customer']['mobile']; ?></div>
                    </div>
                <?php //pr($orderDetails);die;
                    if ($orderDetails['Order']['status'] == 0 ) {
                        $status = 'Draft';
                        $orderStatusClass = 'text-warning';
                    } else if ($orderDetails['Order']['status'] == 1 ) {
                        $status = 'Confirm';
                        $orderStatusClass = 'text-success';
                    } else if ($orderDetails['Order']['status'] == 2) {
                        $status = 'Cancelled';
                        $orderStatusClass = 'text-danger';
                    } else if ($orderDetails['Order']['status'] == 3) {
                        $status = 'Partial Cancelled';
                        $orderStatusClass = 'text-warning';
                    }
                ?>
                        <div class="col-md-6">
                            <div class="tools" style="font-size:18px;">
                                <?php echo "Order ID: " .$orderDetails['Order']['order_number']; ?>
                            </div><br/>
                            <div class="tools" style="font-size:15px;">
                                <span style="font-size:18px;">Date: </span><?php echo date('d-M-Y h:i A', strtotime($orderDetails['Order']['created'])); ?>
                            </div><br/>
                            <div class="tools" style="font-size:15px;">
                                <span style="font-size:18px;">Status: </span><span class="<?php echo $orderStatusClass ?>"><?php echo $status; ?></span>
                            </div>
                        </div>
                    </div><br/><br/>
                    <br/>
                </div>

                <hr>
                
                <div class="panel-body">
                  <table id="" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>Category</th>
						<th>Item</th>
                        <th>Rate</th>
                        <th>Weight</th>
                        <th>Making Charge</th>
                        <th>Gems</th>
                        <th>Gems Rate</th>
                        <th>Gems Weight</th>
						<th>Total</th>
						<th>Discount</th>
						<th>Grand Total</th>
                        <th>Status</th>
                        <?php
                        //if ($orderDetails['Order']['payment_status'] == 1) {
                            $currentDate = strtotime(date("Y-m-d"));
                            $twoDaysAfterOrder = date('Y-m-d', strtotime($orderDetails['Order']['created']. ' + 1 days'));
                            $twoDaysAfterOrder = strtotime($twoDaysAfterOrder);
                            if ($currentDate < $twoDaysAfterOrder) { ?>
                                <th>Action</th>
                        <?php } //} ?>
                      </tr>
                    </thead>
                    <tbody>
					
                    <?php
                        $confirmItem = array();
                        $orderItemDetailsForDiscount = array();
                        $orderItemDetailsForDelete = array();
                        $totalItemInOrder =  count($orderDetails['OrderItem']);
                        foreach ($orderDetails['OrderItem'] as $orderDetail) {
                            $orderItemDetailsForDiscount['item_id'] = $orderDetail['id'];
                            $orderItemDetailsForDiscount['item_discount'] = $orderDetail['discount'];
                            $orderItemDetailsForDiscount['item_grand_total'] = $orderDetail['grand_total'];
                            $orderItemDetailsForDiscount['order_id'] = $orderDetails['Order']['id'];
                            $orderItemDetailsForDiscount['order_grand_total'] = $orderDetails['Order']['grand_total'];
                            //creating data array required to hard delete the item from order 
                            $orderItemDetailsForDelete['item_id'] = $orderDetail['id'];
                            $orderItemDetailsForDelete['item_total'] = $orderDetail['total'];
                            $orderItemDetailsForDelete['item_grand_total'] = $orderDetail['grand_total'];
                            $orderItemDetailsForDelete['order_id'] = $orderDetails['Order']['id'];
                            $orderItemDetailsForDelete['order_grand_total'] = $orderDetails['Order']['grand_total'];
                            $orderItemDetailsForDelete['order_total'] = $orderDetails['Order']['total'];
                            $orderItemDetailsForDelete['order_number'] = $orderDetails['Order']['order_number'];
                            $orderItemDetailsForDelete['customer_id'] = $orderDetails['Order']['customer_id'];
                            $orderItemDetailsForDelete['order_total_item'] = $totalItemInOrder;
                            $payment = 0;
                            foreach ($orderDetails['OrderTransaction'] as $orderTransaction) {
                                $payment+= $orderTransaction['amount_paid'];
                            }
                            $orderItemDetailsForDelete['payment'] = (float)$payment;
                            //Emd of array creation for hard delete item from order
                            
                            if($orderDetail['status'] == 1) {
                                $statusClass = 'text-danger';
                            } else {
                                array_push($confirmItem,$orderDetail['id']);
                                $statusClass = '';
                            }
                        ?>
                    <tr class="odd gradeX">
                        <td><span class="<?php echo $statusClass ?>"><?php echo $orderDetail['Category']['name']; ?></span></td>
                        <td  data-container="body" data-toggle="popover" data-placement="top" data-content="<?php echo $orderDetail['comments']; ?>" data-original-title="Comments"><span class="<?php echo $statusClass ?>"><?php echo $orderDetail['name']; ?></span></td>
                        <?php if(isset($orderDetail['rate']) && !empty($orderDetail['rate'])) { ?>
                            <td><span class="<?php echo $statusClass ?>">&#8377;<?php echo $orderDetail['rate']; ?></span></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <?php if(isset($orderDetail['weight']) && !empty($orderDetail['weight'])) { ?>
                            <td><span class="<?php echo $statusClass ?>"><?php echo $orderDetail['weight']; ?> gm</span></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <?php if(isset($orderDetail['making_charge']) && !empty($orderDetail['making_charge'])) { ?>
                            <td><span class="<?php echo $statusClass ?>">&#8377;<?php echo $orderDetail['making_charge']; ?></span></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <td><span class="<?php echo $statusClass ?>"><?php echo $orderDetail['gems_name']; ?></span></td>
                        <td><span class="<?php echo $statusClass ?>"><?php echo $orderDetail['gems_rate']; ?></span></td>
                        <td><span class="<?php echo $statusClass ?>"><?php echo $orderDetail['gems_weight']; ?></span></td>
                        <!-- <td><?php //echo $orderDetail['gems_price']; ?></td> -->
                        <td><span class="<?php echo $statusClass ?>">&#8377;<?php echo number_format($orderDetail['total'],2); ?></span></td>
                        <?php if(isset($orderDetail['discount']) && !empty($orderDetail['discount'])) { ?>
                            <td class="editable"><span class="<?php echo $statusClass ?>">&#8377;<?php echo number_format($orderDetail['discount'],2); ?></span>
                            <?php if($orderDetail['status'] == 0 && $orderDetails['Order']['payment_status']== 1) { ?>
                                <span style="float:right;cursor:pointer;" details-for-discount=<?php echo json_encode($orderItemDetailsForDiscount)?> class="item_discount" title="Add Discount"><i class="mdi mdi-edit"></i></span>
                            <?php } ?>
                            </td>
                        <?php } else { ?>
                            <td class="editable">
                            <?php if($orderDetail['status'] == 0 && $orderDetails['Order']['payment_status']== 1) { ?>
                                <span style="float:right;cursor:pointer;" details-for-discount=<?php echo json_encode($orderItemDetailsForDiscount)?> class="item_discount" title="Add Discount"><i class="mdi mdi-edit"></i></span>
                            <?php } ?>
                            </td>
                        <?php } ?>
                        <td><span class="<?php echo $statusClass ?>">&#8377;<?php echo  number_format($orderDetail['grand_total'],2); ?></span></td>
                        <?php if($orderDetail['status'] == 1) { ?>
                            <td><span class="text-danger">Cancel</span></td>
                        <?php } else { ?>
                                <td><span class="text-success"><?php echo $this->Html->link('Confirm', 'javascript:void(0);',  array("class" => "text-success return_item", "escape" => false,'order_item_id'=>$orderDetail['id'],'item_grand_total'=>$orderDetail['grand_total'],'title'=>'Return this item')); ?></span></td>
                            
                        <?php } ?>
                        <?php //if ($orderDetails['Order']['payment_status'] == 1) {
                            $currentDate = strtotime(date("Y-m-d"));
                            $twoDaysAfterOrder = date('Y-m-d', strtotime($orderDetails['Order']['created']. ' + 1 days'));
                            $twoDaysAfterOrder = strtotime($twoDaysAfterOrder);
                            if ($currentDate < $twoDaysAfterOrder) { ?>
                                <td style="text-align:center;">
                                    <span style="cursor:pointer;" details-for-delete=<?php echo json_encode($orderItemDetailsForDelete)?> class="delete_item" title="Delete Item"><i class="mdi mdi-delete"></i></span>
                                </td>
                        <?php } //} ?>
                        
                    </tr>
                    <?php }
                        $confirmItemCount = count($confirmItem);
                    ?>
                    </tbody>
                  </table>
                  <br/><br/><br/><br/>
                <hr>
                <div class="col-md-12">
                  <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                        <?php if (isset($orderDetails['Order']['comments']) && !empty($orderDetails['Order']['comments'])) { ?>
                            <label>Comments:&nbsp;&nbsp;</label>
                            <?php echo $orderDetails['Order']['comments']; ?>
                        <?php } ?>
                    </div>
                </div>

                <?php if ($orderDetails['Order']['status'] != 2) { ?>
                    <div class="row xs-pt-12">
                        <div class="form-group col-sm-10">
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Grand Total:</label>
                            &#8377;<?php echo number_format($orderDetails['Order']['grand_total'],2); ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row xs-pt-12">
                        <div class="form-group col-sm-10">
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Grand Total:</label>
                            &#8377;<?php echo number_format($orderDetails['Order']['total'],2); ?>
                        </div>
                    </div>
                <?php } ?>


                 <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Payment:</label>
                        &#8377;<?php 
                            $payment = 0;
                            foreach ($orderDetails['OrderTransaction'] as $orderTransaction) {
                                $payment+= $orderTransaction['amount_paid'];
                            }
                            echo number_format($payment,2); ?>
                    </div>
                </div>

                <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Dues:</label>
                        <?php
                            if ($payment > $orderDetails['Order']['grand_total']) {
                                $dues = '0.00';
                            } else {
                                $sum = 0;
                                foreach ($orderDetails['OrderTransaction'] as $orderTransaction) {
                                    $sum+= $orderTransaction['amount_paid'];
                                }
                                $dues = ($orderDetails['Order']['grand_total'] - $sum);
                            }
                            
                            // echo (int)($dues);die;
                            
                        ?>
                        <span class="text-danger">&#8377;<?php echo number_format($dues,2); ?></span>
                    </div>
                </div>

                <?php
                    
                    if ($payment > $orderDetails['Order']['grand_total']) { 
                        $advance = ($payment - $orderDetails['Order']['grand_total']);
                        ?>
                        <div class="row xs-pt-12">
                            <div class="form-group col-sm-10">
                            </div>
                            <div class="form-group col-sm-2">
                                <label>Wallet:</label>
                                
                                <span class="text-success">&#8377;<?php echo number_format($advance,2); ?></span>
                            </div>
                        </div>
                <?php } ?>
                

                </div>
                <div class="col-md-12">
                    <p class="xs-mt-10 xs-mb-10">
                        <button class="btn btn-rounded btn-space btn-success" id="order_invoice">Order Invoice</button>
                        <?php if ($orderDetails['Order']['payment_status'] == 1) { ?>
                            <button class="btn btn-rounded btn-space btn-primary" id="make_payment">Make Payment</button>
                        <?php }
                        if ($orderDetails['Order']['status'] != 2) { ?>
                        <button class="btn btn-rounded btn-space btn-danger" id="cancel_order">Cancel Order</button>
                        <?php } ?>
                        <?php //if ($orderDetails['Order']['payment_status'] == 1) {
                            $currentDate = strtotime(date("Y-m-d"));
                            $twoDaysAfterOrder = date('Y-m-d', strtotime($orderDetails['Order']['created']. ' + 2 days'));
                            $twoDaysAfterOrder = strtotime($twoDaysAfterOrder);
                            if ($currentDate < $twoDaysAfterOrder) { ?>
                                <button class="btn btn-rounded btn-space" style="background-color:#46F948;border-color:#46F948;" id="add-order-item">Add Order Item</button>
                        <?php } //} ?>
                        <button class="btn btn-rounded btn-space btn" style="background-color:#FC8E39;border-color:#FC8E39;" id="customer_wallet">Wallet Money</button>
                        <button class="btn btn-rounded btn-space btn-warning" id="payment_history">Payment History</button>
                        <button class="btn btn-rounded btn-space btn-default" id="payment_receipt">Payment Receipt</button>
                        <?php if ($orderDetails['Order']['status'] == 0) { ?>
                            <button class="btn btn-rounded btn-space" style="background-color:#1aff8c;" id="confirm_order">Confirm Order</button>
                        <?php } ?>
                        
                    </p>
                </div>
                </div>
              </div>
            </div>
          </div>
      </div>



<div class="modal animated fadeIn" id="orderPayment" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="top:-6%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;height:70px !important;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Payment</h3><hr>
            </div>
            
            <div class="modal-body" style="padding-top:0px !important;">
            
                <?php echo $this->Form->create('OrderTransaction',array('url'=> array('controller' => 'Orders', 'action' => 'pay_dues'),'method'=>'POST')); ?>
                <?php echo $this->Form->input('OrderTransaction.dues',array('type'=>'hidden','value'=>$dues)); ?>
                <?php echo $this->Form->input('OrderTransaction.order_id',array('type'=>'hidden','value'=>$orderDetails['Order']['id'])); ?>
                <?php echo $this->Form->input('OrderTransaction.customer_id',array('type'=>'hidden','value'=>$orderDetails['Order']['customer_id'])); ?>
                <?php echo $this->Form->input('OrderTransaction.order_number',array('type'=>'hidden','value'=>$orderDetails['Order']['order_number'])); ?>
                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>Order ID:</b></div>
                    <div class="col-md-9"><?php echo $orderDetails['Order']['order_number']; ?></div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>Grand Total:</b></div>
                    <div class="col-md-9">&#8377;<?php echo number_format($orderDetails['Order']['grand_total'],2); ?></div>
                </div>

                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>Paid:</b></div>
                    <div class="col-md-9">&#8377;<?php echo number_format($payment,2); ?></div>
                </div>

                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>Dues:</b></div>
                    <div class="col-md-9"><span class="text-danger">&#8377;<?php echo number_format($dues,2); ?></span></div>
                </div>
                
                
                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>Payment:</b></div>
                    <div class="col-md-9">
                        <?php echo $this->Form->input("OrderTransaction.type",array('type'=>'select','options'=>array('cash'=>'Cash','metal'=>'Metal','wallet'=>'Wallet','cheque'=>'Cheque','net-banking'=>'Net-Banking','credit-card'=>'Credit Card','debit-card'=>'Debit Card'),'placeholder'=>'Enter category','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    </div>
                </div>

                <div class="form-group col-md-12 wallet_bal" style="display:none;">
                    <div class="col-md-3"><b>Wallet Money:</b></div>
                    <div class="col-md-9" id="wallent_money"></div>
                    <?php echo $this->Form->input('OrderTransaction.wallet_balance',array('type'=>'hidden','id'=>'wallet_balance')); ?>
                </div>

                <div class="row metal_payment" style="display:none;">
                    <div class="form-group col-md-12">
                        <div class="col-md-4"><?php echo $this->Form->input("OrderTransaction.item",array('placeholder'=>'Enter items','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-2"><?php echo $this->Form->input("OrderTransaction.metal_type",array('type'=>'select','options'=>array('gold'=>'Gold','silver'=>'Silver','others'=>'Others'),'empty'=>'--Select--','class'=>'form-control input-sm','label'=>false));?></div>
                        <div class="col-md-2"><?php echo $this->Form->input("OrderTransaction.weight",array('placeholder'=>'Enter weight','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm allowOnlyNumber payment-input','label'=>false));?></div>
                        <div class="col-md-2"><?php echo $this->Form->input("OrderTransaction.return_percentage",array('placeholder'=>'Enter return %','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm allowOnlyNumber payment-input','label'=>false));?></div>
                        <div class="col-md-2"><?php echo $this->Form->input("OrderTransaction.rate",array('placeholder'=>'Enter Rate','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm allowOnlyNumber payment-input','label'=>false));?></div>
                    </div>
                </div>

                <div class="row cheque_payment" style="display:none;">
                    <div class="form-group col-md-12">
                        <div class="col-md-4"><?php echo $this->Form->input("OrderTransaction.cheque_number",array('placeholder'=>'Enter cheque number','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-4"><?php echo $this->Form->input("OrderTransaction.cheque_bank_name",array('placeholder'=>'Enter Bank Name','id'=>'cheque_bank_name','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-4"><?php echo $this->Form->input("OrderTransaction.cheque_transaction_date",array('placeholder'=>'Select Transaction Date','id'=>'cheque_transaction_date','readonly'=>'readonly','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm datetimepicker payment-input','label'=>false));?></div>
                    </div>
                </div>

                <div class="row card_net_banking_payment" style="display:none;">
                    <div class="form-group col-md-12">
                        <div class="col-md-4"><?php echo $this->Form->input("OrderTransaction.bank_name",array('placeholder'=>'Enter Bank Name','id'=>'card_net_banking_bank_name','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-4"><?php echo $this->Form->input("OrderTransaction.payment_transaction_id",array('placeholder'=>'Enter Transaction Id','id'=>'card_net_banking_transaction_id','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-4"><?php echo $this->Form->input("OrderTransaction.transaction_date",array('placeholder'=>'Select Transaction Date','id'=>'card_net_banking_transaction_date','readonly'=>'readonly','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm datetimepicker payment-input','label'=>false));?></div>
                    </div>
                </div>

                <div class="row cash_payment">
                    <div class="form-group col-md-12">
                        <div class="col-md-4"><?php echo $this->Form->input("OrderTransaction.amount_paid",array('id'=>'dues_payment','placeholder'=>'Enter amount','type'=>'text','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm allowOnlyNumber','maxlength'=>'7','label'=>false));?></div>
                        <div class="col-md-8"><?php echo $this->Form->input("OrderTransaction.comments",array('placeholder'=>'Enter comments','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                    </div>
                </div>
                
                <div class="">
                    <div class="">
                        <div class="col-md-12">
                            <?php echo $this->Form->button('Make Payment',array('type'=>'submit','id'=>'pay_dues','class'=>'btn btn-rounded btn-primary','style'=>'margin-top: 26px;margin-bottom: 18px;','escape'=>false));?>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end();?>
            </div>
        </div>
    </div>
</div>


<div class="modal animated fadeIn" id="paymentHistory" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg" style=" margin: 0  auto;top:10%;width: 40%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Payment History</h3><hr>
            </div>
            <div class="modal-body">
            <!-- <div class="panel-body table-responsive"> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th >Invoice ID</th>
                            <th >Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="no-border-x">
                        <?php foreach ($orderDetails['OrderTransaction'] as $orderTransaction) {?>
                        <tr>
                            <td><?=$orderTransaction['invoice_number']?></td>
                            
                            <td>&#8377;<?php echo number_format($orderTransaction['amount_paid'],2); ?></td>
                            <td><?php echo date('d-M-Y h:i A', strtotime($orderTransaction['created'])); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <!-- </div> -->
                <div class="">
                    <div class="">
                        <div class="col-md-12">
                            <?php echo $this->Form->button('Cancel',array('type'=>'button','data-dismiss'=>'modal','class'=>'btn btn-rounded btn-default','style'=>'margin-top: 26px;margin-bottom: 18px;','escape'=>false));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal animated fadeIn" id="addMoreItem" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="top:6%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;height:70px !important;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Add Order Item</h3><hr>
            </div>
            
            <div class="modal-body" style="padding-top:0px !important;">
            
                <?php echo $this->Form->create('Order',array('url'=> array('controller' => 'Orders', 'action' => 'add_more_item'),'method'=>'POST')); ?>
                <?php echo $this->Form->input('Order.order_id',array('type'=>'hidden','value'=>$orderDetails['Order']['id'])); ?>
                <?php echo $this->Form->input('Order.payment',array('type'=>'hidden','value'=>$payment)); ?>
                <?php echo $this->Form->input('Order.customer_id',array('type'=>'hidden','value'=>$orderDetails['Order']['customer_id'])); ?>
                <?php echo $this->Form->input('Order.order_number',array('type'=>'hidden','value'=>$orderDetails['Order']['order_number'])); ?>
                
                
                

              
                <div class="clone-div" id="clonedInput_0" data-count-val="0">
								<div class="col-md-12">
									<div class="form-group">
										<div class="col-sm-5" style="float:right;">
											<div class="be-radio inline">
												<input type="radio" checked="" class="saleType" sale-type="weight" name="type0" data-count-val="0" id="weight_0">
												<label for="weight_0">By Weight</label>
											</div>
											<div class="be-radio inline">
												<input type="radio" class="saleType" sale-type="piece" name="type0" data-count-val="0" id="piece_0">
												<label for="piece_0">By Piece</label>
											</div>
											<div class="be-radio inline">
												<input type="radio" class="saleType" sale-type="gems" name="type0" data-count-val="0" id="gems_0">
												<label for="gems_0">Gems</label>
											</div>
										</div>
									</div>
								</div>
								<hr style="border: 1px dotted gainsboro;">

								<?php $categoryJson =  json_encode($categoryLists); ?>
								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Category</label>
										<?php echo $this->Form->input("OrderItem.category_id",array('name'=>'data[OrderItem][0][category_id]','id'=>'OrderItemCategoryId_0','type'=>'select','options'=>$categoryLists,'empty'=>'---Select---','placeholder'=>'Enter category','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>

									<div class="form-group col-sm-6">
										<label>Item</label>
										<?php echo $this->Form->input("OrderItem.name",array('name'=>'data[OrderItem][0][name]','id'=>'OrderItemName_0','placeholder'=>'Enter Item','required'=>'required','class'=>'form-control input-sm itemName','label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12 extra_fields_0" id="rateMakingFields_0">
									<div class="form-group col-sm-6">
										<label>Rate</label>
										<?php echo $this->Form->input("OrderItem.rate",array('name'=>'data[OrderItem][0][rate]','id'=>'OrderItemRate_0','placeholder'=>'Enter Rate','required'=>'required','class'=>'form-control input-sm per-weight-field allowOnlyNumber','label'=>false));?>
									</div>

									<div class="form-group col-sm-6">
										<label>Making Charge</label>
										<?php echo $this->Form->input("OrderItem.making_charge",array('name'=>'data[OrderItem][0][making_charge]','id'=>'OrderItemMakingCharge_0','placeholder'=>'Enter Making Charge','required'=>'required','class'=>'form-control input-sm per-weight-field allowOnlyNumber','label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12 extra_fields_0" id="weightPurityFields_0">
									<div class="form-group col-sm-6">
										<label>Weight</label>
										<?php echo $this->Form->input("OrderItem.weight",array('name'=>'data[OrderItem][0][weight]','id'=>'OrderItemWeight_0','placeholder'=>'Enter Weight','required'=>'required','class'=>'form-control input-sm per-weight-field item-weight allowOnlyNumber','label'=>false));?>
									</div>

									<div class="form-group col-sm-6">
										<label>Purity</label>
										<?php echo $this->Form->input("OrderItem.purity",array('name'=>'data[OrderItem][0][purity]','id'=>'OrderItemPurity_0','placeholder'=>'Enter Purity','class'=>'form-control input-sm per-weight-field allowOnlyNumber','label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12 gems_fields_0" id="gemsField_0" style="display:none;">
									<div class="form-group col-sm-3">
										<label>Gems Name</label>
										<?php echo $this->Form->input("OrderItem.gems_name",array('name'=>'data[OrderItem][0][gems_name]','id'=>'GemsName_0','placeholder'=>'Enter Gems Name','class'=>'form-control input-sm','label'=>false));?>
									</div>
									<div class="form-group col-sm-3">
										<label>Gems Rate</label>
										<?php echo $this->Form->input("OrderItem.gems_rate",array('name'=>'data[OrderItem][0][gems_rate]','id'=>'GemsRate_0','placeholder'=>'Enter Gems Rate','class'=>'form-control input-sm allowOnlyNumber per-weight-field','label'=>false));?>
									</div>
									<div class="form-group col-sm-3">
										<label>Gems Weight</label>
										<?php echo $this->Form->input("OrderItem.gems_weight",array('name'=>'data[OrderItem][0][gems_weight]','id'=>'GemsWeight_0','placeholder'=>'Enter Gems Weight','class'=>'form-control input-sm allowOnlyNumber per-weight-field','label'=>false));?>
									</div>
									<div class="form-group col-sm-3">
										<label>Gems Price</label>
										<?php echo $this->Form->input("OrderItem.gems_price",array('name'=>'data[OrderItem][0][gems_price]','id'=>'GemsPrice_0','placeholder'=>'Enter Gems Price','class'=>'form-control input-sm allowOnlyNumber per-weight-field','readonly'=>true, 'label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Total</label>
										<?php echo $this->Form->input("OrderItem.total",array('name'=>'data[OrderItem][0][total]','id'=>'OrderItemTotal_0','placeholder'=>'Total','type'=>'text','required'=>'required','readonly'=>true,'class'=>'form-control input-sm allowOnlyNumber itemTotal','label'=>false));?>
									</div>
									<div class="form-group col-sm-6">
										<label>Discount</label>
										<?php echo $this->Form->input("OrderItem.discount",array('name'=>'data[OrderItem][0][discount]','id'=>'OrderItemDiscount_0','placeholder'=>'Enter Discount','type'=>'text','class'=>'form-control input-sm allowOnlyNumber per-weight-field','label'=>false,'maxLength'=>7));?>
									</div>
								</div>

								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Comments</label>
										<?php echo $this->Form->input("OrderItem.comments",array('name'=>'data[OrderItem][0][comments]','id'=>'OrderItemComments_0','type'=>'text','placeholder'=>'Enter Comments','class'=>'form-control input-sm','label'=>false));?>
									</div>
									<div class="form-group col-sm-6">
										<label>Grand Total</label>
										<?php echo $this->Form->input("OrderItem.grand_total",array('name'=>'data[OrderItem][0][grand_total]','id'=>'OrderItemGrandTotal_0','placeholder'=>'Grand Total','required'=>'required','readonly'=>true,'class'=>'form-control input-sm allowOnlyNumber grand_total','label'=>false));?>
									</div>
								</div>
								<br/>

								<div class="clone-remove" style="padding: 5px;">
									<button type="button" class="btn btn-warning btn-xs remove pull-right" style="display: none;">Remove</button>
								</div>
								
								<hr style="border-color:#4285f4;border-width:2px;">
							</div> 
							<button type="button" class="btn btn-primary btn-xs add-more">Add More</button>

                            <div class="row xs-pt-12">
								<div class="form-group col-sm-6"></div>
								<div class="form-group col-sm-6">
									<label>Grand Total</label>
									<?php echo $this->Form->input("Order.grand_total",array('placeholder'=>'Grand Total','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm orderAllowOnlyNumber','readonly'=>true,'label'=>false));?>
								</div>
							</div>
                
                
                <div class="">
                    <div class="">
                        <div class="col-md-12">
                            <?php echo $this->Form->button('Submit',array('type'=>'submit','id'=>'pay_dues','class'=>'btn btn-rounded btn-primary','style'=>'margin-top: 26px;margin-bottom: 18px;','escape'=>false));?>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end();?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
        $(".datetimepicker").datetimepicker({
            autoclose: true,
            componentIcon: '.mdi.mdi-calendar',
            navIcons:{
                rightIcon: 'mdi mdi-chevron-right',
                leftIcon: 'mdi mdi-chevron-left'
            }
        });

        $('#customer_wallet').click(function(){
            var customerId = '<?php echo $encodedCustomerId?>';
            url='<?php echo $this->webroot?>Wallets/index/' +customerId;
            window.open(url, '_blank');
        });

        $('.delete_item').click(function(){
            var dataDeleteDetails = JSON.parse($(this).attr('details-for-delete'));
            console.log(dataDeleteDetails);
            if (confirm('Are you sure to delete this item from order ?')) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'delete_order_item'));?>",
                    data:({delete_details:dataDeleteDetails}),
                    dataType: 'json',
                    success:function(result){
                        console.log('@@@@@@@@@');
                        if (result.success) {
                            console.log('inside true');
                            if (result.payment) {
                                console.log('inside payment');
                                alert('Either return amount of Rs.'+result.payment+' to customer or use this amount to other order or else add this amount to customer wallet manually ');
                                window.location.href='<?php echo $this->webroot?>Customers/index';
                            
                            } else if (result.advancePayment) {
                                console.log('inside advance payment');
                                alert('Amount of Rs. '+result.advancePayment+' is added to the customer wallet');
                                location.reload();
                            } else {
                                location.reload();
                            }
                            console.log('outside all');
                            
                        } else {
                            console.log('inside error');
                            alert('Error Occured!!');
                        }
                    }
			    });
            }
        });
        
        $('.table-fw-widget').off("click", ".item_discount");
        $('.table-fw-widget').on('click','.item_discount',function(){
            var discountDetails = $(this).attr('details-for-discount');
            console.log(discountDetails);
            var myObj = JSON.parse(discountDetails);
            console.log(myObj.item_discount);
            $(this).closest('tr').find('td.editable').css('width','15%');
            $(this).closest('tr').find('td.editable').html('<span><input class="item_extra_discount allowOnlyNumber" style="width:50%;" type="text" /></span><span class="mdi mdi-check-circle update_discount" data-discount-details='+discountDetails+' style="margin-left:5px;cursor:pointer;" title="Update"></span><a><span class="mdi mdi-close-circle cancel_discount" style="padding:5px;cursor:pointer;" title="Cancel" item_discount="'+myObj.item_discount+'"></span></a>');
            $('.item_extra_discount').focus();
            $('.cancel_discount').click(function(){
                $(this).closest('tr').find('td.editable').css('width','0%');
                var previousDiscount = $(this).attr('item_discount');
                if (previousDiscount === 'null') {
                    previousDiscount = '';
                } else {
                    previousDiscount = '&#8377;'+ previousDiscount;
                }
                $(this).closest('tr').find('td.editable').html(previousDiscount + '<span style="float:right;cursor:pointer;" details-for-discount='+discountDetails+' class="item_discount" title="Add Discount"><i class="mdi mdi-edit"></i></span>');
            });

            $('.update_discount').click(function(){
                var extraDiscountVal = $(this).closest('tr').find('td.editable').find('input').val();
                if (extraDiscountVal == '') {
                    alert('Please enter extra discount');
                    $('.item_extra_discount').focus();
                    return false;
                }
                var dataDiscountDetails = JSON.parse($(this).attr('data-discount-details'));
                dataDiscountDetails.item_extra_discount = parseFloat(extraDiscountVal);
                dataDiscountDetails.dues = parseFloat('<?php echo $dues ?>');
                console.log(dataDiscountDetails);
                $.ajax({
                    type: "POST",
                    url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'extra_discount'));?>",
                    data:({discount_details:dataDiscountDetails}),
                    success:function(data){
                        if (data == 1) {
                            location.reload();
                        } else {
                            alert('Error Occured!!');
                        }
                    }
			    });
            });
            
            
            $('.item_extra_discount').keyup(function(){
                var discountVal = $(this).val();
                var dues = '<?php echo $dues ?>';
                var itemTotal = myObj.item_grand_total;
                if (parseFloat(dues) >= parseFloat(itemTotal)) {
                    if (parseFloat(discountVal) > parseFloat(itemTotal)) {
                        alert('Discount should be less than item value.');
                        $(this).val('');
                    }
                } else if (parseFloat(dues) < parseFloat(itemTotal)) {
                    if (parseFloat(discountVal) > parseFloat(dues)) {
                        alert('Discount should be less than dues.');
                        $(this).val('');
                    }
                }
            });


        });

        $("#confirm_order").click(function(){
            var orderId = '<?php echo $orderDetails['Order']['id'];?>';
            if (confirm('Are you sure to confirm this order ?')) {
                $.ajax({
                    url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'confirm_order'));?>/"+orderId,
                    success:function(data){
                        if (data == 1) {
                            location.reload();
                        } else {
                            alert('Error Occured!!');
                        }
                    }
			    });
            }
		});

		$("#make_payment").click(function(){
            $('#dues_payment').val('');
            $('#orderPayment').modal('show');
            $('#dues_payment').focus();
            $('.payment-input').val('');
            $('#OrderTransactionType').val('cash');
            $('.metal_payment').hide();
            $('.cheque_payment').hide();
            $('.card_net_banking_payment').hide();
            $('.wallet_bal').hide();
        });

        $('#OrderTransactionType').change(function(){
            $('#dues_payment').val('');
            $('.input-sm').removeAttr('required');
            $('#dues_payment').attr('required', 'required');
            $('.wallet_bal').hide();
            $('#dues_payment').removeAttr('readonly',false);
            $('.payment-input').val('');
            $('#pay_dues').attr("disabled", false);
            var transactionType = $(this).val();
            if (transactionType == 'cash') {
                $('.metal_payment').hide();
                $('.cheque_payment').hide();
                $('.card_net_banking_payment').hide();
                
            } else if (transactionType == 'metal') {
                $('.metal_payment').show();
                $('.cheque_payment').hide();
                $('.card_net_banking_payment').hide();
                $('#OrderTransactionMetalType').val('');
                $('#OrderTransactionItem').attr('required', 'required');
                $('#OrderTransactionMetalType').attr('required', 'required');
                $('#OrderTransactionWeight').attr('required', 'required');
                $('#OrderTransactionReturnPercentage').attr('required', 'required');
                $('#OrderTransactionRate').attr('required', 'required');
                
            } else if (transactionType == 'wallet') {
                $('.metal_payment').hide();
                $('.cheque_payment').hide();
                $('.card_net_banking_payment').hide();
                var dues = parseFloat('<?php echo $dues; ?>');
                var customerId = '<?php echo $orderDetails['Order']['customer_id']; ?>';
                $.ajax({
                    url:"<?php echo Router::url(array('controller'=>'Wallets','action'=>'customer_wallet_money'));?>/"+ customerId,
                    success:function(data){
                        var wallet = parseFloat(data);
                       $('#dues_payment').attr('readonly',true);
                        $('#wallent_money').html('&#8377;'+wallet);
                        $('#wallet_balance').val(wallet);
                        $('.wallet_bal').show();
                        if (wallet) {
                            if (dues > wallet) {
                                $('#dues_payment').val(wallet);
                            } else if(wallet > dues) {
                               $('#dues_payment').val(dues);
                            } else if (wallet == dues) {
                               $('#dues_payment').val(dues);
                            }
                        } else {
                            $('#pay_dues').attr("disabled", true);
                        }
                    }
                });

            } else if (transactionType == 'cheque') {
                $('.metal_payment').hide();
                $('.cheque_payment').show();
                $('.card_net_banking_payment').hide();
                $('#OrderTransactionChequeNumber').attr('required', 'required');
                $('#cheque_bank_name').attr('required', 'required');
                $('#cheque_transaction_date').attr('required', 'required');
            } else if (transactionType == 'net-banking') {
                $('.metal_payment').hide();
                $('.cheque_payment').hide();
                $('.card_net_banking_payment').show();
                $('#card_net_banking_bank_name').attr('required', 'required');
                $('#card_net_banking_transaction_id').attr('required', 'required');
                $('#card_net_banking_transaction_date').attr('required', 'required');
            } else if (transactionType == 'credit-card') {
                $('.metal_payment').hide();
                $('.cheque_payment').hide();
                $('.card_net_banking_payment').show();
                $('#card_net_banking_bank_name').attr('required', 'required');
                $('#card_net_banking_transaction_id').attr('required', 'required');
                $('#card_net_banking_transaction_date').attr('required', 'required');
            } else if (transactionType == 'debit-card') {
                $('.metal_payment').hide();
                $('.cheque_payment').hide();
                $('.card_net_banking_payment').show();
                $('#card_net_banking_bank_name').attr('required', 'required');
                $('#card_net_banking_transaction_id').attr('required', 'required');
                $('#card_net_banking_transaction_date').attr('required', 'required');
            }
        });

        $('#dues_payment').keyup(function(){
            var paymentMode = $('#OrderTransactionType').val();
            if (paymentMode == 'cash') {
                var payment = $(this).val();
                var dues = '<?php echo $dues ?>';
                if (parseFloat(payment) > parseFloat(dues)) {
                    alert('Amount should be less than dues.');
                    $(this).val('');
                }
            }
		});

        $('#OrderTransactionPayDuesForm').submit(function(event){
            event.preventDefault();
            $.ajax({
                url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'pay_dues'));?>",
                type: 'POST',
                data: $('#OrderTransactionPayDuesForm').serialize(),
                success:function(data){
                    if (data == 1) {
                        location.reload();
                    } else {
                        alert('Error Occured!!');
                    }
                }
            });
        });

        $('#payment_history').click(function(){
            $('#paymentHistory').modal('show');
        });

        $('#add-order-item').click(function(){
            $('#addMoreItem').modal('show');
        });

         $('#OrderAddMoreItemForm').submit(function(event){
            event.preventDefault();
            $.ajax({
                url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'add_more_item'));?>",
                type: 'POST',
                data: $('#OrderAddMoreItemForm').serialize(),
                success:function(data){
                    if (data == 1) {
                        location.reload();
                    } else {
                        alert('Error Occured!!');
                    }
                }
            });
        });

        $('#payment_receipt').click(function(){
            var orderId = '<?php echo $orderDetails['Order']['id']; ?>';
            var orderNumber = '<?php echo $orderDetails['Order']['order_number']; ?>';
            var customerId = '<?php echo $orderDetails['Order']['customer_id']; ?>';
            var grandTotal = '<?php echo $orderDetails['Order']['grand_total']; ?>';
            var base_url = "<?php echo Router::url(array('controller'=>'Orders','action'=>'generatePaymentHistory'));?>/" + orderId + '/' + customerId + '/' + grandTotal + '/' + orderNumber;
            window.open(base_url,'_blank');
        });

        $('#cancel_order').click(function(){
            var orderId = '<?php echo $orderDetails['Order']['id']; ?>';
            var orderNumber = '<?php echo $orderDetails['Order']['order_number']; ?>';
            var dues = parseFloat('<?php echo $dues ?>');
            var payment = parseFloat('<?php echo $payment ?>');
            var customerId = '<?php echo $orderDetails['Order']['customer_id']; ?>';
            if (confirm('Are you sure to cancel this order ?')) {
                $.ajax({
                    url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'cancel_order'));?>/" + orderId + '/' + dues + '/' + payment + '/' + customerId + '/' + orderNumber,
                    success:function(data){
                        if (data == 1) {
                            location.reload();
                        } else {
                            alert('Error Occured!!');
                        }
                    }
			    });
            }
        });

        $('.return_item').click(function(){
            var orderId = '<?php echo $orderDetails['Order']['id']; ?>';
            var orderNumber = '<?php echo $orderDetails['Order']['order_number']; ?>';
            var itemId = $(this).attr('order_item_id');
            var confirmItemCount = '<?php echo $confirmItemCount; ?>';
            var customerId = '<?php echo $orderDetails['Order']['customer_id']; ?>';
            var itemGrandTotal = $(this).attr('item_grand_total');
            var orderGrandTotal = '<?php echo $orderDetails['Order']['grand_total']; ?>';
            var orderPayment = '<?php echo $payment; ?>';
            var dues = '<?php echo $dues; ?>';
            if (confirm('Are you sure to cancel this item ?')) {
                $.ajax({
                    url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'cancel_order_item'));?>/" + orderId + '/' + itemId + '/' + confirmItemCount + '/' + customerId + '/' + itemGrandTotal + '/' + orderGrandTotal + '/' + orderPayment + '/' + dues + '/' + orderNumber,
                    success:function(data){
                        if (data == 1) {
                            location.reload();
                        } else {
                            alert('Error Occured!!');
                        }
                    }
			    });
            }
        });

        

	});	
      
</script>

