<div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
		  <?php echo $this->Session->flash(); ?>
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading">
              <?php echo $this->Html->image('logo-xx.png',array('height'=>'60','width'=>'70','class'=>'logo-img')) ?>
              </div>
              <div class="panel-body">
              <?php echo $this->Form->create('Admin',array('url'=> array('controller' => 'Admins', 'action' => 'login'),'method'=>'POST')); ?>
                <div class="form-group">
                  <?php echo $this->Form->input("Admin.username",array('placeholder'=>'Username','autocomplete'=>'off','required'=>'required','class'=>'form-control','label'=>false));?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->input("Admin.password",array('placeholder'=>'password','autocomplete'=>'off','required'=>'required','class'=>'form-control','label'=>false));?>
                </div>
                <div class="form-group login-submit">
                  <?php echo $this->Form->button('Sign me in',array('class'=>'btn btn-primary btn-xl','type'=>'submit'));?>
                </div>
                <?php echo $this->Form->end();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>