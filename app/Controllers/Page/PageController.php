<?php


namespace App\Controllers\Page;


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
        //$postes = Model::getModel("Profiles\Postes")->getAll();
        $this->render("home"); //compact("postes")
    }

}