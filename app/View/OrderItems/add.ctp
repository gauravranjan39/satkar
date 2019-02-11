<style>
.switch {
    display: inline-block;
    height: 22px;
    position: relative;
    width: 52px;
	float:right;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider::before {
    background-color: white;
    bottom: 4px;
    content: "";
    height: 16px;
    left: 4px;
    position: absolute;
    transition: all 0.4s ease 0s;
    width: 16px;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="be-content">
    <div class="main-content container-fluid">
	    <?php echo $this->Session->flash(); ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                    <div class="panel-body">
                        <?php echo $this->Form->create('Order',array('url'=> array('controller' => 'OrderItems', 'action' => 'add'),'method'=>'POST')); ?>
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

								<div class="row xs-pt-12 gems_fields" style="display:none;">
									<div class="form-group col-sm-3">
										<label>Gems Name</label>
										<?php echo $this->Form->input("OrderItem.weight",array('name'=>'data[OrderItem][0][weight]','id'=>'OrderItemWeight_0','placeholder'=>'Enter Gems Name','required'=>'required','class'=>'form-control input-sm per-weight-field item-weight','label'=>false));?>
									</div>

									<div class="form-group col-sm-3">
										<label>Gems Rate</label>
										<?php echo $this->Form->input("OrderItem.purity",array('name'=>'data[OrderItem][0][purity]','id'=>'OrderItemPurity_0','placeholder'=>'Gems Rate','class'=>'form-control input-sm per-weight-field allowOnlyNumber','label'=>false));?>
									</div>
									<div class="form-group col-sm-3">
										<label>Gems Weight</label>
										<?php echo $this->Form->input("OrderItem.purity",array('name'=>'data[OrderItem][0][purity]','id'=>'OrderItemPurity_0','placeholder'=>'Gems Weight','class'=>'form-control input-sm per-weight-field allowOnlyNumber','label'=>false));?>
									</div>
									<div class="form-group col-sm-3">
										<label>Gems Price</label>
										<?php echo $this->Form->input("OrderItem.purity",array('name'=>'data[OrderItem][0][purity]','id'=>'OrderItemPurity_0','placeholder'=>'Gems Price','class'=>'form-control input-sm per-weight-field allowOnlyNumber','label'=>false));?>
									</div>

								</div>

								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Total</label>
										<?php echo $this->Form->input("OrderItem.total",array('name'=>'data[OrderItem][0][total]','id'=>'OrderItemTotal_0','placeholder'=>'Total','required'=>'required','readonly' => true,'class'=>'form-control input-sm allowOnlyNumber','label'=>false));?>
									</div>
									<div class="form-group col-sm-6">
										<label>Discount</label>
										<?php echo $this->Form->input("OrderItem.discount",array('name'=>'data[OrderItem][0][discount]','id'=>'OrderItemDiscount_0','placeholder'=>'Enter Discount','class'=>'form-control input-sm allowOnlyNumber','label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Comments</label>
										<?php echo $this->Form->input("OrderItem.comments",array('name'=>'data[OrderItem][0][comments]','id'=>'OrderItemComments_0','type'=>'text','placeholder'=>'Enter Comments','class'=>'form-control input-sm','label'=>false));?>
									</div>
									<div class="form-group col-sm-6">
										<label>Grand Total</label>
										<?php echo $this->Form->input("OrderItem.grand_total",array('name'=>'data[OrderItem][0][grand_total]','id'=>'OrderItemGrandTotal_0','placeholder'=>'Grand Total','required'=>'required','class'=>'form-control input-sm allowOnlyNumber','label'=>false));?>
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
									<?php echo $this->Form->input("Order.total",array('placeholder'=>'Total','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm allowOnlyNumber','label'=>false));?>
								</div>
							</div>

							<div class="row xs-pt-12">
								<div class="form-group col-sm-6"></div>
								<div class="form-group col-sm-6">
									<label>Discount</label>
									<?php echo $this->Form->input("Order.discount",array('placeholder'=>'Discount','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm allowOnlyNumber','label'=>false));?>
								</div>
							</div>

							<div class="row xs-pt-12">
								<div class="form-group col-sm-6"></div>
								<div class="form-group col-sm-6">
									<label>Grand Total</label>
									<?php echo $this->Form->input("Order.grand_total",array('placeholder'=>'Grand Total','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm allowOnlyNumber','label'=>false));?>
								</div>
							</div>

							<div class="row xs-pt-12">
								<div class="form-group col-sm-6"></div>
								<div class="form-group col-sm-6">
									<label>Payment</label>
									<?php echo $this->Form->input("OrderTransaction.amount_paid",array('placeholder'=>'Payment','required'=>'required','autocomplete'=>'off','class'=>'form-control input-sm allowOnlyNumber','label'=>false));?>
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

		$('.saleType').click(function(){
			var saleType = $(this).attr('sale-type');
			if (saleType == 'gems') {
				$('.gems_fields').show();
				$('.extra_fields').show();
			} else if(saleType == 'piece') {
				$('.gems_fields').hide();
				$('.extra_fields').hide();
			} else if(saleType == 'weight') { 
				$('.extra_fields').show();
				$('.gems_fields').hide();
			}
		});

		$(".allowOnlyNumber").keypress(function(evt){
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;
		});

		$('#OrderItemRate_0').blur(function(){
			var test = $(this).parents().find('.clone-div').attr('data-count-val');
			alert(test);
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

		$('body').on('keyup','.item-weight',function(){
			//alert($(this).parent().parent().html());
			var ref = $(this);
			var rate = ref.parent().parent().parent().parent().find("input.rate").val();
			var mkCharge = ref.parent().parent().parent().parent().find("input.mkCharge").val();
			//var weight = ref.parent().parent().parent().parent().find("input.weight").val();
			var weight = ref.val();
			var refAmount = ref.parent().parent().parent().parent().find("input.amount");
			if ((weight != '' || weight != null)) {
				$.ajax({
					url:'<?php echo configure::read('BASE_URL')?>customers/calculate_item_amount',
					data:{'rate':rate,'mkCharge':mkCharge,'weight':weight},
					success:function(data){
						if (data) {
							refAmount.val(data);
						}
					}
				});
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

			var t = '<div class="clone-div" id="clonedInput_' + cloneVal + '" data-count-val="'+cloneVal+'">';t +='<div class="col-md-12"><div class="form-group"><div class="col-sm-4" style="float:right;"><div class="be-radio inline"><input type="radio" checked="" class="saleType" sale-type="weight" name="type'+ cloneVal +'" data-count-val="'+ cloneVal +'" id="weight_'+ cloneVal +'"><label for="weight_'+ cloneVal +'">By Weight</label></div><div class="be-radio inline"><input type="radio" class="saleType" sale-type="piece" name="type'+ cloneVal +'" data-count-val="'+ cloneVal +'" id="piece_'+ cloneVal +'"><label for="piece_'+ cloneVal +'">By Piece</label></div><div class="be-radio inline"><input type="radio" class="saleType" sale-type="gems" name="type'+ cloneVal +'" data-count-val="'+ cloneVal +'" id="gems_'+ cloneVal +'"><label for="gems_'+ cloneVal +'">Gems</label></div></div></div></div>',t +='<hr style="border: 1px dotted gainsboro;">',t += '<div class="row xs-pt-12"><div class="form-group col-sm-6"><label>Category</label><div class="input select"><select name="data[OrderItem]['+ cloneVal +'][category_id]" placeholder="Enter category" required="required" class="form-control input-sm" id="OrderItemCategoryId_' + cloneVal + '"><option value="">---Select---</option>'+allOptions+'</select></div></div>',t += '<div class="form-group col-sm-6"><label>Item</label><div class="input text required"><input name="data[OrderItem]['+ cloneVal +'][name]" placeholder="Enter Item" required="required" class="form-control input-sm itemName" maxlength="100" id="OrderItemName_' + cloneVal + '" type="text"></div></div></div>',t += '<div id="rateMakingFields_' + cloneVal + '" class="row xs-pt-12 extra_fields_'+ cloneVal +'"><div class="form-group col-sm-6"><label>Rate</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][rate]" placeholder="Enter Rate" required="required" class="form-control input-sm per-weight-field allowOnlyNumber" maxlength="100" id="OrderItemRate_' + cloneVal + '" type="text"></div></div><div class="form-group col-sm-6"><label>Making Charge</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][making_charge]" placeholder="Enter Making Charge" required="required" class="form-control input-sm per-weight-field allowOnlyNumber" maxlength="5" id="OrderItemMakingCharge_' + cloneVal + '" type="text"></div></div></div>',t += '<div id="weightPurityFields_' + cloneVal + '" class="row xs-pt-12 extra_fields_'+ cloneVal +'"><div class="form-group col-sm-6"><label>Weight</label><div class="input text required"><input name="data[OrderItem]['+ cloneVal +'][weight]" placeholder="Enter Weight" required="required" class="form-control input-sm per-weight-field item-weight allowOnlyNumber" maxlength="250" id="OrderItemWeight_' + cloneVal + '" type="text"></div></div><div class="form-group col-sm-6"><label>Purity</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][purity]" placeholder="Enter Purity" class="form-control input-sm per-weight-field allowOnlyNumber" maxlength="20" id="OrderItemPurity_' + cloneVal + '" type="text"></div></div></div>',t += '<div class="row xs-pt-12"><div class="form-group col-sm-6"><label>Total</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][total]" placeholder="Total" required="required" class="form-control input-sm allowOnlyNumber" maxlength="200" id="OrderItemTotal_' + cloneVal + '" type="text"></div></div><div class="form-group col-sm-6"><label>Discount</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][discount]" placeholder="Enter Discount" class="form-control input-sm allowOnlyNumber" maxlength="200" id="OrderItemDiscount_' + cloneVal + '" type="text"></div></div></div>',t += '<div class="row xs-pt-12"><div class="form-group col-sm-6"><label>Comments</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][comments]" placeholder="Enter Comments" class="form-control input-sm" id="OrderItemComments_' + cloneVal + '" type="text"></div></div><div class="form-group col-sm-6"><label>Grand Total</label><div class="input text"><input name="data[OrderItem]['+ cloneVal +'][grand_total]" placeholder="Grand Total" required="required" class="form-control input-sm allowOnlyNumber" maxlength="200" id="OrderItemGrandTotal_' + cloneVal + '" type="text"></div></div></div><br>',t += '<div class="clone-remove" style="padding: 5px;"><button type="button" id="removeDiv' + cloneVal + '" class="btn btn-warning btn-xs remove pull-right">Remove</button></div><hr style="border-color:#4285f4;border-width:2px;">',t += '</div>',
			$("div#clonedInput_0").append(t);
        });

        $('body').on('click', '.remove', function() {
		    $(this).parent().closest("div.clone-div").remove();
	    });
	});
</script>