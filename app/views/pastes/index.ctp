<?php e($this->element('notify'));?>
<br style="clear:both;" />

<div id="pastesAll" class="paste-area box">
	<h2><?php __('Latest Pastes');?></h2>
	<?php foreach ($pastes as $paste) {	?>
	<div class="inner">
		<div id="paste-<?php e($paste['Paste']['id']);?>" class="paste">
			<div class="info">
				<div class="column">
					<h3><?php __('Author');?></h3>
					<span><?php e($paste['Paste']['author']);?></span>
				</div>
				<div class="column">
					<h3><?php __('Language');?></h3>
					<span><?php e($paste['Language']['language']);?></span>
				</div>
				<div class="column">
					<h3><?php __('Pasted');?></h3>
					<span><?php e($pastemonkey->timeAgo($paste['Paste']['created']));?></span>
				</div>
			</div>	
			<div class="desc">
				<h3><?php __('Notes');?></h3>
				<span><?php e($paste['Paste']['note']);?></span>
			</div>
			<div class="tasks">
				<?php echo $html->link('View Full Paste', array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['id']), array('class'=>'ajaxLink', 'title'=>md5(__('View Paste', true) . $paste['Paste']['id']))); ?>
				<?php e($html->link(__('Download This Paste', true), array('controller'=> 'pastes', 'action'=>'download', $paste['Paste']['id']), array('class'=>'downloadPaste'), null, false));?>
        	</div>
			<div class="geshi-output-index">
				<?php e($geshi->generate($paste['Paste']['paste'], $paste['Language']['class']));?>
			</div>
		</div>
		</div>
	<?php }; ?>
</div>

<div class="paging">
	<span class="paging-prev">
		<?php echo $paginator->prev('<< '.__('Previous', true), array(), null, array('class'=>'disabled'));?>
	</span>
	<span class="paging-numbers">
		<?php echo $paginator->numbers(array('separator' => ''));?>
	</span>
	<span class="paging-next">
		<?php echo $paginator->next(__('Next', true).' >>', array(), null, array('class'=>'disabled'));?>
	</span>
</div>