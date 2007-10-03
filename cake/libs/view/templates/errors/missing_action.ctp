<?php
/* SVN FILE: $Id: missing_action.ctp 5510 2007-08-11 16:58:21Z dho $ */
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

<h1><?php echo sprintf(__('Missing Method in %s', true), $controller);?></h1>
<p class="error"><?php echo sprintf(__('You are seeing this error because the action <em>%1$s</em> is not defined in controller <em>%2$s</em>', true), $action, $controller);?></p>
<p><span class="notice"><?php echo sprintf(__('If you want to customize this error message, create %s.', true), APP_DIR.DS."views".DS."errors".DS."missing_action.ctp");?></span></p>
<p><span class="notice"><strong><?php __('Fatal'); ?></strong>
<?php echo sprintf(__(': Confirm you have created the %1$s::%2$s in file : %3$s.', true), $controller, $action, APP_DIR.DS."controllers".DS.Inflector::underscore($controller).".php");?></span></p>
<p>&lt;?php<br />
class <?php echo $controller;?> extends AppController {<br />
&nbsp;&nbsp;&nbsp;<strong>function <?php echo $action;?>() {<br />
&nbsp;&nbsp;&nbsp;}</strong><br />
}<br />
?&gt;<br />
</p>
