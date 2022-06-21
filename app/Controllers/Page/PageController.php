<?php


namespace App\Controllers\Page;


use App\Controllers\Account\Pagination;
use App\Controllers\Account\Tri;
use App\Controllers\Utils\Notification;
use App\Core\Controller\Controller;
use App\Core\Model\Model;
use App\Router;

/**
 * Class PageController
 * @package App\Controllers\Page
 */
class PageController extends Controller {


    public function home() {


        if(Model::getModel("Session\Session")->get("admin") == 1) {
            header("Location: ". Router::getRouter()->getLink("admin") ."");
            return;
        }

        $links = Tri::getLinks();
        $categories = Model::getModel("Shop\Category")->getAll();
        $products_brut = Model::getModel("Shop\Product")->getAll();

        $pagination = new Pagination($products_brut);

        $products = $pagination->getPage();

        $buttons = $pagination->getButtons();

        $notif = "";
        if(Notification::is("shop")) {
            $notif = Notification::render("shop");
        }



        $this->render("home",compact("products", "categories", "links", "buttons", "notif"));
    }

}