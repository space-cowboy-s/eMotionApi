<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'App\Controller\AnonymousController' shared autowired service.

$this->services['App\Controller\AnonymousController'] = $instance = new \App\Controller\AnonymousController(($this->privates['App\Repository\UserRepository'] ?? $this->load('getUserRepositoryService.php')), ($this->services['doctrine.orm.default_entity_manager'] ?? $this->getDoctrine_Orm_DefaultEntityManagerService()));

$instance->setContainer(($this->privates['.service_locator.9MhUVNh'] ?? $this->load('get_ServiceLocator_9MhUVNhService.php'))->withContext('App\\Controller\\AnonymousController', $this));

return $instance;
