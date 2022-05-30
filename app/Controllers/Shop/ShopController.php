<?php

namespace App\Controllers\Shop;

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

        $tri = Tri::getTri();

        $categories = Model::getModel("Shop\Category")->getAll();
        $products = Model::getModel("Shop\Product")->getAll();
        $this->render("home",compact("products", "categories", "tri"));
    }



    public function getByCategory() {

        $param = Router::getRouter()->getParam();


        $tri = Tri::getTri();


        if(isset($param['catId'])) {
            $order = false;
            if(isset($param["order"])) {
                if(strcasecmp($param['order'], "desc") == 0) {
                    $order = true;
                }
            }

            $categories = Model::getModel("Shop\Category")->getAll($order);
            if($param["catId"] == "0") {
                $products = Model::getModel("Shop\Product")->getAll($order);
            } else {
                $products = Model::getModel("Shop\Product")->getByCategory($param["catId"], $order);
            }


            $this->render("home",compact("products", "categories", "tri"));

        } else {
            $this->home();
        }

        var_dump($param);

    }

}