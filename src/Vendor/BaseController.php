<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 01.02.2018
 * Time: 23:29
 */

namespace Vendor;


abstract class BaseController
{
    /** @var View $view */
    protected $view;

    public function setView(View $view) {
        $this->view = $view;
    }

    public function getView()
    {
        return $this->view;
    }
}