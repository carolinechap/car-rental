<?php 

class Conducteur extends Db{

    protected $id;
    protected $nom;
    protected $prenom;
    protected $age;
    protected $codepostal;
    protected $ville;
    protected $pays;

    const TABLE_NAME = 'conducteur';

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
    public function setAge($age){
        if (strlen($age) == 0) {
            throw new Exception('L\'age ne peut pas être vide.');
        }
        if (!intval($age)) {
            throw new Exception('L\'age doit être un nombre entier');
        }
        $this->age = $age;
        return $this;
    }
    public function setCodepostal($codepostal){
        if (strlen($codepostal) == 0) {
            throw new Exception('Le code postal ne peut pas être vide.');
        }
        if (strlen($codepostal) > 10) {
            throw new Exception('Le code postal ne peut pas être supérieur à 10 caractères.');
        }
        $this->codepostal = $codepostal;
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

    public function save(){
        $data =[
            'nom'           => $this->nom(),
            'prenom'        => $this->prenom(),
            'age'           => $this->age(),
            'codepostal'    => $this->codepostal(),
            'ville'         => $this->ville(),
            'pays'          => $this->pays()

        ]; 
        if ($this->id() > 0) return $this->update();

        $nouvelElem = Db::dbCreate(self::TABLE_NAME, $data);

        $this->setId($nouvelElem);

        return $this;
    }

    public function update() {

        if ($this->id > 0) {

            $data = [
                'nom'           => $this->nom(),
                'prenom'        => $this->prenom(),
                'age'           => $this->age(),
                'codepostal'    => $this->codepostal(),
                'ville'         => $this->ville(),
                'pays'          => $this->pays(),
                "id"            => $this->id()
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
            'id_conducteur' => $this->id()
        ]);

        return;
    }

    public static function findAll($objects = true) {

        $data = Db::dbFind(self::TABLE_NAME);
        
        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {

                $objectsList[] = new Conducteur($d['nom'], $d['prenom'], $d['age'], $d['codepostal'], $d['ville'], $d['pays'], intval($d['id']));
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
                $objectsList[] = new Conducteur($d['nom'], $d['prenom'], $d['age'], $d['codepostal'], $d['ville'], $d['pays'], intval($d['id']));

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
            $conducteur = new Conducteur($data['nom'], $data['prenom'], $data['age'], $data['codepostal'], $data['ville'], $data['pays'], intval($data['id']));
            return $conducteur;
        }

        return $data;
    }


}