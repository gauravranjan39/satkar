<div class="be-content">
    <div class="main-content container-fluid">
    <?php echo $this->Session->flash(); ?>
        <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-body">
            <?php echo $this->Form->create('Supplier',array('url'=> array('controller' => 'Suppliers', 'action' => 'add'),'method'=>'POST')); ?>
                <div class="form-group xs-pt-10">
                    <label>Name</label>
                    <?php echo $this->Form->input("Supplier.name",array('placeholder'=>'Enter Name','required'=>'required','class'=>'form-control','label'=>false));?>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <?php echo $this->Form->input("Supplier.address",array('type'=>'text','placeholder'=>'Enter Address','required'=>'required','class'=>'form-control','label'=>false));?>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <?php echo $this->Form->input("Supplier.mobile",array('type'=>'text','max'=>10,'placeholder'=>'Enter Mobile Number','required'=>'required','class'=>'form-control','label'=>false));?>
                    <span style="color:red;" id="supplierMobileAjaxMsg"></span>
                </div>
				<div class="form-group">
                    <label>Email</label>
                    <?php echo $this->Form->input("Supplier.email",array('type'=>'email','placeholder'=>'Enter Email','class'=>'form-control','label'=>false));?>
					<span style="color:red;" id="supplierEmailAjaxMsg"></span>
				</div>
                <div class="form-group">
                    <label>Trade Name</label>
                    <?php echo $this->Form->input("Supplier.trade_name",array('type'=>'text','placeholder'=>'Enter Email','class'=>'form-control','label'=>false));?>
				</div>
                <div class="row xs-pt-15">
                    <div class="col-xs-6">
                    <?php echo $this->Form->button('Submit',array('class'=>'btn btn-space btn-primary','id'=>'registerSupplier','type'=>'submit'));?>
					<?php echo $this->Html->link('cancel', array('controller' => 'suppliers','action' => 'index'),array('class'=>'btn btn-space btn-default'));?>                    </div>
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
      	$('#SupplierEmail').blur(function() {
            var supplierEmail = $(this).val();
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            if (supplierEmail != '') {
                if(pattern.test(supplierEmail)) {
                    $.ajax({
                        type: "POST",
                        url:"<?php echo Router::url(array('controller'=>'Suppliers','action'=>'check_email_unique'));?>",
                        data:({data:supplierEmail}),
                        success: function(data) {
                            if(data==0) {
                                $("#supplierEmailAjaxMsg").text(supplierEmail+" already exists");
                                $("#supplierEmailAjaxMsg").show();
                                $("#registerSupplier").attr('disabled','disabled');
                            } else {
                                $("#supplierEmailAjaxMsg").hide();
                                $("#registerSupplier").removeAttr('disabled');
                            }
                        }
                    });
                } else {
                    $("#supplierEmailAjaxMsg").show();
                    $("#supplierEmailAjaxMsg").text("Please enter valid email address!");
                    $("#registerSupplier").removeAttr('disabled');
                }
        } else {
            $("#supplierEmailAjaxMsg").hide();
            $("#registerSupplier").removeAttr('disabled');
        }
        });

        $('#SupplierMobile').keydown(function(e) {
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

        $('#SupplierMobile').blur(function(e) {
            if($(this).val().length < 10) {
                $("#supplierMobileAjaxMsg").show();
                $("#supplierMobileAjaxMsg").text("Mobile Number must be of 10 digit");
                $("#registerSupplier").attr('disabled','disabled');
            } else {
                var supplierMobile = $(this).val();
				$.ajax({
                    type: "POST",
                    url:"<?php echo Router::url(array('controller'=>'suppliers','action'=>'check_unique_mobile'));?>",
                    data:({data:supplierMobile}),
                    success: function(data) {
                        if(data==0) {
                            $("#supplierMobileAjaxMsg").text("This number is already registerd!");
                            $("#supplierMobileAjaxMsg").show();
                            $("#registerSupplier").attr('disabled','disabled');
                        } else {
                            $("#supplierMobileAjaxMsg").hide();
                            $("#registerSupplier").removeAttr('disabled');
                        }
                    }
                });
            }
        });
        
      });
      
</script>