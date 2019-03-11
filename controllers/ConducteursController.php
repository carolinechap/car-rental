<?php

class ConducteursController {

    private $manager;

    public function __construct() {
        $this->manager = new ConducteurManager;
    }

    public function index() {
        $conducteurs = $this->manager->findAll();
        view('conducteurs.index', compact('conducteurs'));
    }

    public function show($id) {
        $conducteur = $this->manager->findOne($id);
        view('conducteurs.show', compact('conducteur'));
    }

    public function add() {
        view('conducteurs.add');
    }

    public function save() {
        $conducteur = new Conducteur($_POST['nom'], $_POST['prenom'], $_POST['age'], $_POST['codepostal'], $_POST['ville'], $_POST['pays']);
        $this->manager->save($conducteur);
        Header('Location: '. url('conducteurs'));
        // exit();
    }

    public function delete($id) {
        $conducteur = $this->manager->findOne($id);
        $this->manager->delete($conducteur);
        var_dump($conducteur);
        // Header('Location: '. url('conducteurs'));
        // exit();
    }
}