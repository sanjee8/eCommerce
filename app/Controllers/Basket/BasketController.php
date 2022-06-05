<?php

namespace App\Controllers\Basket;

use App\Controllers\Utils\Alert;
use App\Core\Controller\Controller;
use App\Core\Model\Model;
use App\Router;

class BasketController extends Controller {

    # Template
    protected $template = "default";

    /**
     * AccountController constructor.
     */
    public function __construct() {
        $this->viewPath = ROOT . '\\eCommerce\\Views\\';
    }



    public function panier() {
        $session = Model::getModel("Session\Session");

        if(!$session->isLogged()) {
            header("Location: ". Router::getRouter()->getLink("signin") ."");
            return;
        }


        $response = "";

        $products_brut = json_decode($_COOKIE['products']);


        $products = Model::getModel("Shop\Product")->check($products_brut);

        $params = Router::getRouter()->getParam();

        if(isset($params['productId'])) {
            $index = intval($params['productId']);


            Model::getModel("Shop\Basket")->deleteOne($session->get("id"),$products[$index]->id);

            array_splice($products, $index, 1);
            $alert = new Alert("L'article a bien été supprimé de votre panier !", "success");
            $response = $alert->render();



        }





        $basket = [];
        $size = sizeof($products);
        $basket["amount"] = $size;
        $price = 0;
        $array_cookie = [];
        foreach ($products as $product) {
            $price += $product->price;
            $obj = array(
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "id" => $product->id,
            );
            array_push($array_cookie, $obj);
        }
        $basket['price'] = $price;
        $basket['final'] = $price + 5;



        if($size > 0) {
            $products_string = json_encode($array_cookie);
            setcookie("products", $products_string, time() + 24*3600*7, '/');

        } else {

            unset($_COOKIE['products']);
            setcookie("products", "[]", time() + 24*3600*7, '/');
        }




        $this->render("basket", compact("products", "basket", "response"));


    }

    public function order() {
        $session = Model::getModel("Session\Session");

        if(!$session->isLogged() || !isset($_POST['paymentOrder'])) {
            header("Location: ". Router::getRouter()->getLink("signin") ."");
            return;
        }

        $history = Model::getModel("Shop\History");


        $products_brut = json_decode($_COOKIE['products']);


        $products = Model::getModel("Shop\Product")->check($products_brut);

        $basket = [];
        $size = sizeof($products);
        $basket["amount"] = $size;
        $price = 0;

        foreach ($products as $product) {
            $price += $product->price;
        }
        $basket['price'] = $price;
        $basket['final'] = $price + 5;

        $history->addHistory($session->get("id"), $basket['final'], $products);
        unset($_COOKIE['products']);
        setcookie("products", "[]", time() + 24*3600*7, '/');

        $this->render("order", compact("basket"));

    }

}