<h3>Navigation</h3>
<ul class="nav nav-pills nav-stacked">
    <li<?php if($this->request->controller == 'comments'): ?> class="active"<?php endif; ?>>
        <?= $this->Html->link('Mes commentaires', array('controller' => 'comments', 'action' => 'user')); ?>
    </li>
    <li<?php if($this->request->action == 'edit'): ?> class="active"<?php endif; ?>>
        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'edit')); ?>
    </li>
    <li<?php if($this->request->action == 'logout'): ?> class="active"<?php endif; ?>>
        <?= $this->Html->link('Se déconnecter', array('controller' => 'users', 'action' => 'logout')); ?>
    </li>
</ul>