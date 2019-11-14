
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <?= $this->Form->create() ?>
                    <div class="form-group row">
                    	<label for="first-name" class="col-md-4 col-form-label text-md-right">First Name</label>
                    	<div class="col-md-6">
                    		<?= $this->Form->input('first_name', ['class' => 'form-control', 'label' => false, 'required']) ?>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<label for="last-name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                    	<div class="col-md-6">
                    		<?= $this->Form->input('last_name', ['class' => 'form-control', 'label' => false]) ?>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<label for="email" class="col-md-4 col-form-label text-md-right">Email address</label>
                    	<div class="col-md-6">
                    		<input type="email" name="email" id="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" required>
                    		<?php if (isset($errors['email'])): ?>
                    		<div class="invalid-feedback">
          						<?= $errors['email']['unique'] ?>
        					</div>
                    		<?php endif ?>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<label for="password2" class="col-md-4 col-form-label text-md-right">Password</label>
                    	<div class="col-md-6">
                    		<input type="password" name="password" id="password" required class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
                    		<?php if (isset($errors['password'])): ?>
                    		<div class="invalid-feedback">
          						<?= $errors['password']['compare'] ?>
        					</div>
                    		<?php endif ?>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<label for="password2" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                    	<div class="col-md-6">
                    		<input type="password" name="password2" id="password2" required class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
                    		<?php if (isset($errors['password'])): ?>
                    		<div class="invalid-feedback">
          						<?= $errors['password']['compare'] ?>
        					</div>
                    		<?php endif ?>
                    	</div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <?= $this->Form->button('Register', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

