<?php ob_start(); ?>
<section id="service" class="home-section text-center">

  <div class="heading-about">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-lg-offset-2  d-flex justify-content-center">
          <div class="section-heading">
            <h2>Les employés</h2>
            <i class="fa fa-2x fa-angle-down"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="service-desc">
          <h5>Ajouter un employé</h5>
          <a class="btn btn-success mt-2 mb-5 btn-lg d-flex justify-content-center" href="<?= url('employees/add') ?>">Ajouter</a>
        </div>
      </div>
    </div>
  </div>
  <div class="mx-5">


    <?php if (empty($employees)) {}
    else{ ?>

    <table class="table table-striped table-hover display" id="tableEmployee">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Poste</th>
          <th>Ville (Pays)</th>
          <th class="text-center">Suppression</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($employees as $employee) : ?>
        <tr>
          <td>
            <?= $employee->nom() ;?>
          </td>
          <td>
            <?= $employee->prenom() ;?>
          </td>
          <td>
            <?= $employee->emploi() ;?>
          </td>
          <td>
            <?= $employee->store()->ville() ;?> (
            <?= $employee->store()->pays() ;?>)</td>
          <td class="text-center">
            <a class="delete" href="<?= url('employees/delete/' . $employee->id()) ?>"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php } ?>
  </div>
</section>



<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>