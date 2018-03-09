<?php
/**
 * Created by PhpStorm.
 * User: Markus
 * Date: 01.02.2018
 * Time: 21:15
 */

namespace Controllers;

use Entities\BlogItem;
use Vendor\BaseController;
use Vendor\RepositoryManager;

class BlogItemController extends BaseController
{

    public function indexAction()
    {
        $blogItems = RepositoryManager::getRepository('BlogItem')->find();
        $this->view->setVars(array('blogItems' => $blogItems));
    }

    public function showAction()
    {
        $id = $this->getRequest()->getParameter('id');
        $blogItem = RepositoryManager::getRepository('BlogItem')->findOne($id);
        $this->view->setVars(array('blogItem' => $blogItem));
    }

    public function createAction()
    {
        $blogItemOld = RepositoryManager::getRepository('BlogItem')->findOne(4);

        if ($this->getRequest()->isMethod('get')) {
            $blogItem = new BlogItem();
            $blogItem->setContent('TestContent');
            $blogItem->setSubject('TestSubject');
            $blogItem->setAuthor($blogItemOld->getAuthor());
            RepositoryManager::getRepository('BlogItem')->save($blogItem);
        } else {
            echo 'no';
        }
    }
}
