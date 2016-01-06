<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>Nouveau message</h3>
            </div>
            <p>Expéditeur : <strong><?= $name; ?></strong></p>
            <p>Email : <strong><?= $mail; ?></strong></p>
            <p>Société : <strong><?= $company; ?></strong></p>
            <p>Sujet : <strong><?= $subject; ?></strong></p>
            <hr>
            <div class="col-md-8 col-md-offset-2">
                <?= nl2br(h($message)); ?>
            </div>
        </div>
    </div>
</div>