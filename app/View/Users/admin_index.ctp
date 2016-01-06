<div class="col-md-12">
    <ul class="nav nav-tabs">
        <li class="active"><?= $this->Html->link('Utilisateurs', array('admin' => true, 'controller' => 'Users', 'action' => 'index')); ?></li>
        <li><?= $this->Html->link('Commentaires', array('admin' => true, 'controller' => 'Comments', 'action' => 'index')); ?></li>
        <li><?= $this->Html->link('Avis', array('admin' => true, 'controller' => 'Ratings', 'action' => 'index')); ?></li>
    </ul>
    <h1>Liste des utilisateurs</h1>
    <table class="table table-striped table-hover">
        <thead>
            <td>Pseudo</td>
            <td>Nom</td>
            <td>Prénom</td>
            <td>inscription</td>
        </thead>
        <tbody>
            <?php foreach ($userList as $k => $v): ?>
                <tr>
                    <td><?= $v['User']['username']; ?></td>
                    <td><?= $v['User']['lastname']; ?></td>
                    <td><?= $v['User']['firstname']; ?></td>
                    <td><?= $v['User']['created']; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>