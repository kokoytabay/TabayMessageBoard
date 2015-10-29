<?php $this->assign('title', 'Update Profile'); ?>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('gender');
		echo $this->Form->input('birthdate');
		echo $this->Form->input('hobby');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>
