<?php

class EmployeesController {

    public function index() {
        $employees = Employee::findAll();
        view('employees.index', compact('employees'));
    }

    public function show($id) {
        $employee = Employee::findOne($id);
        view('employees.show', compact('employee'));
    }

    public function add() {
        $stores = Store::findAll();
        view('employees.add', compact('stores'));
    }

    public function save() {

        $store = Store::findOne($_POST['id_store']);
        
        $employee = new Employee($_POST['nom'], $_POST['prenom'], $_POST['emploi'], $store);
        $employee->save();
        // Header('Location: '. url(''));
        // exit();
    }

    public function delete($id) {
        $employee = Employee::findOne($id);
        $employee->delete();
        // Header('Location: '. url(''));
        // exit();
    }
}