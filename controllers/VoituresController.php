<?php

class VoituresController {

    public function index() {
        $voitures = Voiture::findAll();
        view('voitures.index', compact('voitures'));
    }

    public function show($id) {
        $voiture = Voiture::findOne($id);
        view('voitures.show', compact('voiture'));
    }

    public function add() {
        view('voitures.add');
    }

    public function save() {
        //attention ne pas oublier de faire le $date = new date time !!
        $date = new DateTime($_POST['annee_mise_location']);

        $voiture = new Voiture($_POST['marque'], $_POST['modele'], $date, $_POST['plaque_immat'], $_POST['couleur'], $_POST['id']);
        $voiture->save();
        Header('Location: '. url('voitures'));
        // exit();
    }

    public function delete($id) {
        $voiture = Voiture::findOne($id);
        $voiture->delete();
        // Header('Location: '. url('voitures'));
        // exit();
    }
}