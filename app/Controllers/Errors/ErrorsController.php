<?php


namespace App\Controllers\Errors;


use App\Core\Controller\Controller;

/**
 * Class ErrorsController
 * @package App\Controllers\Errors
 */
class ErrorsController extends Controller {


    /**
     * Render page 404
     */
    public function e_404() {

        $this->render("Errors.404");

    }

}