<?php

class Location extends Db {
    
    protected $id;
    protected $idConducteur;
    protected $idVoiture;
    protected $idEmployee;
    protected $employee;
    protected $ville;
    protected $dateDebutLoc;
    protected $dateFinLoc;


    const TABLE_NAME = "location";

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
        $this->employee = Employee::findOne($this->idEmployee);
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
        $dateFrDeb = $dateDeb->format('Y-m-d H:i:s');
        return $dateFrDeb;
    }
    public function dateFinLoc(){
        $dateFin = new DateTime($this->dateFinLoc);
        $dateFrFin = $dateFin->format('Y-m-d H:i:s');
        return $dateFrFin;
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
            throw new Exception('La ville ne peut pas être vide.');
        }
        if (strlen($ville) > 150) {
            throw new Exception('La ville ne peut pas être supérieur à 150 caractères.');
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


    public function save() {

        $data = [
            "id_conducteur"         => $this->idConducteur(),
            "id_voiture"            => $this->idVoiture(),
            "ville"                 => $this->ville(),
            "id_employee"           => $this->idEmployee(),
            "date_debut_location"   => $this->dateDebutLoc(),
            "date_fin_location"     => $this->dateFinLoc(),
        ];

        if ($this->id > 0) return $this->update();

        $nouvelElem = Db::dbCreate(self::TABLE_NAME, $data);

        $this->setId($nouvelElem);

        return $this;
    }

    public function update() {

        if ($this->id > 0) {

            $data = [
                "id_conducteur"         => $this->idConducteur(),
                "id_voiture"            => $this->idVoiture(),
                "ville"                 => $this->ville(),
                "id_employee"           => $this->idEmployee(),
                "date_debut_location"   => $this->dateDebutLoc(),
                "date_fin_location"     => $this->dateFinLoc(),
                "id"                    => $this->id()
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

                $employee = Employee::findOne($d['id_employee']);
                $dateDeb = new DateTime($_POST['date_debut_location']);
                $dateFin = new DateTime($_POST['date_fin_location']);

                $objectsList[] = new Location($d['id_conducteur'], $d['id_voiture'], $employee, $d['ville'], $dateDeb, $dateFin, intval($d['id']));
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
                $employee = Employee::findOne($d['id_employee']);
                $dateDeb = new DateTime($_POST['date_debut_location']);
                $dateFin = new DateTime($_POST['date_fin_location']);

                $objectsList[] = new Location($d['id_conducteur'], $d['id_voiture'], $employee, $d['ville'], $dateDeb, $dateFin, intval($d['id']));
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
            $employee = Employee::findOne($data['id_employee']);
            $dateDeb = new DateTime($_POST['date_debut_location']);
            $dateFin = new DateTime($_POST['date_fin_location']);

            $locations = new Location($data['id_conducteur'], $data['id_voiture'], $employee, $data['ville'], $dateDeb, $dateFin, intval($d['id']));
            return $locations;
        }

        return $data;
    }

    public function conducteur() {
        return Conducteur::findOne($this->idConducteur());
    }

    public function voiture() {
        return Voiture::findOne($this->idVoiture());
    }













    // Liste des noms des conducteurs
    public static function listeNomConducteur() {

        $req = 'SELECT nom, prenom, age
                FROM location
                INNER JOIN conducteur ON conducteur.id = location.id_conducteur';

        return $data = Db::dbQuery($req);
    }

    // Nombre de voiture par conducteur
    public static function nombreVoitureParConducteur() {

        $req = 'SELECT prenom, nom, count(*)
                FROM location
                INNER JOIN conducteur ON conducteur.id = location.id_conducteur
                GROUP BY location.id_conducteur
                ';

        return $data = Db::dbQuery($req);
    }

    // Nombre de location
    public static function nombreLocation() {

        $req = 'SELECT count(*)
                FROM location
                ';

        return $data = Db::dbQuery($req);
    }


    // Nombre de voiture non louées
    public static function listeVoitureNonLouees() {

        $req = 'SELECT *
                FROM voiture
                LEFT JOIN location ON voiture.id = location.id_voiture
                WHERE id_conducteur IS NULL';

        return $data = Db::dbQuery($req);
    }


    // Liste des voitures, avec le nom du conducteur, meme celles qui n'ont pas été louées
    public static function listeVoitureConducteur() {

        $req = 'SELECT nom, prenom, marque, modele
                FROM conducteur
                LEFT JOIN location ON conducteur.id = location.id_conducteur
                LEFT JOIN voiture ON voiture.id = location.id_voiture';

        return $data = Db::dbQuery($req);
    }

}