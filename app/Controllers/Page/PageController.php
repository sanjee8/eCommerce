<?php


namespace App\Controllers\Page;


use App\Controllers\Account\Tri;
use App\Core\Controller\Controller;
use App\Core\Model\Model;

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


        $links = Tri::getLinks();
        $categories = Model::getModel("Shop\Category")->getAll();
        $products = Model::getModel("Shop\Product")->getAll();
        $this->render("home",compact("products", "categories", "links"));
    }

}