<?php

namespace App\Controllers\Utils;

class Notification {


    public static function set($type, $msg, $css) {

        $_SESSION['errors'][$type]['msg'] = $msg;
        $_SESSION['errors'][$type]['css'] = $css;
    }

    public static function is($type) {

        if(isset($_SESSION["errors"][$type]['msg']) && !empty($_SESSION["errors"][$type]['msg']))
            return true;

        return false;
    }

    public static function remove($type) {

        unset($_SESSION["errors"][$type]['msg']);
        unset($_SESSION["errors"][$type]['css']);

    }

    public static function render($type) {

        $msg = $_SESSION["errors"][$type]['msg'];
        $css = $_SESSION["errors"][$type]['css'];

        $msg = new Alert($msg, $css);

        self::remove($type);

        return $msg->render();
    }



}