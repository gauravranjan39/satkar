<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Order Details
                <br/>
                    <div class="tools" style="font-size:18px;">
                        <?php echo "Order ID: " .$orderDetails['Order']['order_number']; ?>
                    </div><br/><br/>
                </div>
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
                        <th>Gems Amount</th>
						<th>Total</th>
						<th>Discount</th>
						<th>Grand Total</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php foreach ($orderDetails['OrderItem'] as $orderDetail) { ?>
                    <tr class="odd gradeX">
                        <td><?php echo $orderDetail['Category']['name']; ?></td>
                        <td><?php echo $orderDetail['name']; ?></td>
                        <td><?php echo $orderDetail['rate']; ?></td>
                        <td><?php echo $orderDetail['weight']; ?></td>
                        <?php if(isset($orderDetail['making_charge']) && !empty($orderDetail['making_charge'])) { ?>
                            <td>&#8377;<?php echo $orderDetail['making_charge']; ?></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <td><?php echo $orderDetail['gems_name']; ?></td>
                        <td><?php echo $orderDetail['gems_rate']; ?></td>
                        <td><?php echo $orderDetail['gems_weight']; ?></td>
                        <td><?php echo $orderDetail['gems_price']; ?></td>
                        <td>&#8377;<?php echo number_format($orderDetail['total'],2); ?></td>
                        <?php if(isset($orderDetail['discount']) && !empty($orderDetail['discount'])) { ?>
                            <td>&#8377;<?php echo number_format($orderDetail['discount'],2); ?></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <td>&#8377;<?php echo number_format($orderDetail['grand_total'],2); ?></td>
                    </tr>
					<?php } ?>
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
                    <div class="form-group col-sm-2">
                        <label>Total:</label>
                        &#8377;<?php echo number_format($orderDetails['Order']['total'],2); ?>
                    </div>
                </div>

                <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Discount:</label>
                        <?php if (isset($orderDetails['Order']['discount']) && !empty($orderDetails['Order']['discount'])) { ?>
                        &#8377;<?php echo number_format($orderDetails['Order']['discount'],2); ?>
                        <?php } else { ?>
                            &#8377; 0.0
                        <?php } ?>
                    </div>
                </div>

                <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Grand Total:</label>
                        &#8377;<?php echo number_format($orderDetails['Order']['grand_total'],2); ?>
                    </div>
                </div>

                 <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Payment:</label>
                        &#8377;<?php 
                            $sum = 0;
                            foreach ($orderDetails['OrderTransaction'] as $orderTransaction) {
                                $sum+= $orderTransaction['amount_paid'];
                            }
                        echo number_format($sum,2); ?>
                    </div>
                </div>

                <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Dues:</label>
                        <?php 
                            $grandTotal = $orderDetails['Order']['grand_total'];
                            $sum = 0;
                            foreach ($orderDetails['OrderTransaction'] as $orderTransaction) {
                                $sum+= $orderTransaction['amount_paid'];
                            }
                            //$dues = ($orderList['Order']['grand_total'] - $sum);

                            // $payment = $orderDetails['OrderTransaction'][0]['amount_paid'];
                            $dues = ($orderDetails['Order']['grand_total'] - $sum);
                        ?>
                        <span class="text-danger">&#8377;<?php echo number_format($dues,2); ?></span>
                    </div>
                </div>

                </div>
                <div class="col-md-12">
                    <p class="xs-mt-10 xs-mb-10">
                        <button class="btn btn-rounded btn-space btn-success" id="order_invoice">Generate Order Invoice</button>
                        <?php if ($orderDetails['Order']['payment_status'] == 1) { ?>
                            <button class="btn btn-rounded btn-space btn-primary" id="make_payment">Make Payment</button>
                        <?php } ?>
                        <button class="btn btn-rounded btn-space btn-danger" id="cancel_order">Cancel Order</button>
                        <button class="btn btn-rounded btn-space btn-warning" id="payment_history">Payment History</button>
                        <button class="btn btn-rounded btn-space btn-default" id="payment_receipt">Generate Payment Receipt</button>
                    </p>
                </div>

                <?php //pr($orderDetails);die; ?>
                </div>
              </div>
            </div>
          </div>
      </div>



<div class="modal animated fadeIn" id="orderPayment" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg" style=" margin: 0  auto;top:10%;width: 40%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Payment</h3><hr>
            </div>
            
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="col-md-3"><b>Order ID:</b></div>
                    <div class="col-md-9"><?php echo $orderDetails['Order']['order_number']; ?></div>
                </div>
                <br/><br/>

                
                <div class="col-md-12">
                    <div class="col-md-3"><b>Grand Total:</b></div>
                    <div class="col-md-9">&#8377;<?php echo number_format($orderDetails['Order']['grand_total'],2); ?></div>
                </div><br/><br/>

                <div class="col-md-12">
                    <div class="col-md-3"><b>Paid:</b></div>
                    <div class="col-md-9">&#8377;<?php echo number_format($sum,2); ?></div>
                </div><br/><br/>

                <div class="col-md-12">
                    <div class="col-md-3"><b>Dues:</b></div>
                    <div class="col-md-9"><span class="text-danger">&#8377;<?php echo number_format($dues,2); ?></span></div>
                </div><br/><br/>

                <div class="col-md-12">
                    <div class="col-md-3"><b>Payment:</b></div>
                    <div class="col-md-9"><?php echo $this->Form->input("OrderTransaction.amount_paid",array('id'=>'dues_payment','placeholder'=>'Enter amount','required'=>'required','class'=>'form-control input-sm allowOnlyNumber','maxlength'=>'7','label'=>false));?></div>
                </div>
                
                
                <div class="">
                    <div class="">
                        <div class="col-md-12">
                            <?php echo $this->Form->button('Make Payment',array('type'=>'button','id'=>'pay_dues','class'=>'btn btn-rounded btn-primary','style'=>'margin-top: 26px;margin-bottom: 18px;','escape'=>false));?>
                        </div>
                    </div>
                </div>
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

<script type="text/javascript">
	$(document).ready(function() {
		$("#make_payment").click(function(){
            $('#dues_payment').val('');
            $('#orderPayment').modal('show');
            $('#dues_payment').focus();
		});

        $('#dues_payment').keyup(function(){
			var payment = $(this).val();
            var dues = '<?php echo $dues ?>';
            if (parseFloat(payment) > parseFloat(dues)) {
                alert('Amount should be less than dues.');
                $(this).val('');
            }
		});

        $("#pay_dues").click(function(){
            var orderId = '<?php echo $orderDetails['Order']['id']; ?>';
            var dues = '<?php echo $dues ?>';
            var payment = $('#dues_payment').val();
            if (payment == '') {
                alert('Please enter amount');
                return false;
            } else {
                $('#orderPayment').modal('hide');
                $.ajax({
                    url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'pay_dues'));?>/"+ orderId + '/' + payment + '/' + dues,
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

        $('#payment_history').click(function(){
            $('#paymentHistory').modal('show');
        });

        $('#payment_receipt').click(function(){
            var orderId = '<?php echo $orderDetails['Order']['id']; ?>';
            var customerId = '<?php echo $orderDetails['Order']['customer_id']; ?>';
            var grandTotal = '<?php echo $orderDetails['Order']['grand_total']; ?>';
            var base_url = "<?php echo Router::url(array('controller'=>'Orders','action'=>'generatePaymentHistory'));?>/" + orderId + '/' + customerId + '/' + grandTotal;
            //window.location.href=base_url;
            window.open(base_url,'_blank');
        });

	});	
      
</script>

