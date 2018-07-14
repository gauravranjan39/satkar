<div class="be-content">
        <div class="page-head">
          <h2 class="page-head-title">Users</h2>
        </div>
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Default
                    <div class="tools">
                        <span class="icon mdi mdi-download"></span>
                        <span class="icon mdi mdi-more-vert"></span>
                        
                        
                    </div>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>Name</th>
						<th>User Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Role</th>
						<th>Created</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php foreach ($userLists as $userList) { ?>
                      <tr class="odd gradeX">
                        <td><?php echo $userList['User']['name']; ?></td>
                        <td><?php echo $userList['User']['username']; ?></td>
                        <td><?php echo $userList['User']['email']; ?></td>
                        <td><?php echo $userList['User']['mobile']; ?></td>
						<td><?php echo $userList['User']['address']; ?></td>
                        <td class="center"><?php echo $userList['User']['role']; ?></td>
						<td class="center"><?php echo $userList['User']['created']; ?></td>
						<td class="center"><?php echo $this->Html->link('<span class="mdi mdi-edit"></span>',array('controller'=>'users','action'=>'edit',$userList['User']['id']),array('escape'=>false)); ?></td>
                      </tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          
      </div>