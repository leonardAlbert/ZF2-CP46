<?php

namespace Ponto\Controller;

class FuncionarioController extends \Ponto\Controller\CrudAbstractController
{
    public function __construct()
    {
        $this->form       = "\Ponto\Form\Funcionario";
        $this->route      = "ponto";
        $this->entity     = "\Ponto\Entity\Funcionario";
        $this->service    = "\Ponto\Service\Funcionario";
        $this->controller = "funcionario";
    }
    
    public function editarAction()
    {
        $form = new $this->form();
        $request = $this->getRequest();
    
        $repository = $this->getEntityManager()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));
    
        if ($this->params()->fromRoute('id', 0)) {
            $dados = $entity->toArray();
            unset($dados['senha']);
            $form->setData($dados);
        }
    
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $res = $service->editar($form->getData());
    
                $this->flashMessenger()->addMessage("Registro alterado com sucesso!");
    
                return $this->redirect()->toRoute($this->route,
                    array('controller' => $this->controller));
            }
        }
    
        return new \Zend\View\Model\ViewModel(array('form' => $form));
    }
    
    public function loginAction()
    {
        $form = new \Ponto\Form\Login();
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
    
                $auth = new \Zend\Authentication\AuthenticationService();
    
                $sessionStorage = new \Zend\Authentication\Storage\Session("PontoLogin");
                $auth->setStorage($sessionStorage);
                
                $authAdapter = $this->getServiceLocator()->get("\Ponto\Auth\Adapter");
                $authAdapter->__set("usuario", $data['usuario'])
                    ->__set("senha", $data['senha']);
    
                $result = $auth->authenticate($authAdapter);
    
                if ($result->isValid()) {
                    $identity = $auth->getIdentity();
                    $sessionStorage->write($identity['funcionario-sistema'], null);
    
                    return $this->redirect()->toRoute("ponto");
                }
    
                $this->flashMessenger()->addMessage("Usuário ou senha incorretos!");
            }
        }
    
        return new \Zend\View\Model\ViewModel(array('form' => $form));
    }
    
    public function logoutAction() {
        $auth = new \Zend\Authentication\AuthenticationService;
        $auth->setStorage(new \Zend\Authentication\Storage\Session('PontoLogin'));
        $auth->clearIdentity();
    
        return $this->redirect()->toRoute('ponto-login');
    }
    
}
