<?php $this->start('script'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<?php echo $this->Html->script('jquery.jscroll.min.js'); ?>
	<?php echo $this->Html->script('script.js'); ?>
<?php $this->end(); ?>

<div class="messages index">
	<p class="actions">
		<?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?>
	</p>

	<div class="messages-list">
		<?php foreach ($messages as $message): ?>
		<table cellpadding="0" cellspacing="0" with="100%">
			<?php 
				$latestMessageContent = count($message['MessageContent']) - 1;
			?>
			<tr>
				<td rowspan="2" class="messages-avatar">
					<?php 
						$avatar = (!empty($message['MessageFrom']['image'])) ? $message['MessageFrom']['image'] : 'default-avatar.png';
						echo $this->Html->image($avatar); 
					?>
				</td>
				<td><?php echo nl2br($message['MessageContent'][$latestMessageContent]['content']); ?></td>
				<td rowspan="2" class="messages-list-actions actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $message['Message']['id'])); ?>
					<?php if($message['Message']['from_id'] == $authUserId): ?>
						<br /><br />
						<a href="<?php echo $this->Html->url(array('action' => 'delete', $message['Message']['id'])); ?>" class="delete">Delete</a>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="align-right"><?php echo $this->Time->format($message['MessageContent'][$latestMessageContent]['created'], '%B %e, %Y %I:%M %p'); ?></td>
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
