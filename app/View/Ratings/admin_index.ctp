<div class="col-md-12">
    <ul class="nav nav-tabs">
        <li><?= $this->Html->link('Utilisateurs', array('admin' => true, 'controller' => 'Users', 'action' => 'index')); ?></li>
        <li><?= $this->Html->link('Commentaires', array('admin' => true, 'controller' => 'Comments', 'action' => 'index')); ?></li>
        <li class="active"><?= $this->Html->link('Avis', array('admin' => true, 'controller' => 'Ratings', 'action' => 'index')); ?></li>
    </ul>
    <h1>Liste des avis</h1>
    <table class="table table-striped table-hover">
        <thead>
            <td>Pseudo</td>
            <td>Bar</td>
            <td>Note</td>
        </thead>
        <tbody>
            <?php foreach ($ratingList as $k => $v): ?>
                <tr>
                    <td><?= $v['User']['username']; ?></td>
                    <td><?= $v['Bar']['name']; ?></td>
                    <td>
                        <input name="star<?= $v['Rating']['id']; ?>" type="radio" class="star" disabled="disabled" value="1" <?= ($v['Rating']['rate'] == 1) ? 'checked="checked"' : '' ; ?>/>
                        <input name="star<?= $v['Rating']['id']; ?>" type="radio" class="star" disabled="disabled" value="2" <?= ($v['Rating']['rate'] == 2) ? 'checked="checked"' : '' ; ?>/>
                        <input name="star<?= $v['Rating']['id']; ?>" type="radio" class="star" disabled="disabled" value="3" <?= ($v['Rating']['rate'] == 3) ? 'checked="checked"' : '' ; ?>/>
                        <input name="star<?= $v['Rating']['id']; ?>" type="radio" class="star" disabled="disabled" value="4" <?= ($v['Rating']['rate'] == 4) ? 'checked="checked"' : '' ; ?>/>
                        <input name="star<?= $v['Rating']['id']; ?>" type="radio" class="star" disabled="disabled" value="5" <?= ($v['Rating']['rate'] == 5) ? 'checked="checked"' : '' ; ?>/>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>