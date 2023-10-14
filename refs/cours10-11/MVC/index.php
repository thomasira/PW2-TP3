<?php
session_start();
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/controller/Controller.php";
require_once __DIR__ . "/lib/RequirePage.php";
require_once __DIR__ . "/lib/Twig.php";
require_once __DIR__ . "/lib/CheckSession.php";
require_once __DIR__ . "/lib/LogManager.php";

define("ROOT", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));

$url = isset($_GET["url"]) ? explode ("/", ltrim($_GET["url"], "/")) : "/";
$name = "home";
if ($url != "/") $name = $url[0];

$log = new LogManager;
$log->createEntry();

Twig::render("header.php", ['name' => $name]);

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
            if (isset($url[2])) {
                $id = $url[2];
                $controller->$method($id);
            } else {            
                $controller->$method();
            }
        } else $controller->index();
    } else {
        $controllerHome = __DIR__ . "/controller/ControllerHome.php";
        require_once $controllerHome;
        $controller = new ControllerHome;
        $controller->error();
    }
}
Twig::render("footer.php");
?>