<?php ob_start(); ?>

<h1>Ajouter un employé</h1>

<form action="<?= url('employees/save') ?>" method="post">

    <input class="form-control" type="text" name="nom" placeholder="Nom">
    <input class="form-control" type="text" name="prenom" placeholder="Prénom">
    <select name="emploi">
        <option value="manager" title="Manager">Manager</option>
        <option value="responsable" title="Responsable">Responsable</option>
        <option value="stagiaire" title="Stagiaire">Stagiaire</option>
        <option value="conseiller" title="Conseiller">Conseiller</option>
    </select>
    <select name="id_store">
        <?php foreach($stores as $s) : ?>
        <option value="<?= $s->id(); ?>">
        <?= $s->ville(); ?>
        </option>

        <?php endforeach; ?>

    </select>


    <button class="btn btn-primary" type="submit">Ajouter un employé à l'agence</button>

</form>


<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>