<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 01.02.2018
 * Time: 21:15
 */

namespace Controllers;


use Vendor\BaseController;
use Vendor\RepositoryManager;
use Vendor\View;

class BlogItemController extends BaseController
{

    public function indexAction()
    {
        $blogItems = RepositoryManager::getRepository('BlogItem')->find();
        $this->view->setVars(array('blogItems' => $blogItems));
    }



}