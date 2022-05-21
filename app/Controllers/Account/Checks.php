<?php


namespace App\Models\Account;

use App\Core\Model\Model;

/**
 * Class Checks
 * @package App\Account
 */
class Checks {

    /**
     * Check if user exists
     * @param $p
     * @param $n
     * @return array
     */
    public function user_exists($p, $n) {

        $error_msg = "";
        $errors = 0;

        $prenom = trim($p);
        $nom = trim($n);

        $user = Model::getModel("Session\\User");

        if($user->count_by_names($prenom, $nom) > 0) {
            $error_msg .= "Vous êtes déjà inscrit sur le site. <br/>";
            $errors++;
        }

        return array(
            "value" => $prenom.";".$nom,
            "error_msg" => $error_msg,
            "errors" => $errors
        );

    }

    /**
     * Check if id exists
     * @param $id
     * @return array
     */
    public function id_test($id) {

        $error_msg = "";
        $errors = 0;

        if(isset($id)) {
            $identifiant = trim($id);
            $identifiant = htmlentities($identifiant, ENT_NOQUOTES, 'utf-8');
            $identifiant = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $identifiant);
            $identifiant = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $identifiant); // pour les ligatures e.g. '&oelig;'
            $identifiant = preg_replace('#&[^;]+;#', '', $identifiant);
            $identifiant = str_replace(';', '', $identifiant);
            $identifiant = str_replace(' ', '', $identifiant);
            $identifiant = str_replace('php', '', $identifiant);

            if($identifiant == '') {
                $error_msg .= "Vous devez spécifier un identifiant. <br/>";
                $errors++;
            } else if(strlen($identifiant) < 3) {
                $error_msg .= "Votre identifiant est trop court. <br/>";
                $errors++;
            } else if(strlen($identifiant) > 24) {
                $error_msg .= "Votre identifiant est trop long. <br/>";
                $errors++;
            } else {

                if(Model::getModel("Session\\User")->exists($identifiant)) {
                    $error_msg .= "Cet identifiant est déjà utilisé. <br/>";
                    $errors++;
                }

            }


        }

        return array(
            "value" => $identifiant,
            "error_msg" => $error_msg,
            "errors" => $errors
        );

    }

    /**
     * Check if password is correct
     * @param $password
     * @return array
     */
    public function pw_test($password) {

        $errors = 0;
        $error_msg = "";

        $password = trim($password);


        if($password == "") {
            $error_msg .= "Vous devez spécifier un mot de passe. <br />";
            $errors++;
        } elseif(strlen($password) < 4) {
            $error_msg .= "Votre mot de passe est trop court<br />";
            $errors++;
        } elseif(strlen($password) > 50) {
            $error_msg .= "Votre mot de passe est trop long<br />";
            $errors++;
        }

        return array(
            "value" => $password,
            "error_msg" => $error_msg,
            "errors" => $errors
        );

    }

    /**
     * Check if mail is correct
     * @param $mail
     * @return array
     */
    public function mail_test($mail) {

        $errors = 0;
        $error_msg = "";

        $mail = trim($mail);

        if($mail == ''){
            $error_msg .= "Vous devez spécifier votre adresse mail. <br />";
            $errors++;
            $mail = "";
        }
        else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $mail)){
            $error_msg .= "Votre adresse mail n'est pas valide. <br />";
            $errors++;
            $mail = "";
        }
        else {

            if(Model::getModel("Session\\User")->count_by_email($mail)  > 0){
                $error_msg .= "L'adresse mail renseigné est déjà utilisé. <br />";
                $errors++;
                $mail = "";
            }
        }

        return array(
            "value" => $mail,
            "error_msg" => $error_msg,
            "errors" => $errors
        );

    }

    /**
     * Check if same mails
     * @param $confirm_email
     * @param $email
     * @return array
     */
    public function confirm_mail_test($confirm_email, $email) {

        $errors = 0;
        $error_msg = "";

        $confirm_email = trim($confirm_email);

        if($confirm_email != $email) {
            $errors++;
            $error_msg .= "Vos adresses mail ne correspondent pas. <br />";
        }

        return array(
            "value" => $confirm_email,
            "error_msg" => $error_msg,
            "errors" => $errors
        );
    }

    /**
     * Check if same passwords
     * @param $confirm
     * @param $pw
     * @return array
     */
    public function pw_confirm_test($confirm, $pw) {

        $errors = 0;
        $error_msg = "";

        $conf_password = trim($confirm);

        if($conf_password !== $pw && $conf_password !== "") {
            $error_msg .= "Vos mot de passes ne correspondent pas. <br/>";
            $errors++;
        } else if($conf_password === "") {
            $error_msg .= "Vous devez confirmer votre mot de passe <br />";
            $errors++;
        }


        return array(
            "value" => $conf_password,
            "error_msg" => $error_msg,
            "errors" => $errors
        );
    }

}