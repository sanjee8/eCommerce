<?php

namespace App\Models\Shop;

use App\Core\Model\Model;
use PDO;

class Product extends Model {

    public function get($id) {

        return $this->db->prepare("
            SELECT *, articles.id as id, articles.name as name, category.name AS category
            FROM articles
            LEFT JOIN category ON category.id = articles.category
            WHERE articles.id = ?
        ", [$id])->fetch(PDO::FETCH_OBJ);

    }

    public function getByCategory($cat, $order = false) {
        $text = "ORDER BY articles.name ASC;";
        if($order) {
            $text = "ORDER BY articles.name DESC;";
        }
        return $this->db->prepare("
            SELECT *, articles.id as id, articles.name as name, category.name AS category
            FROM articles
            LEFT JOIN category ON category.id = articles.category
            WHERE articles.category = ? 
        " . $text, [$cat])->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAll($order = false) {
        $text = "ORDER BY articles.name ASC;";
        if($order) {
            $text = "ORDER BY articles.name DESC;";
        }
        return $this->db->prepare("
            SELECT *, articles.id as id, articles.name as name, category.name AS category
            FROM articles
            LEFT JOIN category ON category.id = articles.category 
        " . $text)->fetchAll(PDO::FETCH_OBJ);

    }

    public function getMinPrice() {

        return $this->db->prepare("
            SELECT min(price) as minimum
            FROM articles
        ")->fetch(PDO::FETCH_OBJ)->minimum;

    }


    public function getMaxPrice() {

        return $this->db->prepare("
            SELECT max(price) as maximum
            FROM articles
        ")->fetch(PDO::FETCH_OBJ)->maximum;

    }

}