<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <?= $this->Form->create() ?>
                    <div class="form-group row">
                    	<label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                    	<div class="col-md-6">
                    		<?= $this->Form->input('email', ['class' => 'form-control', 'label' => false, 'type' => 'email']) ?>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                    	<div class="col-md-6">
                    		<?= $this->Form->input('password', ['class' => 'form-control', 'label' => false, 'type' => 'password']) ?>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-md-6 offset-md-4">
                    		<div class="form-check">
                    			<?= $this->Form->input('remember', ['class' => 'form-check-input', 'label' => false, 'type' => 'checkbox']) ?>
                    			<label class="form-check-label" for="remember">
                    				Remember Me
                    			</label>
                    		</div>
                    	</div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <?= $this->Form->button('Login', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
                            <?= $this->Html->link('Forgot your password?', ['controller' => 'Users', 'action' => 'resetPassword'], ['class' => 'btn btn-link']) ?>
                        </div>
                    </div>
                    
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

