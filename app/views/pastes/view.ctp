<?php e($this->element('notify'));?>

<div class="viewPaste box">
	<h2><?php __('Paste');?> <?php __('Details');?></h2>
	<?php if ($paste) { ?>
	<div class="inner">
	<div class="permalinks">
		<ul>
			<li>
				Permalink to paste:
				<?php if ($paste['Paste']['private']) { 
								echo $html->link(Configure::read('Site.url') . '/paste/' . $paste['Paste']['priv_stub'], array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['priv_stub']), array('class'=>'pastePermalink', 'title'=>'Permalink to this post'));
						} else {
								echo $html->link(Configure::read('Site.url') . '/paste/' . $paste['Paste']['id'], array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['id']), array('class'=>'pastePermalink', 'title'=>'Permalink to this post'));
						}
					?>
				(<?php echo $html->link('copy', '#', array('class'=>'copy-pastePermalink', 'title'=>'Copy Permalink')); ?>)			
			</li>
			<li>
				<?php if ($paste['Paste']['author'] != 'Anonymous') {
								$author = '/author:' . $paste['Paste']['author'];
							} else {
								$author  = null;
							} 
				?>
				Personal Link:
				<?php echo $html->link(Configure::read('Site.url') . '/add/lang:' . $paste['Language']['class'] . $author, array('controller'=> 'pastes', 'action'=>'add', 'lang:' . $paste['Language']['class'] . $author), array('class'=>'personalLink', 'title'=>'Your own personal link')); ?>
				(<?php echo $html->link('copy', '#', array('class'=>'copy-personalLink', 'title'=>'Copy Personal Link')); ?>)		
			</li>
		</ul>
	</div>
	<div>
		<div id="<?php e($paste['Paste']['id']);?>" class="paste">
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
			<?php if($paste['Paste']['note']) { ?>
			<div class="desc">
				<h3><?php __('Notes');?></h3>
				<span><?php e($paste['Paste']['note']);?></span>
			</div>
			<?php } ?>
			<div class="desc">
				<p>
					<strong>
						To add a comment, double click on the line you wish to comment on, and a popup box will appear.<br />
						To view the comments, either double click the line again, or all comments are shown below the paste.
					</strong>
				</p>
			</div>
			<div class="tasks">
				<?php e($html->link(__('Copy This Paste', true), '#', array('class'=>'copyText'), null, false));?>
				<?php e($html->link(__('Download This Paste', true), array('controller'=> 'pastes', 'action'=>'download', $paste['Paste']['id']), array('class'=>'downloadPaste'), null, false));?>
				<?php e($html->link(__('Edit This Paste', true), array('controller'=> 'pastes', 'action'=>'edit', $paste['Paste']['id']), array('class'=>'ajaxLink', 'title'=>md5(__('Edit', true) . $paste['Paste']['id'])), null, false));?>
				<?php if (isset($paste['Paste']['parent_id'])) { ?>
						<?php e($html->link(__('Download Diff File', true),array('controller'=>'pastes', 'action'=>'diff', $paste['Paste']['parent_id'], $paste['Paste']['id']), array('class'=>'downloadDiff'), null, false));?>
				<?php } ?>
        	</div>
			<div class="geshi-output-view">
				<?php e($geshi->generate($paste['Paste']['paste'], $paste['Language']['class'], array('hlines'=>$paste['Paste']['highlight_lines'])));?>
			</div>
			<div class="viewpaste-plainOutput">
				<?php e($form->input('plain_paste',array('label'=>'','type'=>'textarea','value'=>$paste['Paste']['paste'], 'id'=>'PasteCopy' . $paste['Paste']['id'], 'class'=>'PasteCopy')));?>
			</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="error">
			<strong><?php __('Paste does not exist.');?></strong>
		</div>
	<?php } ?>
	</div>
</div>
<div id="comments" class="box">
	<h2><?php __('All');?> <?php __('Comments');?></h2>
	<div class="inner">
	<?php foreach ($paste['Comment'] as $comment) { ?>
		<?php if ($comment) { ?>
			<div class="comment <?php e($comment['line_position']);?>">
				<div><?php __('Author');?>: <?php e($comment['author']);?> for line <?php e($comment['line_position']);?></div>
				<div><?php e($comment['comment']);?></div>
			</div>
		<?php } else { ?>
			<div>
				<strong>No Comments.</strong>
			</div>
		<?php } ?>
	<?php } ?>
	</div>
</div>