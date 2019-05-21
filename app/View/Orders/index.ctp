<div class="modal animated fadeIn" id="myModalForCustomer" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg" style=" margin: 0  auto;top:10%;width: 40%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Customer Details</h3><hr>
            </div>
            
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="col-md-3"><b>Name:</b></div>
                    <div class="col-md-9 customer-name"></div>
                </div>
                <br/><br/>
                <div class="col-md-12">
                    <div class="col-md-3"><b>Address:</b></div>
                    <div class="col-md-9 customer-address"></div>
                </div><br/><br/>
                <div class="col-md-12">
                    <div class="col-md-3"><b>Mobile:</b></div>
                    <div class="col-md-9 customer-mobile"></div>
                </div><br/><br/>
                <div class="col-md-12">
                    <div class="col-md-3"><b>Email:</b></div>
                    <div class="col-md-9 customer-email"></div>
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

<div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Orders
                  <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        
                        <th style="width:19%;">Order ID</th>
                        <th style="width:17%;">Customer</th>
                        <th style="width:11%;">Total</th>
                        <th style="width:10%;">Paid</th>
                        <th style="width:10%;">Dues</th>
                        <th style="width:10%;">Status</th>
                        <th style="width:15%;">Date</th>
                        <th style="width:10%;">Payment</th>
                        <th style="width:10%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($orderLists as $orderList) {
                            if ($orderList['Order']['status'] == 0 ) {
                                $status = 'Draft';
                                $orderStatusClass = 'text-warning';
                            } else if ($orderList['Order']['status'] == 1 ) {
                                $status = 'Confirm';
                                $orderStatusClass = 'text-success';
                            } else if ($orderList['Order']['status'] == 2) {
                                $status = 'Cancelled';
                                $orderStatusClass = 'text-danger';
                            } else if ($orderList['Order']['status'] == 3) {
                                $status = 'Partial Cancelled';
                                $orderStatusClass = 'text-warning';
                            }
                    ?>
                      <tr>
                        
                      <td><?php echo $orderList['Order']['order_number']; ?></td>
                        <td class="cell-detail"> <span><?php echo $this->Html->link($orderList['Customer']['name'], 'javascript:void(0);',  array("class" => "customer_details", "escape" => false,"mobile"=>$orderList['Customer']['mobile'],"email"=>$orderList['Customer']['email'],"address"=>$orderList['Customer']['address'])); ?></span></td>
                        <td class="milestone">&#8377;<?php echo number_format($orderList['Order']['grand_total'],2); ?></td>
                        <?php 
                            $sum = 0;
                            foreach ($orderList['OrderTransaction'] as $orderTransaction) {
                                $sum+= $orderTransaction['amount_paid'];
                            }
                            $dues = ($orderList['Order']['grand_total'] - $sum);
                        ?>
                        <td class="cell-detail"><span>&#8377;<?php echo number_format($sum,2); ?></span></td>
                        <td class="cell-detail"><span>&#8377;<?php echo number_format($dues,2); ?></span></td>
                        <td class="<?php echo $orderStatusClass ?>"><?php echo $status; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($orderList['Order']['created'])); ?></td>
                        <?php if ($orderList['Order']['payment_status'] == 1) { ?>
                            <td><?php echo $this->Html->link('Pending', 'javascript:void(0);',  array("class" => "text-danger payment_pending", "escape" => false,'order_id'=>$orderList['Order']['id'],'title'=>'Change to Completed')); ?></td>
                        <?php } else { ?>
                            <td class="text-success">Completed</td>
                        <?php } ?>

                        <td class="text-right">
                            <div class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Open <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                <ul role="menu" class="dropdown-menu pull-right">
                                    <li><a href="#">Payment</a></li>
                                    <?php $encodedOrderId = $Encryption->encode($orderList['Order']['id']);?>
                                    <li><?php echo $this->Html->link('Order Details', array('controller' => 'Orders','action' => 'details',$encodedOrderId),array('class'=>''));?></li>
                                </ul>
                            </div>                        
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
        $(".customer_details").click(function(){
            var customerName = $(this).text();
            var customerAddress = $(this).attr('address');
            var customerMobile = $(this).attr('mobile');
            var customerEmail = $(this).attr('email');
            $('#myModalForCustomer').modal('show');
            $('#myModalForCustomer').find('.customer-name').text(customerName);
            $('#myModalForCustomer').find('.customer-address').text(customerAddress);
            $('#myModalForCustomer').find('.customer-mobile').text(customerMobile);
            $('#myModalForCustomer').find('.customer-email').text(customerEmail);
		});

        $('.payment_pending').click(function(){
            var orderID = $(this).attr('order_id');
            var ref = $(this);
            if (confirm('Are you sure to change the payment status ?')) {
                $.ajax({
                    url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'change_payment_status'));?>/"+orderID,
                    success:function(data){
                        if (data == 1) {
                            ref.parent().addClass('text-success');
                            ref.parent().html('Completed');
                        } else {
                            alert('Error Occured!!');
                        }
                    }
			    });
            }
        });

	});	
      
</script>