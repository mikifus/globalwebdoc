<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Global Web Doc');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?> -
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('default');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->Html->script('jquery/jquery'); // Include jQuery library
		$this->Js->JqueryEngine->jQueryObject = 'jQuery';
		echo $this->Html->scriptBlock(
			'var jQuery = jQuery.noConflict();',
			array('inline' => false)
		);
		echo $this->Javascript->link('jquery/jquery-ui-1.8.4.custom.min.js');
		echo $this->Javascript->link('jquery/jquery.autocomplete.min.js');
		echo $this->Javascript->link('jquery/jquery.jeditable.mini.js');
		echo $this->fetch('script');
		echo $this->Html->script('http://openlayers.org/api/OpenLayers.js');
		echo $this->Html->script('OpenLayers-2.12/layers/stamen.js'); // Include jQuery library
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			
		</div>
		<div id="content">
			<div class='left_colum'>
				<div class='title'>
					<a href='/'>Global web doc</a>
				</div>
				<div class='menu'>
					<div>
					<?php
						echo $this->Html->link('Home','/');
					?>
					</div>
					<div>
					<?php
						echo $this->Html->link('About',array('controller'=>'pages','action'=>'about'));
					?>
					</div>
					<div>
					<?php
						echo $this->Html->link('How does it work?',array('controller'=>'pages','action'=>'howdoesitwork'));
					?>
					</div>
				</div>
			</div>
			<div class='content_column'>
				<?php echo $this->fetch('content'); ?>
			</div>
			<?php echo $this->Session->flash(); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php /*echo $this->element('sql_dump');*/ ?>
</body>
</html>
