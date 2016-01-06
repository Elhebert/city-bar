<div class="row">
    <div class="col-md-8">
        <h1>Mes derniers commentaires</h1>

        <?php foreach ($comments as $k => $comment): ?>
            <div class="row">
                <div class="col-md-2">
                    <?php if ($comment['User']['avatar']): ?>
                        <?= $this->Html->image($comment['User']['avatari'], array('class' => 'img-responsive')); ?>
                    <?php endif ?>
                </div>
                <div class="col-md-10">
                    <article>
                        <p><strong><?= h($comment['User']['username']); ?></strong>, <?= $this->Time->timeAgoInWords($comment['Comment']['created']); ?></p>
                        <p>
                            <?= nl2br(h($comment['Comment']['content'])); ?>
                        </p>
                    </article>
                </div>
            </div>
            <hr>
        <?php endforeach ?>

    </div>
    <div class="col-md-4">
        <?= $this->element('sidebar_account'); ?>
    </div>
</div>