<?php

namespace App\Controllers\Account;

use App\Router;

class Tri {

    public static function getTri() {
        $param = Router::getRouter()->getParam();

        if(isset($param['catId'])) {

            $asc = ["catId" => $param['catId'], "catName" => $param['catName'], "order" => "asc"];
            $desc = ["catId" => $param['catId'], "catName" => $param['catName'],  "order" => "desc"];

        } else if(isset($param['minPrice'])) {

            $asc = ["minPrice" => $param['minPrice'], "maxPrice" => $param['maxPrice'], "order" => "asc"];
            $desc = ["minPrice" => $param['minPrice'], "maxPrice" => $param['maxPrice'],  "order" => "desc"];

        } else {
            $asc = ["catId" => 0, "catName" => "all", "order" => "asc"];
            $desc = ["catId" => 0, "catName" => "all", "order" => "desc"];
        }

        return ["asc" => $asc, "desc" => $desc];
    }


    public static function getLinks() {
        $param = Router::getRouter()->getParam();

        if(isset($param['minPrice'])) {
            return [Router::getRouter()->getLink("productsPriceOrder", self::getTri()['asc']),Router::getRouter()->getLink("productsPriceOrder", self::getTri()['desc'])];
        } else {
            return [Router::getRouter()->getLink("productsCatOrder", self::getTri()['asc']),Router::getRouter()->getLink("productsCatOrder", self::getTri()['desc'])];
        }

    }

}