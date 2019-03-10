<?php 

class Employee extends Db{

    protected $id;
    protected $nom;
    protected $prenom;
    protected $emploi;
    protected $idStore;
    protected $store;


    const TABLE_NAME = 'employee';

    public function __construct($nom, $prenom, $emploi, Store $store, $id = null){
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmploi($emploi);
        $this->setStore($store);
        $this->setId($id);
        
    }

    public function id(){
        return $this->id;
    }

    public function nom(){
        return $this->nom;
    }

    public function prenom(){
        return $this->prenom;
    }

    public function emploi(){
        return $this->emploi;
    }
    public function store(){
        if ($this->store instanceof Store){
            return $this->store;
        }
        $this->store = Store::findOne($this->idStore);
        return $this->store;
        
    }
    public function idStore(){
        return $this->idStore;
    }



    public function setId($id){
        $this->id = $id;
    }
    public function setNom($nom){
        if (strlen($nom) == 0) {
            throw new Exception('Le nom ne peut pas être vide.');
        }
        if (strlen($nom) > 150) {
            throw new Exception('Le nom ne peut pas être supérieur à 150 caractères.');
        }
        $this->nom = $nom;
        return $this;
    }
    public function setPrenom($prenom){
        if (strlen($prenom) == 0) {
            throw new Exception('Le prenom ne peut pas être vide.');
        }
        if (strlen($prenom) > 150) {
            throw new Exception('Le prenom ne peut pas être supérieur à 150 caractères.');
        }
        $this->prenom = $prenom;
        return $this;
    }
    public function setEmploi($emploi){
        $emploiAccepte = ['manager', 'responsable', 'stagiaire', 'conseiller'];

        if (strlen($emploi) == 0) {
            throw new Exception('L\'emploi ne peut pas être vide.');
        }
        if (!in_array($emploi, $emploiAccepte) ) {
            throw new Exception('L\'emploi n\'est pas accepté.');
        }
        $this->emploi = $emploi;
        return $this;
    }

    public function setStore(Store $store){
        $this->idStore = $store->id();
        $this->store = $store;
        return $this;
    }
    
    public function nomComplet(){
        return $this->nom() . ' - ' . $this->prenom();
    }


    public function save(){
        $data =[
            'nom'           => $this->nom(),
            'prenom'        => $this->prenom(),
            'emploi'        => $this->emploi(),
            'id_store'      => $this->idStore(),

        ]; 
        if ($this->id() > 0) return $this->update();

        $nouvelElem = Db::dbCreate(self::TABLE_NAME, $data);

        $this->setId($nouvelElem);

        return $this;
    }

    public function update() {

        if ($this->id > 0) {

            $data = [
                'nom'           => $this->nom(),
                'prenom'        => $this->prenom(),
                'emploi'        => $this->emploi(),
                'id_store'      => $this->idStore(),
                "id"            => $this->id()
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

                $store = Store::findOne($d['id_store']);
                $objectsList[] = new Employee ($d['nom'], $d['prenom'], $d['emploi'], $store, intval($d['id']));
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

                $store = Store::findOne($d['id_store']);
                $objectsList[] = new Employee ($d['nom'], $d['prenom'], $d['emploi'], $store, intval($d['id']));

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

            $store = Store::findOne($data['id_store']);
            $employee = new Employee ($data['nom'], $data['prenom'], $data['emploi'], $store, intval($data['id']));
            return $employee;
        }

        return $data;
    }
    
    public function locations() {
        return Location::find([
            ['id_location', '=', $this->id()]
        ]);
    }
    public function admins() {
        return Admin::find([
            ['id_employee', '=', $this->id()]
        ]);
    }
}