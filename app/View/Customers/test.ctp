<div class="be-content">
    <div class="main-content container-fluid">
	<?php echo $this->Session->flash(); ?>
        <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
            
            <div class="panel-body">
            <?php echo $this->Form->create('Customer',array('url'=> array('controller' => 'customers', 'action' => 'edit'),'method'=>'POST')); ?>
			
            <div class="ledger_body">
            
				<div class="row xs-pt-12">
                    <div class="form-group col-sm-6">
                        <label>Category</label>
                        <?php echo $this->Form->input("Customer.name",array('placeholder'=>'Enter category','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Item</label>
                        <?php echo $this->Form->input("Customer.name",array('placeholder'=>'Enter Item','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    </div>
				</div>

                <div class="row xs-pt-12">
                    <div class="form-group col-sm-6">
                        <label>Rate</label>
                        <?php echo $this->Form->input("Customer.name",array('placeholder'=>'Enter Rate','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Weight</label>
                        <?php echo $this->Form->input("Customer.name",array('placeholder'=>'Enter Weight','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    </div>
				</div>

                <div class="row xs-pt-12">
                    <div class="form-group col-sm-6">
                        <label>Making Charge</label>
                        <?php echo $this->Form->input("Customer.name",array('placeholder'=>'Enter Making Charge','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Total</label>
                        <?php echo $this->Form->input("Customer.name",array('placeholder'=>'Total','required'=>'required','class'=>'form-control input-sm','label'=>false));?>
                    </div>
				</div>

				<div class="form-group">
					<label>Comments</label>
					<?php echo $this->Form->input("Customer.address",array('type'=>'text','placeholder'=>'Enter Comments','required'=>'required','class'=>'form-control input-lg','label'=>false));?>
				</div>
			</div> 
                <div class="row xs-pt-15">
                    <div class="col-xs-6">
                    <?php echo $this->Form->button('Submit',array('class'=>'btn btn-space btn-primary','id'=>'customerEditRegister','type'=>'submit'));?>
					<?php echo $this->Html->link('cancel', array('controller' => 'customers','action' => 'index'),array('class'=>'btn btn-space btn-default'));?>
                    </div>
                </div>
               
                <?php echo $this->Form->end();?>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
