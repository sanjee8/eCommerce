<?php

namespace App\Models\Shop;

use App\Core\Model\Model;
use PDO;

class Product extends Model {

    public function add($name, $price, $description, $category, $image, $amount) {

        $this->db->prepare("
            INSERT INTO articles(name, price, description, category, image, amount)
            VALUES(?,?,?,?,?,?)
        ", [$name, $price, $description, $category, $image, $amount]);

    }

    public function delete($id) {

        $this->db->prepare("
            DELETE FROM articles
            WHERE ID = ?
        ", [$id]);

    }

    public function get($id) {

        return $this->db->prepare("
            SELECT *, articles.id as id, articles.name as name, category.name AS category
            FROM articles
            LEFT JOIN category ON category.id = articles.category
            WHERE articles.id = ?
        ", [$id])->fetch(PDO::FETCH_OBJ);

    }

    public function getByCategory($cat, $order = "asc") {
        $text = $this->getOrder($order);
        return $this->db->prepare("
            SELECT *, articles.id as id, articles.name as name, category.name AS category
            FROM articles
            LEFT JOIN category ON category.id = articles.category
            WHERE articles.category = ? 
        " . $text, [$cat])->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAll($order = "asc") {
        $text = $this->getOrder($order);
        return $this->db->prepare("
            SELECT *, articles.id as id, articles.name as name, category.name AS category
            FROM articles
            LEFT JOIN category ON category.id = articles.category 
        " . $text)->fetchAll(PDO::FETCH_OBJ);

    }

    public function getAllMin($min, $order = "asc") {
        $text = $this->getOrder($order);

        return $this->db->prepare("
            SELECT *, articles.id as id, articles.name as name, category.name AS category
            FROM articles
            LEFT JOIN category ON category.id = articles.category
            WHERE articles.price > ?
        " . $text, [$min])->fetchAll(PDO::FETCH_OBJ);

    }

    public function getAllMax($max, $order = "asc") {
        $text = $this->getOrder($order);

        return $this->db->prepare("
            SELECT *, articles.id as id, articles.name as name, category.name AS category
            FROM articles
            LEFT JOIN category ON category.id = articles.category
            WHERE articles.price < ?
        " . $text, [$max])->fetchAll(PDO::FETCH_OBJ);

    }

    public function getAllBet($min, $max, $order = "asc") {
        $text = $this->getOrder($order);

        return $this->db->prepare("
            SELECT *, articles.id as id, articles.name as name, category.name AS category
            FROM articles
            LEFT JOIN category ON category.id = articles.category
            WHERE articles.price > ?
            AND articles.price < ?
        " . $text, [$min,$max])->fetchAll(PDO::FETCH_OBJ);

    }

    public function getMinPrice() {

        return $this->db->prepare("
            SELECT min(price) as minimum
            FROM articles
        ")->fetch(PDO::FETCH_OBJ)->minimum;

    }

    public function getOrder($order = "asc") {
        $text = "ORDER BY articles.name ASC;";
        if($order == "desc") {
            $text = "ORDER BY articles.name DESC;";
        } else if($order == "ascPrice") {
            $text = "ORDER BY articles.price ASC;";
        } else if($order == "descPrice") {
            $text = "ORDER BY articles.price DESC;";
        }



        return $text;
    }


    public function getMaxPrice() {

        return $this->db->prepare("
            SELECT max(price) as maximum
            FROM articles
        ")->fetch(PDO::FETCH_OBJ)->maximum;

    }

    public function check($products) {
        $array = [];
        foreach ($products as $product) {
            $prdt = $this->get($product->id);

            if(isset($prdt->id)) {
                if($prdt->amount > 0)
                    array_push($array, $prdt);
            }

        }



        return $array;

    }

}