
<?php ob_start(); ?>


<form action="<?= url('login') ?>" method="post" class="form">
<h2 class="text-center mt-5">Se connecter à l'espace Admin</h2>
<div class="form-row mx-2 mt-5 justify-content-center">
    <div class="form-group col-4">
        <label for="loginEmail">E-mail</label>
        <input id="loginEmail" name="email" type="email" class="form-control" required>
    </div>

    <div class="form-group col-4">
        <label for="loginPassword">Mot de passe</label>
        <input id="loginPassword" name="password" type="password" class="form-control" required>

    </div>

</div>


    <div class="form-group col-12 d-flex justify-content-center mt-2">
    <button type="submit" class="btn btn-success">Connexion</button>
</div>
</form>

<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>