<div class="viewPaste">
	<h2><?php __('View Paste');?></h2>
	<div>
		<?php if ($paste) { ?>
			<div class="viewPaste-infoArea">
				<strong><? __('Paste') . ' ' . __('by');?> <?php e($paste['Paste']['author']);?> <?php __('in');?> <?php e($html->link($paste['Language']['language'],array('controller'=>'languages','action'=>'view', $paste['Language']['id']), array('class'=>'ajaxLink')));?>, <?php e($pastemonkey->timeAgo($paste['Paste']['created']));?>
				<?php if (isset($paste['Paste']['parent_id'])) { ?>
					<?php __('in response to');?> 
					<?php e($html->link(__('paste', true) . ' ' . $paste['Paste']['parent_id'],array('controller'=>'pastes', 'action'=>'view', $paste['Paste']['parent_id']), array('class'=>'ajaxLink')));?>				
				<?php } ?>
				</strong>
				
				<?php if ($paste['Tag']) { ?>
					<div class="viewPaste-infoArea-tags">
						<dl>
							<dt><strong><?php __('Tags');?>:</strong></dt>
							<dd>
								<?php foreach($paste['Tag'] as $tag) {
									e($html->link($tag['tag'], array('controller'=>'tags', 'action'=>'view', $tag['id']), array('class'=>'ajaxLink')) . ', ');
								} ?>
							</dd>
						</dl>
					</div>
				<?php } ?>
				<div class="viewPaste-infoArea-permalink">
					<strong><?php __('Permalink');?>:</strong>
					<?php e($html->link($pastemonkey->checkAddress() . '/pastes/view/' . $paste['Paste']['id'],array('controller'=>'pastes','action'=>'view', $paste['Paste']['id']), array('class'=>'noAjax')));?>
				</div>
				
				<div class="viewPaste-infoArea-downloadLinks">
					<?php e($html->link($html->image("go-down.png") . '<br />' . __('Download', true), array('controller'=> 'pastes', 'action'=>'download', $paste['Paste']['id']), array('class'=>'downloadPaste'), null, false));?>
					<?php e($html->link($html->image("accessories-text-editor.png") . '<br />' . __('Edit', true), array('controller'=> 'pastes', 'action'=>'edit', $paste['Paste']['id']), array('class'=>'ajaxLink editPaste'), null, false));?>
					<?php if (isset($paste['Paste']['parent_id'])) { ?>
						<?php e($html->link($html->image("edit-copy.png") . '<br />' . __('Download Diff File', true),array('controller'=>'pastes', 'action'=>'diff', $paste['Paste']['parent_id'], $paste['Paste']['id']), array('class'=>'downloadDiff'), null, false));?>
					<?php } ?>
				</div>
				<br style="clear:both;" />
			</div>
			
			<div class="viewPaste-geshiOutput">
				<?php if($paste['Paste']['note']) { ?>
					<div class="viewPaste-geshiOutput-note">
						<strong><?php __('Note');?></strong>: <?php echo $paste['Paste']['note']?>
					</div>
				<?php } ?>
				<?php e($geshi->generate($paste['Paste']['paste'], strtolower($paste['Language']['class'])));?>
			</div>
			
			<div class="viewpaste-plainOutput">
				<?php e($form->input('plain_paste',array('type'=>'textarea','value'=>$paste['Paste']['paste'], 'id'=>'PasteCopy' . $paste['Paste']['id'], 'class'=>'PasteCopy')));?>
				<?php e($html->link(__('Select All Text', true), '#', array('id'=>'PasteCopyButton' . $paste['Paste']['id'], 'class'=>'copyButton', 'rel'=>$paste['Paste']['id'])));?>
			</div>
		
	<?php } else { ?>
		<div class="error">
			<strong><?php __('Paste does not exist.');?></strong>
		</div>
	<?php } ?>
	</div>
</div>