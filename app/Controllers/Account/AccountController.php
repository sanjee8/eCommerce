<?php


namespace App\Controllers\Account;


use App\Controllers\Utils\Alert;
use App\Core\Controller\Controller;
use App\Core\Model\Model;
use App\Router;

/**
 * Class AccountController
 * @package App\Controllers\Account
 */
class AccountController extends Controller {

    # Template
    protected $template = "default";

    /**
     * AccountController constructor.
     */
    public function __construct() {


        $this->viewPath = ROOT . '\\eCommerce\\Views\\';
    }

    public function account() {

        $session = Model::getModel("Session\Session");

        if($session->isLogged()) {
            $g = $_GET;
            if(isset($g["password"])) {
                $this->response("App\Controllers\Account\Password", "Log.password");
            } elseif (isset($g['email'])) {
                $this->response("App\Controllers\Account\Email", "Log.email");
            } else {
                $this->render("log.account");
            }

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
            } elseif(!$resp[0]) {
                $error = new Alert($resp[1]);
                $response = $error->render();
            }
        }


        $this->render($view, compact('response'));

    }

}
