<?php

namespace Ponto;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getViewHelperConfig() 
    {
        return array('invokables' => array(
            'UserIdentity' => new \Ponto\View\Helper\UserIdentity()),
            'factories' => array('flashMessages' => function($service) {
                $flashmessenger = $service->getServiceLocator()
                    ->get('ControllerPluginManager')->get('flashmessenger');
                $messages = new \Ponto\View\Helper\FlashMessages();
                $messages->setFlashMessenger($flashmessenger);
                
                return $messages;
            }),
        );
    }
    
    /**
     * Configure PHP ini settings on the bootstrap event
     * @param Event $e
     */
    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {
        /**
         * Aplica as configurações de acordo com o ambiente pelo ini_set
         */
        $app         = $e->getParam('application');
        $config      = $app->getConfig();
        $phpSettings = $config['phpSettings'];
    
        if($phpSettings) {
            foreach($phpSettings as $key => $value) {
                ini_set($key, $value);
            }
        }
    }
    
    public function init(\Zend\ModuleManager\ModuleManager $moduleManager)
    {
        /**
         * Captura e trata os eventos para o modulo RadioAdmin.
         */
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach("Ponto", "dispatch", function($e) {
            $auth = new \Zend\Authentication\AuthenticationService();
            $auth->setStorage(new \Zend\Authentication\Storage\Session("PontoLogin"));
    
            $controller = $e->getTarget();
            $matchedRoute = $controller->getEvent()
                ->getRouteMatch()->getMatchedRouteName();
            
            $routes = $matchedRoute == "home" || $matchedRoute == "ponto" ||
                $matchedRoute == "ponto-page";
            if (!$auth->hasIdentity() && $routes) {
                return $controller->redirect()->toRoute('ponto-login');
            }
            if ($auth->hasIdentity() && $matchedRoute == "ponto-login") {
                return $controller->redirect()->toRoute('ponto');
            }
        }, 99);
    }
    
    public function getServiceConfig()
    {
        return array(
            "factories" => array(
                "\Ponto\Service\Funcionario" => function($service) {
                    return new \Ponto\Service\Funcionario(
                        $service->get('Doctrine\ORM\EntityManager'));
                },
                "\Ponto\Service\Lancamento" => function($service) {
                    return new \Ponto\Service\Lancamento(
                        $service->get('Doctrine\ORM\EntityManager'));
                },
                "\Ponto\Auth\Adapter" => function($service) {
                    return new \Ponto\Auth\Adapter(
                        $service->get('Doctrine\ORM\EntityManager'));
                },
            )
        );
    }
    
}
