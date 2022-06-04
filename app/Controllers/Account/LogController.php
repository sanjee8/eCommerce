<?php


namespace App\Controllers\Account;


use App\Core\Model\Model;
use App\Router;

/**
 * Class LogController
 * @package App\Controllers\Account
 */
class LogController extends AccountController {

    /**
     *
     */
    public function login() {
        if(!Model::getModel("Session\Session")->isLogged()) {
            $this->response("App\Controllers\Account\Login", "Log.signin");
        } else {
            $link = Router::getRouter()->getLink("home");
            header("Location: ". $link ."");
        }

    }


    public function register() {

        $this->response("App\Controllers\Account\Register", "Log.signup");

    }


    public function logout() {

        $user = Model::getModel("Session\Session");
        $user->log_out();
        unset($_COOKIE['products']);
        setcookie("products", "[]", time() + 24*3600*7, '/');
        $link = Router::getRouter()->getLink("home");

        $this->render("Log.logout", compact("link"));

    }

}
