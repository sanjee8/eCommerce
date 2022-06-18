<?php

namespace App\Controllers\Request;

use App\Core\Controller\Controller;
use App\Core\Model\Model;

class RequestController extends Controller {



    public function add() {


        if(isset($_POST['type'])) {
            $post = $_POST;
            if($post['type'] === "add") {

                if(isset($post['id'])) {

                    $id = intval(trim($post['id']));

                    $session = Model::getModel("Session\Session");
                    if($session->isLogged()) {
                        var_dump($id);
                        $request = Model::getModel("Shop\Basket");
                        $request->add($session->get("id"), $id);
                        echo "added!";
                    }

                }

            }

        }

    }


}