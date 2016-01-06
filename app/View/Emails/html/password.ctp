<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <?= $this->Html->image('logo.png'); ?>
            </div>
            <div class="col-md8">
                <h1>CITY-BAR.BE</h1>
            </div>
            <div class="page-header">
                <h3>Régénération de mot de passe</h3>
            </div>
            <p>Nom d'utilisateur : <strong><?= $username; ?></strong></p>
            <hr>
            <div class="col-md-8 col-md-offset-2">
                Bonjour <?= $username; ?>,<br>
                <br>
                <p>Une demande de regénération de mot de passe à été faite. Si vous n'êtes pas à l'origine de celle ci, vous pouvez ignorer ce mail.</p>
                <p>Pour regénérer votre mot de passe merci de cliquer sur ce liens : <a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'password', $id, $token), true); ?>"><?= $this->Html->url(array('controller' => 'users', 'action' => 'password', $id, $token), true); ?></a></p>
                <p><?= $this->Html->url(array('controller' => 'users', 'action' => 'activate', $id, $token), true); ?></p>

                Merci à vous,

                L'équipe de City-bar.be
            </div>
        </div>
    </div>
</div>