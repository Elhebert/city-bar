<div class="col-md-5">
    <h1>Vous y êtes presque</h1>

    <?php echo $this->Form->create('User'); ?>
    <?php echo $this->Form->input('username', array('label' => 'Pseudo')); ?>
    <?php echo $this->Form->end('Envoyer'); ?>

</div>