<?php


namespace App\Models\Session;


use App\Core\Model\Model;

/**
 * Class Session
 * @package App\Models\Session
 */
class Session extends Model {

    /**
     * Init sessions
     */
    public function init() {
        session_start();
    }

    /**
     * Check if isLogged
     * @return bool
     */
    public function isLogged() {
        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    /**
     * Log out session
     */
    public function log_out() {
        if ($this->isLogged()) {
            unset($_SESSION['user']);
            session_destroy();
        }
    }

    /**
     * Log in session
     * @param $data
     */
    public function log_in($data) {

        $date = time();
        $this->set_session("id", $data['id']);
        $this->set_session("email", $data['email']);
        $this->set_session("date_register", $data['date_register']);
        $this->set_session("prenom", $data['prenom']);
        $this->set_session("nom", $data['nom']);
        $this->set_session("log_time", $date);


    }

    public function get($key) {
        return $_SESSION['user'][$key];
    }

    /**
     * Set session value
     * @param $name
     * @param $value
     */
    public function set_session($name, $value) {
        $_SESSION['user'][$name] = $value;
    }

}