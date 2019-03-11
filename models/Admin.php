<?php

class Admin extends AbstractModel {

    protected $id;
    protected $email;
    protected $password;
    protected $employee;
    protected $idEmployee;

    public function __construct(string $email, string $password, Employee $employee, int $id = null) {

        $this->setEmail($email);
        $this->setEmployee($employee);
        $this->setId($id);

        if ($id !== null) {
            $this->password = $password;
        }

        else {
            $this->setPassword($password);
        }

    }
//getters
    public function id()
    {
        return $this->id;
    }

    public function email()
    {
        return $this->email;
    }
    public function employee(){
        if ($this->employee instanceof Employee){
            return $this->employee;
        }

        $em = new EmployeeManager;
        $this->employee = $em->findOne($this->idEmployee);
        return $this->employee;
    }
    public function idEmployee(){
        return $this->idEmployee;
    }

    public function password()
    {
        return $this->password;
    }

    //setters
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('email non valide');
        }
        $this->email = $email;
        return $this;
    }
    public function setEmployee(Employee $employee){
        $this->idEmployee = $employee->id();
        $this->employee = $employee;
        return $this;
    }

    public function setPassword($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $hash;
        return $this;
    }
}