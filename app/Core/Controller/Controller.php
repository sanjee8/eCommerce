<?php


namespace App\Core\Controller;

use App\Core\Model\Model;
use App\Router;

/**
 * Class Controller
 * @package App\Core\Controller
 */
class Controller {


    protected $viewPath;
    protected $template = "default";


    public function __construct() {

        $general = include "Config/General.php";

        $this->viewPath = $general['view'];
    }

    /**
     * Render page
     * @param $view
     * @param null $variables
     */
    public function render($view, $variables = null) {

        ob_start();

        if($variables != null)
            extract($variables);

        $router = Router::getRouter();
        $session = Model::getModel("Session\Session");

        require (str_replace('\\', '/',$this->viewPath) . str_replace('.', '/', $view) . '.php');

        $content = ob_get_clean();

        require (str_replace('\\', '/',$this->viewPath) . 'templates/' . $this->template . '.php');



    }

}