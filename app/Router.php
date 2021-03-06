<?php

namespace App;

use AltoRouter;
use App\Controllers\Account\AccountController;
use App\Controllers\Account\LogController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Basket\BasketController;
use App\Controllers\Errors\ErrorsController;
use App\Controllers\Page\PageController;
use App\Controllers\Request\RequestController;
use App\Controllers\Shop\ShopController;

/**
 * Class Router
 * @package App
 */
class Router {

    # Singleton router
    private static $rootr;

    # Default template
    private $template = "default";

    # Actual page name
    private $actual;

    # Actual page category
    private $category;

    # Actual page content
    private $content;

    # AltoRouter
    private $router;

    # Root path
    private $path;

    # Params
    private $params;


    # List pages to map
    private $pages = array(
        1 => array(
            "name" => "home",
            "target" => "home",
            "route" => "",
            "post" => true
        ),
        2 => array(
            "name" => "signup",
            "target" => "signup",
            "route" => "signup",
            "post" => true
        ),
        3 => array(
            "name" => "signin",
            "target" => "signin",
            "route" => "signin",
            "post" => true
        ),
        4 => array(
            "name" => "logout",
            "target" => "logout",
            "route" => "logout",
            "post" => true
        ),
        5 => array(
            "name" => "productsCat",
            "target" => "productsCat",
            "route" => "[a:catName]-[i:catId]",
            "post" => true
        ),
        6 => array(
            "name" => "productsCatOrder",
            "target" => "productsCat",
            "route" => "[a:catName]-[i:catId]/[a:order]",
            "post" => true
        ),
        7 => array(
            "name" => "productsPrice",
            "target" => "productsPrice",
            "route" => "[a:minPrice]~[a:maxPrice]",
            "post" => true
        ),
        8 => array(
            "name" => "productsPriceOrder",
            "target" => "productsPrice",
            "route" => "[a:minPrice]~[a:maxPrice]/[a:order]",
            "post" => true
        ),
        9 => array(
            "name" => "productsPricePage",
            "target" => "productsPrice",
            "route" => "[a:minPrice]~[a:maxPrice]/[a:order]/[i:page]",
            "post" => true
        ),
        10 => array(
            "name" => "productsCatPage",
            "target" => "productsCat",
            "route" => "[a:catName]-[i:catId]/[a:order]/[i:page]",
            "post" => true
        ),
        11 => array(
            "name" => "basket",
            "target" => "basket",
            "route" => "basket",
            "post" => true
        ),
        12 => array(
            "name" => "basketDel",
            "target" => "basket",
            "route" => "basket/[i:productId]",
            "post" => true
        ),
        13 => array(
            "name" => "request",
            "target" => "request",
            "route" => "request",
            "post" => true
        ),
        14 => array(
            "name" => "order",
            "target" => "order",
            "route" => "order",
            "post" => true
        ),
        15 => array(
            "name" => "account",
            "target" => "account",
            "route" => "account",
            "post" => true
        ),
        16 => array(
            "name" => "admin",
            "target" => "admin",
            "route" => "admin",
            "post" => true
        ),
        17 => array(
            "name" => "adminAction",
            "target" => "admin",
            "route" => "admin/[a:action]",
            "post" => true
        ),
        18 => array(
            "name" => "adminArticlesId",
            "target" => "admin",
            "route" => "admin/[a:action]/[i:id]",
            "post" => true
        ),
    );

    public function __construct() {

        $general = include "Config/General.php";

        $this->path = $general['path'];

    }

    /**
     * Return singleton Router
     * @return Router
     */
    public static function getRouter() {

        if(self::$rootr === null) {
            self::$rootr = new Router();
        }


        return self::$rootr;

    }

    /**
     * Initialise router
     * @throws \Exception
     */
    public function init() {

        $this->router = new AltoRouter();

        $this->router->setBasePath($this->path);

        foreach ($this->pages as $page) {

            $this->router->map("GET", $page['route'], $page['target'], $page['name']);
            if($page["route"] != "") {
                $this->router->map("GET", $page['route']."/", $page['target']);
            }
            if($page['post']) {
                $this->router->map("POST", $page['route'], $page['target']);
            }

        }





        $match = $this->router->match();


        if($match !== false) {

            $this->params = $match['params'];

            switch ($match['target']) {
                case "home":
                    $this->actual = "Accueil";
                    $this->category = 1;
                    $controller = new PageController();
                    $controller->home();
                    break;
                case "signup":
                    $this->actual = "S'inscrire";
                    $this->category = 5;
                    $controller = new LogController();
                    $controller->register();
                    break;
                case "signin":
                    $this->actual = "Se connecter";
                    $this->category = 5;
                    $controller = new LogController();
                    $controller->login();
                    break;
                case "logout":
                    $this->actual = "Me d??connecter";
                    $this->category = 99;
                    $controller = new LogController();
                    $controller->logout();
                    break;
                case "productsCat":
                    $this->actual = "Produits";
                    $this->category = 2;
                    $controller = new ShopController();
                    $controller->getByCategory();
                    break;
                case "productsPrice":

                    $this->actual = "Produits";
                    $this->category = 3;
                    $controller = new ShopController();
                    $controller->getByPrice();
                    break;
                case "basket":
                    $this->actual = "Votre panier";
                    $this->category = 9;
                    $controller = new BasketController();
                    $controller->panier();
                    break;
                case "request":
                    $this->actual = "request";
                    $this->category = 9999;
                    $controller = new RequestController();
                    $controller->add();
                    break;
                case "order":
                    $this->actual = "Passer commande";
                    $this->category = 8;
                    $controller = new BasketController();
                    $controller->order();
                    break;
                case "account":
                    $this->actual = "Mon compte";
                    $this->category = 50;
                    $controller = new AccountController();
                    $controller->account();
                    break;
                case "admin":
                    $this->actual = "Administration";
                    $this->category = 99999;
                    $controller = new AdminController();
                    $controller->home();
                    break;
            }




        } else {

            $this->actual = "Erreur 404";
            $this->category = 99;
            $error404 = new ErrorsController();
            $error404->e_404();

        }



    }

    /**
     * Get the actual page content
     * @return Html $content
     */
    public function getContent() {
        return $this->content;
    }


    /**
     * Get the actual page display name
     * @return Array
     */
    public function getPageDisplay() {
        return $this->actual;
    }

    /**
     * Get the actual page category
     * @return String
     */
    public function getPageCategory() {
        return $this->category;
    }

    /**
     * Echo Active if active page
     * @param $page String
     */
    public function active($page) {
        if($page == $this->getPageCategory()) {
            echo "active";
        }
    }

    /**
     * @param $name
     * @return String
     */
    public function getLink($name, $param = []) {
        return $this->router->generate($name, $param);
    }

    /**
     * @return mixed
     */
    public function getParam() {
        return $this->params;
    }



}