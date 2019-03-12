<?php ob_start(); ?>
<section id="service" class="home-section">
<h2 class="text-center mt-5">Ajouter une location</h2>

<form action="<?= url('locations/save') ?>" method="post">


    <div class="form-row mx-2 mt-5">
        <div class="form-group col-md-6">
            <label for="inputDateDeb">Date de début : </label>
            <input id="inputDateDeb" class="form-control" type="date" name="date_debut_location" placeholder="Date de début">
        </div>
        <div class="form-group col-md-6">
            <label for="inputDateFin">Date de fin : </label>
            <input id="inputDateFin" class="form-control" type="date" name="date_fin_location" placeholder="Date de fin">
        </div>
    </div>
    <div class="form-row mx-2">
        <div class="form-group col-md-6">
            <label for="inputConducteur">Conducteur : </label>
            <select id="inputConducteur" name="id_conducteur" class="custom-select">
                <?php foreach($conducteurs as $c) : ?>
                <option value="<?= $c->id(); ?>">
                    <?= $c->nom(); ?> -
                    <?= $c->prenom(); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
        <label for="inputVoiture">Voiture : </label>
            <select id="inputVoiture" name="id_voiture" class="custom-select">
                <?php foreach($voitures as $v) : ?>
                <option value="<?= $v->id(); ?>">
                    <?= $v->marque(); ?> -
                    <?= $v->modele(); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-row mx-2">
        <div class="form-group col-md-6">
            <label for="inputVille">Ville de retrait : </label>
            <input id="inputVille" class="form-control" type="text" name="ville" placeholder="Ville">
        </div>
        <div class="form-group col-md-6">
            <label for="employeeInput">Agent de réservation : </label>
            <select id="employeeInput" name="id_employee" class="custom-select">
                <?php foreach($employees as $e) : ?>

                <option value="<?= $e->id(); ?>">
                    <?= $e->nom(); ?> -
                    <?= $e->prenom(); ?> (<?= $e->store()->ville(); ?> - <?= $e->store()->pays(); ?>)
                </option>

                <?php endforeach; ?>

            </select>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-success mt-5" type="submit">Ajouter une location</button>
    </div>

</form>
</section>

<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>