<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
            <div class="col-md-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading"> 
                  <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
                  <div class="title">Orders</div>
                </div>
                <div class="panel-body table-responsive">
                  <table class="table table-striped table-borderless">
                    <thead>
                      <tr>
                        <th >Order ID</th>
                        <th >Customer Name</th>
                        <th class="">Amount</th>
                        <th>Date</th>
                        <th >Status</th>
                        <th class="actions">Action</th>
                      </tr>
                    </thead>
                    <tbody class="no-border-x">
                        <?php foreach ($orderLists as $orderList) { ?>
                            <tr>
                                <td><?php echo $orderList['Order']['order_number']; ?></td>
                                <td><?php echo $orderList['Customer']['name']; ?></td>
                                <td class="">&#8377;<?php echo " " . $orderList['Order']['grand_total']; ?></td>
                                <td><?php echo date('d-M-Y h:i A', strtotime($orderList['Order']['created'])); ?></td>
                                <?php if (empty($orderList['Order']['payment_status'])) { ?>
                                    <td class="text-danger">Pending</td>
                                <?php } else { ?>
                                    <td class="text-success">Completed</td>
                                <?php } ?>
                                <td class="actions"><a href="#" class="icon"><i class="mdi mdi-plus-circle-o"></i></a></td>
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