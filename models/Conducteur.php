<?php 

class Conducteur extends AbstractModel {

    protected $id;
    protected $nom;
    protected $prenom;
    protected $age;
    protected $codepostal;
    protected $ville;
    protected $pays;

    public function __construct($nom, $prenom, $age, $codepostal, $ville, $pays, $id = null){

        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setAge($age);
        $this->setCodePostal($codepostal);
        $this->setVille($ville);
        $this->setPays($pays);
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
    public function nomComplet() {
        return $this->prenom() . ' ' . $this->nom();
    }

    public function age(){
        return $this->age;
    }

    public function codepostal(){
        return $this->codepostal;
    }

    public function ville(){
        return $this->ville;
    }

    public function pays(){
        return $this->pays;
    }
    public function adresseComplete() {
        return $this->codePostal() . ' ' . $this->ville() . ' (' . $this->pays() . ')';
    }


    public function setId($id){
        $this->id = $id;
    }
    public function setNom($nom){
        if (strlen($nom) == 0) {
            throw new Exception('Veuillez remplir le champ nom');
        }
        if (strlen($nom) > 150) {
            throw new Exception('Le champ nom ne peut pas être supérieur à 150 caractères.');
        }
        $this->nom = $nom;
        return $this;
    }
    public function setPrenom($prenom){
        if (strlen($prenom) == 0) {
            throw new Exception('Veuillez remplir le champ prénom');
        }
        if (strlen($prenom) > 150) {
            throw new Exception('Le champ prénom ne peut pas être supérieur à 150 caractères.');
        }
        $this->prenom = $prenom;
        return $this;
    }
    public function setAge($age){
        if (strlen($age) == 0) {
            throw new Exception('Veuillez remplir le champ âge');
        }
        if (!intval($age)) {
            throw new Exception('L\'age doit être un nombre entier');
        }
        $this->age = $age;
        return $this;
    }
    public function setCodepostal($codepostal){
        if (strlen($codepostal) == 0) {
            throw new Exception('Veuillez remplir le champ code postal.');
        }
        if (strlen($codepostal) > 10) {
            throw new Exception('Le champ code postal ne peut pas être supérieur à 10 caractères.');
        }
        $this->codepostal = $codepostal;
        return $this;
    }
    public function setVille($ville){
        if (strlen($ville) == 0) {
            throw new Exception('Veuillez remplir le champ ville');
        }
        if (strlen($ville) > 150) {
            throw new Exception('Le champ ville ne peut pas être supérieur à 150 caractères.');
        }
        $this->ville = $ville;
        return $this;
    }
    public function setPays($pays){
        if (strlen($pays) == 0) {
            throw new Exception('Veuillez remplir le champ pays');
        }
        if (strlen($pays) > 150) {
            throw new Exception('Le champ pays ne peut pas être supérieur à 150 caractères.');
        }
        $this->pays = $pays;
        return $this;
    }


}