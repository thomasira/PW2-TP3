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
        
        Twig::render("category/category-index.php", $data);
    }

    /**
     * afficher formulaire créer
     */
    public function create() {
        if(!isset($_SESSION["fingerPrint"]) || $_SESSION["name"] != "root") RequirePage::redirect("error");
        else Twig::render("category/category-create.php");
    }

    /**
     * supprimer les entrées de la table stamp_category associé à la clé($cat_id) et supprimer l'entrée
     */
    public function delete() {
        checkSession::sessionAuth(2);

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
        
        Twig::render("category/category-edit.php", $data);
        
    }

    /**
     * enregistrer une nouvelle entrée dans la DB
     */
    public function store() {
        if(!isset($_POST["category"])) RequirePage::redirect("error");
        else {
            $category = new Category;
            $categoryId = $category->create($_POST);

            RequirePage::redirect("category");
        }
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