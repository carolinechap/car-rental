<?php

class ConducteurManager extends AbstractManager {

    public $tableName;

    public function __construct(){

        $this->tableName = $GLOBALS['DB_PREFIX'] . "conducteur";

    }

    public function save(Conducteur $conducteur){
        $data =[
            'nom'           => $conducteur->nom(),
            'prenom'        => $conducteur->prenom(),
            'age'           => $conducteur->age(),
            'codepostal'    => $conducteur->codepostal(),
            'ville'         => $conducteur->ville(),
            'pays'          => $conducteur->pays()

        ];
        if ($conducteur->id() > 0) return $this->update();

        $nouvelElem = Db::dbCreate($this->tableName, $data);

        $conducteur->setId($nouvelElem);

        return $conducteur;
    }

    public function update(Conducteur $conducteur) {

        if ($conducteur->id > 0) {

            $data = [
                'nom'           => $conducteur->nom(),
                'prenom'        => $conducteur->prenom(),
                'age'           => $conducteur->age(),
                'codepostal'    => $conducteur->codepostal(),
                'ville'         => $conducteur->ville(),
                'pays'          => $conducteur->pays(),
                "id"            => $conducteur->id()
            ];

            Db::dbUpdate($this->tableName, $data);

            return $conducteur;
        }

        return;
    }

    public function delete(Conducteur $conducteur) {
        $data = [
            'id' => $conducteur->id(),
        ];

        Db::dbDelete($this->tableName, $data);

        // On supprime aussi toutes les loc
        Db::dbDelete('location', [
            'id_conducteur' => $conducteur->id()
        ]);

        return;
    }

    public function findAll($objects = true) {

        $data = Db::dbFind($this->tableName);

        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {

                $objectsList[] = new Conducteur($d['nom'], $d['prenom'], $d['age'], $d['codepostal'], $d['ville'], $d['pays'], intval($d['id']));
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
                $objectsList[] = new Conducteur($d['nom'], $d['prenom'], $d['age'], $d['codepostal'], $d['ville'], $d['pays'], intval($d['id']));

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
            $conducteur = new Conducteur($data['nom'], $data['prenom'], $data['age'], $data['codepostal'], $data['ville'], $data['pays'], intval($data['id']));
            return $conducteur;
        }

        return $data;
    }


}