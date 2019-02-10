<?php 

class Store extends Db{

    protected $id;
    protected $ville;
    protected $pays;

    const TABLE_NAME = 'store';

    public function __construct($ville, $pays, $id = null){
        $this->setVille($ville);
        $this->setPays($pays);
        $this->setId($id);
        
    }

    public function id(){
        return $this->id;
    }

    public function ville(){
        return $this->ville;
    }

    public function pays(){
        return $this->pays;
    }




    public function setId($id){
        $this->id = $id;
    }

    public function setVille($ville){
        if (strlen($ville) == 0) {
            throw new Exception('La ville ne peut pas être vide.');
        }
        if (strlen($ville) > 150) {
            throw new Exception('La ville ne peut pas être supérieur à 150 caractères.');
        }
        $this->ville = $ville;
        return $this;
    }
    public function setPays($pays){
        if (strlen($pays) == 0) {
            throw new Exception('Le pays ne peut pas être vide.');
        }
        if (strlen($pays) > 150) {
            throw new Exception('Le pays ne peut pas être supérieur à 150 caractères.');
        }
        $this->pays = $pays;
        return $this;
    }

    public function save(){
        $data =[
            'ville'             => $this->ville(),
            'pays'              => $this->pays()


        ]; 
        if ($this->id() > 0) return $this->update();

        $nouvelElem = Db::dbCreate(self::TABLE_NAME, $data);

        $this->setId($nouvelElem);

        return $this;
    }

    public function update() {

        if ($this->id > 0) {

            $data = [
                'ville'             => $this->ville(),
                'pays'              => $this->pays(),
                "id"                => $this->id()
            ];

            Db::dbUpdate(self::TABLE_NAME, $data);

            return $this;
        }

        return;
    }

    public function delete() {
        $data = [
            'id' => $this->id(),
        ];
        
        Db::dbDelete(self::TABLE_NAME, $data);

        return;
    }

    public static function findAll($objects = true) {

        $data = Db::dbFind(self::TABLE_NAME);
        
        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {


                $objectsList[] = new Store ($d['ville'], $d['pays'], intval($d['id']));
            }
            return $objectsList;
        }

        return $data;
    }
    public static function find(array $request, $objects = true) {

        $data = Db::dbFind(self::TABLE_NAME, $request);

        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {

                $objectsList[] = new Store ($d['ville'], $d['pays'], intval($d['id']));

            }
            return $objectsList;
        }

        return $data;
    }
    public static function findOne(int $id, $object = true) {

        $request = [
            ['id', '=', $id]
        ];

        $data = Db::dbFind(self::TABLE_NAME, $request);

        if (count($data) > 0) $data = $data[0];
        else return;

        if ($object) {

            $store = new Store ($data['ville'], $data['pays'], intval($data['id']));
            return $store;
        }

        return $data;
    }

    public function employees() {
        return Employee::find([
            ['id_store', '=', $this->id()]
        ]);
    }


}