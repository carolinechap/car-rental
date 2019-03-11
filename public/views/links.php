<ul class="nav navbar-nav">
    <li class="active"><a href="<?= url('/'); ?>">Accueil</a></li>
    <?php  if (isset($_SESSION['admin'])) { ?>
    <li><a href="<?= url('voitures'); ?>">Nos voitures</a></li>
    <li><a href="<?= url('locations'); ?>">Locations enregistrées</a></li>
    <li><a href="<?= url('stores'); ?>">Agences</a></li>
    <li><a href="<?= url('conducteurs'); ?>">Conducteurs</a></li>
    <li><a href="<?= url('employees'); ?>">Employees</a></li>
        <li><a href="<?= url('admin'); ?>">Mon tableau de bord  (<?= unserialize($_SESSION['admin'])->employee()->prenom() ?>)</a></li>
        <li><a href="<?= url('logout'); ?>">Deconnexion</a></li>

     <?php }?>
</ul>