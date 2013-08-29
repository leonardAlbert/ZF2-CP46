<?php

namespace Ponto\Controller;

class LancamentoController extends \Ponto\Controller\CrudAbstractController
{
    public function __construct()
    {
        $this->form       = "\Ponto\Form\Lancamento";
        $this->route      = "ponto";
        $this->entity     = "\Ponto\Entity\Lancamento";
        $this->service    = "\Ponto\Service\Lancamento";
        $this->controller = "lancamento";
    }
    
    public function inserirAction()
    {
        $funcionarios = $this->getEntityManager()
            ->getRepository("\Ponto\Entity\Funcionario")->findAllToArray();
        
        $form = new $this->form($funcionarios);
        $request = $this->getRequest();
    
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->inserir($form->getData());
    
                $this->flashMessenger()->addMessage("Registro inserido com sucesso!");
    
                return $this->redirect()->toRoute(
                        $this->route, array('controller' => $this->controller));
            }
        }
    
        return new \Zend\View\Model\ViewModel(array('form' => $form));
    }
    
}
