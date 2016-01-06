<div class="col-md-12">
    <div class="container">
        <div class="row">
            <?= $this->Html->script("http://maps.google.com/maps/api/js?sensor=false"); ?>

            <?php
              $map_options = array(
                "id"         => "map_canvas",
                "width"      => "98%",
                "height"     => "500px",
                "zoom"       => 15,
                "type"       => "ROADMAP",
                "custom"     => "mapTypeControl: false, disableDefaultUI: true",
                "localize"   => false,
                "address"    => "Namur; Belgium",
                "marker"     => false,
                "infoWindow" => false
              );
            ?>

            <?= $this->Html->image('map.png', array('class' => 'img-responsive'));//$this->GoogleMap->map($map_options); ?>

            <div class="clearfix"></div>

            <div class="page-header">
                <h3>Comment ça marche ?</h3>
            </div>
            <div class="col-md-4 text-center">
                <h3>Vous cherchez un bar ?</h3>
                <?= $this->Html->image('question.png', array('style' => 'width: 200px')); ?>
            </div>
            <div class="col-md-4 text-center">
                <h3>On vous aide à le choisir</h3>
                <?= $this->Html->image('choix.png', array('style' => 'width: 200px')); ?>
            </div>
            <div class="col-md-4 text-center">
                <h3>On vous y emmène</h3>
                <?= $this->Html->image('localistion.png', array('style' => 'width: 200px')); ?>
            </div>

            <div class="clearfix"></div>

            <div class="page-header">
                <h3>Nos partenaires</h3>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre%20logo%20ici', array('class' => 'img-responsive')); ?></p></div>
            <div class="col-md-3 col-sm-3 col-xs-6"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre%20logo%20ici', array('class' => 'img-responsive')); ?></p></div>
            <div class="col-md-3 col-sm-3 col-xs-6"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre%20logo%20ici', array('class' => 'img-responsive')); ?></p></div>
            <div class="col-md-3 col-sm-3 col-xs-6"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre%20logo%20ici', array('class' => 'img-responsive')); ?></p></div>
            <div class="clearfix"></div>
            <div class="col-md-3 col-sm-3 col-xs-6"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre%20logo%20ici', array('class' => 'img-responsive')); ?></p></div>
            <div class="col-md-3 col-sm-3 col-xs-6"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre%20logo%20ici', array('class' => 'img-responsive')); ?></p></div>
            <div class="col-md-3 col-sm-3 col-xs-6"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre%20logo%20ici', array('class' => 'img-responsive')); ?></p></div>
            <div class="col-md-3 col-sm-3 col-xs-6"><p><?= $this->Html->image('http://placehold.it/200x200&text=Votre%20logo%20ici', array('class' => 'img-responsive')); ?></p></div>
        </div>
    </div>
</div>

