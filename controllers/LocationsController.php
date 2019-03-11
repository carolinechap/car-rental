<?php

class LocationsController {

    private $manager;

    public function __construct(){
        $this->manager = new LocationManager;
    }

    public function index() {
        $locations = $this->manager->findAll();
        view('locations.index', compact('locations'));
    }

    public function show($id) {
        $location = $this->manager->findOne($id);
        view('locations.show', compact('location'));
    }

    public function add() {

        $cm = new ConducteurManager;
        $vm = new VoitureManager;
        $em = new EmployeeManager;

        $conducteurs = $cm->findAll();
        $voitures = $vm->findAll();
        $employees = $em->findAll();

        view('locations.add', compact('conducteurs', 'voitures', 'employees'));
    }

    public function save() {
        //attention ne pas oublier de faire le $date = new date time !!
        $dateDeb = new DateTime($_POST['date_debut_location']);
        $dateFin = new DateTime($_POST['date_fin_location']);

        $em = new EmployeeManager;

        $employee = $em->findOne($_POST['id_employee']);

        $location = new Location(
            $_POST['id_voiture'],
            $_POST['id_conducteur'],
            $employee,
            $_POST['ville'],
            $dateDeb,
            $dateFin
        );
        $this->manager->save($location);

        Header('Location: '. url('locations'));
        // exit();
    }

    public function delete($id) {
        $location = $this->manager->findOne($id);
        $this->manager->delete($location);
        Header('Location: '. url('locations'));
        // exit();
    }
}