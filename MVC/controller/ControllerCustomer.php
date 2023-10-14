<?php
RequirePage::model("Customer");
RequirePage::model("Privilege");
RequirePage::model("Stamp");



class ControllerCustomer implements Controller {

    public function index() {
        $customer = new Customer;
        $data["customers"] = $customer->read();
        Twig::render("customer/index.php", $data);
    }

    public function create() {
        $privilege = new Privilege;
        $data["privileges"] = $privilege->read();
        $data["customer"] = true;
        Twig::render("user/create.php", $data);
    }

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
}