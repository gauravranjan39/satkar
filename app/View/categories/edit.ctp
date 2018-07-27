<div class="be-content">
    <div class="main-content container-fluid">
	<?php echo $this->Session->flash(); ?>
        <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
            
            <div class="panel-body">
            <?php echo $this->Form->create('Category',array('url'=> array('controller' => 'categories', 'action' => 'edit'),'method'=>'POST')); ?>
			<?php echo $this->Form->input('id');?>
				<div class="form-group xs-pt-10">
					<label>Category</label>
					<?php echo $this->Form->input("Category.name",array('placeholder'=>'Enter Name','required'=>'required','class'=>'form-control','label'=>false));?>
				</div>
				
				<div class="form-group">
					<label>Parent Category</label>
					<?php echo $this->Form->input('Category.parent_id', array('class'=>'form-control','label'=>false,'selected'=>$this->data['Category']['parent_id']));?>
				</div>
                <div class="row xs-pt-15">
                    <div class="col-xs-6">
                    <?php echo $this->Form->button('Submit',array('class'=>'btn btn-space btn-primary','id'=>'supplierEditRegister','type'=>'submit'));?>
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



