<?php
RequirePage::model("Customer");

class ControllerCustomer implements Controller {

    public function index() {
        $customer = new Customer;
        $data["users"] = $customer->read();
        Twig::render("customer/index.php", $data);
    }
}