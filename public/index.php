<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 01.02.2018
 * Time: 21:13
 */

use Exceptions\NotFoundException;
use Vendor\Autoloader;
use Vendor\Request;
use Vendor\View;

require_once '../src/Vendor/Autoloader.php';

Autoloader::register();

// get the requested url
$url      = (isset($_GET['_url']) ? $_GET['_url'] : '');
$urlParts = explode('/', $url);

// build the controller class
$controllerName      = (isset($urlParts[0]) && $urlParts[0] ? $urlParts[0] : 'index');
$controllerClassName = '\\Controllers\\'.ucfirst($controllerName).'Controller';

// build the action method
$actionName       = (isset($urlParts[1]) && $urlParts[1] ? $urlParts[1] : 'index');
$actionMethodName = ucfirst($actionName).'Action';
try {
    if (!class_exists($controllerClassName)) {
        throw new NotFoundException();
    }
    $controller = new $controllerClassName();

    $request = new Request($_REQUEST, $_SERVER);
    $controller->setRequest($request);
    //if (!$controller instanceof \Mvc\Controller\Controller || !method_exists($controller, $actionMethodName)) {
    //    throw new \Mvc\Library\NotFoundException();
    //}



    $view = new View('../src/Views', $controllerName, $actionName);
    $controller->setView($view);
    $controller->$actionMethodName();
    $view->render();

} catch (NotFoundException $e) {
    http_response_code(404);
    echo 'Page not found: '.$controllerClassName.'::'.$actionMethodName;
} catch (Exception $e) {
    http_response_code(500);
    echo 'Exception: '.$e->getMessage().' '.$e->getTraceAsString();
}
