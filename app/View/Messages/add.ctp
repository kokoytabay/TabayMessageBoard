<?php $this->assign('title', 'New Message'); ?>

<?php $this->start('css'); ?>
	<?php echo $this->Html->css('select2/select2.css'); ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<?php echo $this->Html->script('select2.min.js'); ?>
	<?php echo $this->Html->script('script.js'); ?>
<?php $this->end(); ?>

<div class="messages form">
<?php echo $this->Form->create('Message', array('novalidate' => true)); ?>
	<?php
		echo $this->Form->error('to_id');
		echo $this->Form->error('content');
	?>
	<fieldset>
	<?php
		echo $this->Form->input('to_id', 
			array(
				'label' => 'Recipient',
				'type' => 'select', 
				'empty' => '',
				'options' => $messageTos,
				'error' => false
			)
		);
		echo $this->Form->input('content', 
			array(
				'label' => 'Message',
				'rows' => 6,
				'cols' => 30,
				'error' => false
			)
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
