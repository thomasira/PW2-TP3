<?php
RequirePage::model("Log");

class ControllerLog implements Controller {

    /**
     * afficher l'index
     */
    public function index() {
        CheckSession::sessionAuth(2);
        $log = new log;
        $data["log"] = $log->read("DESC");
        Twig::render("panel/log.php", $data);
    }
}