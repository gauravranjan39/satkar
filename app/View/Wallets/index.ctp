<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js"></script> -->
<?php echo $this->Html->script('vue.min');?>
<?php echo $this->Html->css('bootstrap-datetimepicker.min');?>
<?php echo $this->Html->script('bootstrap-datetimepicker.min');?>
<div class="be-content" id="cust-wallet">
      <div class="main-content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">Wallet 
                            <?php $encodedCustomerId = $Encryption->encode($customerId); ?>
                            <div class="tools">
                                <!-- <span class="icon mdi mdi-more"></span> -->
                                <div class="icon-container">
                                    <div class="icon" title="Make Transaction"><span class="mdi mdi-more wallet_transaction"></span></div>
                                </div>
                            </div>
                        </div>
                        <?php //echo 'index page';pr($criteria); ?>
                        <div class="form-group col-md-12">
                            <?php echo $this->Form->create('Wallet',array('url'=> array('controller' => 'Wallets', 'action' => 'index',$encodedCustomerId),'method'=>'POST')); ?>
                            <?php echo $this->Form->input('Wallet.customer_id',array('type'=>'hidden','value'=>$encodedCustomerId)); ?>
                            <div class="col-md-4">
                                <?php echo $this->Form->input("Wallet.start_date",array('placeholder'=>'Enter start date','id'=>'start_date','class'=>'form-control input-sm date datetimepicker','data-min-view' =>'2','data-date-format'=>'yyyy-mm-dd','autocomplete'=>'off','label'=>false,'value'=>isset($criteria['Wallet']['start_date'])? $criteria['Wallet']['start_date']:''));?>
                            </div>
                            
                            <div class="col-md-4">
                                <?php echo $this->Form->input("Wallet.end_date",array('placeholder'=>'Enter end date','id'=>'end_date','class'=>'form-control input-sm date datetimepicker','data-min-view' =>'2','data-date-format'=>'yyyy-mm-dd','autocomplete'=>'off','label'=>false,'value'=>isset($criteria['Wallet']['end_date'])? $criteria['Wallet']['end_date']:''));?>
                            </div>

                            <div class="col-md-4">
                                <?php echo $this->Form->button('Search',array('type'=>'submit','id'=>'search_orders','class'=>'btn btn-rounded btn-primary','escape'=>false));?>
                            </div>
                            <?php echo $this->Form->end();?>
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
                                <?php foreach ($walletDetails as $walletDetail) { 
                                    $encodedOrderId = $Encryption->encode($walletDetail['Wallet']['order_id']);
                                    $walletDetail['Wallet']['encoded_order_id'] = $encodedOrderId;
                                ?>
                                <tr>
                                    <td><?php echo $walletDetail['Wallet']['type']; ?></td>
                                    <?php if (!empty($walletDetail['Wallet']['credit'])) { ?>
                                        <td>&#8377;<?php echo number_format($walletDetail['Wallet']['credit'],2); ?></td>
                                    <?php } else { ?>
                                        <td></td>
                                    <?php } if (!empty($walletDetail['Wallet']['debit'])) { ?>
                                        <td>&#8377;<?php echo number_format($walletDetail['Wallet']['debit'],2); ?></td>
                                    <?php } else { ?>
                                        <td></td>
                                    <?php } ?>
                                    <td>&#8377;<?php echo number_format($walletDetail['Wallet']['balance'],2); ?></td>
                                    <td><?php echo date('d-M-Y', strtotime($walletDetail['Wallet']['transaction_date'])); ?></td>
                                    <td>
                                    <i class="mdi mdi-eye" title="View Details" style="font-size: 16px;cursor: pointer;" @click='openPopUp(<?php echo json_encode($walletDetail)?>)'></i></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if (!empty($criteria)) {
                $this->Paginator->options(array('url' => array($encodedCustomerId .'/'. 'criteria' => $criteria)));
            }
        ?>	
        <nav>
            <center>
                <ul class="pagination">
                    <li>
                    <?php
                        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                        echo $this->Paginator->numbers(array('separator' => ''));
                        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                    ?>
                    </li>
                </ul>
            </center>
        </nav>
    </div>
    <div class="modal animated fadeIn" id="walletTransaction" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="top:5%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Make Transaction</h3><hr>
            </div>
            
            <div class="modal-body" style="padding-top:0px !important;">
                <?php echo $this->Form->create('Wallet',array('url'=> array('controller' => 'Wallets', 'action' => 'wallet_transaction'),'id'=>'walletMoneyTransaction','method'=>'POST')); ?>
                <?php echo $this->Form->input('Wallet.customer_id',array('type'=>'hidden','value'=>$customerId)); ?>
                

                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>Transaction:</b></div>
                    <div class="col-md-9">
                        <?php echo $this->Form->input("Wallet.transaction_type",array('type'=>'select','options'=>array('credit'=>'Credit','debit'=>'Debit'),'required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    </div>
                </div>
                
                
                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>Payment:</b></div>
                    <div class="col-md-9">
                        <?php echo $this->Form->input("Wallet.type",array('type'=>'select','options'=>array('cash'=>'Cash','metal'=>'Metal','cheque'=>'Cheque','net-banking'=>'Net-Banking','credit-card'=>'Credit Card','debit-card'=>'Debit Card'),'placeholder'=>'Enter category','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    </div>
                </div>

                <div class="form-group col-md-12" id="wallent_money" style="display:none;">
                    <div class="col-md-3"><b>Wallet Money:</b></div>
                    <?php 
                        if (!empty($walletDetails)){
                            $walletBalance = $walletDetails[0]['Wallet']['balance'];
                        } else {
                            $walletBalance = '0.00';
                        }
                    ?>
                    <div class="col-md-9">&#8377;<?php echo number_format($walletBalance,2); ?></div>
                </div>

                <div class="row metal_payment" style="display:none;">
                    <div class="form-group col-md-12">
                        <div class="col-md-4"><?php echo $this->Form->input("Wallet.item",array('placeholder'=>'Enter items','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-2"><?php echo $this->Form->input("Wallet.metal_type",array('type'=>'select','options'=>array('gold'=>'Gold','silver'=>'Silver','others'=>'Others'),'empty'=>'--Select--','class'=>'form-control input-sm','label'=>false));?></div>
                        <div class="col-md-2"><?php echo $this->Form->input("Wallet.weight",array('placeholder'=>'Enter weight','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm allowOnlyNumber payment-input','label'=>false));?></div>
                        <div class="col-md-2"><?php echo $this->Form->input("Wallet.return_percentage",array('placeholder'=>'Enter return %','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm allowOnlyNumber payment-input','label'=>false));?></div>
                        <div class="col-md-2"><?php echo $this->Form->input("Wallet.rate",array('placeholder'=>'Enter Rate','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm allowOnlyNumber payment-input','label'=>false));?></div>
                    </div>
                </div>

                <div class="row cheque_payment" style="display:none;">
                    <div class="form-group col-md-12">
                        <div class="col-md-4"><?php echo $this->Form->input("Wallet.cheque_number",array('placeholder'=>'Enter cheque number','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-4"><?php echo $this->Form->input("Wallet.cheque_bank_name",array('placeholder'=>'Enter Bank Name','id'=>'cheque_bank_name','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-4"><?php echo $this->Form->input("Wallet.cheque_transaction_date",array('placeholder'=>'Select Transaction Date','id'=>'cheque_transaction_date','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm datetimepicker payment-input','label'=>false));?></div>
                    </div>
                </div>

                <div class="row card_net_banking_payment" style="display:none;">
                    <div class="form-group col-md-12">
                        <div class="col-md-4"><?php echo $this->Form->input("Wallet.bank_name",array('placeholder'=>'Enter Bank Name','id'=>'card_net_banking_bank_name','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-4"><?php echo $this->Form->input("Wallet.payment_transaction_id",array('placeholder'=>'Enter Transaction Id','id'=>'card_net_banking_transaction_id','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                        <div class="col-md-4"><?php echo $this->Form->input("Wallet.transaction_date",array('placeholder'=>'Select Transaction Date','id'=>'card_net_banking_transaction_date','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm datetimepicker payment-input','label'=>false));?></div>
                    </div>
                </div>

                <div class="row cash_payment">
                    <div class="form-group col-md-12">
                        <div class="col-md-4"><?php echo $this->Form->input("Wallet.amount_paid",array('id'=>'dues_payment','placeholder'=>'Enter amount','type'=>'text','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm allowOnlyNumber','maxlength'=>'7','label'=>false));?></div>
                        <div class="col-md-8"><?php echo $this->Form->input("Wallet.comments",array('placeholder'=>'Enter comments','type'=>'text','autocomplete'=>'off','class'=>'form-control input-sm payment-input','label'=>false));?></div>
                    </div>
                </div>
                
                <div class="">
                    <div class="">
                        <div class="col-md-12">
                            <?php echo $this->Form->button('Make Payment',array('type'=>'submit','id'=>'walletSubmitButton','class'=>'btn btn-rounded btn-primary','style'=>'margin-top: 26px;margin-bottom: 18px;','escape'=>false));?>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end();?>
            </div>
        </div>
    </div>
</div>


<div class="modal animated fadeIn" id="PaymentDetails" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">

                            
    <div class="modal-dialog modal-lg" style="top:6%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Payment Details</h3><hr>
            </div>
            
            <div class="modal-body" style="padding-top:0px !important;">
            <div class="form-group col-md-12" v-if="PaymentDetails.type">
                    <div class="col-md-3"><b>Payment Type:</b></div>
                    <div class="col-md-9">{{PaymentDetails.type}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.order_number">
                    <div class="col-md-3"><b>Order Number:</b></div>
                    <div class="col-md-9"><a target="_blank" :href="'/satkar/Orders/details/' + PaymentDetails.encoded_order_id">{{ PaymentDetails.order_number }}</a></div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.metal_type">
                    <div class="col-md-3"><b>Metal:</b></div>
                    <div class="col-md-9">{{PaymentDetails.metal_type}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.item">
                    <div class="col-md-3"><b>Item:</b></div>
                    <div class="col-md-9">{{PaymentDetails.item}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.weight">
                    <div class="col-md-3"><b>Weight:</b></div>
                    <div class="col-md-9">{{PaymentDetails.weight}}gm</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.rate">
                    <div class="col-md-3"><b>Rate:</b></div>
                    <div class="col-md-9">&#8377;{{PaymentDetails.rate}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.return_percentage">
                    <div class="col-md-3"><b>Return %:</b></div>
                    <div class="col-md-9">{{PaymentDetails.return_percentage}}%</div>
                </div>
                
                <div class="form-group col-md-12" v-if="PaymentDetails.cheque_number">
                    <div class="col-md-3"><b>Cheque Number:</b></div>
                    <div class="col-md-9">{{PaymentDetails.cheque_number}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.bank_name">
                    <div class="col-md-3"><b>Bank Name:</b></div>
                    <div class="col-md-9">{{PaymentDetails.bank_name}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.payment_transaction_id">
                    <div class="col-md-3"><b>Transaction Id:</b></div>
                    <div class="col-md-9">{{PaymentDetails.payment_transaction_id}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.transaction_date">
                    <div class="col-md-3"><b>Transaction Date:</b></div>
                    <div class="col-md-9">{{PaymentDetails.transaction_date}}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.credit">
                    <div class="col-md-3"><b>Credit:</b></div>
                    <div class="col-md-9">&#8377;{{ formatPrice(PaymentDetails.credit) }}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.debit">
                    <div class="col-md-3"><b>Debit:</b></div>
                    <div class="col-md-9">&#8377;{{ formatPrice(PaymentDetails.debit) }}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.balance">
                    <div class="col-md-3"><b>Balance:</b></div>
                    <div class="col-md-9">&#8377;{{ formatPrice(PaymentDetails.balance) }}</div>
                </div>

                <div class="form-group col-md-12" v-if="PaymentDetails.comments">
                    <div class="col-md-3"><b>Comments:</b></div>
                    <div class="col-md-9">{{PaymentDetails.comments}}</div>
                </div>
                
                
                <div class="">
                    <div class="">
                        <div class="col-md-12">
                            <?php echo $this->Form->button('Cancel',array('type'=>'button','data-dismiss'=>'modal','class'=>'btn btn-rounded btn-default','style'=>'margin-top: 26px;margin-bottom: 18px;','escape'=>false));?>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end();?>
            </div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">

    new Vue({
        data(){
            return {
                PaymentDetails: {}
            }      
        },
        el: '#cust-wallet',
        methods: {
            formatPrice(value) {
                let val = (value/1).toFixed(2)
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
            openPopUp: function(payment) {
                this.PaymentDetails = payment.Wallet;
                $('#PaymentDetails').modal();
                console.log(payment.Wallet);
            }
        }
    })

	$(document).ready(function() {

        var start = new Date();
        // set end date to max one year period:
        var end = new Date(new Date().setYear(start.getFullYear()+1));

        $('#start_date').datetimepicker({
            autoclose: true,
            componentIcon: '.mdi.mdi-calendar',
            navIcons:{
                rightIcon: 'mdi mdi-chevron-right',
                leftIcon: 'mdi mdi-chevron-left'
            },
            //startDate : start,
            endDate   : start
            // update "toDate" defaults whenever "fromDate" changes
            }).on('changeDate', function(){
                // set the "toDate" start to not be later than "fromDate" ends:
                $('#end_date').datetimepicker('setStartDate', new Date($(this).val()));
        }); 

        $('#end_date').datetimepicker({
            autoclose: true,
            componentIcon: '.mdi.mdi-calendar',
            navIcons:{
                rightIcon: 'mdi mdi-chevron-right',
                leftIcon: 'mdi mdi-chevron-left'
            },
            // startDate : start,
            endDate   : start
        // update "fromDate" defaults whenever "toDate" changes
        }).on('changeDate', function(){
            // set the "fromDate" end to not be later than "toDate" starts:
            $('#start_date').datetimepicker('setEndDate', new Date($(this).val()));
        });

        // $("#start_date").datetimepicker({
        //     autoclose: true,
        //     componentIcon: '.mdi.mdi-calendar',
        //     navIcons:{
        //         rightIcon: 'mdi mdi-chevron-right',
        //         leftIcon: 'mdi mdi-chevron-left'
        //     },
        //     onClose: function( selectedDate ) {
        //         $( "#end_date").datetimepicker( "option", "minDate", selectedDate );
        //     }
        // });

        // $("#end_date").datetimepicker({
        //     autoclose: true,
        //     componentIcon: '.mdi.mdi-calendar',
        //     navIcons:{
        //         rightIcon: 'mdi mdi-chevron-right',
        //         leftIcon: 'mdi mdi-chevron-left'
        //     },
        //     onClose: function( selectedDate ) {
        //         $( "#start_date").datetimepicker( "option", "minDate", selectedDate );
        //     }
        // });

        $('.datetimepicker').keypress(function(){
            return false;
        });

        $(".datetimepicker").datetimepicker({
            autoclose: true,
            componentIcon: '.mdi.mdi-calendar',
            navIcons:{
                rightIcon: 'mdi mdi-chevron-right',
                leftIcon: 'mdi mdi-chevron-left'
            },
            endDate   : start
        });
        

        $('.wallet_transaction').click(function(){
            $('#WalletTransactionType').val('credit');
            $('#WalletType').val('cash');
            $('#wallent_money').hide();
            $('.metal_payment').hide();
            $('.cheque_payment').hide();
            $('.card_net_banking_payment').hide();
            $("#WalletType option[value='metal']").remove();
            $("#WalletType").append('<option value="metal">Metal</option>');
            $('#walletTransaction').modal('show');
        });

        $('#WalletTransactionType').change(function(){
            var transactionType = $(this).val();
            $("#WalletType").val('cash');
            $('.metal_payment').hide();
            $('.cheque_payment').hide();
            $('.card_net_banking_payment').hide();
            $('#dues_payment').val('');
            $('#WalletComments').val('');
            $('#WalletType').attr("disabled", false);
            var walletBal = parseFloat('<?php echo $walletBalance;?>');
            if (transactionType == 'debit') {
                $('#wallent_money').show();
                $("#WalletType option[value='metal']").remove();
                if (walletBal) {
                } else {
                    $('#WalletType').attr("disabled", true);
                    $('#dues_payment').attr("readonly", true);
                    $('#walletSubmitButton').attr("disabled", true);
                }
            } else {
                $('#wallent_money').hide();
                $("#WalletType").append('<option value="metal">Metal</option>');
                $('#dues_payment').attr("readonly", false);
                $('#walletSubmitButton').attr("disabled", false);
            }
        });

        $('#WalletType').change(function(){
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
                $('#WalletMetalType').val('');
                $('#WalletItem').attr('required', 'required');
                $('#WalletMetalType').attr('required', 'required');
                $('#WalletWeight').attr('required', 'required');
                $('#WalletReturnPercentage').attr('required', 'required');
                $('#WalletRate').attr('required', 'required');
                
            } else if (transactionType == 'cheque') {
                $('.metal_payment').hide();
                $('.cheque_payment').show();
                $('.card_net_banking_payment').hide();
                $('#WalletChequeNumber').attr('required', 'required');
                $('#cheque_bank_name').attr('required', 'required');
                $('#cheque_transaction_date').attr('required', 'required');
            } else if (transactionType == 'net-banking') {
                $('.metal_payment').hide();
                $('.cheque_payment').hide();
                $('.card_net_banking_payment').show();
                $('#card_net_banking_bank_name').attr('required', 'required');
                //$('#card_net_banking_transaction_id').attr('required', 'required');
                $('#card_net_banking_transaction_date').attr('required', 'required');
            } else if (transactionType == 'credit-card') {
                $('.metal_payment').hide();
                $('.cheque_payment').hide();
                $('.card_net_banking_payment').show();
                $('#card_net_banking_bank_name').attr('required', 'required');
                //$('#card_net_banking_transaction_id').attr('required', 'required');
                $('#card_net_banking_transaction_date').attr('required', 'required');
            } else if (transactionType == 'debit-card') {
                $('.metal_payment').hide();
                $('.cheque_payment').hide();
                $('.card_net_banking_payment').show();
                $('#card_net_banking_bank_name').attr('required', 'required');
                //$('#card_net_banking_transaction_id').attr('required', 'required');
                $('#card_net_banking_transaction_date').attr('required', 'required');
            }
        });

        $('#dues_payment').keyup(function(){
            var walletBal = parseFloat('<?php echo $walletBalance;?>');
            var payment = $(this).val();
            var transactionType = $('#WalletTransactionType').val();
            if (transactionType == 'debit') {
                if (parseFloat(payment) > parseFloat(walletBal)) {
                    alert('Amount should be less than wallet balance.');
                    $(this).val('');
                }
            }
		});

        $('#walletMoneyTransaction').submit(function(event){
            event.preventDefault();
            $.ajax({
                url:"<?php echo Router::url(array('controller'=>'Wallets','action'=>'wallet_transaction'));?>",
                type: 'POST',
                data: $('#walletMoneyTransaction').serialize(),
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