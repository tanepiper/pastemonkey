<?php e($this->element('notify'));?>
<div class="pasteAdd">
	<?php e($form->create('Paste', array('type'=>'file')));?>
		<fieldset id="paste-fieldset">
 			<legend id="paste-legend"><?php __('Add');?> <?php __('Paste');?></legend>
			<div>Use !!! to highlight lines of code.</div>
			<?php
				e($form->input('paste'));
			?>
		</fieldset>
		
		<fieldset id="note-fieldset">
 			<legend id="note-legend"><?php __('Paste');?> <?php __('Note');?></legend>
			<?php
				e($form->input('note'));
			?>
		</fieldset>
		<br style="clear:both;" />
		<fieldset id="details-fieldset">
			<legend id="details-legend"><?php __('Paste');?> <?php __('Details');?></legend>
			<?php
				e($form->input('tags', array('type'=>'text')));
				e($form->input('parent_id', array('type'=>'hidden')));
				e($form->input('language_id'));
				e($form->input('author', array('value'=>$name)));
				e($form->input('remember_me', array('type'=>'checkbox', 'value'=>$remember_me)));
			?>
		</fieldset>
	
		<fieldset id="options-fieldset">
			<legend id="options-label"><?php __('Paste');?> <?php __('Expiry');?></legend>
			<?php e($form->select('expire_type', $expiry_types, null, null, false));?>
			<?php e($form->input('private', array('type'=>'checkbox', 'label'=>'Make this paste private?')));?>
		</fieldset>
		<br style="clear:both;" />
	<?php e($form->end(__('Add New Paste', true), array('class'=>'submit-paste')));?>
</div>