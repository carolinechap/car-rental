<?php ob_start(); ?>


<form action="<?= url('signup') ?>" method="post" class="form">
<h2 class="text-center mt-5">Créer un espace administrateur à un employé</h2>
<div class="form-group mx-2 mt-5">
        <label for="loginEmail">E-mail</label>
        <input id="loginEmail" name="email" type="email" class="form-control" required>
    </div>
<div class="form-row mx-2 mt-2">
    <div class="form-group col-md-6">
    <label for="loginPassword">Mot de passe</label>
        <input id="loginPassword" name="password" type="password" class="form-control" required>
    </div>
    <div class="form-group col-md-6">
    <label for="loginPasswordConfirm">Mot de passe (confirmation)</label>
        <input id="loginPasswordConfirm" name="password_confirm" type="password" class="form-control" required>
    </div>
  </div>
  <div class="d-flex justify-content-center">
  <div class="input-group col-md-6 mb-3">
  <select name="id_employee" class="custom-select">
  <option selected>Choisir un employé</option>
        <?php foreach($employees as $e) : ?>
        <option value="<?= $e->id(); ?>">
        <?= $e->nomComplet(); ?>
        </option>

        <?php endforeach; ?>

    </select>
</div>
</div>

<div class="form-group col-12 d-flex justify-content-center mt-2">
    <button type="submit" class="btn btn-success">Créer mon compte</button>
</div>


</form>

<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>