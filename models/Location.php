<?php

class Location extends AbstractModel {

    protected $id;
    protected $idConducteur;
    protected $idVoiture;
    protected $idEmployee;
    protected $employee;
    protected $ville;
    protected $dateDebutLoc;
    protected $dateFinLoc;

    public function __construct($idVoiture, $idConducteur, Employee $employee, $ville, DateTime $dateDeb, DateTime $dateFin, $id = null)
    {

        $this->setIdConducteur($idConducteur);
        $this->setIdVoiture($idVoiture);
        $this->setEmployee($employee);
        $this->setId($id);
        $this->setVille($ville);
        $this->setDateDebutLoc($dateDeb);
        $this->setDateFinLoc($dateFin);
    }

    public function id()
    {
        return $this->id;
    }

    public function idConducteur()
    {
        return $this->idConducteur;
    }

    public function idVoiture()
    {
        return $this->idVoiture;
    }

    public function employee(){
        if ($this->employee instanceof Employee){
            return $this->employee;
        }

        $em = new EmployeeManager;
        $this->employee = $em->findOne($this->idEmployee);
        return $this->employee;
    }
    public function idEmployee(){
        return $this->idEmployee;
    }

    public function ville(){
        return $this->ville;
    }
    public function dateDebutLoc(){
        $dateDeb = new DateTime($this->dateDebutLoc);
        $dateFrDeb = $dateDeb->format('d/m/Y');
        return $dateFrDeb;
    }
    public function dateDebutLocUs(){
        $dateDeb = new DateTime($this->dateDebutLoc);
        $dateUsDeb = $dateDeb->format('Y-m-d');
        return $dateUsDeb;
    }

    public function dateDebutLocTimestamp(){
        $dateDeb = new DateTime($this->dateDebutLoc);
        $dateUsDeb = $dateDeb->getTimestamp();
        return $dateUsDeb;
    }


    public function dateFinLoc(){
        $dateFin = new DateTime($this->dateFinLoc);
        $dateFrFin = $dateFin->format('d/m/Y');
        return $dateFrFin;
    }
    public function dateFinLocUs(){
        $dateFin = new DateTime($this->dateFinLoc);
        $dateUsFin = $dateFin->format('Y-m-d');
        return $dateUsFin;
    }

    public function dateFinLocTimestamp(){
        $dateFin = new DateTime($this->dateFinLoc);
        $dateUsFin = $dateFin->getTimestamp();
        return $dateUsFin;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setIdConducteur($idConducteur)
    {
        $this->idConducteur = $idConducteur;
        return $this;
    }

    public function setIdVoiture($idVoiture)
    {
        $this->idVoiture = $idVoiture;
        return $this;
    }

    public function setVille($ville){
        if (strlen($ville) == 0) {
            throw new Exception('Veuillez remplir le champ ville.');
        }
        if (strlen($ville) > 150) {
            throw new Exception('Le champ "ville" ne peut pas être supérieur à 150 caractères.');
        }
        $this->ville = $ville;
        return $this;
    }

    public function setEmployee(Employee $employee){
        $this->idEmployee = $employee->id();
        $this->employee = $employee;
        return $this;
    }

    public function setDateDebutLoc(DateTime $dateDeb){
        $this->dateDebutLoc = $dateDeb->format('Y-m-d');
        return $this;

    }
    public function setDateFinLoc(DateTime $dateFin){
        $this->dateFinLoc = $dateFin->format('Y-m-d');
        return $this;

    }


    public function conducteur() {

        $cm = new ConducteurManager;
         return $cm->findOne($this->idConducteur());
    }

    public function voiture() {
        $vm =  new VoitureManager;
        return $vm->findOne($this->idVoiture());
    }

}