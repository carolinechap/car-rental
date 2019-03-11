<?php ob_start(); ?>

<h1>Ajouter une agence</h1>

<form action="<?= url('stores/save') ?>" method="post">

    <input class="form-control" type="text" name="ville" placeholder="Ville">
    <input class="form-control" type="text" name="pays" placeholder="Pays">
  
    <button class="btn btn-primary" type="submit">Ajouter une agence</button>

</form>


<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>