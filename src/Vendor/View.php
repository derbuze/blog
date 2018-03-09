<?php

namespace Vendor;

use Exceptions\NotFoundException;

class View
{
    /** @var string */
    protected $path;

    /** @var string */
    protected $action;

    /** @var string */
    protected $controller;

    /** @var array $vars */
    private $vars;

    public function __construct($path, $controllerName, $actionName)
    {
        $this->path = $path;
        $this->controller = $controllerName;
        $this->action = $actionName;
    }

    /**
     * @throws NotFoundException
     */
    public function render()
    {
        $fileName = $this->path . DIRECTORY_SEPARATOR . ucfirst($this->controller) .
            DIRECTORY_SEPARATOR . $this->action . '.php';

        if (!file_exists($fileName)) {
            throw new NotFoundException();
        }

        foreach ($this->vars as $key => $val) {
            $$key = $val;
        }

        include $fileName;
    }

    /**
     * @param array $vars
     */
    public function setVars(array $vars)
    {
        foreach ($vars as $key => $value) {
            $this->vars[$key] = $value;
        }
    }
}
