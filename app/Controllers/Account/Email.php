<?php


namespace App\Models\Account;

use App\Controllers\Account\Checks;
use App\Core\Model\Model;

/**
 * Class Password
 * @package App\Controllers\Account
 */
class Email {


    public function submit() {

        if(isset($_POST['email_update'])) {

            $post = $_POST;

            $old_pw = trim($post['actual_password']);
            $new_mail = trim($post['new_email']);
            $confirm_mail = trim($post['confirm_email']);

            $user_model = Model::getModel("Session\User");
            $session = Model::getModel("Session\Session");

            $user = $user_model->get($session->get("identifiant"));

            if(password_verify($old_pw, $user['password'])) {

                $check = new Checks();

                $check_mail = $check->mail_test($new_mail);

                if($check_mail['errors'] == 0) {

                    $check_confirm = $check->confirm_mail_test($new_mail, $confirm_mail);

                    if($check_confirm['errors'] == 0) {

                        $id = $session->get('identifiant');

                        $user_model->setEmail($id, $check_mail['value']);

                        return [true, "Votre adresse mail bien été mise à jour !"];

                    } else {
                        return [false, $check_confirm['error_msg']];
                    }

                } else {
                    return [false, $check_mail['error_msg']];
                }

            } else {

                return [false, "Erreur, votre mot de passe actuel est incorrect."];

            }


        }

    }


}