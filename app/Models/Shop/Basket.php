<?php

namespace App\Models\Shop;

use App\Core\Model\Model;
use App\Models\Session\Session;
use PDO;

class Basket extends Model {

    public function add($sessionId, $id) {


        $this->db->prepare("
            INSERT INTO basket(user,product_id)
            VALUES(?,?)
        ", [$sessionId, $id]);

    }

    public function deleteOne($sessionId, $id) {

        $this->db->prepare("
            DELETE FROM basket
            WHERE user = ?
            AND product_id = ?
            LIMIT 1;
        ", [intval($sessionId), intval($id)]);

    }

    public function getBasketOf($sessionId) {

        return $this->db->prepare("
            SELECT *
            FROM basket
            WHERE user = ?
        ", [$sessionId])->fetchAll(PDO::FETCH_OBJ);

    }

}