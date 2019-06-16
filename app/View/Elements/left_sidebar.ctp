<?php $controller = strtolower($this->params['controller']);
$activeClass = 'class="active"';
?>
<div class="be-left-sidebar">
  <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
    <div class="left-sidebar-spacer">
      <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
          <ul class="sidebar-elements">
            <li class="divider">Menu</li>
            <!-- <li <?=($controller == 'users')?$activeClass:null?>>
				<?php //echo $this->Html->link('<i class="icon mdi mdi-home"></i><span>Dashboard</span>',array('controller'=>'users','action'=>'index'),array('escape'=>false)); ?>
			</li> -->
            <!-- <li <?=($controller == 'suppliers')?$activeClass:null?>>
				<?php //echo $this->Html->link('<i class="icon mdi mdi-face"></i><span>Suppliers</span>',array('controller'=>'suppliers','action'=>'index'),array('escape'=>false)); ?>
			</li> -->
			<li <?=($controller == 'customers' || $controller == 'wallets')?$activeClass:null?>>
				<?php echo $this->Html->link('<i class="icon mdi mdi-face"></i><span>Customers</span>',array('controller'=>'customers','action'=>'index'),array('escape'=>false)); ?>
			</li>
			<li <?=($controller == 'categories')?$activeClass:null?>>
				<?php echo $this->Html->link('<i class="icon mdi mdi-layers"></i><span>Category</span>',array('controller'=>'categories','action'=>'index'),array('escape'=>false)); ?>
			</li>
			<li <?=($controller == 'orders')?$activeClass:null?>>
				<?php echo $this->Html->link('<i class="icon mdi mdi-chart-donut"></i><span>Orders</span>',array('controller'=>'Orders','action'=>'index'),array('escape'=>false)); ?>
			</li>
            
          <!-- </ul> -->
        </div>
      </div>
    </div>
    <div class="progress-widget">
      <div class="progress-data"><span class="progress-value">60%</span><span class="name">Current Project</span></div>
      <div class="progress">
        <div style="width: 60%;" class="progress-bar progress-bar-primary"></div>
      </div>
    </div>
  </div>
</div>


<script>
	$(document).ready(function(){
		$('.parent').click(function(){
			$(this).toggleClass("open");
		});
	});
</script>