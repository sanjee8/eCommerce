<?php

namespace App\Controllers\Account;

use App\Router;

class Tri {

    public static function getTri() {
        $param = Router::getRouter()->getParam();

        if(isset($param['catId'])) {

            $asc = ["catId" => $param['catId'], "catName" => $param['catName'], "order" => "asc"];
            $desc = ["catId" => $param['catId'], "catName" => $param['catName'],  "order" => "desc"];

        } else {
            $asc = ["catId" => 0, "catName" => "all", "order" => "asc"];
            $desc = ["catId" => 0, "catName" => "all", "order" => "desc"];
        }

        return ["asc" => $asc, "desc" => $desc];
    }


}