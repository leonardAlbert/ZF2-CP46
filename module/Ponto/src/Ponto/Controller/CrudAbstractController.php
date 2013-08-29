<?php

namespace Ponto\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

abstract class CrudAbstractController extends AbstractActionController 
{
    /**
     * Nome do form a ser trabalhado.
     */
    protected $form;
    
    /**
     * Nome da rota registrada.
     */
    protected $route;
    
    /**
     * Nome da entidade a ser trabalhada.
     */
    protected $entity;
    
    /**
     * Nome do serviço registrado.
     */
    protected $service;
    
    /**
     * Nome do controller da rota.
     */
    protected $controller;
    
    /**
     * Instâcia do objeto EntityManager.
     */
    protected $entityManager;

    public function indexAction() 
    {
        $dados = $this->getEntityManager()
            ->getRepository($this->entity)->findAll();
        
        $page = $this->params()->fromRoute('pagina');

        $paginator = new Paginator(new ArrayAdapter($dados));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(10);
        
        return new \Zend\View\Model\ViewModel(array('dados' => $paginator, 'pagina' => $page));
    }

    public function inserirAction()
    {
        $form = new $this->form();

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

    public function editarAction()
    {
        $form = new $this->form();
        $request = $this->getRequest();

        $repository = $this->getEntityManager()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0)) {
            $form->setData($entity->toArray());
        }

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->editar($form->getData());
                
                $this->flashMessenger()->addMessage("Registro alterado com sucesso!");
                
                return $this->redirect()->toRoute(
                    $this->route, array('controller' => $this->controller));
            }
        }

        return new \Zend\View\Model\ViewModel(array('form' => $form));
    }

    public function removerAction() 
    {
        $service = $this->getServiceLocator()->get($this->service);
        if ($service->remover($this->params()->fromRoute('id', 0))) {
            $this->flashMessenger()->addMessage("Registro removido com sucesso!");
            
            return $this->redirect()->toRoute(
                $this->route, array('controller' => $this->controller));
        }
    }
    
    public function alterarStatusAction()
    {
        $service = $this->getServiceLocator()->get($this->service);
        if ($service->alterarStatus($this->params()->fromRoute('id', 0))) {
            $this->flashMessenger()->addMessage("Status alterado com sucesso!");
            
            return $this->redirect()->toRoute(
                    $this->route, array('controller' => $this->controller));
        }
    }
    
    protected function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        }

        return $this->entityManager;
    }
    
}
