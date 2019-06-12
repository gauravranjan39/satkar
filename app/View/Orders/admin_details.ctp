<?php echo $this->Html->script('vue.min');?>

<div class="be-content" id="cust-order-details">
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
                                        <?php echo "Order ID: " . 'OD' .$orderDetails['Order']['order_number']; ?>
                                    </div><br/>
                                    <div class="tools" style="font-size:15px;">
                                        <span style="font-size:18px;">Date: </span><?php echo date('d-M-Y h:i A', strtotime($orderDetails['Order']['created'])); ?>
                                    </div><br/>
                                    <div class="tools" style="font-size:15px;">
                                        <span style="font-size:18px;">Status: </span><span class="<?php echo $orderStatusClass ?>"><?php echo $status; ?></span>
                                    </div>
                                </div>
                            </div><br/><br/><br/>
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
                                        <td><span class="<?php echo $statusClass ?>">&#8377;<?php echo number_format($orderDetail['total'],2); ?></span></td>
                                        <td><span class="<?php echo $statusClass ?>">&#8377;<?php echo number_format($orderDetail['discount'],2); ?></span></td>
                                        <td><span class="<?php echo $statusClass ?>">&#8377;<?php echo number_format($orderDetail['grand_total'],2); ?></span></td>
                                        <?php if($orderDetail['status'] == 1) { ?>
                                            <td><span class="text-danger">Cancel</span></td>
                                        <?php } else { ?>
                                                <td><span class="text-success">Confirm</span></td>
                                        <?php } ?>
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
                        <button class="btn btn-rounded btn-space btn" style="background-color:#FC8E39;border-color:#FC8E39;" id="customer_wallet">Wallet Money</button>
                        <?php if (!empty($orderDetails['OrderTransaction'])) { ?>
                            <button class="btn btn-rounded btn-space btn-warning" id="payment_history">Payment History</button>
                            <button class="btn btn-rounded btn-space btn-default" id="payment_receipt">Payment Receipt</button>
                        <?php } ?>
                        <?php if ($orderDetails['Order']['is_show'] == 1) { ?>
                            <button class="btn btn-rounded btn-space btn-danger order_show_status" order-show-status="hide_order">Hide Order</button>
                        <?php } else { ?>
                            <button class="btn btn-rounded btn-space order_show_status" order-show-status="show_order" style="background-color:#1aff8c;">show Order</button>
                        <?php } ?>
                    </p>
                </div>
                </div>
              </div>
            </div>
        </div>
    </div>


<div class="modal animated fadeIn" id="paymentHistory" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg" style=" margin: 0  auto;top:10%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Payment History</h3><hr>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="no-border-x">
                        <?php foreach ($orderDetails['OrderTransaction'] as $orderTransaction) { ?>
                        <tr>
                            <td><?php echo $orderTransaction['invoice_number']; ?></td>
                            <td>&#8377;<?php echo number_format($orderTransaction['amount_paid'],2); ?></td>
                            <td><?php echo date('d-M-Y h:i A', strtotime($orderTransaction['transaction_date'])); ?></td>
                            <td><?php echo $orderTransaction['type']; ?></td>
                            <td style="text-align: center;"><i class="mdi mdi-eye view-transaction-details" title="View Details" style="font-size: 16px;cursor: pointer;" @click='openPopUp(<?php echo json_encode($orderTransaction)?>)'></i></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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

<div class="modal animated fadeIn" id="paymentDetails" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg" style=" margin: 0  auto;top:10%;width: 45%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Payment Details</h3><hr>
            </div>
            <div class="modal-body">
            
            <div class="form-group col-md-12" v-if="PaymentHistoryDetails.type">
                    <div class="col-md-5"><b>Payment Type:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.type}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.metal_type">
                    <div class="col-md-5"><b>Metal:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.metal_type}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.item">
                    <div class="col-md-5"><b>Item:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.item}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.rate">
                    <div class="col-md-5"><b>Rate:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.rate}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.weight">
                    <div class="col-md-5"><b>Item Weight:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.weight}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.return_percentage">
                    <div class="col-md-5"><b>Return %:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.return_percentage}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.cheque_number">
                    <div class="col-md-5"><b>Cheque No.:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.cheque_number}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.bank_name">
                    <div class="col-md-5"><b>Bank Name:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.bank_name}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.payment_transaction_id">
                    <div class="col-md-5"><b>Transaction ID:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.payment_transaction_id}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.transaction_date">
                    <div class="col-md-5"><b>Transaction Date:</b></div>
                    <div class="col-md-7">{{PaymentHistoryDetails.transaction_date}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.total_amount">
                    <div class="col-md-5"><b>Total Amount:</b></div>
                    <div class="col-md-7">&#8377;{{formatPrice(PaymentHistoryDetails.total_amount)}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentHistoryDetails.amount_paid">
                    <div class="col-md-5"><b>Amount paid to this order:</b></div>
                    <div class="col-md-7">&#8377;{{formatPrice(PaymentHistoryDetails.amount_paid)}}</div>
                </div>
                
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


<script type="text/javascript">

    new Vue({
        data(){
            return {
                PaymentHistoryDetails: {}
            }      
        },
        el: '#cust-order-details',
        methods: {
            formatPrice(value) {
                let val = (value/1).toFixed(2)
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
            openPopUp: function(payment) {
                this.PaymentHistoryDetails = payment;
                $('#paymentDetails').modal();
                console.log(payment);
            }
        }
    })

	$(document).ready(function() {

        $('#order_invoice').click(function(){
            var orderId = '<?php echo $Encryption->encode($orderDetails['Order']['id']);?>';
            var orderNumber = '<?php echo $orderDetails['Order']['order_number']; ?>';
            var orderDate = '<?php echo date('d-M-Y h:i A', strtotime($orderDetails['Order']['created'])); ?>';
            var grandTotal = '<?php echo number_format($orderDetails['Order']['grand_total'],2); ?>';
            var payment = '<?php echo number_format($payment,2); ?>';
            var dues = '<?php echo number_format($dues,2); ?>';
            //alert(orderDate);
            <?php if ($orderDetails['Order']['payment_status'] == 1) { ?>
                if (confirm('Payment is pending are you sure to print the order invoice ?')) {
                    var base_url = "<?php echo Router::url(array('controller'=>'Orders','action'=>'admin_generateOrderInvoice'));?>/" + orderId + '/' + orderNumber + '/' + grandTotal + '/' + payment + '/' + dues;
                    window.open(base_url,'_blank');
                }
            <?php } else { ?>
                var base_url = "<?php echo Router::url(array('controller'=>'Orders','action'=>'admin_generateOrderInvoice'));?>/" + orderId + '/' + orderNumber + '/' + grandTotal + '/' + payment + '/' + dues;
                window.open(base_url,'_blank');
            <?php } ?>
        });

        $('#customer_wallet').click(function(){
            var customerId = '<?php echo $encodedCustomerId?>';
            url='<?php echo $this->webroot?>admin/Wallets/index/' +customerId;
            window.open(url, '_blank');
        });

        $('#payment_history').click(function(){
            $('#paymentHistory').modal('show');
        });

        $('#payment_receipt').click(function(){
            var orderId = '<?php echo $orderDetails['Order']['id']; ?>';
            var orderNumber = '<?php echo $orderDetails['Order']['order_number']; ?>';
            var customerId = '<?php echo $orderDetails['Order']['customer_id']; ?>';
            var grandTotal = '<?php echo $orderDetails['Order']['grand_total']; ?>';
            var base_url = "<?php echo Router::url(array('controller'=>'Orders','action'=>'admin_generatePaymentHistory'));?>/" + orderId + '/' + customerId + '/' + grandTotal + '/' + orderNumber;
            window.open(base_url,'_blank');
        });

        $('.order_show_status').click(function(){
            var orderId = '<?php echo $orderDetails['Order']['id']; ?>';
            var orderShowStatus = $(this).attr('order-show-status');
            if (confirm('Are you sure to continue ?')) {
                $.ajax({
                    url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'admin_changeShowStatus'));?>/"+orderId + '/' + orderShowStatus,
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

