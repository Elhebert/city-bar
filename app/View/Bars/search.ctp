<div class="col-md-12">
    <div class="col-md-offset-4 col-md-4">
        <div class="text-center">
            <?= $this->Form->create('bars', array('action' => 'search', 'class' => 'form-inline')); ?>
                <div class="input-group">
                    <input name="data[Bar][barSalt]" type="text" class="form-control" placeholder="Recherche">

                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">Recherche</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <h3>Résultats de recherche pour : "<?= $barSalt; ?>" : </h3>

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