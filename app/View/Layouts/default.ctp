<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?> | 
		Message Board
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
	<div id="container">
		<div id="header" class="clearfix">
			<h1 class="float-left"><?php echo $this->fetch('title'); ?></h1>

			<nav class="float-right">
				<ul>
					<?php if(!$isLoggedIn && ($this->request->params['controller'] != 'users' || $this->request->params['action'] != 'add')): ?>
					<li>
					<?php
						echo $this->Html->link(
						    'Register',
						    array(
						        'controller' => 'users',
						        'action' => 'add'
						    )
						);
					?>
					</li>
					<?php elseif($isLoggedIn): ?>
					<li>Hi, <?php echo $authUserName; ?>!</li>
					<li>
					<?php
						echo $this->Html->link(
						    'Messages',
						    array(
						        'controller' => 'messages',
						        'action' => 'index'
						    )
						);
					?>
					</li>
					<li>
					<?php
						echo $this->Html->link(
						    'View Profile',
						    array(
						        'controller' => 'users',
						        'action' => 'view',
						        $authUserId
						    )
						);
					?>
					</li>
					<li>
					<?php
						echo $this->Html->link(
						    'Update Profile',
						    array(
						        'controller' => 'users',
						        'action' => 'edit',
						        $authUserId
						    )
						);
					?>
					</li>
					<li>
					<?php
						echo $this->Html->link(
						    'Change Password',
						    array(
						        'controller' => 'users',
						        'action' => 'changepassword',
						        $authUserId
						    )
						);
					?>
					</li>
					<li>
					<?php
						echo $this->Html->link(
						    'Logout',
						    array(
						        'controller' => 'users',
						        'action' => 'logout'
						    )
						);
					?>
					</li>
					<?php endif; ?>
				</ul>
			</nav>
		</div>
		<div id="content">
			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>

	<?php echo $this->fetch('script'); ?>
</body>
</html>
