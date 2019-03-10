<?php ob_start(); ?>
<section id="service" class="home-section text-center bg-gray">

<h1 class="mt-5">Ajouter une voiture</h1>

<form action="<?= url('voitures/save') ?>" method="post">

<div class="form-row mx-2 mt-5">
    <div class="form-group col-md-6">
      <input class="form-control" type="text" name="marque" placeholder="Marque">
    </div>
    <div class="form-group col-md-3">
    <input class="form-control" type="text" name="modele" placeholder="Modèle">
    </div>
    <div class="form-group col-md-3">
    <input class="form-control" type="text" name="couleur" placeholder="Couleur">
    </div>
  </div>
  <div class="form-row mx-2">
    <div class="form-group col-md-6">
    <input class="form-control" type ="date" name="annee_mise_location" placeholder="Année de mise en location">
    </div>
    <div class="form-group col-md-6">
    <input class="form-control" type="text" name="plaque_immat" placeholder="Plaque Immatriculation">
    </div>
  </div>
  <button class="btn btn-success mt-5" type="submit">Ajouter une voiture au garage de la location</button>




</form>
</section>

<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>