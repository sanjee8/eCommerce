<?php


namespace App\Controllers\Utils;

/**
 * Class Alert
 * @package App\Controllers\Utils
 */
class Alert {

    private $messages;
    private $style;

    public function __construct($message, $style = "danger") {

        $this->style = $style;

        if(is_array($message)) {
            $this->messages = $message;
        } else {
            $this->messages = [$message];
        }

    }

    public function add($msg) {
        array_push($this->messages, $msg);
    }

    public function render() {

        if(sizeof($this->messages) == 1) {
            {
                $html = "<div class='alert alert-" . $this->style . "'>";
                $html .= $this->messages[0];
                $html .= "</div>";

                return $html;
            }
        } else {
            $html = "<div class='alert alert-" . $this->style . "'>";
            $html .= "<strong>" . $this->messages[0] . "</strong> <br />";
            unset($this->messages[0]);
            foreach ($this->messages as $msg) {
                $html .= $msg;
            }
            $html .= "</div>";

            return $html;
        }

    }

}