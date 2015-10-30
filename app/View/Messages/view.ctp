<div class="messages view">
<h2><?php echo __('Message'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($message['Message']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('To Id'); ?></dt>
		<dd>
			<?php echo h($message['Message']['to_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From Id'); ?></dt>
		<dd>
			<?php echo h($message['Message']['from_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($message['Message']['content']); ?>
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
