<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/controller/Controller.php";
require_once __DIR__ . "/lib/ViewLayout.php"; 
require_once __DIR__ . "/lib/RequirePage.php";
require_once __DIR__ . "/lib/Twig.php";

define("ROOT", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));

$url = isset($_SERVER["PATH_INFO"]) ? explode("/", ltrim($_SERVER["PATH_INFO"], "/")) : "/";

session_start();

$name = "home";
if ($url != "/") $name = $url[0];
if (isset($url[1])) $name .= " | ". $url[1];

ViewLayout::schoolHeader("PW2-TP2 | $name");
ViewLayout::navigation();

if ($url == "/") {
    $controllerHome = __DIR__ . "/controller/ControllerHome.php";
    require_once $controllerHome;
    $controller = new ControllerHome;
    $controller->index();
} else {
    $requestURL = $url[0];
    $requestURL = ucfirst($requestURL);
    $controllerPath = __DIR__ . "/controller/Controller" . $requestURL . ".php";
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        $controllerName = "Controller" . $requestURL;
        $controller = new $controllerName;
        if (isset($url[1])) {
            $method = $url[1];
            if (isset($url[2])){
                $id = $url[2];
                $controller->$method($id);
            } else {    
                if(method_exists($controller, $method)) $controller->$method();
                else RequirePage::redirect("error");
            }
        } else $controller->index();
    } else {
        $controllerHome = __DIR__ . "/controller/ControllerHome.php";
        require_once $controllerHome;
        $controller = new ControllerHome;
        $controller->error();
    }
}
ViewLayout::footer();
?>