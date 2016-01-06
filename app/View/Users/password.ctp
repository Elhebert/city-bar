<div class="col-md-12">

    <h1>Modifier mon mot de passe</h1>

    <?= $this->Form->create('User'); ?>
        <?= $this->Form->input('username', array('label' => 'Nom d\'utilisateur','class' => 'form-control')); ?>
        <?= $this->Form->input('password', array('label' => 'Mot de passe','class' => 'form-control')); ?>
        <?= $this->Form->input('password2', array('label' => 'Comfirmer le mot de passe', 'type' => 'password','class' => 'form-control')); ?>
    <?= $this->Form->end('Modifier mon mot de passe'); ?>

</div>