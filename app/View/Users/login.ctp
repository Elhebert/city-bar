<div class="col-md-5">
    <h1>S'inscrire</h1>
    <hr>
    <?= $this->Form->create('User', array('action' => 'signup')); ?>
        <?= $this->Form->input('username', array('label' => 'Nom d\'utilisateur','class' => 'form-control')); ?>
        <?= $this->Form->input('password', array('label' => 'Mot de passe','class' => 'form-control')); ?>
        <?= $this->Form->input('password2', array('label' => 'Comfirmer le mot de passe', 'type' => 'password','class' => 'form-control')); ?>
        <?= $this->Form->input('mail', array('label' => 'Email','class' => 'form-control')); ?>
        <br>
    <?= $this->Form->end('S\'inscrire'); ?>
</div>
<div class="col-md-5 col-md-offset-2">
    <h1>Se connecter <small><a href="<?php echo $this->Html->url(array('action'=>'facebook')); ?>" class="facebookConnect"><?= $this->Html->image('fbConnect.png'); ?></a></small></h1>
    <hr>
    <?= $this->Form->create('User', array('action' => 'login')); ?>
        <?= $this->Form->input('username', array('label' => 'Nom d\'utilisateur','class' => 'form-control')); ?>
        <?= $this->Form->input('password', array('label' => 'Mot de passe','class' => 'form-control')); ?>
        <br>
    <?= $this->Form->end('Se connecter'); ?>
    <p><em><?= $this->Html->link('Mot de passe oublié ?', array('action' => 'forgot')); ?></em></p>
</div>