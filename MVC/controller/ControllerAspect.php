<?php
RequirePage::model("Aspect");
RequirePage::model("Stamp");

class ControllerAspect implements Controller {
    
    /**
     * rediriger ver la page index. Aurait pu ne pas implementer l'interface Controller aussi
     */
    public function index() {
        RequirePage::redirect("error");
    }

    /**
     * valider utilisateur et afficher le formulaire créer
     */
    public function create() {
        CheckSession::sessionAuth(2);
        Twig::render("aspect/aspect-create.php");
    }

    /**
     * mettre à jour les étampes qui partagent la clé($id) et supprimer l'aspect
     */
    public function delete() {
        if(!isset($_SESSION["fingerPrint"]) ||
        $_SESSION["name"] != "root" ||
        !isset($_POST["id"])) {
            RequirePage::redirect("error");
        } else {
            $id = $_POST["id"];

            $stamp = new Stamp;
            $where["target"] = "aspect_id";
            $where["value"] = $id;
            $stamps = $stamp->readWhere($where);
            foreach($stamps as $stamp) {
                $data["aspect_id"] = null;
                $data["id"] = $stamp["id"];
                $stamp = new Stamp;
                $stamp->update($data);
            }

            $aspect = new Aspect;
            $aspect->delete($id);

            RequirePage::redirect("panel");
        }
    }

    /**
     * afficher le formualire mettre à jour
     */
    public function edit() {
        if(!isset($_SESSION["fingerPrint"]) ||
        $_SESSION["name"] != "root" ||
        !isset($_POST["id"])) {
            RequirePage::redirect("error");
        } else {
            $id = $_POST["id"];

            $aspect = new Aspect;
            $data["aspect"] = $aspect->readId($id);

            Twig::render("aspect/aspect-edit.php", $data);
        }
    }

    /**
     * enregistrer une nouvelle entrée dans la DB
     */
    public function store() {
        if(!isset($_POST["aspect"])) RequirePage::redirect("error");
        else {
            $aspect = new Aspect;
            $aspect->create($_POST);

            RequirePage::redirect("panel");
        }
    }

    /**
     * mettre à jour l'entrée dans la DB
     */
    public function update() {
        if(!isset($_POST["aspect"])) RequirePage::redirect("error");
        else {
            $aspect = new Aspect;
            $aspect->update($_POST);
            
            RequirePage::redirect("panel");
        }
    }
}