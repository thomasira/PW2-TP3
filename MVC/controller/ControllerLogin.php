<?php
RequirePage::model("User");

class ControllerLogin implements Controller {

    /**
     * afficher l'index
     */
    public function index() {
        if(!isset($_SESSION["fingerPrint"])) Twig::render("login-index.php");
        else RequirePage::redirect("error");
    }

    /**
     * détruire la session
     */
    public function logout() {
        session_destroy();
        RequirePage::redirect("");
    }
}

?>