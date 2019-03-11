<?php 

class Store extends AbstractModel {

    protected $id;
    protected $ville;
    protected $pays;

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


    public function employees() {

        $em = new EmployeeManager;
        return $em->find([
            ['id_store', '=', $this->id()]
        ]);
    }


}