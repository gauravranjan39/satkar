<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
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
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		// echo $this->Html->meta('icon');
		echo $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon'));
		// echo $this->Html->css('perfect-scrollbar.min');
		// echo $this->Html->css('material-design-icons/css/material-design-iconic-font.min');
		echo $this->Html->css('login');
		//echo $this->Html->script('jquery.min');
		//echo $this->Html->script('perfect-scrollbar.jquery.min');
		// echo $this->Html->script('main');
		// echo $this->Html->script('bootstrap.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<script type="text/javascript">
    //   $(document).ready(function(){
    //   	//initialize the javascript
    //   	App.init();
    //   });
      
</script>
<body class="be-splash-screen">	
<?php //echo $this->element('header');?>

<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content'); ?>

<?php //echo $this->element('footer');?>
</body>
</html>
