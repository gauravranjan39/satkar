<div class="be-content">
	<div class="main-content container-fluid">
		<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default panel-table">
			<div class="panel-heading">Customers
				<div class="icon-container" style="text-align: right;padding:0px;">
					<?php echo $this->Html->link('<div class="icon"><span class="mdi mdi-account-add"></span></div>',array('controller'=>'Customers','action'=>'add'),array('title'=>'Add Customer','escape'=>false)); ?>
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
						<th>Reference</th>
						<th>Status</th>
						<th>Created</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($customerLists as $customerList) { ?>
						<tr class="odd gradeX">
						<td><?php echo $customerList['c1']['name']; ?></td>
						<td><?php echo $customerList['c1']['address']; ?></td>
						<td><?php echo $customerList['c1']['email']; ?></td>
						<td><?php echo $customerList['c1']['mobile']; ?></td>
						<?php if(isset($customerList['c1']['reference_id']) && !empty($customerList['c1']['reference_id'])) { ?>
							<td><?php echo $customerList['c2']['name']; ?></td>
						<?php } else { ?>
							<td></td>
						<?php } ?>
						<td class="center"><?php if($customerList['c1']['status'] == 1) {
							echo $this->Html->link($this->Html->image('circle_green.png',array('alt'=>'active', 'class'=>'status','value'=>$customerList['c1']['id'] )),'javascript:void(0)', array('escape' => false));
						} else {
							echo $this->Html->link($this->Html->image('circle_red.png',array('alt'=>'deactive','class'=>'status','value'=>$customerList['c1']['id'])),'javascript:void(0)', array('escape' => false));
						} ?></td>
						<td class="center"><?php echo $customerList['c1']['created']; ?></td>
						<td class="center">
							<div class="btn-group btn-hspace">
								<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Open <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
								<ul role="menu" class="dropdown-menu pull-right">
									<?php $encodedCustomerId = $Encryption->encode($customerList['c1']['id']);?>
									<li><?php echo $this->Html->link('Edit', array('controller' => 'Customers','action' => 'edit',$customerList['c1']['id']),array('class'=>''));?></li>
									<li><?php echo $this->Html->link('Add Ledger', array('controller' => 'Orders','action' => 'add',$encodedCustomerId),array('class'=>''));?></li>
									<li><?php echo $this->Html->link('Orders', array('controller' => 'Orders','action' => 'index'),array('class'=>''));?></li>
									<li><?php echo $this->Html->link('Passbook', array('controller' => 'Wallets','action' => 'index',$encodedCustomerId),array('class'=>''));?></li>
									<!-- <li><?php //echo $this->Html->link('Passbook', array('controller' => 'Wallets','action' => 'index','?'  => array('custId' =>$encodedCustomerId)),array('class'=>''));?></li> -->
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
		$('#table1').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
      } );

		$(".status").click(function(){
			var val = $(this).attr('value');
			var ref = $(this);
			$.ajax({
				url:"<?php echo Router::url(array('controller'=>'Customers','action'=>'change_status'));?>/"+val,
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

<style>
.dataTables_filter {
	margin-right: 20px !important;
}
.dataTables_length {
	margin-left: 20px;
}
</style>