<?php

namespace App\Models\Shop;

use App\Core\Model\Model;
use PDO;

class Category extends Model {

    public function getAll() {

        return $this->db->prepare("
            SELECT *
            FROM category
        ")->fetchAll(PDO::FETCH_OBJ);

    }

    public function get($id) {

        return $this->db->prepare("
            SELECT *
            FROM category
            WHERE id = ?
        ", [$id])->fetch(PDO::FETCH_OBJ);

    }

    public function getByName($name) {

        return $this->db->prepare("
            SELECT *
            FROM category
            WHERE name = ?
        ", [$name])->fetch(PDO::FETCH_OBJ);

    }

    public function add($name) {

        $this->db->prepare("
            INSERT INTO category(name)
            VALUES(?)
        ", [$name]);

    }

    public function delete($id) {
        $this->db->prepare("
            DELETE FROM category
            WHERE id = ?
        ", [$id]);
    }


}