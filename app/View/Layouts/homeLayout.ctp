<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Elhebert">

        <title>City-Bar.be</title>

        <?= $this->Html->css('bootstrap.css'); ?>

    </head>
    <body>
        <div class="jumbotron">
            <div class="container home">
                <h1>City-bar.be</h1>
                <p>Le premier site de référencement des bars et cafés de Namur</p>
                <p><?= $this->Html->Link('Par ici', '/bars/A'); ?></p>
            </div>
        </div>

            <?= $this->fetch('content'); ?>

    <?= $this->Html->script('jquery.js'); ?>
    <?= $this->Html->script('bootstrap.js'); ?>
    </body>
</html>