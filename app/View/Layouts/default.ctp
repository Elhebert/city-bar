<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->Html->meta('viewport','width=device-width, initial-scale=1.0'); ?>
        <?= $this->Html->meta('robot','index,nofollow'); ?>
        <?= $this->Html->meta('keywords',array('city-bar', 'city', 'bar', 'namur', 'café')); ?>
        <?= $this->Html->meta('description', 'Le premier site de référencement des bars et cafés de Namur'); ?>
        <?= $this->Html->charset(); ?>
        <?= $this->Html->css('bootstrap.css'); ?>
        <?= $this->Html->css('jquery.rating.css'); ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>chope pm.png">

        <title>City-Bar.be</title>

    </head>
    <body>
        <?php require APP . 'Vendor' . DS . 'autoload.php'; ?>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a href="<?= $this->Html->url('/'); ?>"><?= $this->Html->image('logo.png', array('style' => 'width: 55px')); ?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li <?= ($this->params->controller == 'home'  && $this->params->action == 'index') ? 'class="active"' : '' ?>><?= $this->Html->link('Accueil', '/'); ?></li>
                        <li <?= ($this->params->controller == 'bars') ? 'class="active"' : '' ?>><?= $this->Html->link('Liste', '/bars'); ?></li>
                        <li <?= ($this->params->controller == 'home' && $this->params->action == 'about') ? 'class="active"' : '' ?>><?= $this->Html->link('À propos', '/a-propos'); ?></li>
                        <li <?= ($this->params->controller == 'home' && $this->params->action == 'contact') ? 'class="active"' : '' ?>><?= $this->Html->link('Contact', '/contact'); ?></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <form class="navbar-form navbar-left hidden-xs" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Recherche">
                            </div>
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        </form>

                        <li <?= ($this->params->controller == 'users') ? 'class="active"' : '' ?>>
                            <?php if (!$this->Session->read('Auth.User.id')): ?>
                                <a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>"><span class="glyphicon glyphicon-user"></span></a>
                            <?php else: ?>
                                <a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'edit')); ?>"><span class="glyphicon glyphicon-user"></span></a>
                            <?php endif ?>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron test">
            <div class="container">
                <h1>City-bar.be</h1>
                <p>Le premier site de référencement des bars et cafés dans votre ville</p>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <?= $this->Session->flash(); ?>
                <?= $this->Session->flash('auth'); ?>

                <div class="col-md-12">
                    <div class="text-center">
                        <div class="alert alert-warning">
                            <h1>Attention</h1>
                            <p>Ceci est une version de test de city-bar.</p>
                            <p>Il n'est donc pas représentatif du résultat final. Le design et les diverses fonctionnalités sont toujours en cours de développement.</p>
                        </div>
                    </div>
                </div>

                <?= $this->fetch('content'); ?>

                <div class="clearfix"></div>
                <br><br>

            </div>
        </div>

        <footer class="panel-footer">
            <div class="text-center">
                <?= $this->Html->image('fb_small.png'); ?><a href="https://twitter.com/citybar_be" target="_blank"><?= $this->Html->image('twitter_small.png'); ?></a><?= $this->Html->image('gp_small.png'); ?>
                <p>L'abus d'alcool est dangereux pour la santé. A consommer avec modération.</p>
                <p><?= $this->Html->link('City-bar.be', '/'); ?> (c) 2014 - All right reserved.</p>
            </div>
        </footer>


    <?= $this->Html->script('jquery.js'); ?>
    <?= $this->Html->script('bootstrap.js'); ?>
    <?= $this->Html->script('cake-bootstrap.js'); ?>
    <?= $this->Html->script('jquery.MetaData.js'); ?>
    <?= $this->Html->script('jquery.rating.js'); ?>

    <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-48354721-1', 'city-bar.be');
          ga('send', 'pageview');
    </script>
    </body>
</html>