<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 01.02.2018
 * Time: 23:08
 */

namespace Vendor;


class View
{
    protected $path, $controller, $action;

    /** @var array $vars */
    private $vars;

    public function __construct($path, $controllerName, $actionName)
    {
        $this->path = $path;
        $this->controller = $controllerName;
        $this->action = $actionName;
    }

    public function render()
    {
        $fileName = $this->path . DIRECTORY_SEPARATOR . $this->controller . DIRECTORY_SEPARATOR . $this->action . '.php';

        if (!file_exists($fileName)) {
            throw new NotFoundException();
        }

        foreach ($this->vars as $key => $val) {
            $$key = $val;
        }

        include $fileName;
    }

    public function setVars(array $vars)
    {
        foreach ($vars as $key => $value) {
            $this->vars[$key] = $value;
        }
    }
}