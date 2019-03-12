<?php ob_start(); ?>
<section id="service" class="home-section text-center">

<h2 class="text-center mt-5">Ajouter un conducteur</h2>

<form action="<?= url('conducteurs/save') ?>" method="post">

<div class="form-row mx-2 mt-5">
    <div class="form-group col-md-6">
        <input class="form-control" type="text" name="nom" placeholder="Nom">
    </div>
    <div class="form-group col-md-3">
        <input class="form-control" type="text" name="prenom" placeholder="Prénom">
    </div>
    <div class="form-group col-md-3">
    <input class="form-control" type="number" name="age" placeholder="Age">
    </div>
  </div>
  <div class="form-row mx-2">
    <div class="form-group col-md-6">
    <input class="form-control" type="text" name="codepostal" placeholder="Code Postal">
    </div>
    <div class="form-group col-md-3">
    <input class="form-control" type="text" name="ville" placeholder="Ville">
    </div>
    <div class="form-group col-md-3">
    <input class="form-control" type="text" name="pays" placeholder="Pays">
    </div>
  </div>

  <button class="btn btn-success mt-5" type="submit">Ajouter un conducteur</button>

</form>

</section>

<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>