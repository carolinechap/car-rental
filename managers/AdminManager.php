<?php

class AdminManager extends AbstractManager {

    public $tableName;

    public function __construct() {

        $this->tableName = $GLOBALS['DB_PREFIX'] . "admin";

    }

    /**
     * Recherche (SELECT) dans la table 'admin'
     *
     * @param   array $request Array contenant 1+ arrays de type ['champ', 'operateur', 'valeur']
     *
     * @return Admin[]|false
     */
    public function find(array $request) {
        $datas = Db::dbFind( $this->tableName, $request);

        if ( count($datas) > 0 ) {
            $admins = [] ;
            foreach ($datas as $data) {
                $em = new EmployeeManager;
                $employee = $em->findOne($data['id_employee']);
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

    public function save(Admin $admin) {

        $id = Db::dbCreate($this->tableName, [
            'email'         => $admin->email(),
            'password'      => $admin->password(),
            'id_employee'   => $admin->idEmployee(),
        ]);

        $admin->setId($id);

        return $admin;
    }

    public function findByEmail(string $email)
    {
        $data = Db::dbFind($this->tableName, [
            ['email', '=', $email]
        ]);
        if (count($data) > 0) $data = $data[0];
        else return; // throw new Exception('Admin n\'existe pas.');
        $employee = EmployeeManager::findOne($data['id_employee']);
        $admin = new Admin(
            $data['email'],
            $data['password'],
            $employee,
            intval($data['id'])
        );
        return $admin;
    }

    public function findByCredentials(string $email, string $password)
    {
        $data = Db::dbFind($this->tableName, [
            ['email', '=', $email],
            ['email', '=', password_verify($password, PASSWORD_DEFAULT)]
        ]);
        if (count($data) > 0) $data = $data[0];
        else return; // throw new Exception('Admin n\'existe pas.');
        $employee = EmployeeManager::findOne($data['id_employee']);
        $admin = new Admin(
            $data['email'],
            $data['password'],
            $employee,
            intval($data['id'])
        );
        return $admin;
    }

    public function findByEmployee(string $employee)
    {
        $data = Db::dbFind($this->tableName, [
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