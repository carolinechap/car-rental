<?php

class VoituresController {

    private $manager;

    public function __construct(){
        $this->manager = new VoitureManager;
    }

    public function index() {
        $voitures = $this->manager->findAll();
        view('voitures.index', compact('voitures'));
    }

    public function show($id) {
        $voiture = $this->manager->findOne($id);
        view('voitures.show', compact('voiture'));
    }

    public function add() {
        view('voitures.add');
    }

    public function save() {
        //attention ne pas oublier de faire le $date = new date time !!
        $date = new DateTime($_POST['annee_mise_location']);

        $voiture = new Voiture($_POST['marque'], $_POST['modele'], $date, $_POST['plaque_immat'], $_POST['couleur']);

        $this->manager->save($voiture);
        Header('Location: '. url('voitures'));
        // exit();
    }

    public function delete($id) {
        $voiture = $this->manager->findOne($id);
        $voiture->delete();
        // Header('Location: '. url('voitures'));
        // exit();
    }
}