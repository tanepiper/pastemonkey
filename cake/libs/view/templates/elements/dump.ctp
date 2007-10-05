<?php
/* SVN FILE: $Id: dump.ctp 5508 2007-08-11 15:03:28Z nate $ */
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
 * @subpackage		cake.cake.libs.view.templates.elements
 * @since			CakePHP(tm) v 0.10.5.1782
 * @version			$Revision: 5508 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2007-08-11 16:03:28 +0100 (Sat, 11 Aug 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<div id="cakeControllerDump">
	<h2><?php __('Controller dump:'); ?></h2>
		<pre>
			<?php Debugger::exportVar($controller); ?>
		</pre>
</div>