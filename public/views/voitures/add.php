<?php ob_start(); ?>
<section id="service" class="home-section text-center">

<h2 class="text-center mt-5">Ajouter une voiture</h2>

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
    <div class="form-group col-md-6 text-left">
      <label for="MiseEnLocInput">Année de mise en location : </label>
    <input class="form-control" type ="date" name="annee_mise_location" placeholder="Année de mise en location">
    </div>
    <div class="form-group col-md-6 text-left">
    <label for="PlaqueImmatInput">Plaque d'immatriculation</label>
    <input id="PlaqueImmatInput" class="form-control" type="text" name="plaque_immat">
    </div>
  </div>
  <button class="btn btn-success mt-5" type="submit">Ajouter une voiture au garage de la location</button>




</form>
</section>

<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>