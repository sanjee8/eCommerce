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
    protected $template;

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

        require ($this->viewPath . str_replace('.', '\\', $view) . '.php');

        $content = ob_get_clean();

        require ($this->viewPath . 'templates\\' . $this->template . '.php');



    }

}