<div class="buttons">
	<p>
	<?php echo $html->link(
			$html->image('cake.power.png', array('alt'=>"CakePHP: the rapid development php framework", 'border'=>"0")),
			'http://www.cakephp.org/',
			array('target'=>'_new'), null, false
		  );
	?>
	</p>
	<p>
	<?php echo $html->link(
			$html->image('jq.png', array('alt'=>"jQuery JavaScript Library", 'border'=>"0")),
			'http://www.jquery.com/',
			array('target'=>'_new'), null, false
		  );
	?>
	</p>
	<p>
	<?php e($html->link(__('Get Source Code',true), 'http://code.google.com/p/pastemonkey/'));?>
	</p>
	<br style="clear:both;" />
</div>