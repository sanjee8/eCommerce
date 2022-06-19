<?php
namespace App\Controllers\Account;

use App\Core\Model\Model;


/**
 * Class Login
 * @package App\Controllers\Account
 */
class Login {

    /**
     * Submit login form
     * @return array
     */
    public function submit() {


        if(isset($_POST['email'])) {

            $post = $_POST;

            $user = Model::getModel("Session\\User");

            $errors = 0;
            $error_msg = "Erreur lors la connexion : <br />";


            if(isset($post['email']) && !empty($post['email'])) {

                $email = trim($post['email']);

                if(!$user->exists($email)) {
                    $errors++;
                    $error_msg .= "- L'utilisateur rentré est introuvable.<br />";
                }


            } else {
                $errors++;
                $error_msg .= "- Vous devez rentrer votre adresse mail.<br />";
            }

            if(isset($post['password']) && !empty($post["password"])) {

                $password = trim($post["password"]);

            } else {
                $errors++;
                $error_msg .= "- Vous devez rentrer votre mot de passe.<br />";
            }

            if($errors == 0) {

                $data = $user->get($email);


                if(password_verify($password, $data['password'])) {



                    Model::getModel("Session\\Session")->log_in($data);

                    if(isset($_COOKIE['productsNOTLOGGED'])) {
                        $pCookiesNL = json_decode($_COOKIE['productsNOTLOGGED']);

                        foreach ($pCookiesNL as $pNL) {

                            $request = Model::getModel("Shop\Basket");
                            $request->add($data['id'], $pNL->id);

                        }


                        unset($_COOKIE['productsNOTLOGGED']);
                        setcookie("productsNOTLOGGED", "[]", time() + 24*3600*7, '/');

                    }

                    $products_brut = Model::getModel("Shop\Basket")->getBasketOf($data['id']);
                    $products = Model::getModel("Shop\Product")->check($products_brut, true);


                    $size = sizeof($products);
                    $array_cookie = [];
                    foreach ($products as $product) {
                        $obj = array(
                            "name" => $product->name,
                            "price" => $product->price,
                            "image" => $product->image,
                            "id" => $product->id,
                        );
                        array_push($array_cookie, $obj);
                    }

                    if($size > 0) {
                        $products_string = json_encode($array_cookie);
                        setcookie("products", $products_string, time() + 24*3600*7, '/');

                    } else {
                        unset($_COOKIE['products']);
                        setcookie("products", "[]", time() + 24*3600*7, '/');
                    }






                    return [true, "<strong>Connexion réussie ! </strong> Veuillez patienter, vous allez être redirigé.<br />"];

                } else {

                    $errors++;
                    $error_msg .= "- Le mot de passe et l'identifiant ne correspondent pas.<br />";

                }




            }

            if($errors > 0) {
                return [false, $error_msg];
            }


        }

    }




}
