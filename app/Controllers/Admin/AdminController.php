<?php

namespace App\Controllers\Admin;

use App\Controllers\Utils\Alert;
use App\Core\Controller\Controller;
use App\Core\Model\Model;
use App\Models\Session\Session;
use App\Router;

class AdminController extends Controller {

    # Template
    protected $template = "admin";

    /**
     * AccountController constructor.
     */
    public function __construct() {


        $this->viewPath = ROOT . '\\eCommerce\\Views\\';
    }


    public function home() {

        $session = Model::getModel("Session\Session");
        if(!$session->isLogged() || $session->get("admin") == 0) {
            header("Location: ". Router::getRouter()->getLink("signin") ."");
            return;
        }

        $param = Router::getRouter()->getParam();
        $response = "";

        if(isset($param['action']) && $param['action'] == "articles") {

            $productModel = Model::getModel("Shop\Product");


            if(isset($_POST['addProduct'])) {

                if($this->check($_POST['name']) && $this->check($_POST['price']) && $this->check($_POST['description']) && $this->check($_POST['amount']) && $this->check($_POST['image']) && $this->check($_POST['category']) ) {

                    $name = trim($_POST['name']);
                    $price = trim($_POST['price']);
                    $description = trim($_POST['description']);
                    $category = trim($_POST['category']);
                    $image = trim($_POST['image']);
                    $amount = trim($_POST['amount']);

                    $productModel->add($name, $price, $description, $category, $image, $amount);

                    $alertSuccess = new Alert("L'article a bien été ajouté !", "success");
                    $response = $alertSuccess->render();

                } else {

                    $alertError = new Alert("Erreur ! Vous devez remplir tous les champs !");
                    $response = $alertError->render();

                }

            } else if(isset($_POST['deleteProduct'])) {

                $deleteId = trim($_POST['productId']);

                $productModel->delete($deleteId);

                $alertSuccess = new Alert("L'article a bien été supprimé !", "success");
                $response = $alertSuccess->render();

            }

            $products = $productModel->getAll();
            $this->render("Admin.articles", compact("response", "products"));

        } else if(isset($param['action']) && $param['action'] == "category") {

            $categoryModel = Model::getModel("Shop\Category");

            if(isset($_POST['addCategory'])) {

                if($this->check($_POST['name'])) {

                    $name = trim($_POST['name']);


                    $categoryModel->add($name);

                    $alertSuccess = new Alert("La catégorie a bien été ajouté !", "success");
                    $response = $alertSuccess->render();

                } else {

                    $alertError = new Alert("Erreur ! Vous devez remplir tous les champs !");
                    $response = $alertError->render();

                }

            } else if(isset($_POST['deleteCategory'])) {

                $deleteId = trim($_POST['productId']);

                $categoryModel->delete($deleteId);

                $alertSuccess = new Alert("La catégorie a bien été supprimé !", "success");
                $response = $alertSuccess->render();

            }

            $categories = $categoryModel->getAll();

            $this->render("Admin.category", compact("response", "categories"));

        } else {
            $latest = Model::getModel("Shop\History")->getOrdersAdmin();
            $this->render("Admin.home", compact("latest"));
        }


    }

    public function check($param) {

        return isset($param) && !empty($param);

    }


}