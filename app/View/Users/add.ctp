<?php $this->assign('title', 'Register'); ?>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<?php
		echo $this->Form->error('name');
		echo $this->Form->error('email');
		echo $this->Form->error('password');
		echo $this->Form->error('confirm_password');
	?>
	<fieldset>
	<?php
		echo $this->Form->input('name', array('error' => false));
		echo $this->Form->input('email', array('error' => false));
		echo $this->Form->input('password', array('error' => false));
		echo $this->Form->input('confirm_password', array('type' => 'password', 'error' => false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Register')); ?>
</div>
