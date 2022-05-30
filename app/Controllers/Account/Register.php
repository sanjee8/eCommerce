<?php


namespace App\Controllers\Account;

use App\Core\Model\Model;

/**
 * Class Register
 * @package App\Controllers\Account
 */
class Register {


    /**
     * Submit register form
     * @return array
     */
    public function submit() {

        if(isset($_POST['signup'])) {

            $post = $_POST;



            $errors = 0;
            $error_msg = ["Erreur lors de votre inscription :"];


            $check = new Checks();


            $name_check = $check->user_exists($post['prenom'], $post['nom']);

            $errors += $name_check['errors'];
            array_push($error_msg, $name_check['error_msg']);


            if($errors == 0) {

                $nom_check = $check->name_test($post["nom"], "nom");
                $errors += $nom_check['errors'];
                array_push($error_msg, $nom_check['error_msg']);

                $prenom_check = $check->name_test($post["prenom"], "prénom");
                $errors += $prenom_check['errors'];
                array_push($error_msg, $prenom_check['error_msg']);

                $email_check = $check->mail_test($post['email']);
                $errors += $email_check['errors'];
                array_push($error_msg, $email_check['error_msg']);

                $pw_check = $check->pw_test($post['password']);
                $errors += $pw_check['errors'];
                array_push($error_msg, $pw_check['error_msg']);

                $pw_confirm_check = $check->pw_confirm_test($post['confirm_password'], $pw_check['value']);
                $errors += $pw_confirm_check['errors'];
                array_push($error_msg, $pw_confirm_check['error_msg']);


            }






            if($errors == 0) {

                $names= explode(";", $name_check['value']);
                $prenom = $names[0];
                $nom = $names[1];


                $user_model = Model::getModel("Session\User");
                $user_model->create($email_check['value'], $pw_check['value'], $prenom, $nom);

                $data = $user_model->get($email_check['value']);
                Model::getModel("Session\\Session")->log_in($data);
                return [true, "Félicitations ! Vous êtes désormais inscrit."];


            } else {

                return [false, $error_msg];

            }

        }

    }



}


namespace App\Controllers\Account;

use App\Core\Model\Model;

/**
 * Class Register
 * @package App\Controllers\Account
 */
class Register {


    /**
     * Submit register form
     * @return array
     */
    public function submit() {

        if(isset($_POST['signup'])) {

            $post = $_POST;



            $errors = 0;
            $error_msg = ["Erreur lors de votre inscription :"];


            $check = new Checks();


            $name_check = $check->user_exists($post['prenom'], $post['nom']);

            $errors += $name_check['errors'];
            array_push($error_msg, $name_check['error_msg']);


            if($errors == 0) {

                $nom_check = $check->name_test($post["nom"], "nom");
                $errors += $nom_check['errors'];
                array_push($error_msg, $nom_check['error_msg']);

                $prenom_check = $check->name_test($post["prenom"], "prénom");
                $errors += $prenom_check['errors'];
                array_push($error_msg, $prenom_check['error_msg']);

                $email_check = $check->mail_test($post['email']);
                $errors += $email_check['errors'];
                array_push($error_msg, $email_check['error_msg']);

                $pw_check = $check->pw_test($post['password']);
                $errors += $pw_check['errors'];
                array_push($error_msg, $pw_check['error_msg']);

                $pw_confirm_check = $check->pw_confirm_test($post['confirm_password'], $pw_check['value']);
                $errors += $pw_confirm_check['errors'];
                array_push($error_msg, $pw_confirm_check['error_msg']);


            }






            if($errors == 0) {

                $names= explode(";", $name_check['value']);
                $prenom = $names[0];
                $nom = $names[1];


                $user_model = Model::getModel("Session\User");
                $user_model->create($email_check['value'], $pw_check['value'], $prenom, $nom);

                $data = $user_model->get($email_check['value']);
                Model::getModel("Session\\Session")->log_in($data);
                return [true, "Félicitations ! Vous êtes désormais inscrit."];


            } else {

                return [false, $error_msg];

            }

        }

    }



}