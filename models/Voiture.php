<?php

class Voiture extends Db{

    protected $id;
    protected $marque;
    protected $modele;
    protected $anneeMiseEnLoc;
    protected $plaqueImmat;
    protected $couleur;


    const TABLE_NAME = 'voiture';

    public function __construct($marque, $modele, DateTime $date, $plaqueImmat, $couleur, $id = null){
        $this->setMarque($marque);
        $this->setModele($modele);
        $this->setAnneeMiseEnLoc($date);
        $this->setPlaqueImmat($plaqueImmat);
        $this->setCouleur($couleur);
        $this->setId($id);
        
    }

    public function id(){
        return $this->id;
    }

    public function marque(){
        return $this->marque;
    }

    public function modele(){
        return $this->modele;
    }

    public function anneeMiseEnLoc(){
        $date = new DateTime($this->anneeMiseEnLoc);
        $dateFr = $date->format('d/m/Y');
        return $dateFr;
    }

    public function anneeMiseEnLocUs(){
        $date = new DateTime($this->anneeMiseEnLoc);
        $dateUs = $date->format('Y-m-d');
        return $dateUs;
    }

    public function plaqueImmat(){
        return $this->plaqueImmat;
    }

    public function couleur(){
        return $this->couleur;
    }
    


    public function setMarque($marque){
        if (strlen($marque) == 0) {
            throw new Exception('La marque ne peut pas être vide.');
        }
        if (strlen($marque) > 150) {
            throw new Exception('La marque ne peut pas être supérieur à 150 caractères.');
        }
        $this->marque = $marque;
        return $this;
    }
    public function setModele($modele){
        if (strlen($modele) == 0) {
            throw new Exception('Le modele ne peut pas être vide.');
        }
        if (strlen($modele) > 150) {
            throw new Exception('Le modele ne peut pas être supérieur à 150 caractères.');
        }
        $this->modele = $modele;
        return $this;

    }
    public function setAnneeMiseEnLoc(DateTime $date){
        $this->anneeMiseEnLoc = $date->format('Y-m-d');
        return $this;

    }
    public function setPlaqueImmat($plaqueImmat){
        if (strlen($plaqueImmat) == 0) {
            throw new Exception('La plaque d\'immatriculation ne peut pas être vide.');
        }
        if (strlen($plaqueImmat) > 20) {
            throw new Exception('La plaque d\'immatriculation ne peut pas être supérieur à 20 caractères.');
        }
        $this->plaqueImmat = $plaqueImmat;
        return $this;
    }

    public function setCouleur($couleur){
        if (strlen($couleur) == 0) {
            throw new Exception('La couleur ne peut pas être vide.');
        }
        if (strlen($couleur) > 50) {
            throw new Exception('La couleur ne peut pas être supérieur à 50 caractères.');
        }
        $this->couleur = $couleur;
        return $this;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function save(){
        $data =[
            'marque'                => $this->marque(),
            'modele'                => $this->modele(),
            'annee_mise_location'   => $this->anneeMiseEnLocUs(),
            'plaque_immat'          => $this->plaqueImmat(),
            'couleur'               => $this->couleur()

        ]; 
        
        if ($this->id() > 0) return $this->update();

        $nouvelElem = Db::dbCreate(self::TABLE_NAME, $data);

        $this->setId($nouvelElem);

        return $this;
    }

    public function update() {

        if ($this->id > 0) {

            $data = [
                'marque'                => $this->marque(),
                'modele'                => $this->modele(),
                'annee_mise_location'   => $this->anneeMiseEnLocUs(),
                'plaque_immat'          => $this->plaqueImmat(),
                'couleur'               => $this->couleur()
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

        // On supprime aussi toutes les loc
        Db::dbDelete('location', [
            'id_voiture' => $this->id()
        ]);

        return;
    }

    public static function findAll($objects = true) {

        $data = Db::dbFind(self::TABLE_NAME);
        
        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {
                $date = new DateTime($d['annee_mise_location']);
                $objectsList[] = new Voiture($d['marque'], $d['modele'], $date, $d['plaque_immat'], $d['couleur'], intval($d['id']));
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
                $date = new DateTime($d['annee_mise_location']);
                $objectsList[] = new Voiture($d['marque'], $d['modele'], $date, $d['plaque_immat'], $d['couleur'], intval($d['id']));

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
            $date = new DateTime($d['annee_mise_location']);
            $voiture = new Voiture($d['marque'], $d['modele'], $date, $d['plaque_immat'], $d['couleur'], intval($d['id']));
            return $voiture;
        }

        return $data;
    }



}