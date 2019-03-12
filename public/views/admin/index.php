<?php ob_start(); ?>
<section id="service" class="home-section text-center">

<div class="heading-about">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-8 col-lg-offset-2">
          <div class="section-heading">
            <h2 class="text-center">Tableau de bord</h2>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-12">
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="wow fadeInLeft" data-wow-delay="0.2s">
        <div class="service-box">
          <div class="service-desc">
            <h5>Ajouter une voiture</h5>
            <p>L'agence vient d'acquérir un nouveau véhicule ? Ajoutez le au garage de location !</p>
            <a class="btn btn-success my-5 btn-lg d-flex justify-content-center"  href="<?= url('voitures/add') ?>">Ajouter</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="service-box">
          <div class="service-desc">
          <h5>Ajouter un conducteur</h5>
            <p>Un nouveau client ? Ajoutez le au carnet d'adresse de l'agence !</p>
            <a class="btn btn-success my-5 btn-lg d-flex justify-content-center"  href="<?= url('conducteurs/add') ?>">Ajouter</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="service-box">
          <div class="service-desc">
          <h5>Ajouter une location</h5>
            <p>Une demande de location ? Par ici, ajoutez la location à l'agence !</p>
            <a class="btn btn-success my-5 btn-lg d-flex justify-content-center"  href="<?= url('locations/add') ?>">Ajouter</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="service-box">
          <div class="service-desc">
          <h5>Ajouter un employé</h5>
            <p>Un nouvel employé à l'agence ? Ajoutez l'employé à l'équipe de l'agence!</p>
            <a class="btn btn-success my-5 btn-lg d-flex justify-content-center"  href="<?= url('employees/add') ?>">Ajouter</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="service-box">
          <div class="service-desc">
          <h5>Ajouter une agence</h5>
            <p>Extension de l'agence ? Ajoutez une nouvelle agence à la chaîne !</p>
            <a class="btn btn-success my-5 btn-lg d-flex justify-content-center"  href="<?= url('stores/add') ?>">Ajouter</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>