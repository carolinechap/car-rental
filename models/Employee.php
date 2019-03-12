<?php

class Employee extends AbstractModel {

    protected $id;
    protected $nom;
    protected $prenom;
    protected $emploi;
    protected $idStore;
    protected $store;

    public $manager;

    public function __construct($nom, $prenom, $emploi, Store $store, $id = null){

        $this->manager = new EmployeeManager;

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
        $this->store = $this->manager->findOne($this->idStore);
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
        $emploiAccepte = ['Manager', 'Responsable', 'Stagiaire', 'Conseiller(e)'];

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

    public function locations() {

        $lm = new LocationManager;

        return $lm->find([
            ['id_location', '=', $this->id()]
        ]);
    }
    public function admins() {

        $am = new AdminManager;

        return $am->find([
            ['id_employee', '=', $this->id()]
        ]);
    }
}