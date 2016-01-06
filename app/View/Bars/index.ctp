<div class="col-md-12">
    <div class="text-center">
        <p>Si vous ne trouvez pas votre bar/café favoris, n'hésitez pas à nous le notifier via le formulaire de contact</p>

        <div class="page-header">
            <h3>bars de la semaine</h3>
        </div>

        <div class="col-md-3 col-sm-3 hidden-xs"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre logo ici', array('class' => 'img-responsive')); ?></p></div>
        <div class="col-md-3 col-sm-3 hidden-xs"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre logo ici', array('class' => 'img-responsive')); ?></p></div>
        <div class="col-md-3 col-sm-3 hidden-xs"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre logo ici', array('class' => 'img-responsive')); ?></p></div>
        <div class="col-md-3 col-sm-3 hidden-xs"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre logo ici', array('class' => 'img-responsive')); ?></p></div>

        <div class="pagination">
            <ul class="pagination">
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == '#') ? 'class="active"' : '' ?>><?= $this->Html->Link('#', '/bars'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'A') ? 'class="active"' : '' ?>><?= $this->Html->Link('A', '/bars/tri/A'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'B') ? 'class="active"' : '' ?>><?= $this->Html->Link('B', '/bars/tri/B'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'C') ? 'class="active"' : '' ?>><?= $this->Html->Link('C', '/bars/tri/C'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'E') ? 'class="active"' : '' ?>><?= $this->Html->Link('E', '/bars/tri/E'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'F') ? 'class="active"' : '' ?>><?= $this->Html->Link('F', '/bars/tri/F'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'G') ? 'class="active"' : '' ?>><?= $this->Html->Link('G', '/bars/tri/G'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'H') ? 'class="active"' : '' ?>><?= $this->Html->Link('H', '/bars/tri/H'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'I') ? 'class="active"' : '' ?>><?= $this->Html->Link('I', '/bars/tri/I'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'L') ? 'class="active"' : '' ?>><?= $this->Html->Link('L', '/bars/tri/L'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'M') ? 'class="active"' : '' ?>><?= $this->Html->Link('M', '/bars/tri/M'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'N') ? 'class="active"' : '' ?>><?= $this->Html->Link('N', '/bars/tri/N'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'P') ? 'class="active"' : '' ?>><?= $this->Html->Link('P', '/bars/tri/P'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'Q') ? 'class="active"' : '' ?>><?= $this->Html->Link('Q', '/bars/tri/Q'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'R') ? 'class="active"' : '' ?>><?= $this->Html->Link('R', '/bars/tri/R'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'S') ? 'class="active"' : '' ?>><?= $this->Html->Link('S', '/bars/tri/S'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'T') ? 'class="active"' : '' ?>><?= $this->Html->Link('T', '/bars/tri/T'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'V') ? 'class="active"' : '' ?>><?= $this->Html->Link('V', '/bars/tri/V'); ?></li>
                <li <?= ($this->params->controller == 'bars' && $this->params->letter == 'X') ? 'class="active"' : '' ?>><?= $this->Html->Link('X', '/bars/tri/X'); ?></li>
            </ul>
        </div>

    </div>
    <div class="col-md-4 text-center col-md-offset-4">
        <p>
            Tri : <a href="<?= $this->Html->url('/bars/sort/alpha'); ?>" class="btn btn-xs <?= ($this->Session->read('sort') == 'pop') ? 'btn-primary' : 'btn-success' ; ?>">Alphabétique</a>
            <a href="<?= $this->Html->url('/bars/sort/pop'); ?>" class="btn btn-xs <?= ($this->Session->read('sort') == 'pop') ? 'btn-success' : 'btn-primary' ; ?>">Popularité</a>
            <br>
        </p>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <table class="table table-striped table-hover">
            <tbody>
                <?php
                    foreach ($barList as $k => $v):
                ?>

                <tr>
                    <td><?= $v['Bar']['name']; ?></td>
                    <td><?= $this->Html->Link('En savoir plus', '/bars/' . $v['Bar']['slug']); ?></td>
                    <td>
                        <input name="star<?= $v['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="1" <?= ($v['Bar']['rate'] == 1) ? 'checked="checked"' : '' ; ?>/>
                        <input name="star<?= $v['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="2" <?= ($v['Bar']['rate'] == 2) ? 'checked="checked"' : '' ; ?>/>
                        <input name="star<?= $v['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="3" <?= ($v['Bar']['rate'] == 3) ? 'checked="checked"' : '' ; ?>/>
                        <input name="star<?= $v['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="4" <?= ($v['Bar']['rate'] == 4) ? 'checked="checked"' : '' ; ?>/>
                        <input name="star<?= $v['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="5" <?= ($v['Bar']['rate'] == 5) ? 'checked="checked"' : '' ; ?>/>
                        (<?= $v['Bar']['nbRate']; ?> avis)
                    </td>
                    <td><?= $v['Bar']['nbComment'] ?> <?= ($v['Bar']['nbComment'] < 2) ? 'commentaire' : 'commentaires'; ?></td>
                </tr>

                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>