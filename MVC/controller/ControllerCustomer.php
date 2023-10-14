<?php
RequirePage::model("Customer");
RequirePage::model("Privilege");


class ControllerCustomer implements Controller {

    public function index() {
        $customer = new Customer;
        $data["users"] = $customer->read();
        Twig::render("customer/index.php", $data);
    }
    public function create() {
        $privilege = new Privilege;
        $data["privileges"] = $privilege->read();
        $data["customer"] = true;
        Twig::render("user/create.php", $data);
    }
}