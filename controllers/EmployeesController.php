<?php

class EmployeesController {

    private $manager;

    public function __construct(){
        $this->manager = new EmployeeManager;
    }

    public function index() {
        $sm = new StoreManager;
        $stores =  $sm->findAll();
        $employees = $this->manager->findAll();
        view('employees.index', compact('employees', 'stores'));
    }

    public function show($id) {
        $employee = $this->manager->findOne($id);
        view('employees.show', compact('employee'));
    }

    public function add() {
        $sm = new StoreManager;

        $stores = $sm->findAll();
        view('employees.add', compact('stores'));
    }

    public function save() {

        $sm = new StoreManager;
        $store = $sm->findOne($_POST['id_store']);

        $employee = new Employee($_POST['nom'], $_POST['prenom'], $_POST['emploi'], $store);
        $this->manager->save($employee);
        // Header('Location: '. url(''));
        // exit();
    }

    public function delete($id) {
        $employee = $this->manager->findOne($id);
        $this->manager->delete($employee);
        // Header('Location: '. url(''));
        // exit();
    }
}