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
            $link = Router::getRouter()->getLink("account");
            header("Location: ". $link ."");
        }

    }


    public function register() {

        $this->response("App\Controllers\Account\Register", "Log.signup");

    }


    public function logout() {

        $user = Model::getModel("Session\Session");
        $user->log_out();

        $link = Router::getRouter()->getLink("home");

        $this->render("Log.logout", compact("link"));

    }

}
