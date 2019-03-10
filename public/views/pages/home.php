<?php ob_start(); ?>
<div class="container-fluid intro px-0">


<div class="container pt-5">

<section id="intro">
  <div class="slogan">
    <h2>Location de voitures</h2>
    <h4>Projet de dashboard d'une agence de location de voitures</h4>
    <a class="btn btn-secondary my-5 btn-lg d-flex justify-content-center"  href="<?= url('signup') ?>">S'inscrire</a>
    <a class="btn btn-secondary my-5 btn-lg d-flex justify-content-center"  href="<?= url('login') ?>">Se connecter</a>
  </div>
</section>
</div>


<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>
