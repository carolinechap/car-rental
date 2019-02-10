<?php

class StoresController {

    public function index() {
        $stores = Store::findAll();
        view('stores.index', compact('stores'));
    }

    public function show($id) {
        $store = Store::findOne($id);
        view('stores.show', compact('store'));
    }

    public function add() {
        view('stores.add');
    }

    public function save() {
        $store = new Store($_POST['ville'], $_POST['pays'], $_POST['id']);
        $store->save();
        // Header('Location: '. url('conducteurs'));
        // exit();
    }

    public function delete($id) {
        $store = Store::findOne($id);
        $store->delete();
        // Header('Location: '. url('conducteurs'));
        // exit();
    }
}