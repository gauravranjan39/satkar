<div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">Wallet
                            <div class="tools">
                                <span class="icon mdi mdi-plus"></span>
                                <!-- <span class="icon mdi mdi-more-vert"></span> -->
                            </div>
                        </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th style="width:19%;">Type</th>
                                <th style="width:19%;">Credit</th>
                                <th style="width:17%;">Debit</th>
                                <th style="width:11%;">Balance</th>
                                <th style="width:11%;">Date</th>
                                <th style="width:10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($walletDetails as $walletDetail) { ?>
                                <tr>
                                    <td><?php echo $walletDetail['Wallet']['type']; ?></td>
                                    <td><?php echo $walletDetail['Wallet']['credit']; ?></td>
                                    <td><?php echo $walletDetail['Wallet']['debit']; ?></td>
                                    <td><?php echo $walletDetail['Wallet']['balance']; ?></td>
                                    <td><?php echo date('d-M-Y', strtotime($walletDetail['Wallet']['transaction_date'])); ?></td>
                                    <td></td>
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
