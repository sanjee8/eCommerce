<?php


namespace App\Models\Session;


use App\Core\Model\Model;

/**
 * Class User
 * @package App\Models\Session
 */
class User extends Model {

    public function create($id, $password, $email, $prenom, $nom) {

        $date = time();
        $hash = password_hash($password, PASSWORD_DEFAULT);


        $this->db->prepare("
            INSERT INTO users(email, password, date_register, prenom, nom)
            VALUES(?,?,?,?,?)
        ", [$email, $hash, $date, $prenom, $nom]);

    }

    /**
     * Get user by id
     * @param $id
     * @return mixed
     */
    public function get($id) {

        return $this->db->prepare("
            SELECT *
            FROM users
            WHERE identifiant = ?
        ", [$id])->fetch();


    }

    /**
     * If exists by id
     * @param $id
     * @return bool
     */
    public function exists($id) {

        if($this->count_by_id($id) > 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Count by names
     * @param $prenom
     * @param $nom
     * @return mixed
     */
    public function count_by_names($prenom, $nom) {

        $result = $this->db->prepare("
            SELECT count(*) AS nbr
            FROM users WHERE prenom = ? AND nom = ?
        ", [$prenom, $nom])->fetch();

        return $result['nbr'];

    }

    /**
     * Count by id
     * @param $id
     * @return mixed
     */
    public function count_by_id($id) {

        $result = $this->db->prepare("
            SELECT count(*) AS nbr
            FROM users WHERE identifiant = ?
        ", [$id])->fetch();

        return $result['nbr'];

    }

    /**
     * Count by email
     * @param $email
     * @return mixed
     */
    public function count_by_email($email) {

        $result = $this->db->prepare("
            SELECT count(*) AS nbr
            FROM users WHERE email = ?
        ", [$email])->fetch();

        return $result['nbr'];

    }

    /**
     * Change password of a user
     * @param $id
     * @param $password
     */
    public function setPassword($id, $password) {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->db->prepare("
            UPDATE users
            SET password = ?
            WHERE identifiant = ?
        ", [$hash, $id]);

    }

    /**
     * Change email of a user
     * @param $id
     * @param $mail
     */
    public function setEmail($id, $mail) {

        $this->db->prepare("
            UPDATE users
            SET email = ?
            WHERE identifiant = ?
        ", [$mail, $id]);

    }



}