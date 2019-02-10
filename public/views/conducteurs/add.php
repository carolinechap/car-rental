<?php ob_start(); ?>

<h1>Ajouter un conducteur</h1>

<form action="<?= url('conducteurs/save') ?>" method="post">

    <input class="form-control" type="text" name="prenom" placeholder="Prenom">
    <input class="form-control" type="text" name="nom" placeholder="Nom">
    <input class="form-control" type="number" name="age" placeholder="Age">
    <input class="form-control" type="text" name="codepostal" placeholder="Code Postal">
    <input class="form-control" type="text" name="ville" placeholder="Ville">
    <input class="form-control" type="text" name="pays" placeholder="Pays">

    <button class="btn btn-primary" type="submit">Créer un conducteur</button>

</form>


<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>