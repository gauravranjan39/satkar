<div class="be-content">
	<div class="main-content container-fluid">
		<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default panel-table">
			<div class="panel-heading">Suppliers
				<div class="icon-container" style="text-align: right;padding:0px;">
					<?php echo $this->Html->link('<div class="icon"><span class="mdi mdi-account-add"></span></div>',array('controller'=>'Suppliers','action'=>'admin_add'),array('title'=>'Add Supplier','escape'=>false)); ?>
				</div>
				<div class="tools">
				</div>
			</div>
			<div class="panel-body">
				<table id="table1" class="table table-striped table-hover table-fw-widget">
					<thead>
						<tr>
						<th>Name</th>
						<th>Address</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Trade Name</th>
						<th>Status</th>
						<th>Created</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($supplierLists as $supplierList) { ?>
						<tr class="odd gradeX">
						<td><?php echo $supplierList['Supplier']['name']; ?></td>
						<td><?php echo $supplierList['Supplier']['address']; ?></td>
						<td><?php echo $supplierList['Supplier']['email']; ?></td>
						<td><?php echo $supplierList['Supplier']['mobile']; ?></td>
						<td><?php echo $supplierList['Supplier']['trade_name']; ?></td>
						<td class="center"><?php if($supplierList['Supplier']['status'] == 1) {
							echo $this->Html->link($this->Html->image('circle_green.png',array('alt'=>'active', 'class'=>'status','value'=>$supplierList['Supplier']['id'] )),'javascript:void(0)', array('escape' => false));
						} else {
							echo $this->Html->link($this->Html->image('circle_red.png',array('alt'=>'deactive','class'=>'status','value'=>$supplierList['Supplier']['id'])),'javascript:void(0)', array('escape' => false));
						} ?></td>
						<td class="center"><?php echo date('d-M-Y', strtotime($supplierList['Supplier']['created'])); ?></td>
						<td class="center"><?php echo $this->Html->link('<span class="mdi mdi-edit"></span>',array('controller'=>'suppliers','action'=>'admin_edit',$supplierList['Supplier']['id']),array('escape'=>false)); ?></td>
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
			$.ajax({
				url:"<?php echo Router::url(array('controller'=>'Suppliers','action'=>'admin_change_status'));?>/"+val,
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
		});
	});	
      
</script>