<?php $this->assign('title', 'View Profile'); ?>

<div class="users view">
	<div class="profile-view clearfix">
		<div class="float-left">
		<?php 
			$avatar = (!empty($user['User']['image'])) ? $user['User']['image'] : 'default-avatar.png';
			echo $this->Html->image($avatar); 
		?>
		</div>

		<div class="float-left">
			<h2><?php echo h($user['User']['name']); ?></h2>
			<p><?php echo __('Email'); ?>: <?php echo h($user['User']['email']); ?></p>
			<p><?php echo __('Gender'); ?>: <?php echo (!empty($user['User']['gender'])) ? $genderOptions[$user['User']['gender']] : ''; ?></p>
			<p><?php echo __('Birthdate'); ?>: <?php echo $this->Time->format($user['User']['birthdate'], '%B %e, %Y'); ?></p>
			<p><?php echo __('Joined'); ?>: <?php echo $this->Time->format($user['User']['created'], '%B %e, %Y %I:%M %p'); ?></p>
			<p><?php echo __('Joined IP'); ?>: <?php echo h($user['User']['created_ip']); ?></p>
			<p><?php echo __('Modified'); ?>: <?php echo $this->Time->format($user['User']['modified'], '%B %e, %Y %I:%M %p'); ?></p>
			<p><?php echo __('Modified IP'); ?>: <?php echo h($user['User']['modified_ip']); ?></p>
			<p><?php echo __('Last Login'); ?>: <?php echo $this->Time->format($user['User']['last_login_time'], '%B %e, %Y %I:%M %p'); ?></p>
		</div>
	</div>

	<p><?php echo __('Hobby'); ?>:</p>

	<p><?php echo nl2br($user['User']['hobby']); ?></p>
</div>
