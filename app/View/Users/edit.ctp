<?php $this->assign('title', 'Update Profile'); ?>

<?php $this->start('css'); ?>
	<?php echo $this->Html->css('jquery-ui/jquery-ui.min.css'); ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<?php echo $this->Html->script('jquery-ui.min.js'); ?>
	<?php echo $this->Html->script('script.js'); ?>
<?php $this->end(); ?>

<div class="users form">
<?php echo $this->Form->create('User', array('type' => 'file')); ?>
	<?php
		echo $this->Form->error('name');
		echo $this->Form->error('email');
		echo $this->Form->error('birthdate');
	?>
	<?php if(count($imageErrors) > 0): ?>
		<?php foreach($imageErrors as $imageError): ?>
			<div class="error-message">
				<?php echo $imageError; ?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	<div id="image-preview"></div>
	<fieldset>
	<?php
		echo $this->Form->input('avatar', 
			array(
				'type' => 'file', 
				'label' => 'Upload Photo', 
				'error' => false
			)
		);
		echo $this->Form->input('name', array('error' => false));
		echo $this->Form->input('email', array('error' => false));
		echo $this->Form->input('gender', 
			array(
				'type' => 'select', 
				'empty' => '',
				'options' => $genderOptions	
			)
		);
		echo $this->Form->input('birthdate', array('type' => 'text', 'error' => false));
		echo $this->Form->input('hobby');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>
