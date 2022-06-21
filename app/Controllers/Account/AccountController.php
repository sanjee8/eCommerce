<?php


namespace App\Controllers\Account;


use App\Controllers\Utils\Alert;
use App\Controllers\Utils\Notification;
use App\Core\Controller\Controller;
use App\Core\Model\Model;
use App\Router;

/**
 * Class AccountController
 * @package App\Controllers\Account
 */
class AccountController extends Controller {

    public function account() {

        $session = Model::getModel("Session\Session");

        if($session->get("admin") == 1) {
            header("Location: ". Router::getRouter()->getLink("admin") ."");
            return;
        }

        if($session->isLogged()) {

            $orders = Model::getModel("Shop\History")->getOrders($session->get("id"));
            $response = "";
            if(sizeof($orders) == 0) {
                $message = new Alert("Vous n'avez encore passé aucune commande !", "warning");
                $response = $message->render();
            }
            $productsOf = [];
            foreach ($orders as $order) {

                $productsOf[$order->id] = Model::getModel("Shop\History")->getProducts($order->id);

            }

            $this->render("Account.orders", compact("orders", "productsOf", "response"));


        } else {
            $link = Router::getRouter()->getLink("signin");
            header("Location: ". $link);
        }

    }

    protected function response($class, $view) {

        $sign = new $class();
        $resp = $sign->submit();
        $response = null;



        if($resp != null) {
            if($resp[0]) {
                $success = new Alert($resp[1], "success");
                $response = $success->render();
                $link = Router::getRouter()->getLink("home");

                $session = Model::getModel("Session\Session");
                $products_logged = Model::getModel("Shop\Basket")->getBasketOf($session->get('id'));
                $products_basket = [];
                foreach ($products_logged as $pro) {

                    $fproduct = Model::getModel("Shop\Product")->get($pro->product_id);
                    array_push($products_basket, $fproduct);
                }

                if($session->get("id") == 1) {
                    header("Location: ". Router::getRouter()->getLink("admin") ."");
                    return;
                }

                setcookie("products", json_encode($products_basket), time() + 24*3600*7, '/');

                header("Location: ". $link ."");
            } elseif(!$resp[0]) {
                $error = new Alert($resp[1]);
                $response = $error->render();
            }
        }

        $notif = "";
        if(Notification::is("login")) {
            $notif = Notification::render("login");
        }


        $this->render($view, compact('response', "notif"));

    }

}
