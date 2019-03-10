<?php ob_start(); ?>

<h1>Ajouter une location</h1>

<form action="<?= url('locations/save') ?>" method="post">

    <input class="form-control" type="text" name="ville" placeholder="Ville">
    <select name="id_conducteur">
        <?php foreach($conducteurs as $c) : ?>

        <option value="<?= $c->id(); ?>">
        <?= $c->nom(); ?> -
        <?= $c->prenom(); ?>
        </option>

        <?php endforeach; ?>

    </select>
    <select name="id_voiture">
        <?php foreach($voitures as $v) : ?>

        <option value="<?= $v->id(); ?>">
        <?= $v->marque(); ?> - <?= $v->modele(); ?>
        </option>

        <?php endforeach; ?>

    </select>
    <select name="id_employee">
        <?php foreach($employees as $e) : ?>

        <option value="<?= $e->id(); ?>">
        <?= $e->nom(); ?> -
        <?= $e->prenom(); ?>
        </option>

        <?php endforeach; ?>

    </select>

    <input class="form-control" type="date" name="date_debut_location" placeholder="Date de début">
    <input class="form-control" type="date" name="date_fin_location" placeholder="Date de fin">

    <button class="btn btn-primary" type="submit">Ajouter une location</button>

</form>


<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>