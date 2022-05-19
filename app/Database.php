<?php
namespace App;
use PDO;

/**
 * Class Database
 * @package App
 */
class Database {

    # Database variable
    private static $db;

    /**
     * Initialise or return a database
     * @return Database
     */
    public static function getDb() {

        if(self::$db === null) {
            self::$db = new Database();
        }

        return self::$db;
    }

    # MySQL information variables
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;

    # MySQL PDO stocked in
    private $pdo;

    /**
     * Database constructor.
     * @param string $db_name
     * @param string $db_user
     * @param string $db_pass
     * @param string $db_host
     */
    public function __construct($db_name = "sportlog", $db_user = "root", $db_pass = '', $db_host= "localhost") {

        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_pass = $db_pass;
        $this->db_user = $db_user;

    }

    /**
     * Get PDO
     * or Create PDO if not exists
     * @return PDO
     */
    public function getPDO() {

        if($this->pdo === null) {
            $pdo = new PDO("mysql:dbname=$this->db_name;host=$this->db_host", $this->db_user, $this->db_pass);

            $this->pdo = $pdo;
        }

        return $this->pdo;

    }


    /**
     * PDO get query data
     * @param $statement
     * @return array
     */
    public function query($statement) {

        $req = $this->getPDO()->query($statement);
        $datas = $req->fetchAll(PDO::FETCH_OBJ);
        return $datas;

    }

    /**
     * PDO get prepare data
     * @param $statement
     * @param null $data
     * @return bool|\PDOStatement
     */
    public function prepare($statement, $data = null) {

        $req = $this->getPDO()->prepare($statement);
        $req->execute($data);

        return $req;

    }


}