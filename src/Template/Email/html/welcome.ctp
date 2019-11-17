<div class="container">
	<h4>Welcome to Drone Clothing Co.</h4>
	<p>
		Please click this link to verify your account.
	</p>
	<p>
		<?= $this->Html->link('Link', $this->Url->build(['controller' => 'Users', 'action' => 'login', '?' => ['user' => $user->verification_token]], true)) ?>
	</p>
</div>