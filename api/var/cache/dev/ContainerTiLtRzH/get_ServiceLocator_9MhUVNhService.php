<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.9MhUVNh' shared service.

return $this->privates['.service_locator.9MhUVNh'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, array(
    'doctrine' => array('services', 'doctrine', 'getDoctrineService', false),
    'fos_rest.view_handler' => array('services', 'fos_rest.view_handler', 'getFosRest_ViewHandlerService.php', true),
    'http_kernel' => array('services', 'http_kernel', 'getHttpKernelService', false),
    'parameter_bag' => array('privates', 'parameter_bag', 'getParameterBagService', false),
    'request_stack' => array('services', 'request_stack', 'getRequestStackService', false),
    'router' => array('services', 'router', 'getRouterService', false),
    'security.authorization_checker' => array('services', 'security.authorization_checker', 'getSecurity_AuthorizationCheckerService', false),
    'security.csrf.token_manager' => array('services', 'security.csrf.token_manager', 'getSecurity_Csrf_TokenManagerService.php', true),
    'security.token_storage' => array('services', 'security.token_storage', 'getSecurity_TokenStorageService', false),
    'serializer' => array('services', 'serializer', 'getSerializerService', false),
    'session' => array('services', 'session', 'getSessionService.php', true),
    'twig' => array('services', 'twig', 'getTwigService', false),
));