<?php

namespace Ponto;

return array(
    // Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'Index'       => 'Ponto\Controller\IndexController',
            'Funcionario' => 'Ponto\Controller\FuncionarioController',
            'Lancamento'  => 'Ponto\Controller\LancamentoController',
        ),
    ),
    // Routes for this module
    'router' => array(
        'routes' => array(
            
            'home' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'ponto' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/[:controller][/:action][/:param][/:id]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'param'      => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'ponto-page' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/[:controller][/:action][/pagina/:page]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'page'       => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Index',
                        'action'     => 'index',
                        'page'       => 1
                    ),
                ),
            ),
                
            'ponto-login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/funcionario/login',
                    'defaults' => array(
                            'controller' => 'Funcionario',
                            'action'     => 'login',
                    ),
                ),
            ),
            
            'ponto-logout' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/funcionario/logout',
                    'defaults' => array(
                        'controller' => 'Funcionario',
                        'action'     => 'logout',
                    ),
                ),
            ),
                
        ),
    ),    
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    // Doctrine configuration
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
    // View setup for this module
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'ponto' => __DIR__ . '/../view',
        ),
    ),
    
);

