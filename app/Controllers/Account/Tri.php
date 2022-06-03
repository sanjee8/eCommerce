<?php

namespace App\Controllers\Account;

use App\Router;

class Tri {

    public static function getTri() {
        $param = Router::getRouter()->getParam();

        if(isset($param['catId'])) {

            $asc = ["catId" => $param['catId'], "catName" => $param['catName'], "order" => "asc"];
            $desc = ["catId" => $param['catId'], "catName" => $param['catName'],  "order" => "desc"];
            $ascPrice = ["catId" => $param['catId'], "catName" => $param['catName'],  "order" => "ascPrice"];
            $descPrice = ["catId" => $param['catId'], "catName" => $param['catName'],  "order" => "descPrice"];

        } else if(isset($param['minPrice'])) {

            $asc = ["minPrice" => $param['minPrice'], "maxPrice" => $param['maxPrice'], "order" => "asc"];
            $desc = ["minPrice" => $param['minPrice'], "maxPrice" => $param['maxPrice'],  "order" => "desc"];
            $ascPrice = ["minPrice" => $param['minPrice'], "maxPrice" => $param['maxPrice'], "order" => "ascPrice"];
            $descPrice = ["minPrice" => $param['minPrice'], "maxPrice" => $param['maxPrice'],  "order" => "descPrice"];


        } else {
            $asc = ["catId" => 0, "catName" => "all", "order" => "asc"];
            $desc = ["catId" => 0, "catName" => "all", "order" => "desc"];
            $ascPrice = ["catId" => 0, "catName" => "all", "order" => "ascPrice"];
            $descPrice = ["catId" => 0, "catName" => "all", "order" => "descPrice"];
        }

        return ["asc" => $asc, "desc" => $desc, "ascPrice" => $ascPrice, "descPrice" => $descPrice];
    }


    public static function getLinks() {
        $param = Router::getRouter()->getParam();

        if(isset($param['minPrice'])) {
            return [
                Router::getRouter()->getLink("productsPriceOrder", self::getTri()['asc']),
                Router::getRouter()->getLink("productsPriceOrder", self::getTri()['desc']),
                Router::getRouter()->getLink("productsPriceOrder", self::getTri()['ascPrice']),
                Router::getRouter()->getLink("productsPriceOrder", self::getTri()['descPrice'])
            ];
        } else {
            return [
                Router::getRouter()->getLink("productsCatOrder", self::getTri()['asc']),
                Router::getRouter()->getLink("productsCatOrder", self::getTri()['desc']),
                Router::getRouter()->getLink("productsCatOrder", self::getTri()['ascPrice']),
                Router::getRouter()->getLink("productsCatOrder", self::getTri()['descPrice'])
            ];
        }

    }

}