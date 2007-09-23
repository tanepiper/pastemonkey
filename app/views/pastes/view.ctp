<div class="pastes">
	<h2><?php __('Pastes');?></h2>
	<div>
		<?php e($form->create('Paste', array('action'=>'add')));?>
		<h4><?php __('Language');?> : <?php echo $html->link($paste['Language']['language'], array('controller'=> 'languages', 'action'=>'view', $paste['Language']['id'])); ?></h4>
		<div><?php __('Pasted By');?>  on <?php echo $paste['Paste']['created']?></div>
		<div>
			<?php echo $paste['Paste']['paste_formatted']?>
		</div>
		<hr />
		<?php e($form->input('plain_paste',array('type'=>'textarea','value'=>$paste['Paste']['paste'])));?>
		<hr />
		<?php echo $paste['Paste']['note']?>
		<hr />
		<?php echo $paste['Paste']['tags']?>
		<hr />
		<h4><?php __('Expires');?> :<?php echo $paste['Paste']['expiry']?></h4>
		<?php e($form->end('Submit Paste Change'));?>
	</div>
</div>