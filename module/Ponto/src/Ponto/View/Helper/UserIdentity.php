<?php

namespace Ponto\View\Helper;

class UserIdentity extends \Zend\View\Helper\AbstractHelper 
{

    protected $authService;

    public function getAuthService() 
    {
        return $this->authService;
    }

    public function __invoke($namespace = null) 
    {
        $sessionStorage = new \Zend\Authentication\Storage\Session($namespace);
        $this->authService = new \Zend\Authentication\AuthenticationService();
        $this->authService->setStorage($sessionStorage);

        if ($this->getAuthService()->hasIdentity()) {
            return $this->getAuthService()->getIdentity();
        }
        
        return false;
    }

}
