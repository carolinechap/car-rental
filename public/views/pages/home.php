<?php ob_start(); ?>
<div class="container-fluid intro">
<div class="container">
  <div class="navbar">
      <a class="navbar-brand" href="<?= url('/'); ?>">
        <h1>Location de voiture</h1>
      </a>
      <?php view('links'); ?>
    </div>
  </div>
<section id="intro">
  <div class="slogan">
    <h2>Location de voiture</h2>
    <h4>Projet PHP POO sous une architecture MVC</h4>
  </div>
</section>
</div>


<?php $content = ob_get_clean(); ?>

<?php view('template', compact('content')); ?>