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
        Twig::render("aspect/create.php");
    }

    /**
     * mettre à jour les étampes qui partagent la clé($id) et supprimer l'aspect
     */
    public function delete() {
        if($_SERVER["REQUEST_METHOD"] != "POST") {
            requirePage::redirect("error");
            exit();
        }
        $id = $_POST["id"];
        $stamp = new Stamp;
        $where["target"] = "aspect_id";
        $where["value"] = $id;
        $stamps = $stamp->readWhere($where);
        if($stamps) {
            foreach($stamps as $stamp) {
                $data["aspect_id"] = null;
                $data["id"] = $stamp["id"];
                $stamp = new Stamp;
                $stamp->update($data);
            }
        }
        $aspect = new Aspect;
        $aspect->delete($id);
        RequirePage::redirect("panel");
    }

    /**
     * afficher le formulaire mettre à jour
     */
    public function edit() {
        if($_SERVER["REQUEST_METHOD"] != "POST") {
            requirePage::redirect("error");
            exit();
        }
        $id = $_POST["id"];
        $aspect = new Aspect;
        $data["aspect"] = $aspect->readId($id);
        Twig::render("aspect/edit.php", $data);
    }

    /**
     * enregistrer une nouvelle entrée dans la DB
     */
    public function store() {
        if($_SERVER["REQUEST_METHOD"] != "POST") {
            requirePage::redirect("error");
            exit();
        }

        $result = $this->validate();

        if($result->isSuccess()) {
            $aspect = new Aspect;
            $aspect->create($_POST);
            RequirePage::redirect("panel");
        } else {
            $data["aspect"] = $_POST;
            $data["errors"] = $result->getErrors();
            Twig::render("aspect/create.php", $data);
        }
    }

    /**
     * mettre à jour l'entrée dans la DB
     */
    public function update() {
        if($_SERVER["REQUEST_METHOD"] != "POST") {
            requirePage::redirect("error");
            exit();
        }

        $result = $this->validate();
        
        if($result->isSuccess()) {
            $aspect = new Aspect;
            $aspect->update($_POST);
            RequirePage::redirect("panel");
        } else {
            $data["aspect"] = $_POST;
            $data["errors"] = $result->getErrors();
            Twig::render("aspect/edit.php", $data);
        }
    }

    /**
     * valider les entrées
     */
    public function Validate() {
        if($_SERVER["REQUEST_METHOD"] != "POST") {
            requirePage::redirect("error");
            exit();
        }
        RequirePage::library("Validation");
        $val = new Validation;

        extract($_POST);
        $val->name("aspect")->value($aspect)->min(3)->max(45)->required();

        return $val;
    }
}