<nav class="navbar navbar-default navbar-fixed-top be-top-header">
  <div class="container-fluid">
    <div class="navbar-header">
	<?php echo $this->Html->link('',array('controller'=>'Customers','action'=>'index'),array('escape'=>false,'class'=>'navbar-brand')); ?>
		<!-- <a href="index.html" class="navbar-brand"></a> -->
	</div>
    <div class="be-right-navbar">
	<?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE) { ?>
		<div class="icon-container helbutton" style="float:left;padding:4px;cursor:pointer;" title="Speak what you want to type">
			<div class="icon"><span class="mdi mdi-mic"></span></div>
		</div>
	<?php } ?>
	
      <ul class="nav navbar-nav navbar-right be-user-nav">
        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">
		<?php echo $this->Html->image('avatar.png',array('escape'=>false)); ?>
		<span class="user-name">Túpac Amaru</span></a>
          <ul role="menu" class="dropdown-menu">
            <li>
              <div class="user-info">
			  
                <div class="user-name"><?php echo $this->Session->read('Auth.User.name'); ?></div>
                <div class="user-position online">Available</div>
              </div>
            </li>
            <li><a href="#"><span class="icon mdi mdi-face"></span> Account</a></li>
            <li><?php echo $this->Html->link('<span class="icon mdi mdi-settings"></span> Change Password','javascript:void(0);',array('escape'=>false,'id'=>'user-change-password')); ?></li>
            <li>
            <?php echo $this->Html->link('<span class="icon mdi mdi-power"></span> Logout',array('controller'=>'Users','action'=>'logout'),array('escape'=>false)); ?>
          </ul>
        </li>
      </ul>
      <!-- <div class="page-title"><span>Dashboard</span></div> -->
      <!-- <ul class="nav navbar-nav navbar-right be-icons-nav">
        <li class="dropdown"><a href="#" role="button" aria-expanded="false" class="be-toggle-right-sidebar"><span class="icon mdi mdi-settings"></span></a></li>
        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
          <ul class="dropdown-menu be-notifications">
            <li>
              <div class="title">Notifications<span class="badge">3</span></div>
              <div class="list">
                <div class="be-scroller">
                  <div class="content">
                    <ul>
                      <li class="notification notification-unread"><a href="#">
                          <div class="image"><img src="assets/img/avatar2.png" alt="Avatar"></div>
                          <div class="notification-info">
                            <div class="text"><span class="user-name">Jessica Caruso</span> accepted your invitation to join the team.</div><span class="date">2 min ago</span>
                          </div></a></li>
                      <li class="notification"><a href="#">
                          <div class="image"><img src="assets/img/avatar3.png" alt="Avatar"></div>
                          <div class="notification-info">
                            <div class="text"><span class="user-name">Joel King</span> is now following you</div><span class="date">2 days ago</span>
                          </div></a></li>
                      <li class="notification"><a href="#">
                          <div class="image"><img src="assets/img/avatar4.png" alt="Avatar"></div>
                          <div class="notification-info">
                            <div class="text"><span class="user-name">John Doe</span> is watching your main repository</div><span class="date">2 days ago</span>
                          </div></a></li>
                      <li class="notification"><a href="#">
                          <div class="image"><img src="assets/img/avatar5.png" alt="Avatar"></div>
                          <div class="notification-info"><span class="text"><span class="user-name">Emily Carter</span> is now following you</span><span class="date">5 days ago</span></div></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="footer"> <a href="#">View all notifications</a></div>
            </li>
          </ul> -->
        </li>
        <!-- <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-apps"></span></a>
          <ul class="dropdown-menu be-connections">
            <li>
              <div class="list">
                <div class="content">
                  <div class="row">
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="assets/img/github.png" alt="Github"><span>GitHub</span></a></div>
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="assets/img/bitbucket.png" alt="Bitbucket"><span>Bitbucket</span></a></div>
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="assets/img/slack.png" alt="Slack"><span>Slack</span></a></div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="assets/img/dribbble.png" alt="Dribbble"><span>Dribbble</span></a></div>
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="assets/img/mail_chimp.png" alt="Mail Chimp"><span>Mail Chimp</span></a></div>
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="assets/img/dropbox.png" alt="Dropbox"><span>Dropbox</span></a></div>
                  </div>
                </div>
              </div>
              <div class="footer"> <a href="#">More</a></div>
            </li>
          </ul>
        </li> -->
      </ul>
    </div>
  </div>
</nav>

<div class="modal animated fadeIn" id="UserChangePassword" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="line-height:1;">Change Password</h3><hr>
            </div>
            
            <div class="modal-body" >
				<div id="message_block"></div>
			
            
                <?php echo $this->Form->create('User',array('url'=> array('controller' => 'Users', 'action' => 'changePassword'),'method'=>'POST')); ?>
                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>Current Password:</b></div>
                    <div class="col-md-9"><?php echo $this->Form->input("User.current_password",array('placeholder'=>'Enter current password','type'=>'password','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm','label'=>false));?></div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>New Password:</b></div>
                    <div class="col-md-9"><?php echo $this->Form->input("User.new_password",array('placeholder'=>'Enter new password','type'=>'password','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm','label'=>false));?></div>
                </div>

                <div class="form-group col-md-12">
                    <div class="col-md-3"><b>Confirm Password:</b></div>
                    <div class="col-md-9"><?php echo $this->Form->input("User.confirm_password",array('placeholder'=>'Re-enter new password','type'=>'password','autocomplete'=>'off','required'=>'required','class'=>'form-control input-sm','label'=>false));?></div>
                </div>
                
                <div class="">
                    <div class="">
                        <div class="form-group col-md-12">
                            <?php echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-rounded btn-primary','escape'=>false));?>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end();?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$('#user-change-password').click(function(){
			$('#UserChangePasswordForm').find('.input-sm').val('');   
			$('#UserChangePassword').modal('show');
		});

		$('#UserChangePasswordForm').submit(function(event){
            event.preventDefault();
            $.ajax({
                url:"<?php echo Router::url(array('controller'=>'Users','action'=>'changePassword'));?>",
                type: 'POST',
                data: $('#UserChangePasswordForm').serialize(),
                success:function(data){
					console.log(data);
                    if (data == 0) {
						console.log('@@@@@@@@@@@');
                        $('#message_block').html('<div role="alert" class="alert alert-danger alert-dismissible"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-close-circle-o"></span>Please enter correct password</div>');
                    } else if (data == 1) {
						$('#message_block').html('<div role="alert" class="alert alert-danger alert-dismissible"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-close-circle-o"></span>New password and confirm password didnot matched !</div>');
					} else if (data == 2) {
						alert('Password change successfully.');
						$('#UserChangePassword').modal('hide');
						// $('#messgae_block').html('<div role="alert" class="alert alert-success alert-dismissible"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span><strong>Good!</strong>Password change successfully.</div>');
					} else {
                        alert('Error Occured!!');
                    }
                }
            });
        });

	});
</script>