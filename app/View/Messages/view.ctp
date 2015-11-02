<div class="messages view">
<h2><?php echo __('Message'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($message['Message']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message To'); ?></dt>
		<dd>
			<?php echo $this->Html->link($message['MessageTo']['name'], array('controller' => 'users', 'action' => 'view', $message['MessageTo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message From'); ?></dt>
		<dd>
			<?php echo $this->Html->link($message['MessageFrom']['name'], array('controller' => 'users', 'action' => 'view', $message['MessageFrom']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($message['Message']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($message['Message']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
