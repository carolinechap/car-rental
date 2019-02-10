<?php ob_start(); ?>
<section id="service" class="home-section text-center bg-gray">

<div class="heading-about">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <div class="wow bounceInDown" data-wow-delay="0.4s">
          <div class="section-heading">
            <h2>Les voitures</h2>
            <i class="fa fa-2x fa-angle-down"></i>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-2 col-lg-offset-5">
      <hr class="marginbot-50">
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="wow fadeInLeft" data-wow-delay="0.2s">
        <div class="service-box">
          <div class="service-icon">
            <img src="img/icons/service-icon-1.png" alt="" />
          </div>
          <div class="service-desc">
            <h5>Ajouter une voiture</h5>
            <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p>
            <a class="btn btn-success my-5 btn-lg d-flex justify-content-center"  href="<?= url('conducteurs/add') ?>">Ajouter</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="service-box">
          <div class="service-icon">
            <img src="img/icons/service-icon-2.png" alt="" />
          </div>
          <div class="service-desc">
            <h5>Web Design</h5>
            <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="service-box">
          <div class="service-icon">
            <img src="img/icons/service-icon-3.png" alt="" />
          </div>
          <div class="service-desc">
            <h5>Photography</h5>
            <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="wow fadeInRight" data-wow-delay="0.2s">
        <div class="service-box">
          <div class="service-icon">
            <img src="img/icons/service-icon-4.png" alt="" />
          </div>
          <div class="service-desc">
            <h5>Cloud System</h5>
            <p>Vestibulum tincidunt enim in pharetra malesuada. Duis semper magna metus electram accommodare.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>