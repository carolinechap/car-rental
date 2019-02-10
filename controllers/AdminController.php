<?php

class AdminController {

    public function index() {
        view('admin.index');
    }

    public function show($id) {
        $conducteur = Conducteur::findOne($id);
        view('conducteurs.show', compact('conducteur'));
    }

    public function add() {
        view('conducteurs.add');
    }

    public function save() {
        $conducteur = new Conducteur($_POST['nom'], $_POST['prenom'], $_POST['age'], $_POST['codepostal'], $_POST['ville'], $_POST['pays'], $_POST['id']);
        $conducteur->save();
        // Header('Location: '. url('conducteurs'));
        // exit();
    }

    public function delete($id) {
        $conducteur = Conducteur::findOne($id);
        $conducteur->delete();
        // Header('Location: '. url('conducteurs'));
        // exit();
    }
}