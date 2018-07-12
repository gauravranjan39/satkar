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
<div class="be-left-sidebar">
  <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
    <div class="left-sidebar-spacer">
      <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
          <ul class="sidebar-elements">
            <li class="divider">Menu</li>
            <li class="active">
				<?php echo $this->Html->link('<i class="icon mdi mdi-home"></i><span>Dashboard</span>',array('controller'=>'users','action'=>'listing'),array('escape'=>false)); ?>
			</li>
            <li class="parent"><a href="#"><i class="icon mdi mdi-face"></i><span>UI Elements</span></a>
              <ul class="sub-menu">
                <li><a href="ui-alerts.html">Alerts</a>
                </li>
                <li><a href="ui-buttons.html">Buttons</a>
                </li>
                <li><a href="ui-panels.html">Panels</a>
                </li>
                <li><a href="ui-general.html">General</a>
                </li>
                <li><a href="ui-modals.html">Modals</a>
                </li>
                <li><a href="ui-notifications.html">Notifications</a>
                </li>
                <li><a href="ui-icons.html">Icons</a>
                </li>
                <li><a href="ui-grid.html">Grid</a>
                </li>
                <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a>
                </li>
                <li><a href="ui-nestable-lists.html">Nestable Lists</a>
                </li>
                <li><a href="ui-typography.html"><span class="label label-primary pull-right">New</span>Typography</a>
                </li>
              </ul>
            </li>
            <li class="parent"><a href="charts.html"><i class="icon mdi mdi-chart-donut"></i><span>Charts</span></a>
              <ul class="sub-menu">
                <li><a href="charts-flot.html">Flot</a>
                </li>
                <li><a href="charts-sparkline.html">Sparklines</a>
                </li>
                <li><a href="charts-chartjs.html">Chart.js</a>
                </li>
                <li><a href="charts-morris.html">Morris.js</a>
                </li>
              </ul>
            </li>
            <li class="parent"><a href="#"><i class="icon mdi mdi-dot-circle"></i><span>Forms</span></a>
              <ul class="sub-menu">
                <li><a href="form-elements.html">Elements</a>
                </li>
                <li><a href="form-validation.html">Validation</a>
                </li>
                <li><a href="form-wizard.html">Wizard</a>
                </li>
                <li><a href="form-masks.html">Input Masks</a>
                </li>
                <li><a href="form-wysiwyg.html">WYSIWYG Editor</a>
                </li>
                <li><a href="form-upload.html">Multi Upload</a>
                </li>
              </ul>
            </li>
            <li class="parent"><a href="#"><i class="icon mdi mdi-border-all"></i><span>Tables</span></a>
              <ul class="sub-menu">
                <li><a href="tables-general.html">General</a>
                </li>
                <li><a href="tables-datatables.html">Data Tables</a>
                </li>
              </ul>
            </li>
            <li class="parent"><a href="#"><i class="icon mdi mdi-layers"></i><span>Pages</span></a>
              <ul class="sub-menu">
                <li><a href="pages-blank.html">Blank Page</a>
                </li>
                <li><a href="pages-blank-header.html">Blank Page Header</a>
                </li>
                <li><a href="pages-login.html">Login</a>
                </li>
                <li><a href="pages-login2.html">Login v2</a>
                </li>
                <li><a href="pages-404.html">404 Page</a>
                </li>
                <li><a href="pages-sign-up.html">Sign Up</a>
                </li>
                <li><a href="pages-forgot-password.html">Forgot Password</a>
                </li>
                <li><a href="pages-profile.html">Profile</a>
                </li>
                <li><a href="pages-pricing-tables.html">Pricing Tables</a>
                </li>
                <li><a href="pages-pricing-tables2.html">Pricing Tables v2</a>
                </li>
                <li><a href="pages-timeline.html"><span class="label label-primary pull-right">New</span>Timeline</a>
                </li>
                <li><a href="pages-timeline2.html"><span class="label label-primary pull-right">New</span>Timeline v2</a>
                </li>
                <li><a href="pages-invoice.html"><span class="label label-primary pull-right">New</span>Invoice</a>
                </li>
                <li><a href="pages-calendar.html">Calendar</a>
                </li>
                <li><a href="pages-gallery.html">Gallery</a>
                </li>
              </ul>
            </li>
            <li class="divider">Features</li>
            <li class="parent"><a href="#"><i class="icon mdi mdi-inbox"></i><span>Email</span></a>
              <ul class="sub-menu">
                <li><a href="email-inbox.html">Inbox</a>
                </li>
                <li><a href="email-read.html">Email Detail</a>
                </li>
                <li><a href="email-compose.html">Email Compose</a>
                </li>
              </ul>
            </li>
            <li class="parent"><a href="#"><i class="icon mdi mdi-view-web"></i><span>Layouts</span></a>
              <ul class="sub-menu">
                <li><a href="layouts-primary-header.html">Primary Header</a>
                </li>
                <li><a href="layouts-success-header.html">Success Header</a>
                </li>
                <li><a href="layouts-warning-header.html">Warning Header</a>
                </li>
                <li><a href="layouts-danger-header.html">Danger Header</a>
                </li>
                <li><a href="layouts-nosidebar-left.html">Without Left Sidebar</a>
                </li>
                <li><a href="layouts-nosidebar-right.html">Without Right Sidebar</a>
                </li>
                <li><a href="layouts-nosidebars.html">Without Both Sidebars</a>
                </li>
                <li><a href="layouts-fixed-sidebar.html">Fixed Left Sidebar</a>
                </li>
                <li><a href="pages-blank-aside.html">Page Aside</a>
                </li>
              </ul>
            </li>
            <li class="parent"><a href="#"><i class="icon mdi mdi-pin"></i><span>Maps</span></a>
              <ul class="sub-menu">
                <li><a href="maps-google.html">Google Maps</a>
                </li>
                <li><a href="maps-vector.html">Vector Maps</a>
                </li>
              </ul>
            </li>
          </ul>
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
<?php echo $this->fetch('content'); ?>

</div>
</body>
</html>
