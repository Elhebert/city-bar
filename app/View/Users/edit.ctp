<div class="row">
    <div class="col-md-8">
        <h1>Mon compte</h1>
        <p>&nbsp;</p>
        <div class="col-md-2">
            <?php if ($this->Session->read('Auth.User.avatar')): ?>
                <?= $this->Html->image($this->Session->read('Auth.User.avatari') . '?' . rand(), array('class' => 'img-responsive')); ?>
            <?php endif ?>
        </div>
        <div class="col-md-6">
            <?= $this->Form->create('User', array('type' => 'file')); ?>
                <?= $this->Form->input('avatarf', array('type' => 'file', 'label' => 'Avatar', 'class' => 'form-control', 'required' => false)); ?>
                <?= $this->Form->input('username', array('label' => 'Nom d\'utilisateur', 'disabled' => true, 'value' => $this->Session->read('Auth.User.username'), 'class' => 'form-control')); ?>
                <?= $this->Form->input('firstname', array('label' => 'Prénom', 'value' => $this->Session->read('Auth.User.firstname'), 'class' => 'form-control')); ?>
                <?= $this->Form->input('lastname', array('label' => 'Nom', 'value' => $this->Session->read('Auth.User.lastname'), 'class' => 'form-control')); ?>
                <br>
            <?= $this->Form->end('Modifier '); ?>
        </div>
    </div>
    <div class="col-md-4">
        <?= $this->element('sidebar_account'); ?>
    </div>
</div>