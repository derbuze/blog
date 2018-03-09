<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 19.02.18
 * Time: 21:35
 */

namespace Controllers;

use Vendor\BaseController;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->view->setVars(array('title' => 'Hello World'));
    }
}
