<?php
RequirePage::model("Category");
RequirePage::model("StampCategory");

class ControllerCategory implements Controller {

    /**
     * afficher index
     */
    public function index() {
        $category = new Category;
        $data["categories"] = $category->read();
        
        Twig::render("category/index.php", $data);
    }

    /**
     * afficher formulaire créer
     */
    public function create() {
        CheckSession::sessionAuth(2);
        Twig::render("category/create.php");
    }

    /**
     * supprimer les entrées de la table stamp_category associé à la clé($cat_id) et supprimer l'entrée
     */
    public function delete() {

        if($_SERVER["REQUEST_METHOD"] != "POST") {
            requirePage::redirect("error");
            exit();
        }
        $cat_id = $_POST["id"];

        $stampCategories = new StampCategory;
        $stampCategories->deleteStampCat(null, $cat_id);

        $category = new Category;
        $category->delete($cat_id);

        RequirePage::redirect("panel");
    }

    /**
     * afficher formulaire mettre à jour
     */
    public function edit() {
        checkSession::sessionAuth(2);

        $id = $_POST["id"];

        $category = new Category;
        $data["category"] = $category->readId($id);
        
        Twig::render("category/edit.php", $data);
        
    }

    /**
     * enregistrer une nouvelle entrée dans la DB
     */
    public function store() {
        if($_SERVER["REQUEST_METHOD"] != "POST") requirePage::redirect("error");
        
        $category = new Category;
        $category->create($_POST);

        RequirePage::redirect("category"); 
    }

    /**
     * mettre à jour l'entrée dans la DB
     */
    public function update() {
        if(!isset($_POST["category"])) RequirePage::redirect("error");
        else {
            $category = new Category;
            $category->update($_POST);
            
            RequirePage::redirect("panel");
        }
    }
}