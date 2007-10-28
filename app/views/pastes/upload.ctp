<?php e($this->element('notify'));?>
<div class="newpaste">
	<?php e($form->create('Paste', array('type'=>'file', 'action'=>'upload')));?>
	<?php e($form->input('parent_id', array('type'=>'hidden')));?>
	<div class="box">
		<h2><?php __('Enter');?> <?php __('Paste');?></h2>
		<div class="inner">
		<p>
			<strong>To highlight lines in your code, put <em>!!!</em> within the line.</strong>
		</p>
		<fieldset>
			<div class="textarea">
				<strong>File Upload Limit: </strong><?php e(Configure::read('File.maxsize') / 1024);?> Kb<br />
				<?php e($form->file('file'));?>
			</div>
			<div class="columns">
				<div class="column large">
					<?php e($form->input('language_id', array('value'=>$overide_lang)));?>
					<label for="PasteExpireType">Expires in</label>
					<?php e($form->select('expire_type', $expiry_types, null, null, false));?>				
				</div>
				<div class="column large">
					<?php e($form->input('author', array('value'=>$name))); ?>
					<?php e($form->input('remember_me', array('type'=>'checkbox', 'value'=>$remember_me))); ?>
				</div>
			</div>
		</fieldset>
		</div>
		</div>

		<div class="box">
		<h2><?php __('Additional');?> <?php __('Info');?></h2>
		<div class="inner">
			<fieldset>
				<div class="textarea">
					<div><a href="#" rel="PasteNote" class="increase"> + </a> <a href="#" rel="PasteNote" class="decrease"> - </a></div>
					<?php e($form->input('note')); ?>
				</div>
				<div class="columns">
					<div class="column large">
						<?php e($form->input('tags', array('type'=>'text')));?>
					</div>
					<div class="column large">
						<?php e($form->input('private', array('type'=>'checkbox', 'label'=>'Make this paste private?')));?>
					</div>
				</div>
			</fieldset>
		</div>
		</div>
	<?php e($form->input('i_am_a_human', array('type'=>'hidden')));?>
	<?php e($form->end(__('Add New Paste', true), array('class'=>'submit-paste')));?>
</div>