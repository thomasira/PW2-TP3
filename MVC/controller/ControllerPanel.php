<?php
RequirePage::model("Stamp");
RequirePage::model("Aspect");
RequirePage::model("Customer");
RequirePage::model("Staff");
RequirePage::model("Privilege");
RequirePage::model("Category");

class ControllerPanel implements Controller {

    public function __construct() {
        CheckSession::sessionAuth(2);
    }
    
    /**
     * afficher l'index, requiert toutes les entrées des tables simples
     */
    public function index() {

        $stamp = new Stamp;
        $data["stamps"] = $stamp->read();

        $customer = new Customer;
        $data["customers"] = $customer->read();

        $staff = new Staff;
        $data["staff"] = $staff->read();
        if($data["staff"]) {
            foreach($data["staff"] as &$employee) {
                $privilege = new Privilege;
                $employee["privilege"] = $privilege->readId($employee["privilege_id"])["privilege"];
            }
        }

        $category = new Category;
        $data["categories"] = $category->read();

        $aspect = new Aspect;
        $data["aspects"] = $aspect->read();

        Twig::render("panel/index.php", $data);
    }
}