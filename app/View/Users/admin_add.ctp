<div class="be-content">
    <div class="main-content container-fluid">
    <?php echo $this->Session->flash(); ?>
        <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-body">
            <?php echo $this->Form->create('User',array('url'=> array('controller' => 'Users', 'action' => 'admin_add'),'method'=>'POST')); ?>
                <div class="form-group xs-pt-10">
                    <label>Name</label>
                    <?php echo $this->Form->input("User.name",array('placeholder'=>'Enter Name','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                </div>
                <div class="form-group">
                    <label>UserName</label>
                    <?php echo $this->Form->input("User.username",array('type'=>'text','placeholder'=>'Enter username','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <?php echo $this->Form->input("User.address",array('type'=>'text','placeholder'=>'Enter Address','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <?php echo $this->Form->input("User.mobile",array('type'=>'text','max'=>10,'placeholder'=>'Enter Mobile Number','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    <span style="color:red;" id="userMobileAjaxMsg"></span>
                </div>
				<div class="form-group">
                    <label>Email</label>
                    <?php echo $this->Form->input("User.email",array('type'=>'email','placeholder'=>'Enter Email','class'=>'form-control input-sm','label'=>false));?>
					<span style="color:red;" id="userEmailAjaxMsg"></span>
				</div>
                <div class="form-group">
                    <label>Type</label>
                    <?php echo $this->Form->input("User.type",array('class'=>'form-control input-sm','options'=>array('admin'=>'Admin','user'=>'User'),'label'=>false));?>
				</div>
                <div class="row xs-pt-15">
                    <div class="col-xs-6">
                    <?php echo $this->Form->button('Submit',array('class'=>'btn btn-space btn-primary','id'=>'registerUser','type'=>'submit'));?>
					<?php echo $this->Form->button('cancel', array('class'=>'btn btn-space btn-default','div'=>false,'label'=>false,'onclick'=>"window.location.href = '../Users/index'"));?> 
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
        
        $('#UserEmail').keyup(function() {
            var userEmail = $(this).val();
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            if (userEmail != '') {
                if(pattern.test(userEmail)) {
                    $.ajax({
                        type: "POST",
                        url:"<?php echo Router::url(array('controller'=>'Users','action'=>'admin_check_email_unique'));?>",
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
                } else {
                    $("#userEmailAjaxMsg").show();
                    $("#userEmailAjaxMsg").text("Please enter valid email address!");
                    $("#registerUser").attr('disabled','disabled');
                }
            } else {
                $("#userEmailAjaxMsg").hide();
                $("#registerUser").removeAttr('disabled');
            }
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

        $('#UserMobile').keyup(function(e) {
            if($(this).val().length < 10) {
                $("#userMobileAjaxMsg").show();
                $("#userMobileAjaxMsg").text("Mobile Number must be of 10 digit");
                $("#registerUser").attr('disabled','disabled');
            } else {
				var userMobile = $(this).val();
				$.ajax({
                    type: "POST",
                    url:"<?php echo Router::url(array('controller'=>'Users','action'=>'admin_check_unique_mobile'));?>",
                    data:({data:userMobile}),
                    success: function(data) {
                        if(data==0) {
                            $("#userMobileAjaxMsg").text("This number is already registerd!");
                            $("#userMobileAjaxMsg").show();
                            $("#registerUser").attr('disabled','disabled');
                        } else {
                            $("#userMobileAjaxMsg").hide();
                            $("#registerUser").removeAttr('disabled');
                        }
                    }
                });
            }
        });


      });
      
</script>