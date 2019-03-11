<?php

class StoresController {

    private $manager;

    public function __construct(){
        $this->manager = new StoreManager;
    }

    public function index() {
        $stores = $this->manager->findAll();
        view('stores.index', compact('stores'));
    }

    public function show($id) {
        $store = $this->manager->findOne($id);
        view('stores.show', compact('store'));
    }

    public function add() {
        view('stores.add');
    }

    public function save() {
        $store = new Store($_POST['ville'], $_POST['pays']);

        $this->manager->save($store);
        Header('Location: '. url('stores'));
        // exit();
    }

    public function delete($id) {
        $store = $this->manager->findOne($id);
        $this->manager->delete($store);
        // Header('Location: '. url('conducteurs'));
        // exit();
    }
}