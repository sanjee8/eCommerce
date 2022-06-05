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