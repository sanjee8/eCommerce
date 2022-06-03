<?php

namespace App\Controllers\Shop;

use App\Controllers\Account\Pagination;
use App\Controllers\Account\Tri;
use App\Core\Controller\Controller;
use App\Core\Model\Model;
use App\Router;

class ShopController extends Controller {

    protected $template = "default";


    public function __construct() {
        $this->viewPath = ROOT . '\\eCommerce\\Views\\';
    }

    public function home() {

        $links = Tri::getLinks();

        $categories = Model::getModel("Shop\Category")->getAll();
        $products = Model::getModel("Shop\Product")->getAll();
        $this->render("home",compact("products", "categories", "links"));
    }



    public function getByCategory() {

        $param = Router::getRouter()->getParam();


        $links = Tri::getLinks();


        if(isset($param['catId'])) {
            $order = "asc";
            if(isset($param["order"])) {
                $order = trim($param['order']);
            }



            $categories = Model::getModel("Shop\Category")->getAll($order);
            if($param["catId"] == "0") {
                $products_brut = Model::getModel("Shop\Product")->getAll($order);
            } else {
                $products_brut = Model::getModel("Shop\Product")->getByCategory($param["catId"], $order);
            }



            $pagination = new Pagination($products_brut);

            $products = $pagination->getPage();

            $buttons = $pagination->getButtons();


            if(count($products) == 0) {
                header('Location: ' . Router::getRouter()->getLink("home"));
            }
            $this->render("home",compact("products", "categories", "links", "buttons"));

        } else {
            $this->home();
        }



    }

    public function getByPrice() {

        $param = Router::getRouter()->getParam();

        $links = Tri::getLinks();




        $order = "asc";
        if(isset($param["order"])) {
            $order = trim($param['order']);
        }



        $categories = Model::getModel("Shop\Category")->getAll($order);
        if(isset($param['minPrice']) && isset($param['maxPrice'])) {

            $minPrice = trim($param['minPrice']);
            $maxPrice = trim($param['maxPrice']);

            if($maxPrice == 'all' AND $minPrice == 'all') {
                header('Location: ' . Router::getRouter()->getLink("home"));
            } else if($maxPrice == 'all') {
                $minPrice = intval($minPrice);
                $products_brut = Model::getModel("Shop\Product")->getAllMin($minPrice, $order);

            } else if($minPrice == 'all') {
                $maxPrice = intval($maxPrice);
                $products_brut = Model::getModel("Shop\Product")->getAllMax($maxPrice, $order);


            } else {
                $minPrice = intval($minPrice);
                $maxPrice = intval($maxPrice);
                $products_brut = Model::getModel("Shop\Product")->getAllBet($minPrice,$maxPrice, $order);

            }

            $pagination = new Pagination($products_brut);

            $products = $pagination->getPage();

            $buttons = $pagination->getButtons();


            if(count($products) == 0) {
                header('Location: ' . Router::getRouter()->getLink("home"));
            }
            $this->render("home",compact("products", "categories", "links", "buttons"));

        }






    }

}