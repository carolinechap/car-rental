<?php

class AdminController {

    public function index() {
        view('admin.index');
    }

    public function show($id) {

        $cm = new ConducteurManager;
        $conducteur = $cm->findOne($id);
        view('conducteurs.show', compact('conducteur'));
    }

    public function add() {
        view('conducteurs.add');
    }

    public function save() {
        $conducteur = new Conducteur($_POST['nom'], $_POST['prenom'], $_POST['age'], $_POST['codepostal'], $_POST['ville'], $_POST['pays'], $_POST['id']);

        $cm = new ConducteurManager;
        $cm->save($conducteur);

        // Header('Location: '. url('conducteurs'));
        // exit();
    }

    public function delete($id) {

        $cm = new ConducteurManager;
        $conducteur = $cm->findOne($id);

        $cm->delete($conducteur);

        // Header('Location: '. url('conducteurs'));
        // exit();
    }
}