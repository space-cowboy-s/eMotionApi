<?php

use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherTrait;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    use PhpMatcherTrait;

    public function __construct(RequestContext $context)
    {
        $this->context = $context;
        $this->staticRoutes = array(
            '/api/admin/profile' => array(
                array(array('_route' => 'app_admin_getapiadminprofile', '_controller' => 'App\\Controller\\AdminController::getApiAdminProfile'), null, array('GET' => 0), null, false, false, null),
                array(array('_route' => 'app_admin_patchapiadminprofile', '_controller' => 'App\\Controller\\AdminController::patchApiAdminProfile'), null, array('PATCH' => 0), null, false, false, null),
            ),
            '/api/admin/users' => array(array(array('_route' => 'app_admin_getapiallusers', '_controller' => 'App\\Controller\\AdminController::getApiAllUsers'), null, array('GET' => 0), null, false, false, null)),
            '/api/admin/users/add' => array(array(array('_route' => 'app_admin_postapiadmiadduser', '_controller' => 'App\\Controller\\AdminController::postApiAdmiAddUser'), null, array('POST' => 0), null, false, false, null)),
            '/api/all-users' => array(array(array('_route' => 'app_anonymous_getapiallusers', '_controller' => 'App\\Controller\\AnonymousController::getApiAllUsers'), null, array('GET' => 0), null, false, false, null)),
            '/api/new/user' => array(array(array('_route' => 'app_anonymous_postapinewuser', '_controller' => 'App\\Controller\\AnonymousController::postApiNewUser'), null, array('POST' => 0), null, false, false, null)),
            '/api/bookings' => array(array(array('_route' => 'app_booking_getapiadminallbooking', '_controller' => 'App\\Controller\\BookingController::getApiAdminAllBooking'), null, array('GET' => 0), null, false, false, null)),
            '/api/admin/bookings/add' => array(array(array('_route' => 'app_booking_postapiadminbooking', '_controller' => 'App\\Controller\\BookingController::postApiAdminBooking'), null, array('POST' => 0), null, false, false, null)),
            '/api/user/profile' => array(
                array(array('_route' => 'app_users_getapiuserprofile', '_controller' => 'App\\Controller\\UsersController::getApiUserProfile'), null, array('GET' => 0), null, false, false, null),
                array(array('_route' => 'app_users_patchapiuserprofile', '_controller' => 'App\\Controller\\UsersController::patchApiUserProfile'), null, array('PATCH' => 0), null, false, false, null),
            ),
            '/api/doc.json' => array(array(array('_route' => 'app.swagger', '_controller' => 'nelmio_api_doc.controller.swagger'), null, array('GET' => 0), null, false, false, null)),
            '/api/doc' => array(array(array('_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'), null, array('GET' => 0), null, false, false, null)),
            '/_profiler' => array(array(array('_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'), null, null, null, true, false, null)),
            '/_profiler/search' => array(array(array('_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'), null, null, null, false, false, null)),
            '/_profiler/search_bar' => array(array(array('_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'), null, null, null, false, false, null)),
            '/_profiler/phpinfo' => array(array(array('_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'), null, null, null, false, false, null)),
            '/_profiler/open' => array(array(array('_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'), null, null, null, false, false, null)),
        );
        $this->regexpList = array(
            0 => '{^(?'
                    .'|/api/(?'
                        .'|admin/(?'
                            .'|users/profile/(?'
                                .'|([^/]++)(?'
                                    .'|(*:52)'
                                .')'
                                .'|remove/([^/]++)(*:75)'
                            .')'
                            .'|bookings/(?'
                                .'|edit/([^/]++)(*:108)'
                                .'|remove/([^/]++)(*:131)'
                            .')'
                        .')'
                        .'|profile/([^/]++)(*:157)'
                        .'|bookings/([^/]++)(*:182)'
                    .')'
                    .'|/_(?'
                        .'|error/(\\d+)(?:\\.([^/]++))?(*:222)'
                        .'|wdt/([^/]++)(*:242)'
                        .'|profiler/([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:288)'
                                .'|router(*:302)'
                                .'|exception(?'
                                    .'|(*:322)'
                                    .'|\\.css(*:335)'
                                .')'
                            .')'
                            .'|(*:345)'
                        .')'
                    .')'
                .')/?$}sDu',
        );
        $this->dynamicRoutes = array(
            52 => array(
                array(array('_route' => 'app_admin_getapiuserprofile', '_controller' => 'App\\Controller\\AdminController::getApiUserProfile'), array('id'), array('GET' => 0), null, false, true, null),
                array(array('_route' => 'app_admin_patchapiadminuserprofile', '_controller' => 'App\\Controller\\AdminController::patchApiAdminUserProfile'), array('id'), array('PATCH' => 0), null, false, true, null),
            ),
            75 => array(array(array('_route' => 'app_admin_deleteapiuser', '_controller' => 'App\\Controller\\AdminController::deleteApiUser'), array('id'), array('DELETE' => 0), null, false, true, null)),
            108 => array(array(array('_route' => 'app_booking_patchapiadminbooking', '_controller' => 'App\\Controller\\BookingController::patchApiAdminBooking'), array('id'), array('PATCH' => 0), null, false, true, null)),
            131 => array(array(array('_route' => 'app_booking_deleteapibooking', '_controller' => 'App\\Controller\\BookingController::deleteApiBooking'), array('id'), array('DELETE' => 0), null, false, true, null)),
            157 => array(array(array('_route' => 'app_anonymous_getapiuserprofile', '_controller' => 'App\\Controller\\AnonymousController::getApiUserProfile'), array('id'), array('GET' => 0), null, false, true, null)),
            182 => array(array(array('_route' => 'app_booking_getapiadminonebooking', '_controller' => 'App\\Controller\\BookingController::getApiAdminOneBooking'), array('id'), array('GET' => 0), null, false, true, null)),
            222 => array(array(array('_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'), array('code', '_format'), null, null, false, true, null)),
            242 => array(array(array('_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'), array('token'), null, null, false, true, null)),
            288 => array(array(array('_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'), array('token'), null, null, false, false, null)),
            302 => array(array(array('_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'), array('token'), null, null, false, false, null)),
            322 => array(array(array('_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'), array('token'), null, null, false, false, null)),
            335 => array(array(array('_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'), array('token'), null, null, false, false, null)),
            345 => array(array(array('_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'), array('token'), null, null, false, true, null)),
        );
    }
}
