<?php
RequirePage::model("Log");

class ControllerLog implements Controller {

    /**
     * afficher l'index
     */
    public function index() {
        $log = new log;
        $data["log"] = $log->read("DESC");
        Twig::render("panel/log.php", $data);
    }

    public function create() {
        $data["ip_address"] = $_SERVER["REMOTE_ADDR"];
        if(isset($_SERVER["PATH_INFO"])) {
            $data["page"] = ltrim( $_SERVER["PATH_INFO"], "/");
        } else $data["page"] = "home";
        if(isset($_SESSION["fingerprint"])) {
            $data["user_name"] = $_SESSION["name"];
            $data["privilege_id"] = $_SESSION["privilege_id"];
        }
        else $data["name"] = "guest";

        $log = new Log;
        $log->create($data);
    }
}