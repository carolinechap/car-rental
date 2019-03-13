<?php

class Voiture extends AbstractModel {

    protected $id;
    protected $marque;
    protected $modele;
    protected $anneeMiseEnLoc;
    protected $plaqueImmat;
    protected $couleur;

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
            throw new Exception('Veuillez remplir le champ de la marque');
        }
        if (strlen($marque) > 150) {
            throw new Exception('Le champ marque ne peut pas être supérieur à 150 caractères.');
        }
        $this->marque = $marque;
        return $this;
    }
    public function setModele($modele){
        if (strlen($modele) == 0) {
            throw new Exception('Veuillez remplir le champ du modèle.');
        }
        if (strlen($modele) > 150) {
            throw new Exception('Le champ modèle ne peut pas être supérieur à 150 caractères.');
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
            throw new Exception('Veuillez remplir le champ de la plaque d\'immatriculation.');
        }
        if (strlen($plaqueImmat) > 20) {
            throw new Exception('Le champ de la plaque d\'immatriculation ne peut pas être supérieur à 20 caractères.');
        }
        $this->plaqueImmat = $plaqueImmat;
        return $this;
    }

    public function setCouleur($couleur){
        if (strlen($couleur) == 0) {
            throw new Exception('Veuillez remplir le champ de la couleur.');
        }
        if (strlen($couleur) > 50) {
            throw new Exception('Le champ de la couleur ne peut pas être supérieur à 50 caractères.');
        }
        $this->couleur = $couleur;
        return $this;
    }
    public function setId($id){
        $this->id = $id;
    }

}