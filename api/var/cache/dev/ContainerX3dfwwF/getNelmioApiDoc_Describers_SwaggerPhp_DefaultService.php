<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'nelmio_api_doc.describers.swagger_php.default' shared service.

return $this->privates['nelmio_api_doc.describers.swagger_php.default'] = new \Nelmio\ApiDocBundle\Describer\SwaggerPhpDescriber(($this->privates['nelmio_api_doc.routes.default'] ?? $this->load('getNelmioApiDoc_Routes_DefaultService.php')), ($this->privates['nelmio_api_doc.controller_reflector'] ?? $this->load('getNelmioApiDoc_ControllerReflectorService.php')), ($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService()), ($this->privates['monolog.logger'] ?? $this->getMonolog_LoggerService()));
