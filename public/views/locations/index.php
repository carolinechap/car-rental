<?php ob_start(); ?>
<section id="service" class="home-section text-center">

  <div class="heading-about">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-lg-offset-2  d-flex justify-content-center">
          <div class="section-heading">
            <h2>Les locations de l'agence</h2>
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
            <h5>Ajouter une location</h5>
            <a class="btn btn-success mt-2 mb-5 btn-lg d-flex justify-content-center" href="<?= url('locations/add') ?>">Ajouter</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mx-0">
      <?php if (empty($locations)) {}
    else{ ?>

      <table class="table table-striped table-hover display" id="tableLocation">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Voiture louée</th>
            <th>Début de location</th>
            <th>Fin de location</th>
            <th>Depuis quelle ville?</th>
            <th class="text-center">Suppression</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($locations as $location) { ?>
          <tr>
            <td>
              <?= $location->conducteur()->nom() ;?>
            </td>
            <td>
              <?= $location->conducteur()->prenom() ;?>
            </td>
            <td>
              <?= $location->voiture()->marque();?> -
              <?= $location->voiture()->modele() ;?>
            </td>
            <td data-sort="<?= $location->dateDebutLocTimestamp(); ?>">
              <?= $location->dateDebutLoc() ;?>
            </td>
            <td data-sort="<?= $location->dateFinLocTimestamp(); ?>">
              <?=$location->dateFinLoc() ; ?>
            </td>
            <td>
              <?= $location->ville() ;?>
            </td>
            <td class="text-center">
              <a class="delete" href="<?= url('locations/delete/' . $location->id()) ?>"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php } ?>
    </div>








  </div>
  </div>
</section>
<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>