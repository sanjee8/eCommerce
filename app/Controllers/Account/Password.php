<?php


namespace App\Controllers\Account;

use App\Core\Model\Model;

/**
 * Class Password
 * @package App\Controllers\Account
 */
class Password {


    public function submit() {

        if(isset($_POST['password_update'])) {

            $post = $_POST;

            $old_pw = trim($post['actual_password']);
            $new_pw = trim($post['new_password']);
            $confirm_pw = trim($post['confirm_password']);

            $user_model = Model::getModel("Session\User");
            $session = Model::getModel("Session\Session");

            $user = $user_model->get($session->get("identifiant"));

            if(password_verify($old_pw, $user['password'])) {

                $check = new Checks();

                $check_pw = $check->pw_test($new_pw);

                if($check_pw['errors'] == 0) {

                    $check_confirm = $check->pw_confirm_test($new_pw, $confirm_pw);

                    if($check_confirm['errors'] == 0) {

                        $id = $session->get('identifiant');

                        $user_model->setPassword($id, $check_pw['value']);

                        return [true, "Votre mot de passe a bien été mise à jour !"];

                    } else {
                        return [false, $check_confirm['error_msg']];
                    }

                } else {
                    return [false, $check_pw['error_msg']];
                }

            } else {

                return [false, "Erreur, votre mot de passe actuel est incorrect."];

            }


        }

    }


}