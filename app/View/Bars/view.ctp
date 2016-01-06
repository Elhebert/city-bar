<?= $this->Html->script("http://maps.google.com/maps/api/js?sensor=false"); ?>

<?php
  $map_options = array(
    "id"         => "map_canvas",
    "width"      => "250px",
    "height"     => "250px",
    "zoom"       => 16,
    "type"       => "ROADMAP",
    "custom"     => "mapTypeControl: false, disableDefaultUI: true",
    "localize"   => false,
    "address"    => $barInfo[0]['Bar']['addr'] . ', BELGIUM',
    "marker"     => true,
    "markerTitle"=> $barInfo[0]['Bar']['name'],
    "infoWindow" => false
  );
?>

<div class="col-md-12">
    <h1><?= $barInfo[0]['Bar']['name']; ?></h1>

    <p>
      <input name="star<?= $barInfo[0]['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="1" <?= ($barInfo[0]['Bar']['rate'] == 1) ? 'checked="checked"' : '' ; ?>/>
      <input name="star<?= $barInfo[0]['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="2" <?= ($barInfo[0]['Bar']['rate'] == 2) ? 'checked="checked"' : '' ; ?>/>
      <input name="star<?= $barInfo[0]['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="3" <?= ($barInfo[0]['Bar']['rate'] == 3) ? 'checked="checked"' : '' ; ?>/>
      <input name="star<?= $barInfo[0]['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="4" <?= ($barInfo[0]['Bar']['rate'] == 4) ? 'checked="checked"' : '' ; ?>/>
      <input name="star<?= $barInfo[0]['Bar']['id']; ?>" type="radio" class="star" disabled="disabled" value="5" <?= ($barInfo[0]['Bar']['rate'] == 5) ? 'checked="checked"' : '' ; ?>/>
    </p>
    <br>
    <?= $this->Html->image('http://placehold.it/1170x500&text=Vos photos ici', array('class' => 'img-responsive')); ?>
    <div class="text-center"><?= $this->Html->link('<< Retour', 'Javascript:history.go(-1)'); ?></div>
</div>
 <div class="col-md-8">
    <section class="comments">
        <div class="page-header">
            <h3><?= $nbComment['nb']; ?> Commentaire(s)</h3>
        </div>
            <?php if($nbComment['nb'] != 0){ ?>
                <div class="row">
                    <div class="col-md-12">
                    <!--nocache-->
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
                    <!--/nocache-->
                    </div>
                </div>
            <?php } ?>

        <div class="page-header">
            <h3>Votre avis</h3>
        </div>

        <?= $this->Form->create('Comment'); ?>
            <?php if (!$this->Session->read('Auth.User.id')): ?>
                <?= $this->Form->input('username', array('label' => 'Votre pseudo', 'class' => 'form-control')); ?>
                <?= $this->Form->input('bar_id', array('type' => 'hidden', 'value' => $barInfo[0]['Bar']['id'])); ?>
                <?= $this->Form->input('mail', array('label' => 'Votre email', 'class' => 'form-control')); ?>
                <?= $this->Form->input('content', array('label' => 'Votre message', 'type' => 'textarea', 'class' => 'form-control')); ?>
            <?php else: ?>
                <?= $this->Form->input('bar_id', array('type' => 'hidden', 'value' => $barInfo[0]['Bar']['id'])); ?>
                <div class="col-md-2">
                    <?php if($this->Session->read('Auth.User.avatar')): ?>
                        <?= $this->Html->image($this->Session->read('Auth.User.avatari'), array('class' => 'img-responsive')); ?>
                    <?php endif ?>
                    <div class="text-center">
                        <strong><?= $this->Session->read('Auth.User.username') ?></strong>
                    </div>
                </div>
                <div class="col-md-10">
                    <?= $this->Form->input('content', array('label' => 'Votre message', 'type' => 'textarea', 'class' => 'form-control')); ?>
                </div>
                <div class="clearfix"></div>
            <?php endif ?>
            <br>
        <?= $this->Form->end('Ajouter'); ?>
        <!--/nocache-->
    </section>
</div>
<div class="col-md-4">
    <div class="page-header">
        <h3>Informations</h3>
    </div>

    <table class="table table-striped table-hover">
         <tbody>
             <tr>
                 <td>Adresse</td><td><?= $barInfo[0]['Bar']['addr']; ?>
                 <?= $this->GoogleMap->map($map_options); ?></td>
             </tr>
             <tr>
                 <td>Horaire</td><td><?= $barInfo[0]['Bar']['horaire']; ?></td>
             </tr>
             <tr>
                 <td>Téléphone</td><td><?= $barInfo[0]['Bar']['tel']; ?></td>
             </tr>
             <tr>
                 <td>Email</td><td><?= $barInfo[0]['Bar']['email']; ?></td>
             </tr>
             <tr>
                 <td>Avis</td>
                 <td>
                  <?php if ($this->Session->read('Auth.User.id')): ?>
                    <?php if(!isset($rate[0]['Rating']['rate'])): ?>
                      <?= $this->Form->create('Rating', array('action' => 'rate')); ?>
                      <input name="star" type="hidden" value="0"/>
                      <input name="bar_id" type="hidden" value="<?= $barInfo[0]['Bar']['id']; ?>"/>
                      <input name="star" type="radio" class="star" value="1"/>
                      <input name="star" type="radio" class="star" value="2"/>
                      <input name="star" type="radio" class="star" value="3"/>
                      <input name="star" type="radio" class="star" value="4"/>
                      <input name="star" type="radio" class="star" value="5"/><br>
                      <?= $this->Form->end(array('label' => 'Valider', 'class' => 'btn btn-default btn-xs')); ?>
                    <?php else: ?>
                      <input name="star" type="radio" class="star" disabled="disabled" value="1" <?= ($rate[0]['Rating']['rate'] == 1) ? 'checked="checked"' : '' ; ?>/>
                      <input name="star" type="radio" class="star" disabled="disabled" value="2" <?= ($rate[0]['Rating']['rate'] == 2) ? 'checked="checked"' : '' ; ?>/>
                      <input name="star" type="radio" class="star" disabled="disabled" value="3" <?= ($rate[0]['Rating']['rate'] == 3) ? 'checked="checked"' : '' ; ?>/>
                      <input name="star" type="radio" class="star" disabled="disabled" value="4" <?= ($rate[0]['Rating']['rate'] == 4) ? 'checked="checked"' : '' ; ?>/>
                      <input name="star" type="radio" class="star" disabled="disabled" value="5" <?= ($rate[0]['Rating']['rate'] == 5) ? 'checked="checked"' : '' ; ?>/>
                    <?php endif ?>

                  <?php else: ?>
                    <p>Vous devez être connectez pour notez un bar</p>
                  <?php endif ?>

                 </td>
             </tr>
        </tbody>
    </table>
</div>