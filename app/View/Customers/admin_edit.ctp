<div class="be-content">
    <div class="main-content container-fluid">
	<?php echo $this->Session->flash(); ?>
        <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
            <?php //pr($this->request->data); ?>
            <div class="panel-body">
            <?php echo $this->Form->create('Customer',array('url'=> array('controller' => 'Customers', 'action' => 'admin_edit'),'method'=>'POST')); ?>
			<?php echo $this->Form->input('id');?>
				<div class="form-group xs-pt-10">
				<label>Name</label>
				<?php echo $this->Form->input("Customer.name",array('placeholder'=>'Enter Name','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
				</div>
				<div class="form-group">
					<label>Address</label>
					<?php echo $this->Form->input("Customer.address",array('type'=>'text','placeholder'=>'Enter Address','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
				</div>
				<div class="form-group">
					<label>Mobile</label>
					<?php echo $this->Form->input("Customer.mobile",array('type'=>'text','max'=>10,'placeholder'=>'Enter Mobile Number','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
					<span style="color:red;" id="customerMobileAjaxMsg"></span>
				</div>

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
		$('#CustomerEmail').blur(function() {
            var customerEmail = $(this).val();
			var customerId = $('#CustomerId').val();
            $.ajax({
                type: "POST",
                url:"<?php echo Router::url(array('controller'=>'customers','action'=>'admin_check_email_unique'));?>",
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

        $('#CustomerMobile').keypress(function(e) {
            if($(this).val().length < 10) {
                $("#customerMobileAjaxMsg").show();
                $("#customerMobileAjaxMsg").text("Mobile Number must be of 10 digit");
                $("#registerCustomer").attr('disabled','disabled');
            } else {
				var customerMobile = $(this).val();
				$.ajax({
                    type: "POST",
                    url:"<?php echo Router::url(array('controller'=>'customers','action'=>'admin_check_unique_mobile'));?>",
                    data:({data:customerMobile}),
                    success: function(data) {
                        if(data==0) {
                            $("#customerMobileAjaxMsg").text("This number is already registerd!");
                            $("#customerMobileAjaxMsg").show();
                            $("#registerCustomer").attr('disabled','disabled');
                        } else {
                            $("#customerMobileAjaxMsg").hide();
                            $("#registerCustomer").removeAttr('disabled');
                        }
                    }
                });
            }
        });

      });
      
</script>