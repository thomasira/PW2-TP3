<?php
RequirePage::model("Customer");
RequirePage::model("User");
RequirePage::model("StampCategory");
RequirePage::model("StampArchive");
RequirePage::model("Privilege");
RequirePage::model("Stamp");

class ControllerCustomer implements Controller {

    /**
     * afficher l'index
     */
    public function index() {
        $customer = new Customer;
        $data["customers"] = $customer->read();
        Twig::render("customer/index.php", $data);
    }

    /**
     * afficher le formulaire créer
     */
    public function create() {
        $privilege = new Privilege;
        $data["privileges"] = $privilege->read();
        $data["customer"] = true;
        Twig::render("user/create.php", $data);
    }

    /**
     * suprrimer une entrée(customer + user)
     */
    public function delete() {
        if($_SERVER["REQUEST_METHOD"] != "POST"){
            requirePage::redirect("error");
            exit();
        } else {
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
                    $deletedStamp = $stamp->readId($stamp_id);

                    $stampArchive = new StampArchive;
                    $stampArchive->create($deletedStamp);
                    
                    $stamp->delete($stamp_id);
                }
            }
            $customer = new Customer;
            $customer->delete($id);
            $user = new User;
            $user->delete($id);
            
            if($_SESSION["privilege_id"] == 3) {
                session_destroy();
                RequirePage::redirect("");
            } elseif($_SESSION["privilege_id"] < 2) RequirePage::redirect("panel");
        }
    }

    /**
     * afficher une entrée
     */
    public function show($id) {
        $customer = new Customer;
        $data["customer"] = $customer->readId($id);

        $stamp = new Stamp;
        $where = [
            "target" => "customer_user_id",
            "value" => $data["customer"]["id"]
        ];
        $data["stamps"] = $stamp->readWhere($where);

        Twig::render("customer/show.php", $data);
    }

    /**
     * afficher le profil d'un utilisateur
     */
    public function profile() {
        checkSession::sessionAuth();

        if($_SESSION["privilege_id"] < 2) {
            RequirePage::redirect("panel");
            exit();
        } 

        $id = $_SESSION["id"];
        $customer = new Customer;
        $data["customer"] = $customer->readId($id);

        $stamp = new Stamp;
        $where["target"] = "customer_user_id";
        $where["value"] = $data["customer"]["id"];
        $data["stamps"] = $stamp->readWhere($where);
        
        Twig::render("customer/profile.php", $data);
    }
}