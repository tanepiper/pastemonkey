<div class="pastes">
	<h2><?php __('Pastes');?></h2>
	<div>
		<div class="infoarea">
			<table>
				<tr>
					<td><?php __('Author');?>:</td>
					<td><?php e($paste['Paste']['author']);?></td>
					<td><?php __('Language');?>:</td>
					<td><?php echo $html->link($paste['Language']['language'], array('controller'=> 'languages', 'action'=>'view', $paste['Language']['id'])); ?></td>
				</tr>
				<tr>
					<td><?php __('Date Posted');?>:</td>
					<td><?php echo $paste['Paste']['created']?></td>
					<td><?php __('Note');?>:</td>
					<td><?php echo $paste['Paste']['note']?></td>
				</tr>
				<tr>
					<td><?php __('Tags');?>:</td>
					<td colspan="3"><?php echo $paste['Paste']['tags']?></td>
				</tr>
			</table>
		</div>
		<div>
			<?php echo $paste['Paste']['paste_formatted']?>
		</div>
		<hr />
		<?php e($form->input('plain_paste',array('type'=>'textarea','value'=>$paste['Paste']['paste'])));?>
	</div>
</div>