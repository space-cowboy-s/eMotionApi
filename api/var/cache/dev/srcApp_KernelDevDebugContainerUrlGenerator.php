<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        'app_admin_getapiadminprofile' => array(array(), array('_controller' => 'App\\Controller\\AdminController::getApiAdminProfile'), array(), array(array('text', '/api/admin/profile')), array(), array()),
        'app_admin_getapiuserprofile' => array(array('id'), array('_controller' => 'App\\Controller\\AdminController::getApiUserProfile'), array(), array(array('variable', '/', '[^/]++', 'id', true), array('text', '/api/admin/users/profile')), array(), array()),
        'app_admin_getapiallusers' => array(array(), array('_controller' => 'App\\Controller\\AdminController::getApiAllUsers'), array(), array(array('text', '/api/admin/users')), array(), array()),
        'app_admin_postapiadmiadduser' => array(array(), array('_controller' => 'App\\Controller\\AdminController::postApiAdmiAddUser'), array(), array(array('text', '/api/admin/users/add')), array(), array()),
        'app_admin_patchapiadminprofile' => array(array(), array('_controller' => 'App\\Controller\\AdminController::patchApiAdminProfile'), array(), array(array('text', '/api/admin/profile')), array(), array()),
        'app_admin_patchapiadminuserprofile' => array(array('id'), array('_controller' => 'App\\Controller\\AdminController::patchApiAdminUserProfile'), array(), array(array('variable', '/', '[^/]++', 'id', true), array('text', '/api/admin/users/profile')), array(), array()),
        'app_admin_deleteapiuser' => array(array('id'), array('_controller' => 'App\\Controller\\AdminController::deleteApiUser'), array(), array(array('variable', '/', '[^/]++', 'id', true), array('text', '/api/admin/users/profile/remove')), array(), array()),
        'app_anonymous_getapiallusers' => array(array(), array('_controller' => 'App\\Controller\\AnonymousController::getApiAllUsers'), array(), array(array('text', '/api/all-users')), array(), array()),
        'app_anonymous_getapiuserprofile' => array(array('id'), array('_controller' => 'App\\Controller\\AnonymousController::getApiUserProfile'), array(), array(array('variable', '/', '[^/]++', 'id', true), array('text', '/api/profile')), array(), array()),
        'app_anonymous_postapinewuser' => array(array(), array('_controller' => 'App\\Controller\\AnonymousController::postApiNewUser'), array(), array(array('text', '/api/new/user')), array(), array()),
        'app_booking_getapiadminallbooking' => array(array(), array('_controller' => 'App\\Controller\\BookingController::getApiAdminAllBooking'), array(), array(array('text', '/api/bookings')), array(), array()),
        'app_booking_getapiadminonebooking' => array(array('id'), array('_controller' => 'App\\Controller\\BookingController::getApiAdminOneBooking'), array(), array(array('variable', '/', '[^/]++', 'id', true), array('text', '/api/bookings')), array(), array()),
        'app_booking_postapiadminbooking' => array(array(), array('_controller' => 'App\\Controller\\BookingController::postApiAdminBooking'), array(), array(array('text', '/api/admin/bookings/add')), array(), array()),
        'app_booking_patchapiadminbooking' => array(array('id'), array('_controller' => 'App\\Controller\\BookingController::patchApiAdminBooking'), array(), array(array('variable', '/', '[^/]++', 'id', true), array('text', '/api/admin/bookings/edit')), array(), array()),
        'app_booking_deleteapibooking' => array(array('id'), array('_controller' => 'App\\Controller\\BookingController::deleteApiBooking'), array(), array(array('variable', '/', '[^/]++', 'id', true), array('text', '/api/admin/bookings/remove')), array(), array()),
        'app_users_getapiuserprofile' => array(array(), array('_controller' => 'App\\Controller\\UsersController::getApiUserProfile'), array(), array(array('text', '/api/user/profile')), array(), array()),
        'app_users_patchapiuserprofile' => array(array(), array('_controller' => 'App\\Controller\\UsersController::patchApiUserProfile'), array(), array(array('text', '/api/user/profile')), array(), array()),
        'app.swagger' => array(array(), array('_controller' => 'nelmio_api_doc.controller.swagger'), array(), array(array('text', '/api/doc.json')), array(), array()),
        'app.swagger_ui' => array(array(), array('_controller' => 'nelmio_api_doc.controller.swagger_ui'), array(), array(array('text', '/api/doc')), array(), array()),
        '_twig_error_test' => array(array('code', '_format'), array('_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'), array('code' => '\\d+'), array(array('variable', '.', '[^/]++', '_format', true), array('variable', '/', '\\d+', 'code', true), array('text', '/_error')), array(), array()),
        '_wdt' => array(array('token'), array('_controller' => 'web_profiler.controller.profiler::toolbarAction'), array(), array(array('variable', '/', '[^/]++', 'token', true), array('text', '/_wdt')), array(), array()),
        '_profiler_home' => array(array(), array('_controller' => 'web_profiler.controller.profiler::homeAction'), array(), array(array('text', '/_profiler/')), array(), array()),
        '_profiler_search' => array(array(), array('_controller' => 'web_profiler.controller.profiler::searchAction'), array(), array(array('text', '/_profiler/search')), array(), array()),
        '_profiler_search_bar' => array(array(), array('_controller' => 'web_profiler.controller.profiler::searchBarAction'), array(), array(array('text', '/_profiler/search_bar')), array(), array()),
        '_profiler_phpinfo' => array(array(), array('_controller' => 'web_profiler.controller.profiler::phpinfoAction'), array(), array(array('text', '/_profiler/phpinfo')), array(), array()),
        '_profiler_search_results' => array(array('token'), array('_controller' => 'web_profiler.controller.profiler::searchResultsAction'), array(), array(array('text', '/search/results'), array('variable', '/', '[^/]++', 'token', true), array('text', '/_profiler')), array(), array()),
        '_profiler_open_file' => array(array(), array('_controller' => 'web_profiler.controller.profiler::openAction'), array(), array(array('text', '/_profiler/open')), array(), array()),
        '_profiler' => array(array('token'), array('_controller' => 'web_profiler.controller.profiler::panelAction'), array(), array(array('variable', '/', '[^/]++', 'token', true), array('text', '/_profiler')), array(), array()),
        '_profiler_router' => array(array('token'), array('_controller' => 'web_profiler.controller.router::panelAction'), array(), array(array('text', '/router'), array('variable', '/', '[^/]++', 'token', true), array('text', '/_profiler')), array(), array()),
        '_profiler_exception' => array(array('token'), array('_controller' => 'web_profiler.controller.exception::showAction'), array(), array(array('text', '/exception'), array('variable', '/', '[^/]++', 'token', true), array('text', '/_profiler')), array(), array()),
        '_profiler_exception_css' => array(array('token'), array('_controller' => 'web_profiler.controller.exception::cssAction'), array(), array(array('text', '/exception.css'), array('variable', '/', '[^/]++', 'token', true), array('text', '/_profiler')), array(), array()),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && null !== $name) {
            do {
                if ((self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
                    unset($parameters['_locale']);
                    $name .= '.'.$locale;
                    break;
                }
            } while (false !== $locale = strstr($locale, '_', true));
        }

        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
