<?php ob_start(); ?>
<section id="service" class="home-section text-center bg-gray">

  <div class="heading-about">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-lg-offset-2  d-flex justify-content-center">
            <div class="section-heading">
              <h2>Les voitures</h2>
              <i class="fa fa-2x fa-angle-down"></i>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <hr>
    <div class="row">
      <div class="col-md-12">
        <div>
            <div class="service-desc">
              <h5>Ajouter une voiture</h5>
              <a class="btn btn-success mt-2 mb-5 btn-lg d-flex justify-content-center" href="<?= url('voitures/add') ?>">Ajouter</a>
            </div>
        </div>
      </div>
      <?php
    foreach ($voitures as $voiture) {
     ?>
      <div class="col-md-3">
        <div>
          <h5>
            <?= $voiture->marque() ;?> -
            <?= $voiture->modele() ;?>
          </h5>
          <p>Couleur :
            <?= $voiture->couleur() ;?>
          </p>
          <p>Plaque d'immatriculation : <br>
            <?= $voiture->plaqueImmat() ;?>
          </p>
          <p>Date de mise en location :
            <?= $voiture->anneeMiseEnLoc() ;?>
          </p>
        </div>
    </div>
        <?php }?>
      </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>