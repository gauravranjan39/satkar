<div class="be-content">
    <div class="main-content container-fluid">
    <?php echo $this->Session->flash(); ?>
        <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-body">
            <?php echo $this->Form->create('Category',array('url'=> array('controller' => 'categories', 'action' => 'add'),'method'=>'POST')); ?>
                <div class="form-group xs-pt-10">
                    <label>Parent Category</label>
                    <?php echo $this->Form->input('Category.parent_id',array('class'=>'form-control','label'=>false)); ?>
                    <?php //echo $this->Form->input("Category.parent_id",array('placeholder'=>'Enter Name','required'=>'required','class'=>'form-control','label'=>false));?>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <?php echo $this->Form->input("Category.name",array('type'=>'text','placeholder'=>'Enter Category Name','required'=>'required','class'=>'form-control','label'=>false));?>
                </div>
                
                <div class="row xs-pt-15">
                    <div class="col-xs-6">
                    <?php echo $this->Form->button('Submit',array('class'=>'btn btn-space btn-primary','id'=>'registerSupplier','type'=>'submit'));?>
					<?php echo $this->Html->link('cancel', array('controller' => 'categories','action' => 'index'),array('class'=>'btn btn-space btn-default',));?> 
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
      	$('#SupplierEmail').blur(function() {
            var userEmail = $(this).val();
            $.ajax({
                type: "POST",
                url:"<?php echo Router::url(array('controller'=>'Suppliers','action'=>'check_email_unique'));?>",
                data:({data:userEmail}),
                success: function(data) {
                    if(data==0) {
                        $("#supplierEmailAjaxMsg").text(userEmail+" already exists");
                        $("#supplierEmailAjaxMsg").show();
                        $("#registerSupplier").attr('disabled','disabled');
                    } else {
                        $("#supplierEmailAjaxMsg").hide();
                        $("#registerSupplier").removeAttr('disabled');
                    }
                }
            });
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
                $("#supplierMobileAjaxMsg").text("Mobile Number must be of 10 digit");
                $("#registerSupplier").attr('disabled','disabled');
            } else {
                $("#supplierMobileAjaxMsg").hide();
                $("#registerSupplier").removeAttr('disabled');
            }
        });
        
      });
      
</script>