<?php


namespace App\Controllers\Page;


use App\Controllers\Account\Pagination;
use App\Controllers\Account\Tri;
use App\Core\Controller\Controller;
use App\Core\Model\Model;
use App\Router;

/**
 * Class PageController
 * @package App\Controllers\Page
 */
class PageController extends Controller {

    protected $template = "default";


    public function __construct() {
        $this->viewPath = ROOT . '\\eCommerce\\Views\\';
    }

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



        $this->render("home",compact("products", "categories", "links", "buttons"));
    }

}