<?php

namespace App\Controllers\Account;

use App\Router;

class Pagination {

    const PAGE_SIZE = 9;
    private $products;
    private $params;

    public function __construct($products) {
        $this->params = Router::getRouter()->getParam();
        $this->products = $this->getValid($products);

    }


    private function getValid($products) {

        $array = [];
        foreach ($products as $product) {
            if($product->amount > 0) {
                array_push($array, $product);
            }
        }

        return $array;
    }

    public function getAmount() {

        return sizeof($this->products);

    }

    public function getActual() {

        $p =$this->params;
        $array = [];


        if(isset($p['catId'])) {

            $array['catName'] = $p['catName'];
            $array['catId'] = $p['catId'];
        } else if(isset($param['minPrice'])) {

            $array['minPrice'] = $p['minPrice'];
            $array['maxPrice'] = $p['maxPrice'];

        } else {
            $array['catName'] = "all";
            $array['catId'] = 0;
        }

        if(isset($p['order'])) {
            $array['order'] = $p['order'];
        } else {
            $array['order'] = "asc";
        }


        return $array;

    }

    public function getNextLink() {

        $array = $this->getActual();
        if(isset($this->params['page'])) {
            $array['page'] = $this->params['page'] + 1;
        } else {
            $array['page'] = 1;
        }


        if(isset($this->params['minPrice'])) {
            return Router::getRouter()->getLink("productsPricePage", $array);
        } else {
            return Router::getRouter()->getLink("productsCatPage", $array);
        }


    }

    public function getPreviousLink() {

        $array = $this->getActual();
        if(isset($this->params['page'])) {
            $array['page'] = $this->params['page'] - 1;
        } else {
            $array['page'] = 0;
        }

        if(isset($this->params['minPrice'])) {
            return Router::getRouter()->getLink("productsPricePage", $array);
        } else {
            return Router::getRouter()->getLink("productsCatPage", $array);
        }

    }

    public function getButtons() {


        $array = [];
        $i = 0;
        $amount = $this->getAmount();
        while ($amount > 0) {
            $amount -= 9;
            $i++;
        }
        array_push($array, $i-1);
        if(isset($this->params['page'])) {
            array_push($array, $this->params['page']);
        } else {
            array_push($array, 0);
        }
        array_push($array, $this->getActual());
        array_push($array, $this->getNextLink());
        array_push($array, $this->getPreviousLink());

        return $array;

    }



    public function getPage() {
        $array = [];
        $page = 0;
        if(isset($this->params['page'])) {
            $page = intval($this->params['page']);
        }
        $i = 0;

        $intervalMin = self::PAGE_SIZE * $page;
        $intervalMax = (($page+1) * self::PAGE_SIZE) - 1;

        foreach ($this->products as $product) {

            if($i >= $intervalMin && $i <= $intervalMax) {

                array_push($array, $product);

            }

            $i++;
        }


        return $array;

    }

}