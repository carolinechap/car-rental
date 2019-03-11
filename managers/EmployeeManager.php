<?php 

class EmployeeManager extends AbstractManager {

    public $tableName;

    public function __construct() {

        $this->tableName = $GLOBALS['DB_PREFIX'] . "employee";

    }

    public function save(Employee $employee){
        $data =[
            'nom'           => $employee->nom(),
            'prenom'        => $employee->prenom(),
            'emploi'        => $employee->emploi(),
            'id_store'      => $employee->idStore(),

        ];
        if ($employee->id() > 0) return $this->update();

        $nouvelElem = Db::dbCreate($this->tableName, $data);

        $employee->setId($nouvelElem);

        return $employee;
    }

    public function update(Employee $employee) {

        if ($this->id > 0) {

            $data = [
                'nom'           => $employee->nom(),
                'prenom'        => $employee->prenom(),
                'emploi'        => $employee->emploi(),
                'id_store'      => $employee->idStore(),
                "id"            => $employee->id()
            ];

            Db::dbUpdate($this->tableName, $data);

            return $employee;
        }

        return;
    }

    public function delete(Employee $employee) {
        $data = [
            'id' => $employee->id(),
        ];
        
        Db::dbDelete($this->tableName, $data);

        return;
    }

    public function findAll($objects = true) {

        $data = Db::dbFind($this->tableName);
        
        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {

                $sm = new StoreManager;

                $store = $sm->findOne($d['id_store']);
                $objectsList[] = new Employee ($d['nom'], $d['prenom'], $d['emploi'], $store, intval($d['id']));
            }
            return $objectsList;
        }

        return $data;
    }
    public function find(array $request, $objects = true) {

        $data = Db::dbFind($this->tableName, $request);

        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {

                $sm = new StoreManager;
                $store = $sm->findOne($d['id_store']);
                $objectsList[] = new Employee ($d['nom'], $d['prenom'], $d['emploi'], $store, intval($d['id']));

            }
            return $objectsList;
        }

        return $data;
    }

    public function findOne(int $id, $object = true) {

        $request = [
            ['id', '=', $id]
        ];

        $data = Db::dbFind($this->tableName, $request);

        if (count($data) > 0) $data = $data[0];
        else return;

        if ($object) {

            $sm = new StoreManager;
            $store = $sm->findOne($data['id_store']);
            $employee = new Employee ($data['nom'], $data['prenom'], $data['emploi'], $store, intval($data['id']));
            return $employee;
        }

        return $data;
    }

}