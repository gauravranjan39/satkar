<div class="be-content">
    <div class="main-content container-fluid">
	    <?php echo $this->Session->flash(); ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-body">
                        <?php echo $this->Form->create('Order',array('url'=> array('controller' => 'OrderItems', 'action' => 'add',$customerId),'method'=>'POST')); ?>
                            <div class="clone-div" id="clonedInput_0" data-count-val="0">
							
								<div class="col-md-12">
									<div class="form-group">
										<div class="col-sm-4" style="float:right;">
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
										<?php echo $this->Form->input("OrderItem.gems_price",array('name'=>'data[OrderItem][0][gems_weight]','id'=>'GemsPrice_0','placeholder'=>'Enter Gems Price','class'=>'form-control input-sm allowOnlyNumber per-weight-field','readonly'=>true, 'label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Total</label>
										<?php echo $this->Form->input("OrderItem.total",array('name'=>'data[OrderItem][0][total]','id'=>'OrderItemTotal_0','placeholder'=>'Total','required'=>'required','readonly'=>true,'class'=>'form-control input-sm allowOnlyNumber itemTotal','label'=>false));?>
									</div>
									<div class="form-group col-sm-6">
										<label>Discount</label>
										<?php echo $this->Form->input("OrderItem.discount",array('name'=>'data[OrderItem][0][discount]','id'=>'OrderItemDiscount_0','placeholder'=>'Enter Discount','class'=>'form-control input-sm allowOnlyNumber per-weight-field','label'=>false,'maxLength'=>4));?>
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
									<label>Total</label>
									<?php echo $this->Form->input("Order.total",array('placeholder'=>'Total','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm orderAllowOnlyNumber','readonly'=>true,'label'=>false));?>
								</div>
							</div>

							<div class="row xs-pt-12">
								<div class="form-group col-sm-6"></div>
								<div class="form-group col-sm-6">
									<label>Discount</label>
									<?php echo $this->Form->input("Order.discount",array('placeholder'=>'Discount','autocomplete'=>'off','class'=>'form-control input-sm orderAllowOnlyNumber','label'=>false));?>
								</div>
							</div>

							<div class="row xs-pt-12">
								<div class="form-group col-sm-6"></div>
								<div class="form-group col-sm-6">
									<label>Grand Total</label>
									<?php echo $this->Form->input("Order.grand_total",array('placeholder'=>'Grand Total','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm orderAllowOnlyNumber','readonly'=>true,'label'=>false));?>
								</div>
							</div>

							<div class="row xs-pt-12">
								<div class="form-group col-sm-6"></div>
								<div class="form-group col-sm-6">
									<label>Payment</label>
									<?php echo $this->Form->input("OrderTransaction.amount_paid",array('placeholder'=>'Payment','required'=>'required','autocomplete'=>'off','class'=>'form-control input-sm orderAllowOnlyNumber','label'=>false));?>
								</div>
							</div>

							<div class="row xs-pt-12">
								<div class="form-group col-sm-6"></div>
								<div class="form-group col-sm-6">
									<label>Dues</label>
									<?php echo $this->Form->input("OrderTransaction.dues",array('placeholder'=>'Dues','autocomplete'=>'off','class'=>'form-control input-sm orderAllowOnlyNumber','readonly'=>true,'label'=>false));?>
								</div>
							</div>
							
							<div class="row xs-pt-15">
								<div class="col-xs-6">
									<?php echo $this->Form->button('Submit',array('class'=>'btn btn-space btn-primary','id'=>'orderItems','type'=>'submit'));?>
									<?php echo $this->Html->link('cancel', array('controller' => 'customers','action' => 'index'),array('class'=>'btn btn-space btn-default'));?>
								</div>
							</div>
                    
                        <?php echo $this->Form->end();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){

		$('.clone-div').on('change','.saleType',function(){
			var saleType = $(this).attr('sale-type');
			var countVal = $(this).attr('data-count-val');
			if (saleType == 'gems') {
				$('.gems_fields_'+countVal).show();
				$('.extra_fields_'+countVal).show();
				$('.extra_fields_'+countVal).find('input').attr('required', 'required');
				$('.extra_fields_'+countVal).find('input').val('');
				$('.gems_fields_'+countVal).find('input').attr('required', 'required');
				$('#OrderItemTotal_'+countVal).attr('readonly',true);
				$('#OrderItemTotal_'+countVal).val('');
				$('#OrderItemGrandTotal_'+countVal).val('');
				$('#OrderItemName_'+countVal).val('');
				$('#OrderItemCategoryId_'+countVal).val('');
				$('#OrderItemDiscount_'+countVal).val('');
			} else if(saleType == 'piece') {
				$('.gems_fields_'+countVal).hide();
				$('.extra_fields_'+countVal).hide();
				$('.gems_fields_'+countVal).find('input').val('');
				$('.extra_fields_'+countVal).find('input').val('');
				$('.extra_fields_'+countVal).find('input').removeAttr('required');
				$('.gems_fields_'+countVal).find('input').removeAttr('required');
				$('#OrderItemTotal_'+countVal).removeAttr('readonly',false);
				$('#OrderItemTotal_'+countVal).val('');
				$('#OrderItemGrandTotal_'+countVal).val('');
				$('#OrderItemName_'+countVal).val('');
				$('#OrderItemCategoryId_'+countVal).val('');
				$('#OrderItemDiscount_'+countVal).val('');
			} else if(saleType == 'weight') {
				$('.extra_fields_'+countVal).show();
				$('.gems_fields_'+countVal).hide();
				$('.gems_fields_'+countVal).find('input').val('');
				$('.gems_fields_'+countVal).find('input').removeAttr('required');
				$('.extra_fields_'+countVal).find('input').attr('required', 'required');
				$('#OrderItemTotal_'+countVal).attr('readonly',true);
				$('#OrderItemTotal_'+countVal).val('');
				$('#OrderItemGrandTotal_'+countVal).val('');
				$('#OrderItemName_'+countVal).val('');
				$('#OrderItemCategoryId_'+countVal).val('');
				$('#OrderItemDiscount_'+countVal).val('');
			}
		});
		
		$('.clone-div').off("keypress", ".allowOnlyNumber");
		$('.clone-div').on('keypress','.allowOnlyNumber',function(evt){
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;
		});

		$('.orderAllowOnlyNumber').keypress(function(evt){
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;
		});

		$('body').on('change','.hideSomeField',function(){
			//alert($(this).attr('data-count-val'));return false;
			if ($(this).prop("checked") == true) {
				$(this).parent().parent().parent("div.clone-div").find("div.extra_fields").show();
				$(this).parent().parent().parent("div.clone-div").find("div.extra_fields").find('input').attr('required', 'required');
			} else {
				$(this).parent().parent().parent("div.clone-div").find("div.extra_fields").hide();
				$(this).parent().parent().parent("div.clone-div").find("div.extra_fields").find('input').removeAttr('required');
				$(this).parent().parent().parent("div.clone-div").find("div.extra_fields").find('input').val('');
			}
		});

		$(document).off("focus change keyup", "input.per-weight-field");

		$(document).on("focus change keyup", "input.per-weight-field,input.itemTotal", function(){
			var parentDiv = $(this).parents('.clone-div').attr('data-count-val');
			var saleType = $("input[name='type"+parentDiv+"']:checked").attr('sale-type');

			if (saleType == 'weight') {
				var curentElemRate = $('#OrderItemRate_'+parentDiv).val();
				var curentElemMaking = $('#OrderItemMakingCharge_'+parentDiv).val();
				var curentElemWeight = $('#OrderItemWeight_'+parentDiv).val();
				var curentElemDiscount = $('#OrderItemDiscount_'+parentDiv).val();
			
				if (curentElemDiscount == '') {
					curentElemDiscount = '0.00';
				}
				if (curentElemRate == '' || curentElemMaking == '' || curentElemWeight == '' ) {
					$('#OrderItemTotal_'+parentDiv).val('');
					$('#OrderItemGrandTotal_'+parentDiv).val('');
				}
				
				var calculatePrice = (parseFloat(curentElemRate) + parseFloat(curentElemMaking)) * parseFloat(curentElemWeight);
				if ($.isNumeric(calculatePrice)) {
					$('#OrderItemTotal_'+parentDiv).val(calculatePrice.toFixed(2));
					var currentElemTotal = $('#OrderItemTotal_'+parentDiv).val();
					if (parseFloat(curentElemDiscount) > parseFloat(currentElemTotal)) {
						alert('Discount amount must be less than total amount');
						$('#OrderItemDiscount_'+parentDiv).val('');
						curentElemDiscount = '0.00';
					}
					var currentElemGrandTotal =  (parseFloat(currentElemTotal) - parseFloat(curentElemDiscount));
					$('#OrderItemGrandTotal_'+parentDiv).val(currentElemGrandTotal.toFixed(2));
				}
			} else if (saleType == 'piece') {
				var currentElemTotal = $('#OrderItemTotal_'+parentDiv).val();
				if ($.isNumeric(currentElemTotal)) {
					$('#OrderItemGrandTotal_'+parentDiv).val(currentElemTotal);
				}
				var curentElemDiscount = $('#OrderItemDiscount_'+parentDiv).val();
				if (curentElemDiscount == '') {
					curentElemDiscount = '0.00';
				}

				if (currentElemTotal == '' ) {
					$('#OrderItemTotal_'+parentDiv).val('');
					$('#OrderItemGrandTotal_'+parentDiv).val('');
					$('#OrderItemDiscount_'+parentDiv).val('');
					curentElemDiscount = '0.00';
				}

				if (parseFloat(curentElemDiscount) > parseFloat(currentElemTotal)) {
					alert('Discount amount must be less than total amount');
					$('#OrderItemDiscount_'+parentDiv).val('');
					curentElemDiscount = '0.00';
				}
				var currentElemGrandTotal =  (parseFloat(currentElemTotal) - parseFloat(curentElemDiscount));
				if ($.isNumeric(currentElemGrandTotal)) {
					$('#OrderItemGrandTotal_'+parentDiv).val(currentElemGrandTotal.toFixed(2));
				}
			} else if (saleType == 'gems') {
				var curentElemRate = $('#OrderItemRate_'+parentDiv).val();
				var curentElemMaking = $('#OrderItemMakingCharge_'+parentDiv).val();
				var curentElemWeight = $('#OrderItemWeight_'+parentDiv).val();
				var curentElemGemsDiscount = $('#OrderItemDiscount_'+parentDiv).val();

				if (curentElemGemsDiscount == '') {
					curentElemGemsDiscount = '0.00';
				}
				if (curentElemRate == '' || curentElemMaking == '' || curentElemWeight == '' ) {
					$('#OrderItemTotal_'+parentDiv).val('');
					$('#OrderItemGrandTotal_'+parentDiv).val('');
				}

				var metalPrice = (parseFloat(curentElemRate) + parseFloat(curentElemMaking)) * parseFloat(curentElemWeight);
				
				var curentElemGemsRate = $('#GemsRate_'+parentDiv).val();
				var curentElemGemsWeight = $('#GemsWeight_'+parentDiv).val();
				var curentElemGemsWeight = (curentElemGemsWeight * 5.5);
				if (curentElemGemsWeight != '') {
					var curentElemGemsTotal = (parseFloat(curentElemGemsRate)) * parseFloat(curentElemGemsWeight);
				} else {
					$('#OrderItemTotal_'+parentDiv).val('');
					$('#OrderItemGrandTotal_'+parentDiv).val('');
				}
				
				if ($.isNumeric(curentElemGemsTotal)) { 
					$('#GemsPrice_'+parentDiv).val(curentElemGemsTotal.toFixed(2));
				}
				var gemsItemTotalAmt = (parseFloat(curentElemGemsTotal) + parseFloat(metalPrice));
				if ($.isNumeric(gemsItemTotalAmt)) { 
					$('#OrderItemTotal_'+parentDiv).val(gemsItemTotalAmt.toFixed(2));
					$('#OrderItemGrandTotal_'+parentDiv).val(gemsItemTotalAmt.toFixed(2));
					var currentElemGemsTotal = $('#OrderItemTotal_'+parentDiv).val();
					if (parseFloat(curentElemGemsDiscount) > parseFloat(currentElemGemsTotal)) {
						alert('Discount amount must be less than total amount');
						$('#OrderItemDiscount_'+parentDiv).val('');
						curentElemGemsDiscount = '0.00';
					}
					var currentElemGemsGrandTotal =  (parseFloat(gemsItemTotalAmt) - parseFloat(curentElemGemsDiscount));
					$('#OrderItemGrandTotal_'+parentDiv).val(currentElemGemsGrandTotal.toFixed(2));
				}
			}
			var orderTotalAmt = 0;
			$('.clone-div .grand_total').each(function() { 
				var grandTotal = $(this).val();
				if ($.isNumeric(grandTotal)) { 
					orderTotalAmt += parseFloat(grandTotal);
				}
			});
			$('#OrderTotal').val(orderTotalAmt);
			$('#OrderGrandTotal').val(orderTotalAmt);
		});
		
		//calculate the grand total after discount amount
		$('#OrderDiscount').keyup(function(){
			var orderTotalAmount = $('#OrderTotal').val();
			var orderDiscount = $(this).val();
			if (orderDiscount == '') {
				orderDiscount = '0.00';
			}
			if (parseFloat(orderDiscount) > parseFloat(orderTotalAmount)) {
				alert('Order discount amount must be less than order total amount');
				$('#OrderDiscount').val('');
				orderDiscount = '0.00';
			}
			var orderGrandTotal =  (parseFloat(orderTotalAmount) - parseFloat(orderDiscount));
			if ($.isNumeric(orderGrandTotal)) { 
				$('#OrderGrandTotal').val(orderGrandTotal.toFixed(2));
			}
		});

		
		
		var category = JSON.parse('<?php echo $categoryJson; ?>');

	    $('.add-more').click(function (e) {
            e.preventDefault();
			var cloneVal = $('.clone-div').length;
			var allOptions = '';
			$.each(category, function(key, value) {
				allOptions+= '<option value="'+ key +'">'+ value +'</option>';
			});

			var t = '<div class="clone-div" id="clonedInput_' + cloneVal + '" data-count-val="'+cloneVal+'">';t +='<div class="col-md-12"><div class="form-group"><div class="col-sm-4" style="float:right;"><div class="be-radio inline"><input type="radio" checked="" class="saleType" sale-type="weight" name="type'+ cloneVal +'" data-count-val="'+ cloneVal +'" id="weight_'+ cloneVal +'"><label for="weight_'+ cloneVal +'">By Weight</label></div><div class="be-radio inline"><input type="radio" class="saleType" sale-type="piece" name="type'+ cloneVal +'" data-count-val="'+ cloneVal +'" id="piece_'+ cloneVal +'"><label for="piece_'+ cloneVal +'">By Piece</label></div><div class="be-radio inline"><input type="radio" class="saleType" sale-type="gems" name="type'+ cloneVal +'" data-count-val="'+ cloneVal +'" id="gems_'+ cloneVal +'"><label for="gems_'+ cloneVal +'">Gems</label></div></div></div></div>',t +='<hr style="border: 1px dotted gainsboro;">',t += '<div class="row xs-pt-12"><div class="form-group col-sm-6"><label>Category</label><div class="input select"><select name="data[OrderItem]['+ cloneVal +'][category_id]" placeholder="Enter category" required="required" class="form-control input-sm" id="OrderItemCategoryId_' + cloneVal + '"><option value="">---Select---</option>'+allOptions+'</select></div></div>',t += '<div class="form-group col-sm-6"><label>Item</label><div class="input text required"><input name="data[OrderItem]['+ cloneVal +'][name]" placeholder="Enter Item" required="required" class="form-control input-sm itemName" maxlength="100" id="OrderItemName_' + cloneVal + '" type="text"></div></div></div>',t += '<div id="rateMakingFields_' + cloneVal + '" class="row xs-pt-12 extra_fields_'+ cloneVal +'"><div class="form-group col-sm-6"><label>Rate</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][rate]" placeholder="Enter Rate" required="required" class="form-control input-sm per-weight-field allowOnlyNumber" maxlength="100" id="OrderItemRate_' + cloneVal + '" type="text"></div></div><div class="form-group col-sm-6"><label>Making Charge</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][making_charge]" placeholder="Enter Making Charge" required="required" class="form-control input-sm per-weight-field allowOnlyNumber" maxlength="5" id="OrderItemMakingCharge_' + cloneVal + '" type="text"></div></div></div>',t += '<div id="weightPurityFields_' + cloneVal + '" class="row xs-pt-12 extra_fields_'+ cloneVal +'"><div class="form-group col-sm-6"><label>Weight</label><div class="input text required"><input name="data[OrderItem]['+ cloneVal +'][weight]" placeholder="Enter Weight" required="required" class="form-control input-sm per-weight-field item-weight allowOnlyNumber" maxlength="250" id="OrderItemWeight_' + cloneVal + '" type="text"></div></div><div class="form-group col-sm-6"><label>Purity</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][purity]" placeholder="Enter Purity" class="form-control input-sm per-weight-field allowOnlyNumber" maxlength="20" id="OrderItemPurity_' + cloneVal + '" type="text"></div></div></div>',t +='<div class="row xs-pt-12 gems_fields_'+cloneVal+'" id="gemsField_'+cloneVal+'" style="display:none;"><div class="form-group col-sm-3"><label>Gems Name</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][gems_name]" id="GemsName_'+ cloneVal +'" placeholder="Enter Gems Name" class="form-control input-sm" type="text"></div></div><div class="form-group col-sm-3"><label>Gems Rate</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][gems_rate]" id="GemsRate_'+ cloneVal +'" placeholder="Enter Gems Rate" class="form-control input-sm allowOnlyNumber per-weight-field" type="text"></div></div><div class="form-group col-sm-3"><label>Gems Weight</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][gems_weight]" id="GemsWeight_'+ cloneVal +'" placeholder="Enter Gems Weight" class="form-control input-sm allowOnlyNumber per-weight-field" type="text"></div></div><div class="form-group col-sm-3"><label>Gems Price</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][gems_weight]" id="GemsPrice_'+ cloneVal +'" placeholder="Enter Gems Price" readonly="readonly" class="form-control input-sm allowOnlyNumber per-weight-field" type="text"></div></div></div>',t += '<div class="row xs-pt-12"><div class="form-group col-sm-6"><label>Total</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][total]" placeholder="Total" required="required" readonly="readonly" class="form-control input-sm allowOnlyNumber itemTotal" maxlength="200" id="OrderItemTotal_' + cloneVal + '" type="text"></div></div><div class="form-group col-sm-6"><label>Discount</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][discount]" placeholder="Enter Discount" class="form-control input-sm allowOnlyNumber per-weight-field" maxlength="4" id="OrderItemDiscount_' + cloneVal + '" type="text"></div></div></div>',t += '<div class="row xs-pt-12"><div class="form-group col-sm-6"><label>Comments</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][comments]" placeholder="Enter Comments" class="form-control input-sm" id="OrderItemComments_' + cloneVal + '" type="text"></div></div><div class="form-group col-sm-6"><label>Grand Total</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][grand_total]" placeholder="Grand Total" readonly="readonly" required="required" class="form-control input-sm allowOnlyNumber grand_total" maxlength="200" id="OrderItemGrandTotal_' + cloneVal + '" type="text"></div></div></div><br>',t += '<div class="clone-remove" style="padding: 5px;"><button type="button" id="removeDiv' + cloneVal + '" class="btn btn-warning btn-xs remove pull-right">Remove</button></div><hr style="border-color:#4285f4;border-width:2px;">',t += '</div>',
			$("div#clonedInput_0").append(t);
        });

        $('body').on('click', '.remove', function() {
		    $(this).parent().closest("div.clone-div").remove();
	    });
	});
</script>