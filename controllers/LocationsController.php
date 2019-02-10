<?php

class LocationsController {

    public function index() {
        $locations = Location::findAll();
        view('locations.index', compact('locations'));
    }

    public function show($id) {
        $location = Location::findOne($id);
        view('locations.show', compact('location'));
    }

    public function add() {

        $conducteurs = Conducteur::findAll();
        $voitures = Voiture::findAll();
        $employees = Employee::findAll();

        view('locations.add', compact('conducteurs', 'voitures', 'employees'));
    }

    public function save() {
        //attention ne pas oublier de faire le $date = new date time !!
        $dateDeb = new DateTime($_POST['date_debut_location']);
        $dateFin = new DateTime($_POST['date_fin_location']);

        $employee = Employee::findOne($_POST['id_employee']);
        
    
        $location = new Location($_POST['id_voiture'], $_POST['id_conducteur'], $employee, $_POST['ville'], $dateDeb, $dateFin);
        $location->save();
        // Header('Location: '. url('locations'));
        // exit();
    }

    public function delete($id) {
        $location = Location::findOne($id);
        $location->delete();
        // Header('Location: '. url('voitures'));
        // exit();
    }
}