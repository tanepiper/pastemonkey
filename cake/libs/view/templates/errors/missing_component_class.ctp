<?php
/* SVN FILE: $Id: missing_component_class.ctp 5510 2007-08-11 16:58:21Z dho $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.view.templates.errors
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 5510 $
 * @modifiedby		$LastChangedBy: dho $
 * @lastmodified	$Date: 2007-08-11 17:58:21 +0100 (Sat, 11 Aug 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<h1><?php __('Missing Component Class'); ?></h1>
<p class="error">
<?php echo sprintf(__('You are seeing this error because the component class <em>%1$s</em> you have set in <em>%2$s</em> can\'t be found or doesn\'t exist.', true), $component."Component", $controller."Controller");?>
</p>
<p><span class="notice"><strong><?php __('Notice'); ?>: </strong>
<?php echo sprintf(__('If you want to customize this error message, create %s', true), APP_DIR.DS."views".DS."errors".DS."missing_component_class.ctp");?></span></p>
<p><span class="notice"><strong><?php __('Fatal'); ?>: </strong>
<?php echo sprintf(__('Create the class below in file: %s', true), APP_DIR.DS."controllers".DS."components".DS.$file);?></span></p>

<p>&lt;?php<br />
class <?php echo $component;?>Component extends Object {<br />
}<br />
?&gt;<br />
</p>
