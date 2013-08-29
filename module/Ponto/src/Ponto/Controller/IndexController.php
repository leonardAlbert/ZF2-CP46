<?php

namespace Ponto\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new \Zend\View\Model\ViewModel(array());
    }
}
