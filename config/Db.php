<?php
class Db {
    public function __construct() { /** */ }
    
    protected static function getDb() {
        try {
            // Essaie de faire ce script...
            $bdd = new PDO('mysql:host='.$GLOBALS['DB_HOST'].';dbname='.$GLOBALS['DB_NAME'].';charset=utf8;port='.$GLOBALS['DB_PORT'], $GLOBALS['DB_USER'], $GLOBALS['DB_PWD']);
        }
        catch (Exception $e) {
            // Sinon, capture l'erreur et affiche la
            die('Erreur : ' . $e->getMessage());
        }
        return $bdd;
    }
    /**
     * Permet d'enregistrer (INSERT) des données en base de données.
     * @param string    $table  Nom de la table dans lequel faire un INSERT
     * @param array     $data   Array contenant en clé les noms des champs de la table, en valeurs les values à enregistrer
     * 
     * @return int      Id de l'enregistrement.
     * 
     * Exemple :
     * $table = "Category";
     * $data = [
     *      'title'         => "Nouvelle catégorie",
     *      'description'   => 'Ma nouvelle catégorie.',
     * ];
     */
    protected static function dbCreate(string $table, array $data) {
        $bdd = self::getDb();
        // Construction de la requête au format : INSERT INTO $table($data.keys) VALUES(:$data.keys) 
        $req  = "INSERT INTO " . $table;
        $req .= " (`".implode("`, `", array_keys($data))."`)";
        $req .= " VALUES (:".implode(", :", array_keys($data)).") ";
                
        pdoSqlDebug($req, $data);

        $response = $bdd->prepare($req);
        $response->execute($data);

        var_dump( $bdd->lastInsertId());

        return $bdd->lastInsertId();
    }
    /**
     * Permet de supprimer (DELETE) des données en base de données.
     * @param string    $table  Nom de la table dans lequel faire un DELETE
     * @param array     $data   Array contenant en clé la PK de la table, en value la valeur à donner.
     * 
     * @return void
     * 
     * Exemple: 
     * $table = "Movie";
     * $data = [ 'id' => 3 ];
     */
    protected static function dbDelete(string $table, array $data) {
        $bdd = self::getDb();
        // Construction de la requête au format : INSERT INTO $table($data.keys) VALUES(:$data.keys) 
        $req  = "DELETE FROM " . $table . " WHERE " . array_keys($data)[0] . " = :" . array_keys($data)[0];

        pdoSqlDebug($req, $data);

        $response = $bdd->prepare($req);
        $response->execute($data);

        return;
    }
    /**
     * Permet de récupérer (SELECT) des données en base de données.
     * @param string    $table  Nom de la table dans lequel faire un SELECT
     * @param array     $request   Array contenant une liste de trios ["champ", "opérateur", "valeur"].
     * 
     * @return array    Données demandées.
     * 
     * Exemple: 
     * $table = "Movie";
     * $request = [
     *      [ 'title', "like",'Rocky' ],
     *      [ 'realease_date', '>', '2000-01-01']
     * ];
     */
    protected static function dbFind(string $table, array $request = null) {
        $bdd = self::getDb();
        $req = "SELECT * FROM " . $table;
        if (isset($request)) {
            $req .= " WHERE ";
            $reqOrder = '';
            foreach($request as $r) {
                switch($r[0]):
                    case "orderBy":
                        $reqOrder = " ORDER BY `" . htmlspecialchars($r[1]) . "` " . htmlspecialchars($r[2]);
                        break;
                    
                    default:
                        $req .= "`". htmlspecialchars($r[0]) . "` " . htmlspecialchars($r[1]) . " '" . htmlspecialchars($r[2]) . "'";
                        $req .= " AND ";
                endswitch;
                
            }
            $req = substr($req, 0, -5);
            $req .= $reqOrder;
        }

        pdoSqlDebug($req);

        $response = $bdd->query($req);

        $data = ($response) ? $response->fetchAll(PDO::FETCH_ASSOC) : [];

        return $data;
    }
    /**
     * Permet de mettre à jour (UPDATE) des données en base de données.
     * @param string    $table  Nom de la table dans lequel faire un UPDATE
     * @param array     $data   Array contenant en clé les noms des champs de la table, en valeurs les values à enregistrer.
     * 
     * @return int      Id de l'élément modifié.
     * 
     * OBLIGATOIRE : Passer un champ 'id' dans le tableau 'data'.
     * 
     * Exemple :
     * $table = "Category";
     * $data = [
     *      'id'            => 4,
     *      'title'         => "Nouveau titre de catégorie",
     *      'description'   => 'Ma nouvelle catégorie.',
     * ];
     */
    protected static function dbUpdate(string $table, array $data, string $idField = null) {
        $bdd = self::getDb();
        $req  = "UPDATE " . $table . " SET ";
        $whereIdString = '';
        /**
         * Set du WHERE
         */
        $whereIdString = ($idField !== null) ? " WHERE `" . $idField . "` = :" . $idField : " WHERE id = :id";
        /**
         * Set des key = :value
         */
        foreach($data as $key => $value) {
            
            if ($key !== 'id') {
                $req .= "`" . $key . "` = :" . $key . ", ";
            }
        }
        $req = substr($req, 0, -2);
        $req .= $whereIdString;
        
        pdoSqlDebug($req, $data);
        
        $response = $bdd->prepare($req);
        $response->execute($data);

        return $bdd->lastInsertId();
    }

    public static function dbJoin(string $table1, string $table2, array $columns) {

        $bdd = self::getDb();

        $req = "SELECT " . implode(', ', $columns);
        $req .= " FROM " . $table1;
        $req .= " INNER JOIN " . $table2 . " ON ";
        $req .= $table2 . ".id = " . $table1 . ".id_" . $table2;

        pdoSqlDebug($req);

        $res = $bdd->query($req);
        $data = $res->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public static function dbQuery(string $req) {

        $bdd = self::getDb();

        pdoSqlDebug($req);

        $res = $bdd->query($req);

        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}