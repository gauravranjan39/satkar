<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Order Summary
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
                            <td>&#8377;<?php echo " ". $orderDetail['making_charge']; ?></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <td><?php echo $orderDetail['gems_name']; ?></td>
                        <td><?php echo $orderDetail['gems_rate']; ?></td>
                        <td><?php echo $orderDetail['gems_weight']; ?></td>
                        <td><?php echo $orderDetail['gems_price']; ?></td>
                        <td>&#8377;<?php echo " ". number_format($orderDetail['total'],2); ?></td>
                        <td>&#8377;<?php echo " ". number_format($orderDetail['discount'],2); ?></td>
                        <td>&#8377;<?php echo " ". number_format($orderDetail['grand_total'],2); ?></td>
                    </tr>
					<?php } ?>
                    </tbody>
                  </table>
                  <br/><br/><br/><br/>
                <hr>
                <div class="col-md-12">
                  <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                        <label>Comments:&nbsp;&nbsp;</label>
                        <?php echo $orderDetails['Order']['comments']; ?>
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Total:</label>
                        &#8377;<?php echo " ". number_format($orderDetails['Order']['total'],2); ?>
                    </div>
                </div>

                <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Discount:</label>
                        &#8377;<?php echo " ". number_format($orderDetails['Order']['discount'],2); ?>
                    </div>
                </div>

                <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Grand Total:</label>
                        &#8377;<?php echo " ". number_format($orderDetails['Order']['grand_total'],2); ?>
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
                        echo " ". number_format($sum,2); ?>
                    </div>
                </div>

                <div class="row xs-pt-12">
                    <div class="form-group col-sm-10">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Dues:</label>
                        <?php 
                            $grandTotal = $orderDetails['Order']['grand_total'];
                            $payment = $orderDetails['OrderTransaction'][0]['amount_paid'];
                            $dues = ($orderDetails['Order']['grand_total'] - $orderDetails['OrderTransaction'][0]['amount_paid']);
                        ?>
                        &#8377;<?php echo " ". number_format($dues,2); ?>
                    </div>
                </div>

                </div>
                <div class="col-md-12">
                    <p class="xs-mt-10 xs-mb-10">
                        <button class="btn btn-rounded btn-space btn-success" id="order_invoice">Generate Order Invoice</button>
                        <button class="btn btn-rounded btn-space btn-primary" id="confirm_order">Confirm Order</button>
                        <button class="btn btn-rounded btn-space btn-danger" id="delete_order">Delete Order</button>
                        <button class="btn btn-rounded btn-space btn-default" id="payment_receipt">Generate Payment Receipt</button>
                    </p>
                </div>

                <?php //pr($orderDetails); ?>
                </div>
              </div>
            </div>
          </div>
      </div>
