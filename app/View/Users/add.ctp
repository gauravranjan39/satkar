<div class="be-content">
    <div class="main-content container-fluid">
    <?php echo $this->Session->flash(); ?>
        <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-body">
            <?php echo $this->Form->create('User',array('url'=> array('controller' => 'Users', 'action' => 'add'),'method'=>'POST')); ?>
                <div class="form-group xs-pt-10">
                    <label>Name</label>
                    <?php echo $this->Form->input("User.name",array('placeholder'=>'Enter Name','required'=>'required','class'=>'form-control','label'=>false));?>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <?php echo $this->Form->input("User.address",array('type'=>'text','placeholder'=>'Enter Address','required'=>'required','class'=>'form-control','label'=>false));?>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <?php echo $this->Form->input("User.mobile",array('type'=>'text','max'=>10,'placeholder'=>'Enter Mobile Number','required'=>'required','class'=>'form-control','label'=>false));?>
                </div>
				<div class="form-group">
                    <label>Email</label>
                    <?php echo $this->Form->input("User.email",array('type'=>'email','placeholder'=>'Enter Email','required'=>'required','class'=>'form-control','label'=>false));?>
					<span style="color:red;" id="userEmailAjaxMsg"></span>
				</div>
                <div class="row xs-pt-15">
                    <div class="col-xs-6">
                    <?php echo $this->Form->button('Submit',array('class'=>'btn btn-space btn-primary','id'=>'registerUser','type'=>'submit'));?>
					<?php echo $this->Form->button('cancel', array('class'=>'btn btn-space btn-default','div'=>false,'label'=>false,'onclick'=>"window.location.href = '../users/index'"));?> 
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
      	$('#UserEmail').blur(function() {
            var userEmail = $(this).val();
            $.ajax({
                type: "POST",
                url:"<?php echo Router::url(array('controller'=>'Users','action'=>'check_email_unique'));?>",
                data:({data:userEmail}),
                success: function(data) {
                    if(data==0) {
                        $("#userEmailAjaxMsg").text(userEmail+" already exists");
                        $("#userEmailAjaxMsg").show();
                        $("#registerUser").attr('disabled','disabled');
                    } else {
                        $("#userEmailAjaxMsg").hide();
                        $("#registerUser").removeAttr('disabled');
                    }
                }
            });
        });

        $('#UserMobile').keydown(function(e) {
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
      });
      
</script>