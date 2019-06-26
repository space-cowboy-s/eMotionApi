<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'App\Controller\UsersController' shared autowired service.

$this->services['App\Controller\UsersController'] = $instance = new \App\Controller\UsersController(($this->privates['App\Repository\UserRepository'] ?? $this->load('getUserRepositoryService.php')), ($this->privates['App\Repository\BookingRepository'] ?? $this->load('getBookingRepositoryService.php')), ($this->services['doctrine.orm.default_entity_manager'] ?? $this->getDoctrine_Orm_DefaultEntityManagerService()));

$instance->setContainer(($this->privates['.service_locator.9MhUVNh'] ?? $this->load('get_ServiceLocator_9MhUVNhService.php'))->withContext('App\\Controller\\UsersController', $this));

return $instance;
