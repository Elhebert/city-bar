<div class="col-md-12">
    <h1>Rappel du mot de passe</h1>

    <?= $this->Form->create('Users'); ?>
        <?= $this->Form->input('mail', array('class' => 'form-control')); ?>
    <?= $this->Form->end('Regénérer mon mot de passe'); ?>
</div>