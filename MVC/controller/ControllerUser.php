<?php
RequirePage::model("User");
RequirePage::model("Privilege");
RequirePage::model("Staff");
RequirePage::model("Stamp");
RequirePage::model("Customer");
RequirePage::model("StampCategory");

class ControllerUser implements Controller {

    /**
     * afficher l'index
     */
    public function index() {
        $user = new User;
        $read = $user->read();
        $data = ["users" => $read];
        Twig::render("user/user-index.php", $data);
    }

    /**
     * afficher le formulaire créer
     */
    public function create() {
        if(CheckSession::sessionAuth() == 1) {
            $privilege = new Privilege;
            $data["privileges"] = $privilege->read();

            Twig::render("user/user-create.php", $data);

        } else RequirePage::redirect("error");
    }

    /**
     * supprimer une entrée de la DB et supprimer les entrées associées de la DB
     */
    public function delete() {
        if(!isset($_POST["id"])) {
            RequirePage::redirect("error");
        } else {
            $id;
            if($_SESSION["name"] == "root") $id = $_POST["id"];
            else $id = $_SESSION["id"];

            $stamp = new Stamp;
            $where = ["target" => "user_id", "value" => $id];
            $stamps = $stamp->readWhere($where);

            if($stamps) {
                foreach($stamps as $stamp) {
                    $stamp_id = $stamp["id"];
                    $stampCategories = new StampCategory;
                    $stampCategories->deleteStampCat($stamp_id);

                    $stamp = new Stamp;
                    $stamp->delete($stamp_id);
                }
            }
            $user = new User;
            $user->delete($id);
            if($_SESSION["name"] != "root") {
                session_destroy();
                RequirePage::redirect("user");
            } elseif($_SESSION["name"] == "root") RequirePage::redirect("panel");
        }
    }
    

    /**
     * enregistrer une entrée dans la DB
     */
    public function store() {
        if($_SERVER["REQUEST_METHOD"] != "POST") requirePage::redirect("error");

        $user = new User;
        $salt = "7dh#9fj0K";
        $_POST["password"] = password_hash($_POST["password"] . $salt, PASSWORD_BCRYPT);
        $userId = $user->create($_POST);


        if($_POST["privilege_id"] < 3) {
            $staff = new Staff;
            $_POST["user_id"] = $userId;
            $staff->create($_POST);
        }
        if($_POST["privilege_id"] == 3) {
            $customer = new Customer;
        }

        $data["success"] = "account created, please log in";
        if(CheckSession::sessionAuth() < 3) {
            RequirePage::redirect("panel");
        } else Twig::render("login-index.php", $data);
    }

    /**
     * afficher un utilisateur
     */
    public function show($id) {
        $user = new User;
        $data["user"] = $user->readId($id);

/*         $stamp = new Stamp;
        $where = ["target" => "user_id", "value" => $data["user"]["id"]];
        $data["stamps"] = $stamp->readWhere($where); */

        Twig::render("user/user-show.php", $data);
    }

    /**
     * afficher le profil d'utilisateur
     */
    public function profile() {
        if(isset($_SESSION["fingerPrint"]) && $_SESSION["name"] == "root") {
            RequirePage::redirect("panel");
        } 
        if(!isset($_SESSION["fingerPrint"])) {
            Twig::render("error.php");
            exit();
        } 

        $id = $_SESSION["id"];
        $user = new User;
        $data["user"] = $user->readId($id);

        $stamp = new Stamp;
        $where = ["target" => "user_id", "value" => $data["user"]["id"]];
        $data["stamps"] = $stamp->readWhere($where);
        
        Twig::render("user-profile.php", $data);
    }

    /**
     * afficher le formulaire mettre à jour
     */
    public function edit() {
        $id;
        if(!isset($_SESSION["fingerPrint"])){
            Twig::render("error.php");
            exit();
        }
        if($_SESSION["name"] == "root") $id = $_POST["id"];
        else $id = $_SESSION["id"];

        $user = new User;
        $data["user"] = $user->readId($id);
        Twig::render("user-edit.php", $data);
    }

    /**
     * mettre à jour une entrée dans la DB
     */
    public function update() {
        if(!isset($_POST["id"])) {
            Twig::render("error.php");
            exit();
        }
        $user = new User;
        $updatedId = $user->update($_POST);
        if($updatedId) {
            RequirePage::redirect('user/profile');
        }
        else print_r($updatedId);
    }

    /**
     * authentifier l'identification d'un utilisateur
     */
    public function auth() {
        $user = new User;
        $where = ["target" => "email", "value" => $_POST["email"]];
        $readUser = $user->readWhere($where);

        if(!$readUser) {
            $data["error"] = "no such account";
            Twig::render("login-index.php", $data);
            exit();
        }

        $readUser = $readUser[0];
        $password = $_POST["password"];
        $dbPassword = $readUser["password"];
        $salt = "7dh#9fj0K";

        if(password_verify($password.$salt, $dbPassword)){
            session_regenerate_id();
            $_SESSION["id"] = $readUser["id"];
            $_SESSION["name"] = $readUser["name"];
            $_SESSION["fingerprint"] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
            $_SESSION["privilege_id"] = $readUser["privilege_id"];
        } else {
            $data["error"] = "password not correct";
            Twig::render("login-index.php", $data);
            exit();
        }
        if($_SESSION["name"] == "root") RequirePage::redirect("panel");
        else RequirePage::redirect("user/profile");
    }
}