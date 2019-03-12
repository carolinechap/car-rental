<?php ob_start(); ?>

<section id="service" class="home-section">
    <h2 class="text-center mt-5">Ajouter un employé</h2>

    <form action="<?= url('employees/save') ?>" method="post">

        <div class="form-row mx-2 mt-5">
            <div class="form-group col-md-6">
                <input class="form-control" type="text" name="nom" placeholder="Nom">
            </div>
            <div class="form-group col-md-6">
                <input class="form-control" type="text" name="prenom" placeholder="Prénom">
            </div>
        </div>
        <div class="form-row mx-2">
            <div class="form-group col-md-6">
                <label for="inputVoiture">Poste occupé dans l'agence :</label>
                <select name="emploi" class="custom-select">
                    <option value="Manager" title="Manager">Manager</option>
                    <option value="Responsable" title="Responsable">Responsable</option>
                    <option value="Stagiaire" title="Stagiaire">Stagiaire</option>
                    <option value="Conseiller(e)" title="Conseiller(e)">Conseiller(e)</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="inputConducteur">Agence de :</label>
                <select name="id_store" class="custom-select">
                    <?php foreach($stores as $s) : ?>
                    <option value="<?= $s->id(); ?>">
                        <?= $s->ville(); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-success mt-5" type="submit">Ajouter un employé à l'agence</button>
        </div>
    </form>


    <?php $content = ob_get_clean(); ?>
    <?php view('template', compact('content')); ?>