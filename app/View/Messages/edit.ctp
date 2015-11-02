<div class="messages form">
<?php echo $this->Form->create('Message'); ?>
	<fieldset>
		<legend><?php echo __('Edit Message'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('to_id');
		echo $this->Form->input('from_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
