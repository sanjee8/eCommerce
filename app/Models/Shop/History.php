<?php

namespace App\Models\Shop;

use App\Core\Model\Model;
use PDO;

class History extends Model {

    public function getOf($sessionId) {

        return $this->db->prepare("
            SELECT * FROM history_orders
            LEFT JOIN order_articles ON history_orders.id = order_articles.order_id
            WHERE user_id = ?
        ", [$sessionId])->fetchAll(PDO::FETCH_OBJ);

    }

    public function getOrdersAdmin() {

        return $this->db->prepare("
            SELECT *, history_orders.id as id FROM history_orders
            LEFT JOIN users ON history_orders.user_id = users.id
            ORDER BY date_of DESC
        ")->fetchAll(PDO::FETCH_OBJ);

    }

    public function getOrders($sessionId) {

        return $this->db->prepare("
            SELECT * FROM history_orders
            WHERE user_id = ?
            ORDER by date_of desc
        ", [$sessionId])->fetchAll(PDO::FETCH_OBJ);

    }

    public function getProducts($id) {

        return $this->db->prepare("
            SELECT *, order_articles.price as paid, articles.name AS name, category.name AS category FROM order_articles
            LEFT JOIN articles ON order_articles.product_id = articles.id
            LEFT JOIN category ON articles.category = category.id
            WHERE order_id = ?
        ", [$id])->fetchAll(PDO::FETCH_OBJ);

    }

    /**
     * @throws \Exception
     */
    public function addHistory($sessionId, $final_price, $products) {
        $dateOf = time();
        $this->db->prepare("
            INSERT INTO history_orders(user_id, date_of, final_price)
            VALUES(?,?,?)
        ", [$sessionId, $dateOf, $final_price]);


        $id_order = $this->db->getPDO()->lastInsertId();

        foreach ($products as $product) {

            $this->db->prepare("
                INSERT INTO order_articles(product_id, order_id, price)
                VALUES(?,?,?)
            ", [$product->id, $id_order, $product->price]);

        }


    }

}