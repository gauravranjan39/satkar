<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php //echo $cakeDescription ?>:
		<?php //echo $title_for_layout; ?>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		// echo $this->Html->meta('icon');
		echo $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon'));

		echo $this->Html->css('perfect-scrollbar.min');
		echo $this->Html->css('material-design-icons/css/material-design-iconic-font');
		echo $this->Html->css('dataTables.bootstrap.min');
		// echo $this->Html->css('bootstrap-datetimepicker.min');
		// echo $this->Html->css('select2.min');
		// echo $this->Html->css('bootstrap-slider');
		echo $this->Html->css('style');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('perfect-scrollbar.jquery.min');
		echo $this->Html->script('main');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery.dataTables.min');
		echo $this->Html->script('dataTables.bootstrap.min');
		echo $this->Html->script('dataTables.buttons');
		echo $this->Html->script('buttons.html5');
		echo $this->Html->script('buttons.flash');
		echo $this->Html->script('buttons.print');
		echo $this->Html->script('buttons.colVis');
		echo $this->Html->script('buttons.bootstrap');
		echo $this->Html->script('app-tables-datatables');
		// echo $this->Html->script('perfect-scrollbar.jquery.min');
		// echo $this->Html->script('bootstrap-slider');
		// echo $this->Html->script('app-form-elements');
		// echo $this->Html->script('select2.min');
		echo $this->Html->script('speechToText');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<script type="text/javascript">
     $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.dashboard();
		// App.dataTables();
		// App.formElements();
		
		$('.helbutton').click(function(){
			allowMicrophone();
		});

		$('body').on('keypress','.allowOnlyNumber',function(evt){
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;
		});

		$('.allowOnlyNumber').bind('copy paste cut',function(e) {
			e.preventDefault();
			alert('Sorry, pasting is not allowed. Please type in.');	
		});
		
	});

	//when click on browser back button it will redirect to the same page
	function preventBack() { window.history.forward(); }
		setTimeout("preventBack()", 0);
		window.onunload = function () { null };

		
	if(navigator.userAgent.indexOf("Chrome") != -1 ) {
		/** Initialise the speech Recognization*/
		var speech2text = new speech2text();

		// Start Interacting with SPEECH by allowing your microphone
		speech2text.start(callBackCalledAfterUpdate);

		/** Allow access to microphone on click*/
		function allowMicrophone() {
			speech2text.start(callBackCalledAfterUpdate);
		}

		/**  Callback to be called after starting SPEECH RECOGNIZATION*/
		function callBackCalledAfterUpdate(voice) {
			// What you say, will be console here
			//console.log(voice);
			if (voice == 'go back') {
				window.history.back();
			} else if (voice == 'kill you' || voice == 'logout') {
				// $this->redirect(array('controller'=>'Users','action' => 'logout'));
				// $this->Session->delete('Auth');
				// window.location.href = '<?php //echo $base_url ?>/Users/logout' ;
			}
			// If let the robot to speak what you say
			speech2text.onReadLoud(voice);
		}
	}
      
</script>
<body>	
	<div class="be-wrapper be-fixed-sidebar">
		<?php echo $this->element('admin_header');?>
		<?php echo $this->element('admin_left_sidebar'); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>
