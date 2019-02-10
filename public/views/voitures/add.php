<?php ob_start(); ?>

<h1>Ajouter une voiture</h1>

<form action="<?= url('voitures/save') ?>" method="post">

    <input class="form-control" type="text" name="marque" placeholder="Marque">
    <input class="form-control" type="text" name="modele" placeholder="Modèle">
    <input class="form-control" type ="date" name="annee_mise_location" placeholder="Année de mise en location">
    <input class="form-control" type="text" name="plaque_immat" placeholder="Plaque Immatriculation">
    <input class="form-control" type="text" name="couleur" placeholder="Couleur">

    <button class="btn btn-primary" type="submit">Ajouter une voiture au garage de la location</button>

</form>


<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>