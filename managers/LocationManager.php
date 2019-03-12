<?php

class LocationManager extends AbstractManager {
    
    public $tableName;

    public function __construct()
    {
        $this->tableName = $GLOBALS['DB_PREFIX'] . "location";

    }

    public function save(Location $location) {

        $data = [
            "id_conducteur"         => $location->idConducteur(),
            "id_voiture"            => $location->idVoiture(),
            "ville"                 => $location->ville(),
            "id_employee"           => $location->idEmployee(),
            "date_debut_location"   => $location->dateDebutLocUs(),
            "date_fin_location"     => $location->dateFinLocUs(),
        ];

        if ($location->id() > 0) return $this->update();

        $nouvelElem = Db::dbCreate($this->tableName, $data);

        $location->setId($nouvelElem);

        return $location;
    }

    public function update(Location $location) {

        if ($location->id() > 0) {

            $data = [
                "id_conducteur"         => $location->idConducteur(),
                "id_voiture"            => $location->idVoiture(),
                "ville"                 => $location->ville(),
                "id_employee"           => $location->idEmployee(),
                "date_debut_location"   => $location->dateDebutLoc(),
                "date_fin_location"     => $location->dateFinLoc(),
                "id"                    => $location->id()
            ];

            Db::dbUpdate($this->tableName, $data);

            return $location;
        }

        return;
    }

    public function delete(Location $location) {
        $data = [
            'id' => $location->id(),
        ];
        
        Db::dbDelete($this->tableName, $data);
        return;
    }

    public function findAll($objects = true) {

        $data = Db::dbFind($this->tableName);
        
        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {

                $em =  new EmployeeManager;
                $employee = $em->findOne($d['id_employee']);
                $dateDeb = new DateTime($d['date_debut_location']);
                $dateFin = new DateTime($d['date_fin_location']);

                $objectsList[] = new Location($d['id_voiture'], $d['id_conducteur'], $employee, $d['ville'], $dateDeb, $dateFin, intval($d['id']));
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
                $em =  new EmployeeManager;
                $employee = $em->findOne($d['id_employee']);
                $dateDeb = new DateTime($d['date_debut_location']);
                $dateFin = new DateTime($d['date_fin_location']);

                $objectsList[] = new Location($d['id_voiture'], $d['id_conducteur'], $employee, $d['ville'], $dateDeb, $dateFin, intval($d['id']));
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
            $em =  new EmployeeManager;
            $employee = $em->findOne($data['id_employee']);
            $dateDeb = new DateTime($data['date_debut_location']);
            $dateFin = new DateTime($data['date_fin_location']);

            $locations = new Location($data['id_voiture'], $data['id_conducteur'], $employee, $data['ville'], $dateDeb, $dateFin, intval($data['id']));
            return $locations;
        }

        return $data;
    }

    public function conducteur() {
        $cm = new ConducteurManager;
        return $cm->findOne($this->idConducteur());
    }

    public function voiture() {
        $vm = new VoitureManager;
        return $vm->findOne($this->idVoiture());
    }













    // Liste des noms des conducteurs
    public function listeNomConducteur() {

        $req = 'SELECT nom, prenom, age
                FROM location
                INNER JOIN conducteur ON conducteur.id = location.id_conducteur';

        return $data = Db::dbQuery($req);
    }

    // Nombre de voiture par conducteur
    public function nombreVoitureParConducteur() {

        $req = 'SELECT prenom, nom, count(*)
                FROM location
                INNER JOIN conducteur ON conducteur.id = location.id_conducteur
                GROUP BY location.id_conducteur
                ';

        return $data = Db::dbQuery($req);
    }

    // Nombre de location
    public function nombreLocation() {

        $req = 'SELECT count(*)
                FROM location
                ';

        return $data = Db::dbQuery($req);
    }


    // Nombre de voiture non louées
    public function listeVoitureNonLouees() {

        $req = 'SELECT *
                FROM voiture
                LEFT JOIN location ON voiture.id = location.id_voiture
                WHERE id_conducteur IS NULL';

        return $data = Db::dbQuery($req);
    }


    // Liste des voitures, avec le nom du conducteur, meme celles qui n'ont pas été louées
    public function listeVoitureConducteur() {

        $vm = new VoitureManager;
        $cm = new ConducteurManager;

        $req = 'SELECT nom, prenom, marque, modele
                FROM conducteur
                LEFT JOIN '. $this->tableName .' ON '. $cm->tableName .'.id = '. $this->tableName .'.id_conducteur
                LEFT JOIN ' . $vm->tableName . ' ON '. $vm->tableName.'.id = '. $this->tableName .'.id_voiture';

        return $data = Db::dbQuery($req);
    }

}