<?php e($this->element('notify'));?>
<?php echo $form->create('Comment');?>
	<div class="box>
		<h2><?php __('Add');?> <?php __('Comment');?></h2>
		<div class="inner">
			<?php
				e($form->input('paste_id', array('type'=>'hidden')));
				e($form->input('line_position', array('type'=>'hidden')));
				e($form->input('comment'));
				e($form->input('author'));
			?>
			<?php e($form->input('i_am_a_human', array('type'=>'hidden'))); ?>	
			<?php echo $form->end(__('Submit', true));?>
			<button class="cancelComment"><?php __('Cancel');?></button>
		</div>
	</div>