<div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Users
				<div class="icon-container" style="text-align: right;padding:0px;">
					<?php echo $this->Html->link('<div class="icon"><span class="mdi mdi-account-add"></span></div>',array('controller'=>'Users','action'=>'admin_add'),array('title'=>'Add User','escape'=>false)); ?>
				</div>
                    <div class="tools">
                    </div>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>Name</th>
						<th>UserName</th>
						<th>Address</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <!-- <th>Token</th> -->
						<th>Status</th>
						<th>Type</th>
						<th>Created</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php foreach ($userLists as $userList) { ?>
                      <tr class="odd gradeX">
                        <td><?php echo $userList['User']['name']; ?></td>
						<td data-container="body" data-toggle="popover" data-placement="top" data-content="<?php echo $userList['User']['hash_token']; ?>" data-original-title="Token"><?php echo $userList['User']['username']; ?></td>
                        <td><?php echo $userList['User']['address']; ?></td>
                        <td><?php echo $userList['User']['email']; ?></td>
                        <td><?php echo $userList['User']['mobile']; ?></td>
                        <!-- <td class="center"><?php //echo $userList['User']['hash_token']; ?></td> -->
						<td class="center"><?php if($userList['User']['status'] == 1) {
							echo $this->Html->link($this->Html->image('circle_green.png',array('alt'=>'active', 'class'=>'status','value'=>$userList['User']['id'] )),'javascript:void(0)', array('escape' => false));
						} else {
							echo $this->Html->link($this->Html->image('circle_red.png',array('alt'=>'deactive','class'=>'status','value'=>$userList['User']['id'])),'javascript:void(0)', array('escape' => false));
						} ?></td>
						<td><span class="user_type" style="cursor:pointer;" user-id="<?php echo $userList['User']['id'];?>"><?php echo $userList['User']['type']; ?></span></td>
						<td class="center"><?php echo date('d-M-Y', strtotime($userList['User']['created'])); ?></td>
						<td class="center">
							<div class="btn-group btn-hspace">
								<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Open <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
								<ul role="menu" class="dropdown-menu pull-right">
									<?php //$encodedCustomerId = $Encryption->encode($customerList['c1']['id']);?>
									<li><?php echo $this->Html->link('Edit', array('controller' => 'Users','action' => 'admin_edit',$userList['User']['id']),array('class'=>''));?></li>
								</ul>
							</div>
						</td>
					</tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
<script type="text/javascript">
	$(document).ready(function() {
		App.dataTables();
		$(".status").click(function(){
			var val = $(this).attr('value');
			var ref = $(this);
			if (confirm('Are you sure to continue ?')) {
				$.ajax({
					url:"<?php echo Router::url(array('controller'=>'Users','action'=>'change_status'));?>/"+val,
					success:function(data){
						if(data == 0){
							ref.attr({
								src: '/satkar/img/circle_red.png',
								value: val,
								alt:'inactive',
								title:'Inactive'
								});
						}else{
							ref.attr({
								src: '/satkar/img/circle_green.png',
								value: val,
								alt:'active',
								title:'Active'
							});
						}
					}
				});
			}
		});

		$('.user_type').click(function(){
			var userType = $(this).text();
			var userId = $(this).attr('user-id');
			var ref = $(this);
			if (confirm('Are you sure to continue ?')) { 
				$.ajax({
					type: "POST",
					url:"<?php echo Router::url(array('controller'=>'Users','action'=>'admin_changeUserType'));?>",
					data:({userType:userType,userId:userId}),
					success: function(data) {
						ref.text(data);
					}
				});
			}
		});

	});	
      
</script>