<?php if(!empty($messages)): ?>
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
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $message['Message']['id'])); ?>
				<?php if($message['Message']['from_id'] == $authUserId): ?>
					<br /><br />
					<a href="<?php echo $this->Html->url(array('action' => 'delete', $message['Message']['id'])); ?>" class="delete">Delete</a>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="align-right"><?php echo $this->Time->format($message['MessageContent']['created'], '%B %e, %Y %I:%M %p'); ?></td>
		</tr>
	</table>
	<?php endforeach; ?>
<?php else: ?>
	<div class="align-center">No messages found</div>	
<?php endif; ?>