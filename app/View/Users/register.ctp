<div class="be-wrapper be-login be-signup">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container sign-up">
          <?php echo $this->Session->flash(); ?>
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading">
                <?php echo $this->Html->image('logo-xx.png',array('height'=>'60','width'=>'70','class'=>'logo-img')) ?>
              </div>
              <div class="panel-body">
              <?php echo $this->Form->create('User',array('url'=> array('controller' => 'Users', 'action' => 'Register'),'method'=>'POST')); ?>
                <span class="splash-title xs-pb-20">Sign Up</span>
                  <div class="form-group">
                    <?php echo $this->Form->input("User.user_name",array('placeholder'=>'Username','autocomplete'=>'off','required'=>'required','class'=>'form-control','label'=>false));?>
                  </div>
                  <div class="form-group">
                    <?php echo $this->Form->input("User.email",array('placeholder'=>'Email','type'=>'email','autocomplete'=>'off','required'=>'required','class'=>'form-control','label'=>false));?>
                  </div>
                  <div class="form-group row signup-password">
                    <div class="col-xs-6">
                        <?php echo $this->Form->input("User.password",array('placeholder'=>'Password','type'=>'password','autocomplete'=>'off','required'=>'required','class'=>'form-control','label'=>false));?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $this->Form->input("User.confirm_passowrd",array('placeholder'=>'Confirm Password','type'=>'password','autocomplete'=>'off','required'=>'required','class'=>'form-control','label'=>false));?>
                    </div>
                  </div>
                  <div class="form-group xs-pt-10">
                    <?php echo $this->Form->button('Sign Up',array('class'=>'btn btn-block btn-primary btn-xl','type'=>'submit'));?>
                  </div>
                <?php echo $this->Form->end();?>
              </div>
            </div>
            <div class="splash-footer">&copy; 2018 Satkar</div>
          </div>
        </div>
      </div>
    </div>