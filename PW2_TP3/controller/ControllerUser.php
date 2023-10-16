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

    public function delete() {
        if($_SERVER["REQUEST_METHOD"] != "POST"){
            requirePage::redirect("error");
            exit();
        } else {
            $id;
            if($_SESSION["privilege_id"] < 2) $id = $_POST["id"];
            else $id = $_SESSION["id"];

            
            $stamp = new Stamp;
            $where = ["target" => "customer_user_id", "value" => $id];
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
            if($_SESSION["privilege_id"] == 3) {
                session_destroy();
                RequirePage::redirect("user");
            } elseif($_SESSION["privilege_id"] > 2) RequirePage::redirect("panel");
        }
    }
    

    /**
     * enregistrer une entrée dans la DB
     */
    public function store() {
        if($_SERVER["REQUEST_METHOD"] != "POST"){
            requirePage::redirect("error");
            exit();
        } 

        if($_POST["privilege_id"] < 3) $data["staff"] = true;
        else $data["customer"] = true;

        $result = $this->validate();

        if($result->isSuccess()) {
            //vérifier si email existe dans la DB
            $user = new User;
            $where["target"] = "email";
            $where["value"] = $email;
            $exist = $user->ReadWhere($where);
            if($exist) {
                $data["error"] = "email already exists";
                if(isset($_SESSION["fingerprint"])) Twig::render("user/create.php", $data);
                else Twig::render("login/index.php", $data);
                exit();
            }

            //créer utilisateur
            $user = new User;
            $salt = "7dh#9fj0K";
            $_POST["password"] = password_hash($_POST["password"] . $salt, PASSWORD_BCRYPT);
            $userId = $user->create($_POST);

            //créer employé
            if($_POST["privilege_id"] < 3) {
                $staff = new Staff;
                $_POST["user_id"] = $userId;
                $staff->create($_POST);
            }
            //créer customer
            if($_POST["privilege_id"] == 3) {
                $customer = new Customer;
                $_POST["user_id"] = $userId;
                $customer->create($_POST);
            }

            //message custom ou panel si la requête est faite à l'interne(employé seulement)
            $data["success"] = "account created, please log in";
            if($_SESSION["privilege_id"] < 2) RequirePage::redirect("panel");
            else Twig::render("login/index.php", $data);

        } else {
            $data["errors"] = $result->getErrors();
            $data["user"] = $_POST;

            if(isset($_SESSION["fingerprint"])) Twig::render("user/create.php", $data);
            else Twig::render("login/index.php", $data);
        }
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
        checkSession::sessionAuth();

        $id;
        if($_SESSION["privilege_id"] < 2) $id = $_POST["id"];
        else $id = $_SESSION["id"];

        $user = new User;
        $data["user"] = $user->readId($id);
        Twig::render("user/edit.php", $data);
    }

    /**
     * mettre à jour une entrée dans la DB
     */
    public function update() {
        if($_SERVER["REQUEST_METHOD"] != "POST"){
            requirePage::redirect("error");
            exit();
        } 
        $result = $this->validate();

        if($result->isSuccess()) {
            $user = new User;
            $updatedId = $user->update($_POST);
            if($updatedId) RequirePage::redirect("customer/profile");
            else print_r($updatedId);
        } else {
            $data["errors"] = $result->getErrors();
            $data["user"] = $_POST;

            Twig::render("user/edit.php", $data);
        }

    }

    private function validate() {
        RequirePage::library("Validation");
        $val = new Validation;

        extract($_POST);
        $val->name("name")->value($name)->min(4)->max(45)->required();
        if(isset($email)) $val->name("email")->value($email)->pattern("email")->max(45)->required();
        if(isset($password)) $val->name("password")->value($password)->min(8)->max(20)->pattern("no_space")->required();
        $val->name("address")->value($address)->max(100);
        if(isset($nas)) $val->name("nas")->value($nas)->max(45)->required();

        return $val;
    }
}