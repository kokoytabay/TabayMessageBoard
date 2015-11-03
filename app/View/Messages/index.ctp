<?php $this->start('script'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<?php echo $this->Html->script('jquery.jscroll.min.js'); ?>
	<?php echo $this->Html->script('script.js'); ?>
<?php $this->end(); ?>

<div class="messages index">
	<div class="clearfix">
		<div class="float-left actions">
			<?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?>
		</div>

		<div class="float-right search-container">
			<form id="search-form" method="get" class="search" action="<?php echo $this->Html->url(array('action' => 'search')); ?>">
				<input type="text" name="search" id="search">
				<input type="submit" value="Search">
			</form>
		</div>
	</div>

	<div class="messages-list">
		<?php if(!empty($messages)): ?>
			<?php foreach ($messages as $message): ?>
			<table cellpadding="0" cellspacing="0" with="100%">
				<?php 
					$latestMessageContent = count($message['MessageContent']) - 1;
				?>
				<tr>
					<td rowspan="2" class="messages-avatar">
						<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $message['MessageContent'][$latestMessageContent]['from_id'])); ?>">
						<?php 
							if (!empty($message['MessageContent'][$latestMessageContent]['MessageContentFrom']['image'])) {
								$avatar = $message['MessageContent'][$latestMessageContent]['MessageContentFrom']['image']; 
							} else {
								$avatar = 'default-avatar.png';
							}	
							echo $this->Html->image($avatar); 
						?>
						</a>
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
		<?php else: ?>
			<div class="align-center">No messages found.</div>	
		<?php endif; ?>
	</div>
</div>
