<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'nelmio_api_doc.routes.default' shared service.

return $this->privates['nelmio_api_doc.routes.default'] = (new \Nelmio\ApiDocBundle\Routing\FilteredRouteCollectionBuilder(array('path_patterns' => array(0 => '^/api(?!/doc$)'), 'host_patterns' => array())))->filter(($this->services['router'] ?? $this->getRouterService())->getRouteCollection());
