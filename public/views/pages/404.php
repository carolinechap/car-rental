<?php ob_start(); ?>






<a class="btn btn-secondary my-5 btn-lg d-flex justify-content-center"  href="<?= url('signup') ?>">S'inscrire</a>
    <a class="btn btn-secondary my-5 btn-lg d-flex justify-content-center"  href="<?= url('login') ?>">Se connecter</a>

    
<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>