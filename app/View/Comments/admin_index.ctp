<div class="col-md-12">
    <ul class="nav nav-tabs">
        <li><?= $this->Html->link('Utilisateurs', array('admin' => true, 'controller' => 'Users', 'action' => 'index')); ?></li>
        <li class="active"><?= $this->Html->link('Commentaires', array('admin' => true, 'controller' => 'Comments', 'action' => 'index')); ?></li>
        <li><?= $this->Html->link('Avis', array('admin' => true, 'controller' => 'Ratings', 'action' => 'index')); ?></li>
    </ul>
    <h1>Liste des commentaire</h1>
    <?php foreach ($comments as $k => $comment): ?>
        <div class="row">
            <div class="col-md-2">
                <?php if ($comment['User']['avatar']): ?>
                    <?= $this->Html->image($comment['User']['avatari'], array('class' => 'img-responsive', 'style' => 'width: 100px;')); ?>
                <?php endif ?>
            </div>
            <div class="col-md-6">
                <p><strong><?= h($comment['User']['username']); ?></strong>, <?= $this->Time->timeAgoInWords($comment['Comment']['created']); ?></p>
                <p>
                    <?= nl2br(h($comment['Comment']['content'])); ?>
                </p>
                <p><em>à propos de : <?= $this->Html->link($comment['Bar']['name'], $comment['Bar']['url']); ?></em></p>
            </div>
        </div>
        <hr>
    <?php endforeach ?>
</div>