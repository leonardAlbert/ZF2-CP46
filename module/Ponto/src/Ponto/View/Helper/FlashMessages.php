<?php
 
namespace Ponto\View\Helper;
 
use Zend\Mvc\Controller\Plugin\FlashMessenger as FlashMessenger;
 
class FlashMessages extends \Zend\View\Helper\AbstractHelper
{
    /**
     * @var FlashMessenger
     */
    protected $flashMessenger;
 
    public function setFlashMessenger(FlashMessenger $flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;
    }
 
    public function __invoke($includeCurrentMessages = false)
    {
        $messages = array(
            FlashMessenger::NAMESPACE_ERROR   => array(),
            FlashMessenger::NAMESPACE_SUCCESS => array(),
            FlashMessenger::NAMESPACE_INFO    => array(),
            FlashMessenger::NAMESPACE_DEFAULT => array()
        );
 
        foreach ($messages as $namespace => &$modulo) {
            $modulo = $this->flashMessenger->getMessagesFromNamespace($namespace);
            if ($includeCurrentMessages) {
                $modulo = array_merge($modulo, $this->flashMessenger
                    ->getCurrentMessagesFromNamespace($namespace));
                
                $this->flashMessenger->clearCurrentMessagesFromNamespace($namespace);
            }
        }

        return $messages;
    }
}