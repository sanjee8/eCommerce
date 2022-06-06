<?php

namespace App\Models\Contrainte;

use App\Core\Model\Model;
use PDO;

class Contrainte extends Model {

    public function get($action) {

        return $this->db->prepare("
                SELECT value
                FROM contraintes
                WHERE action = ?
            ", [$action])->fetch(PDO::FETCH_OBJ)->value;

    }

    public function set($action, $value) {

        $this->db->prepare("
            UPDATE contraintes
            SET value = ?
            WHERE action = ?
        ", [$value, $action]);

    }

}