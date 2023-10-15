<?php
RequirePage::model("StampArchive");

class ControllerArchive implements Controller {

    /**
     * afficher l'index
     */
    public function index() {
        CheckSession::sessionAuth(2);
        $archive = new StampArchive;
        $data["archive"] = $archive->read();
        Twig::render("panel/archive.php", $data);
    }

}