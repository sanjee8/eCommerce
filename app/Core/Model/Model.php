<?php


namespace App\Core\Model;


use App\Database;

/**
 * Class Model
 * @package App\Core\Model
 */
class Model {

    protected $db;

    public function __construct() {
        $this->db = Database::getDb();
    }

    /**
     * Get an instance of a Model
     * @param $name
     * @return mixed
     */
    public static function getModel($name) {

        $class_name = '\\App\\Models\\' . ucfirst($name);
        return new $class_name();


    }

}