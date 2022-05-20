<?php


namespace App\Controllers\Errors;


use App\Core\Controller\Controller;

/**
 * Class ErrorsController
 * @package App\Controllers\Errors
 */
class ErrorsController extends Controller {

    protected $template = "default";

    public function __construct() {

        $this->viewPath = ROOT . '\\eCommerce\\Views\\';
    }

    /**
     * Render page 404
     */
    public function e_404() {

        $this->render("Errors.404");

    }

}