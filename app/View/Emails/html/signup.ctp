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
                <h3>Inscription</h3>
            </div>
            <p>Nom d'utilisateur : <strong><?= $username; ?></strong></p>
            <hr>
            <div class="col-md-8 col-md-offset-2">
                Bonjour <?= $username; ?>,<br>
                <br>
                <p>Bienvenue sur city-bar.be, afin de terminer votre inscription veuillez activer votre compte grâce au lien suivant :</p>
                <p><?= $this->Html->url(array('controller' => 'users', 'action' => 'activate', $id, $token), true); ?></p>

                Merci à vous,

                L'équipe de City-bar.be
            </div>
        </div>
    </div>
</div>