<?php ob_start(); ?>
<section id="service" class="home-section text-center">

<form action="<?= url('stores/save') ?>" method="post" class="form">
<h2 class="text-center mt-5">Ajouter une agence</h2>
<div class="form-row mx-2 mt-5 justify-content-center">
    <div class="form-group col-4">
        <input class="form-control" type="text" name="ville" placeholder="Ville">
    </div>

    <div class="form-group col-4">
        <input class="form-control" type="text" name="pays" placeholder="Pays">

    </div>

</div>


    <div class="form-group col-12 d-flex justify-content-center mt-2">
    <button class="btn btn-success" type="submit">Ajouter une agence</button>
</div>
</form>

</section>

<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>