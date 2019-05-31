<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Order Summary
                <br/><br/>
                <div class="col-md-12">
                    <div class="col-md-6">
                    <div style="font-size:15px;"><b>Customer Name:</b>
                        <?php $encodedOrderId = $Encryption->encode($orderDetails['Order']['id']);?>
                        <?php $encodedCustomerId = $Encryption->encode($orderDetails['Order']['customer_id']);?>
                        <?php echo $customerDetails['Customer']['name']; ?></div>
                        <div style="font-size:15px;"><b>Address:  </b><?php echo $customerDetails['Customer']['address']; ?></div>
                        <div style="font-size:15px;"><b>Mb: </b><?php echo '+91-' . $customerDetails['Customer']['mobile']; ?></div>
                    </div>
                        <div class="col-md-6">
                            <div class="tools" style="font-size:18px;">
                                <?php echo "Order ID: " .$orderDetails['Order']['order_number']; ?>
                            </div><br/>
                            <div class="tools" style="font-size:15px;">
                                <span style="font-size:18px;">Date: </span><?php echo date('d-M-Y h:i A', strtotime($orderDetails['Order']['created'])); ?>
                            </div><br/>
                            <div class="tools" style="font-size:15px;">
                                <span style="font-size:18px;">Status: </span><span style="color:#FC8E39;">In-Progress</span>
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
                        <th>Gems Amount</th>
						<th>Total</th>
						<th>Discount</th>
						<th>Grand Total</th>
                        <th>Action</th>
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
                            <td>&#8377;<?php echo " ". $orderDetail['making_charge']; ?></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <td><?php echo $orderDetail['gems_name']; ?></td>
                        <td><?php echo $orderDetail['gems_rate']; ?></td>
                        <td><?php echo $orderDetail['gems_weight']; ?></td>
                        <td><?php echo $orderDetail['gems_price']; ?></td>
                        <td>&#8377;<?php echo " ". number_format($orderDetail['total'],2); ?></td>
                        <?php if(isset($orderDetail['discount']) && !empty($orderDetail['discount'])) { ?>
                            <td>&#8377;<?php echo " ". number_format($orderDetail['discount'],2); ?></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <td>&#8377;<?php echo " ". number_format($orderDetail['grand_total'],2); ?></td>
                        <td style="text-align:center;">
                            <span style="cursor:pointer;" class="delete_item" title="Delete Item"><i class="mdi mdi-delete"></i></span>
                        </td>
                    </tr>
					<?php } ?>
                    </tbody>
                  </table>
                  <br/><br/><br/><br/>
                <hr>
                
                <div class="col-md-12">

                    <div class="col-md-10">
                    <?php if (isset($orderDetails['Order']['comments']) && !empty($orderDetails['Order']['comments'])) { ?>
                            <label>Comments:&nbsp;&nbsp;</label>
                            <?php echo $orderDetails['Order']['comments']; ?>
                        <?php } ?>
                    </div>

                    <div class="col-md-2">
                    <label>Grand Total:</label>
                        &#8377;<?php echo " ". number_format($orderDetails['Order']['grand_total'],2); ?>
                    </div>

                </div>
               
                <div class="col-md-12">
                    <p class="xs-mt-10 xs-mb-10">
                        <button class="btn btn-rounded btn-space btn-success" id="add-order-item">Add More Item</button>
                        <button class="btn btn-rounded btn-space btn-danger" id="delete_order">Delete Order</button>
                        <button class="btn btn-rounded btn-space btn-primary" id="order_proceed">Proceed For Payment</button>
                    </p>
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
		$("#delete_order").click(function(){
            var orderId = '<?php echo $orderDetails['Order']['id'];?>';
            if (confirm('Are you sure to delete this order ?')) {
                $.ajax({
                    url:"<?php echo Router::url(array('controller'=>'Orders','action'=>'delete_order'));?>/"+orderId,
                    success:function(data){
                        if (data == 1) {
                            window.location.href='<?php echo $this->webroot?>Customers/index';
                        } else {
                            alert('Error Occured!!');
                        }
                    }
			    });
            }
		});

        $('#add-order-item').click(function(){
            $('#addMoreItem').modal('show');
        });
        
        $('#order_proceed').click(function(){
            var encodedOrderId = '<?php echo $encodedOrderId; ?>';
            window.location.href='<?php echo $this->webroot?>Orders/details/' + encodedOrderId;
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

	});	
      
</script>