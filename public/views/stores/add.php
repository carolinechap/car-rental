<?php ob_start(); ?>
<!-- TODO: -->
<h1>Ajouter une agence</h1>

<form action="<?= url('agences/save') ?>" method="post">

    <input class="form-control" type="text" name="ville" placeholder="Ville">
    <input class="form-control" type="text" name="pays" placeholder="Pays">
    <select name="id_employee">
        <?php foreach($employees as $e) : ?>

        <option value="<?= $e->id(); ?>" title="<?= $e->nom(); ?>">
        <?= $e->nom(); ?> -
        <?= $e->prenom(); ?>
        </option>

        <?php endforeach; ?>

    </select>
    <div class="form-check">
    <?php foreach($voitures as $v) : ?>
        <input class="form-check-input" type="checkbox" value="<?= $v['id']; ?>" id="<?= $v->marque(); ?>/<?= $v->modele(); ?>">
        <label class="form-check-label" for="<?= $v->marque(); ?>/<?= $v->modele(); ?>">
        <?= $v->marque(); ?> - <?= $v->modele(); ?>
        </label>

        <?php endforeach; ?>
    </div>


    <button class="btn btn-primary" type="submit">Ajouter une agence</button>

</form>


<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>