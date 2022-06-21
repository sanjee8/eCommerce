<?php

namespace App\Controllers\Shop;

use App\Controllers\Account\Pagination;
use App\Controllers\Account\Tri;
use App\Controllers\Utils\Notification;
use App\Core\Controller\Controller;
use App\Core\Model\Model;
use App\Router;

class ShopController extends Controller {


    public function home() {

        if(Model::getModel("Session\Session")->get("admin") == 1) {
            header("Location: ". Router::getRouter()->getLink("admin") ."");
            return;
        }
        $links = Tri::getLinks();

        $categories = Model::getModel("Shop\Category")->getAll();
        $products = Model::getModel("Shop\Product")->getAll();
        $notif = "";
        if(Notification::is("shop")) {
            $notif = Notification::render("shop");
        }
        $this->render("home",compact("products", "categories", "links", "notif"));
    }



    public function getByCategory() {
        $notif = "";
        if(Model::getModel("Session\Session")->get("admin") == 1) {
            header("Location: ". Router::getRouter()->getLink("admin") ."");
            return;
        }

        $param = Router::getRouter()->getParam();


        $links = Tri::getLinks();


        if(isset($param['catId'])) {
            $order = null;
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
                Notification::set("shop", "Aucun produit disponible dans cette catégorie !", "warning");
                header('Location: ' . Router::getRouter()->getLink("home"));
                return;
            }

            if(Notification::is("shop")) {
                $notif = Notification::render("shop");
            }

            $this->render("home",compact("products", "categories", "links", "buttons", "notif"));

        } else {
            $this->home();
        }



    }

    public function getByPrice() {
        if(Model::getModel("Session\Session")->get("admin") == 1) {
            header("Location: ". Router::getRouter()->getLink("admin") ."");
            return;
        }
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
            $products_brut = [];
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
                Notification::set("shop", "Aucun produit disponible dans cette catégorie !", "warning");
                header('Location: ' . Router::getRouter()->getLink("home"));
                return;
            }

            $notif = "";
            if(Notification::is("shop")) {
                $notif = Notification::render("shop");
            }

            $this->render("home",compact("products", "categories", "links", "buttons", "notif"));

        }






    }

}