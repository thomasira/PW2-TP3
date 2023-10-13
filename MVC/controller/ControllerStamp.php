<?php
RequirePage::model("Stamp");
RequirePage::model("User");
RequirePage::model("Aspect");
RequirePage::model("Category");
RequirePage::model("StampCategory");


class ControllerStamp implements Controller {

    /**
     * afficher l'index
     */
    public function index() {
        $stamp = new Stamp;
        $data["stamps"] = $stamp->read();

        Twig::render("stamp/stamp-index.php", $data);
    }

    /**
     * afficher le formulaire créer
     */
    public function create() {
        if(isset($_SESSION["fingerPrint"])) $data["session_user"] = $_SESSION;

        $aspect = new Aspect;
        $data["aspects"] = $aspect->read();

        $category = new Category;
        $data["categories"] = $category->read();

        $user = new User;
        $data["users"] = $user->read();

        Twig::render("stamp/stamp-create.php", $data);
    }

    /**
     * supprimer les entrées de la table stamp_category associé à la clé($stamp_id) et supprimer l'entrée
     */
    public function delete() {
        if(!$_POST){
            RequirePage::redirect("error");
            exit();
        }
        $stamp_id = $_POST["id"];

        $stampCategories = new StampCategory;
        $stampCategories->deleteStampCat($stamp_id);

        $stamp = new Stamp;
        $stamp->delete($stamp_id);

        RequirePage::redirect("stamp");
    }

    /**
     * afficher le formulaire mettre à jour
     */
    public function edit() {
        if(isset($_SESSION["fingerPrint"])) $data["session_user"] = $_SESSION;

        if(!$_POST){
            RequirePage::redirect("error");
            exit();
        }
        $id = $_POST["id"];
        $stamp = new stamp; 

        $aspect = new Aspect;
        $data["aspects"] = $aspect->read();

        $category = new Category;
        $data["categories"] = $category->read();

        $user = new User;
        $data["users"] = $user->read();


        $data["stamp"] = $stamp->readId($id);
        $stampCategories = new StampCategory;
        if($stampCategories->readStampCat($data["stamp"]["id"])) {
            $readStampCategories = $stampCategories->readStampCat($data["stamp"]["id"]);

            foreach($readStampCategories as $stampCategory) {
                $category = new Category;
                $data["stamp_categories"][] = $category->readId($stampCategory["category_id"]);
            }

            /* boucler sur les categories correspondantes et les "check" */
            foreach ($data["categories"] as &$category) {
                foreach ($data["stamp_categories"] as $stamp_category) {
                    if($stamp_category["category"] == $category["category"]) $category["checked"] = true;
                }
            }
        }
        /* boucler sur les aspects et "selected" le correspondant */
        foreach ($data["aspects"] as &$aspect) {
            if($data["stamp"]["aspect_id"] == $aspect["id"]) $aspect["selected"] = true;
        }
        Twig::render("stamp/stamp-edit.php", $data);
    }

    /**
     * afficher un timbre
     */
    public function show($id) {
        $categories = [];
        $stamp = new Stamp;
        $readStamp = $stamp->readId($id);
        $data["stamp"] = $readStamp;


        if(isset($readStamp["aspect_id"])){
            $aspect = new Aspect;
            $data["aspect"] = $aspect->readId($readStamp["aspect_id"]);
        }
        
        $stampCategories = new StampCategory;
        if($stampCategories->readStampCat($readStamp["id"])) {
            $readStampCategories = $stampCategories->readStampCat($readStamp["id"]);
            foreach($readStampCategories as $stampCategory) {
                $category = new Category;
                $data["categories"][] = $category->readId($stampCategory["category_id"]);
            }
        }
        Twig::render("stamp/stamp-show.php", $data);
    }

    /**
     * enregistrer une entrée dans la DB
     */
    public function store() {
        if(!$_POST){
            RequirePage::redirect("error");
            exit();
        }
        $stamp = new Stamp;

        /* s'assurer que l'entrée soit INT */
        $_POST["year"] = intval($_POST["year"]);

        /*enregistrer les entrées liées à la table category et stamp_category */
        if(isset($_POST["new_categories"])) {
            foreach($_POST["new_categories"] as $category) {
                if($category != "") {
                    $data["category"] = $category;

                    $category = new Category;
                    $category_id = $category->create($data);

                    /*conversion de la valeur en clé, poussé dans le $_POST, utile car les autres champs recueillis sont booléens, voir plus bas */
                    $_POST["category_id"][$category_id] = 1;
                }
            }
        }
        $stamp_id = $stamp->create($_POST);
        
        if(isset($_POST["category_id"])){
            foreach($_POST["category_id"] as $category_id => $category){
                $stampCategory = new StampCategory;
                $stampCategory->create([ "stamp_id" => $stamp_id, "category_id" => $category_id]);
            }
        }
        RequirePage::redirect('stamp/show/'. $stamp_id);
    }

    /**
     * mettre à jour les entrées
     */
    public function update() {
        if(!$_POST){
            RequirePage::redirect("error");
            exit();
        }
        $stamp_id = $_POST["id"];
        $stampCategories = new StampCategory;
        $stampCategories->deleteStampCat($stamp_id);

        /*enregistrer les entrées liées à la table category et stamp_category */
        if(isset($_POST["new_categories"])) {
            foreach($_POST["new_categories"] as $category) {
                if($category != "") {
                    $data["category"] = $category;

                    $category = new Category;
                    $category_id = $category->create($data);

                    $_POST["category_id"][$category_id] = 1;
                }
            }
        }
        if(isset($_POST["category_id"])){
            foreach($_POST["category_id"] as $category_id => $category){
                $stampCategory = new StampCategory;
                $stampCategory->create([ "stamp_id" => $stamp_id, "category_id" => $category_id]);
            }
        }
        
        $stamp = new stamp;
        $_POST["year"] = intval($_POST["year"]);
        $updatedId = $stamp->update($_POST);
        if($updatedId) {
            RequirePage::redirect("stamp/show/$stamp_id");
        }
        else print_r($updatedId);
    }

}