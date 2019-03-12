<?php ob_start(); ?>
<section id="service" class="home-section text-center">

  <div class="heading-about">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-lg-offset-2  d-flex justify-content-center">
          <div class="section-heading">
            <h2>Nos agences de location</h2>
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
          <h5>Ajouter une agence</h5>
          <a class="btn btn-success mt-2 mb-5 btn-lg d-flex justify-content-center" href="<?= url('stores/add') ?>">Ajouter</a>
        </div>
      </div>
    </div>
  </div>
  <?php if (empty($stores)) {}
    else{ ?>
  <table class="table table-striped table-hover">
    <tr>
        <th>Ville</th>
        <th>Pays</th>
        <th class="text-center">Suppression</th>
    </tr>

    <?php foreach($stores as $store) : ?>
        <tr>
            <td><?= $store->ville() ;?></td>
            <td><?= $store->pays() ;?></td>
            <td class="text-center">
            <a class="delete" href="<?= url('stores/delete/' . $store->id()) ?>"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php } ?>
</div>
</section>



<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>