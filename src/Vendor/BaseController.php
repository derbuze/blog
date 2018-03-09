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

    /** @var Request */
    protected $request;

    public function setView(View $view)
    {
        $this->view = $view;
    }

    public function getView(): View
    {
        return $this->view;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
}
