<?php
RequirePage::model("Stamp");
RequirePage::model("Log");

class ControllerHome implements Controller {

    /**
     * afficher l'index
     */
    public function index() {
        $stamp = new Stamp;
        $data["stamps"] = $stamp->read();
        Twig::render("home-index.php", $data);
    }

    /**
     * afficher page erreur
     */
    public function error() {
        Twig::render("error.php");
    }
}