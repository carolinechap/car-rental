<?php

class VoitureManager extends AbstractManager {

    public $tableName;

    public function __construct(){

        $this->tableName = $GLOBALS['DB_PREFIX'] . "voiture";

    }

    public function save(Voiture $voiture){
        $data =[
            'marque'                => $voiture->marque(),
            'modele'                => $voiture->modele(),
            'annee_mise_location'   => $voiture->anneeMiseEnLocUs(),
            'plaque_immat'          => $voiture->plaqueImmat(),
            'couleur'               => $voiture->couleur()

        ];

        if ($voiture->id() > 0) return $this->update($voiture);

        $nouvelElem = Db::dbCreate($this->tableName, $data);

        $voiture->setId($nouvelElem);

        return $this;
    }

    public function update(Voiture $voiture) {

        if ($voiture->id > 0) {

            $data = [
                'marque'                => $voiture->marque(),
                'modele'                => $voiture->modele(),
                'annee_mise_location'   => $voiture->anneeMiseEnLocUs(),
                'plaque_immat'          => $voiture->plaqueImmat(),
                'couleur'               => $voiture->couleur()
            ];

            Db::dbUpdate($this->tableName, $data);

            return $voiture;
        }

        return;
    }

    public function delete(Voiture $voiture) {
        $data = [
            'id' => $voiture->id(),
        ];

        Db::dbDelete($this->tableName, $data);

        // On supprime aussi toutes les loc
        Db::dbDelete('location', [
            'id_voiture' => $voiture->id()
        ]);

        return;
    }

    public function findAll($objects = true) {

        $data = Db::dbFind($this->tableName);

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
    public function find(array $request, $objects = true) {

        $data = Db::dbFind($this->tableName, $request);

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
    public function findOne(int $id, $object = true) {

        $request = [
            ['id', '=', $id]
        ];

        $data = Db::dbFind($this->tableName, $request);

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