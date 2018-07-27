<div class="be-content">
	<div class="main-content container-fluid">
		<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default panel-table">
			<div class="panel-heading">Category
				<div class="tools">
					<!-- <span class="icon mdi mdi-download"></span>
					<span class="icon mdi mdi-more-vert"></span> -->
					<?php echo $this->Html->link('<div class="icon"><span class="mdi mdi-account-add"></span></div>',array('controller'=>'categories','action'=>'add'),array('escape'=>false)); ?>
				</div>
			</div>
			<div class="panel-body">
				<table id="table1" class="table table-striped table-hover table-fw-widget">
					<thead>
						<tr>
						<th>Category</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($categoryLists as $categoryId=>$categoryList) { ?>
						<tr class="odd gradeX">
						<td><?php echo $categoryList; ?></td>
						
						<td class="center"><?php echo $this->Html->link('<span class="mdi mdi-edit"></span>',array('controller'=>'categories','action'=>'edit',$categoryId),array('escape'=>false)); ?></td>
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
		$(".status").click(function(){
			var val = $(this).attr('value');
			var ref = $(this);
			$.ajax({
				url:"<?php echo Router::url(array('controller'=>'Suppliers','action'=>'change_status'));?>/"+val,
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