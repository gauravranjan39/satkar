<div class="be-content">
    <div class="main-content container-fluid">
	<?php echo $this->Session->flash(); ?>
        <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
            <?php //pr($this->request->data); ?>
            <div class="panel-body">
            <?php echo $this->Form->create('Customer',array('url'=> array('controller' => 'customers', 'action' => 'edit'),'method'=>'POST')); ?>
			<?php echo $this->Form->input('id');?>
				<div class="form-group xs-pt-10">
				<label>Name</label>
				<?php echo $this->Form->input("Customer.name",array('placeholder'=>'Enter Name','required'=>'required','class'=>'form-control input-sm speechText','label'=>false));?>
				</div>
				<div class="form-group">
					<label>Address</label>
					<?php echo $this->Form->input("Customer.address",array('type'=>'text','placeholder'=>'Enter Address','required'=>'required','class'=>'form-control input-sm speechText','label'=>false));?>
				</div>
				<div class="form-group">
					<label>Mobile</label>
					<?php echo $this->Form->input("Customer.mobile",array('type'=>'text','max'=>10,'placeholder'=>'Enter Mobile Number','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
					<span style="color:red;" id="customerMobileAjaxMsg"></span>
				</div>

                <?php //pr($this->request->data[0]['c2']['name']); ?>

                <!-- <div class="row xs-pt-12 extra_fields_0" id="rateMakingFields_0">
                    <div class="form-group col-sm-6">
                        <label>Reference</label>
                        <div class="input-group">
                            <div class="input-group-btn search-panel">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="height:37px;">
                                    <span id="search_concept">Mobile</span> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#mobile">Mobile</a></li>
                                    <li><a href="#name">Name</a></li>
                                </ul>
                            </div>
                            <input type="hidden" name="search_param" value="mobile" id="search_param">
                            <?php //echo $this->Form->input("Customer.referenceBy",array('type'=>'text','div'=>false,'maxlength'=>10,'placeholder'=>'Search','class'=>'form-control input-sm allowOnlyNumber','autocomplete'=>'off','label'=>false));?>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default search_reference" style="height:37px;"><i class="icon mdi mdi-search"></i></button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Refered By</label>
                        <?php //echo $this->Form->input("Customer.reference_id",array('type'=>'select','options'=>array($this->request->data[0]['c2']['name']),'class'=>'form-control input-sm','label'=>false));?>
                    </div>
                </div> -->


				<div class="form-group">
					<label>Email</label>
					<?php echo $this->Form->input("Customer.email",array('type'=>'email','placeholder'=>'Enter Email','class'=>'form-control input-sm','label'=>false));?>
					<span style="color:red;" id="customerEmailAjaxMsg"></span>
				</div>
                <div class="row xs-pt-15">
                    <div class="col-xs-6">
                    <?php echo $this->Form->button('Submit',array('class'=>'btn btn-space btn-primary','id'=>'customerEditRegister','type'=>'submit'));?>
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
<script type="text/javascript">
      $(document).ready(function() {
		$('#CustomerEmail').keyup(function() {
            var customerEmail = $(this).val();
            var customerId = $('#CustomerId').val();
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            if (customerEmail != '') {
                if(pattern.test(customerEmail)) {
                    $.ajax({
                        type: "POST",
                        url:"<?php echo Router::url(array('controller'=>'customers','action'=>'check_email_unique'));?>",
                        data:({get_customerEmail:customerEmail,get_customerId:customerId}),
                        success: function(data) {
                            if(data==0) {
                                $("#customerEmailAjaxMsg").text(customerEmail+" already exists");
                                $("#customerEmailAjaxMsg").show();
                                $("#customerEditRegister").attr('disabled','disabled');
                            } else {
                                $("#customerEmailAjaxMsg").hide();
                                $("#customerEditRegister").removeAttr('disabled');
                            }
                        }
                    });
                } else {
                    $("#customerEmailAjaxMsg").show();
                    $("#customerEmailAjaxMsg").text("Please enter valid email address!");
                    $("#customerEditRegister").attr('disabled','disabled');
                }
            } else {
                $("#customerEmailAjaxMsg").hide();
                $("#customerEditRegister").removeAttr('disabled');
            }
        });

        $('#CustomerMobile').keydown(function(e) {
            if (e.which>=96 && e.which<=105) {
                return true;
            } else if (e.shiftKey || e.ctrlKey || e.altKey) {
                e.preventDefault();
            } else {
                var regex = /^[0-9._]+|[\b]+$/;
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
            }
            e.preventDefault();
            return false;
        });

        $('#CustomerMobile').keyup(function(e) {
            if($(this).val().length < 10) {
                $("#customerMobileAjaxMsg").show();
                $("#customerMobileAjaxMsg").text("Mobile Number must be of 10 digit");
                $("#customerEditRegister").attr('disabled','disabled');
            } else {
				var customerMobile = $(this).val();
                var customerId = $('#CustomerId').val();
				$.ajax({
                    type: "POST",
                    url:"<?php echo Router::url(array('controller'=>'customers','action'=>'check_unique_mobile'));?>",
                    data:({get_customerMobile:customerMobile,get_customerId:customerId}),
                    success: function(data) {
                        if(data==0) {
                            $("#customerMobileAjaxMsg").text("This number is already registerd!");
                            $("#customerMobileAjaxMsg").show();
                            $("#customerEditRegister").attr('disabled','disabled');
                        } else {
                            $("#customerMobileAjaxMsg").hide();
                            $("#customerEditRegister").removeAttr('disabled');
                        }
                    }
                });
            }
        });

      });
      
</script>