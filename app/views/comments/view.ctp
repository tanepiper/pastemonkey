<strong><?php __('Comments');?></strong>
<div class="inner">
<?php foreach ($comments as $comment) { ?>
	<div class="comment <?php e($comment['Comment']['line_position']);?>">
		<div><?php __('Author');?>: <?php e($comment['Comment']['author']);?></div>
		<div><?php e($comment['Comment']['comment']);?></div>
	</div>
<?php } ?>
</div>