<?php $this->start('script'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<?php echo $this->Html->script('jquery.jscroll.min.js'); ?>
	<?php echo $this->Html->script('script.js'); ?>
<?php $this->end(); ?>

<div class="messages form">
<?php echo $this->Form->create('MessageContent', 
		array(
			'novalidate' => true, 
			'url' => array(
				'controller' => 'messages', 
				'action' => 'addcontent'
			)
		)
	); 
?>
	<fieldset>
	<?php
		echo $this->Form->input('content', 
			array(
				'label' => false,
				'rows' => 6,
				'cols' => 30,
				'error' => false,
				'placeholder' => 'Message'
			)
		);
	?>
	</fieldset>
	<input type="hidden" name="data[MessageContent][message_id]" value="<?php echo $id; ?>">
<?php echo $this->Form->end(__('Reply Message')); ?>
</div>
<div id="loading-reply" class="align-center"></div>

<div class="messages view">
	<div class="messages-list">
		<?php foreach ($messages as $message): ?>
		<table cellpadding="0" cellspacing="0" with="100%">
			<tr>
				<td rowspan="2" class="messages-avatar">
					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $message['MessageContent']['from_id'])); ?>">
					<?php 
						$avatar = (!empty($message['MessageContentFrom']['image'])) ? $message['MessageContentFrom']['image'] : 'default-avatar.png';
						echo $this->Html->image($avatar); 
					?>
					</a>
				</td>
				<td><?php echo nl2br($message['MessageContent']['content']); ?></td>
				<td rowspan="2" class="messages-list-actions actions">
					<?php if($message['MessageContent']['from_id'] == $authUserId): ?>
						<a href="<?php echo $this->Html->url(array('action' => 'deletecontent', $message['MessageContent']['id'])); ?>" class="delete">Delete</a>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="align-right"><?php echo $this->Time->format($message['MessageContent']['created'], '%B %e, %Y %I:%M %p'); ?></td>
			</tr>
		</table>
		<?php endforeach; ?>
		<div class="align-center">
		<?php
			echo $this->Paginator->next('Show More', array(), null, array('class' => 'next disabled'));
		?>
		</div>
	</div>
</div>
