<h1>Register</h1>
<?= $this->Form->create($user);?>
<?= $this->Form->input('email');?>
<?= $this->Form->input('password');?>
<?= $this->Form->button('Register');?>
<?= $this->Form->end();?>