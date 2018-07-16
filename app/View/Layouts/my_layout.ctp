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
		echo $this->Html->meta('icon');

		echo $this->Html->css('perfect-scrollbar.min');
		echo $this->Html->css('material-design-icons/css/material-design-iconic-font.min');
		echo $this->Html->css('dataTables.bootstrap.min');
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

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<script type="text/javascript">
     $(document).ready(function(){
        //initialize the javascript
        App.init();
        //App.dashboard();
		App.dataTables();
    });
      
</script>
<body>	
	<div class="be-wrapper be-fixed-sidebar">
		<?php echo $this->element('header');?>
		<?php echo $this->element('left_sidebar'); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>
