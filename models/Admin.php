<?php

class Admin extends Db{

    protected $id;
    protected $email;
    protected $password;
    protected $employee;
    protected $idEmployee;
    
    const TABLE_NAME = 'admin';

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
        $this->employee = Employee::findOne($this->idEmployee);
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
    /**
     * Méthodes CRUD
     */
    
    /**
     * Recherche (SELECT) dans la table 'admin'
     *
     * @param   array $request Array contenant 1+ arrays de type ['champ', 'operateur', 'valeur']
     *
     * @return Admin[]|false
     */
    public static function find(array $request) {
        $datas = Db::dbFind( self::TABLE_NAME, $request);
        
        if ( count($datas) > 0 ) {
            $admins = [] ;
            foreach ($datas as $data) {
                $employee = Employee::findOne($data['id_employee']);
                $admin = new Admin(
                    $data['email'],
                    $data['password'],
                    $employee,
                    intval($data['id'])
                );
                $admins[] = $admin;
            }
            return $admins;
        }
        return false;
    }
    public function save() {
        $id = Db::dbCreate(self::TABLE_NAME, [
            'email' => $this->email(),
            'password' => $this->password(),
            'id_employee' => $this->idEmployee(),
        ]);
        $this->setId($id);
        return $this;
    }

    public static function findByEmail(string $email)
    {
        $data = Db::dbFind(self::TABLE_NAME, [
            ['email', '=', $email]
        ]);
        if (count($data) > 0) $data = $data[0];
        else return; // throw new Exception('Admin n\'existe pas.');
        $employee = Employee::findOne($data['id_employee']);
        $admin = new Admin(
            $data['email'],
            $data['password'],
            $employee,
            intval($data['id'])
        );
        return $admin;
    }
    public static function findByCredentials(string $email, string $password)
    {
        $data = Db::dbFind(self::TABLE_NAME, [
            ['email', '=', $email],
            ['email', '=', password_verify($password, PASSWORD_DEFAULT)]
        ]);
        if (count($data) > 0) $data = $data[0];
        else return; // throw new Exception('Admin n\'existe pas.');
        $employee = Employee::findOne($data['id_employee']);
        $admin = new Admin(
            $data['email'],
            $data['password'],
            $employee,
            intval($data['id'])
        );
        return $admin;
    }
    public static function findByEmployee(string $employee)
    {
        $data = Db::dbFind(self::TABLE_NAME, [
            ['id_employee', '=', $employee]
        ]);
        if (count($data) > 0) $data = $data[0];
        else return; // throw new Exception('Admin n\'existe pas.');
        $admin = new Admin(
            $data['email'],
            $data['password'],
            $data['id_employee'],
            intval($data['id'])
        );
        return $admin;
    }

}