<?php 

class StoreManager extends AbstractManager {

    public $tableName;

    public function __construct(){

        $this->tableName = $GLOBALS['DB_PREFIX'] . "store";
    }

    public function save(Store $store){
        $data =[
            'ville'             => $store->ville(),
            'pays'              => $store->pays()


        ]; 
        if ($store->id() > 0) return $this->update();

        $nouvelElem = Db::dbCreate($this->tableName, $data);

        $store->setId($nouvelElem);

        return $store;
    }

    public function update(Store $store) {

        if ($store->id > 0) {

            $data = [
                'ville'             => $store->ville(),
                'pays'              => $store->pays(),
                "id"                => $store->id()
            ];

            Db::dbUpdate($this->tableName, $data);

            return $store;
        }

        return;
    }

    public function delete(Store $store) {
        $data = [
            'id' => $store->id(),
        ];
        
        Db::dbDelete($this->tableName, $data);

        return;
    }

    public function findAll($objects = true) {

        $data = Db::dbFind($this->tableName);
        
        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {


                $objectsList[] = new Store ($d['ville'], $d['pays'], intval($d['id']));
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

                $objectsList[] = new Store ($d['ville'], $d['pays'], intval($d['id']));

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

            $store = new Store ($data['ville'], $data['pays'], intval($data['id']));
            return $store;
        }

        return $data;
    }

    public function employees() {
        return EmployeeManager::find([
            ['id_store', '=', $this->id()]
        ]);
    }


}