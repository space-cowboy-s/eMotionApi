<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.r4Gfxdh' shared service.

return $this->privates['.service_locator.r4Gfxdh'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, array(
    'userManager' => array('privates', 'App\\Manager\\UserManager', 'getUserManagerService.php', true),
    'validator' => array('services', 'validator', 'getValidatorService', false),
));