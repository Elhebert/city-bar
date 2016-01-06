<div class="col-md-8">
    <div class="page-header">
        <h4>Nous contacter</h4>
    </div>
    <!--nocache-->
    <?php
    $options = array(
        'Demande d\'information' => 'Demande d\'information',
        'Demande de partenariat' => 'Demande de partenariat',
        'Suggestions' => 'Suggestions',
        'Autre' => 'Autre',
    );
    ?>
    <?= $this->Form->create('Contact'); ?>
        <?= $this->Form->input('subject', array('label' => 'Sujet *', 'options' => $options, 'empty' => 'Veuillez choisir un sujet', 'class' => 'form-control')); ?>
        <?= $this->Form->input('company', array('label' => 'Votre société', 'class' => 'form-control')); ?>
        <?= $this->Form->input('name', array('label' => 'Votre nom *', 'class' => 'form-control', 'value' => $this->Session->read('Auth.User.username'))); ?>
        <?= $this->Form->input('mail', array('label' => 'Votre adresse mail *', 'class' => 'form-control', 'value' => $this->Session->read('Auth.User.mail'))); ?>
        <?= $this->Form->input('website', array('label' => false, 'class' => 'website_form')); ?>
        <?= $this->Form->input('message', array('label' => 'Votre message *', 'type' => 'textarea', 'class' => 'form-control')); ?>
        <!--/nocache-->
    <?= $this->Form->end('Envoyer'); ?>
</div>
<div class="col-md-4">
    <div class="page-header">
        <h4>Vous pouvez nous retrouver sur :</h4>
    </div>
    <p class="fb"><a href="<?= $this->Html->url('http://facebook.com/citybar.be'); ?>" target="_blank"><?= $this->Html->image('fb_small.png'); ?> /citybar.be</a></p>
    <p class="twitter"><a href="<?= $this->Html->url('https://twitter.com/citybar_be'); ?>" target="_blank"><?= $this->Html->image('twitter_small.png'); ?> @citybar_be</a></p>
    <p class="google"><a href="<?= $this->Html->url('http://plus.google.com/101381680898227406612'); ?>" target="_blank"><?= $this->Html->image('gp_small.png'); ?> +City-Bar.be</a></p>
</div>