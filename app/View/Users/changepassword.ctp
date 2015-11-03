<?php $this->assign('title', 'Change Password'); ?>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<?php
		echo $this->Form->error('password');
		echo $this->Form->error('confirm_password');
	?>
	<fieldset>
	<?php
		echo $this->Form->input('password', array('label' => 'New Password', 'value' => '', 'error' => false));
		echo $this->Form->input('confirm_password', array('type' => 'password', 'value' => '', 'error' => false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>
