<ul class="nav navbar-nav">
    <li class="active"><a href="<?= url('/'); ?>">Accueil</a></li>
    <li><a href="<?= url('voitures'); ?>">Nos voitures</a></li>
    <li><a href="<?= url('locations'); ?>">Locations enregistrées</a></li>
    <li><a href="<?= url('agence'); ?>">Agences</a></li>
    <li><a href="<?= url('conducteurs'); ?>">Conducteurs</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon compte <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?= url('login'); ?>">Se connecter</a></li>
            <li><a href="<?= url('admin'); ?>">Espace Admin</a></li>
        </ul>
    </li>
</ul>