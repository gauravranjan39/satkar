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
                            <div class="clone-div clonedInput" id="clonedInput">
							
								<div class="col-md-12">
									<label class="switch">
										<input type="checkbox" class="hideSomeField" checked>
										<span class="slider round"></span>
									</label>
								</div>
								<?php $i=1; ?>
								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Category</label>
										<?php echo $this->Form->input("OrderItem.category_id",array('name'=>'data[OrderItem]['.$i.'][category_id]','type'=>'select','options'=>$categoryLists,'empty'=>'---Select---','placeholder'=>'Enter category','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>

									<div class="form-group col-sm-6">
										<label>Item</label>
										<?php echo $this->Form->input("OrderItem.name",array('name'=>'data[OrderItem][][name]','placeholder'=>'Enter Item','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Rate</label>
										<?php echo $this->Form->input("OrderItem.rate",array('name'=>'data[OrderItem][][rate]','placeholder'=>'Enter Rate','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>

									<div class="form-group col-sm-6">
										<label>Weight</label>
										<?php echo $this->Form->input("OrderItem.weight",array('name'=>'data[OrderItem][][weight]','placeholder'=>'Enter Weight','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Making Charge</label>
										<?php echo $this->Form->input("OrderItem.making_charge",array('name'=>'data[OrderItem][][making_charge]','placeholder'=>'Enter Making Charge','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>

									<div class="form-group col-sm-6">
										<label>Purity</label>
										<?php echo $this->Form->input("OrderItem.purity",array('name'=>'data[OrderItem][][purity]','placeholder'=>'Enter Purity','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Total</label>
										<?php echo $this->Form->input("OrderItem.total",array('name'=>'data[OrderItem][][total]','placeholder'=>'Total','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>
									<div class="form-group col-sm-6">
										<label>Discount</label>
										<?php echo $this->Form->input("OrderItem.discount",array('name'=>'data[OrderItem][][discount]','placeholder'=>'Enter Discount','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>
								</div>

								<div class="row xs-pt-12">
									<div class="form-group col-sm-6">
										<label>Comments</label>
										<?php echo $this->Form->input("OrderItem.comments",array('name'=>'data[OrderItem][][comments]','type'=>'text','placeholder'=>'Enter Comments','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>
									<div class="form-group col-sm-6">
										<label>Grand Total</label>
										<?php echo $this->Form->input("OrderItem.grand_total",array('name'=>'data[OrderItem][][grand_total]','placeholder'=>'Grand Total','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
									</div>
								</div>
								<br/>

								<div class="clone-remove" style="padding: 5px;">
									<button type="button" class="btn btn-warning btn-xs remove pull-right" style="display: none;">Remove</button>
								</div>
								
								<hr style="border-color:black;">
							</div> 
							

							<button type="button" class="btn btn-primary btn-xs add-more">Add More</button>
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

		$('body').on('change','.hideSomeField',function(){
			if ($(this).prop("checked") == true) {
				$(this).parents("div").next("div .extra_fields").show();
			} else {
				$(this).parents("div").next("div .extra_fields").hide();
			}
		});
		

	    $('.add-more').click(function (e) {
            e.preventDefault();

			// var regex = /^(.+?)(\d+)$/i;
			// var cloneIndex = $(".clonedInput").length;
			
		

			// $('.clone-div:last').clone()
			// .insertAfter(".clonedInput:last")
			// .attr("id", "clonedInput" +  cloneIndex)
			// .find("*")
			// .each(function() {
			// 	var id = this.id || "";
			// 	var match = id.match(regex) || [];
			// 	if (match.length == 3) {
			// 		this.id = match[1] + (cloneIndex);
			// 	}
        	// })



            var cloneDiv = $('.clone-div:last').clone().insertAfter(".clone-div:last");
            cloneDiv.find('input').val("");
			
			var cloneVal = $('.clone-div').length;
	
            cloneDiv.find('div.clone-remove button.remove').css("display","block");
        });

        $('body').on('click', '.remove', function() {
		    $(this).parent().closest("div.clone-div").remove();
	    });
	});
</script>