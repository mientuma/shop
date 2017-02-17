<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevDebugProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // de__RG__app_admin_admin
        if ($pathinfo === '/de/admin') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::adminAction',  '_locale' => 'de',  '_route' => 'de__RG__app_admin_admin',);
        }

        // en__RG__app_admin_admin
        if ($pathinfo === '/admin') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::adminAction',  '_locale' => 'en',  '_route' => 'en__RG__app_admin_admin',);
        }

        // fr__RG__app_admin_admin
        if ($pathinfo === '/fr/admin') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::adminAction',  '_locale' => 'fr',  '_route' => 'fr__RG__app_admin_admin',);
        }

        // pl__RG__app_admin_admin
        if ($pathinfo === '/pl/admin') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::adminAction',  '_locale' => 'pl',  '_route' => 'pl__RG__app_admin_admin',);
        }

        // de__RG__adminOrders
        if ($pathinfo === '/de/admin/orders') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::ordersAdminAction',  '_locale' => 'de',  '_route' => 'de__RG__adminOrders',);
        }

        // en__RG__adminOrders
        if ($pathinfo === '/admin/orders') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::ordersAdminAction',  '_locale' => 'en',  '_route' => 'en__RG__adminOrders',);
        }

        // fr__RG__adminOrders
        if ($pathinfo === '/fr/admin/orders') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::ordersAdminAction',  '_locale' => 'fr',  '_route' => 'fr__RG__adminOrders',);
        }

        // pl__RG__adminOrders
        if ($pathinfo === '/pl/admin/orders') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::ordersAdminAction',  '_locale' => 'pl',  '_route' => 'pl__RG__adminOrders',);
        }

        // de__RG__adminOrdersDetails
        if (0 === strpos($pathinfo, '/de/admin/orders/details') && preg_match('#^/de/admin/orders/details/(?P<orderId>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__adminOrdersDetails')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::ordersDetailsAdminAction',  '_locale' => 'de',));
        }

        // en__RG__adminOrdersDetails
        if (0 === strpos($pathinfo, '/admin/orders/details') && preg_match('#^/admin/orders/details/(?P<orderId>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__adminOrdersDetails')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::ordersDetailsAdminAction',  '_locale' => 'en',));
        }

        // fr__RG__adminOrdersDetails
        if (0 === strpos($pathinfo, '/fr/admin/orders/details') && preg_match('#^/fr/admin/orders/details/(?P<orderId>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__adminOrdersDetails')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::ordersDetailsAdminAction',  '_locale' => 'fr',));
        }

        // pl__RG__adminOrdersDetails
        if (0 === strpos($pathinfo, '/pl/admin/orders/details') && preg_match('#^/pl/admin/orders/details/(?P<orderId>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__adminOrdersDetails')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::ordersDetailsAdminAction',  '_locale' => 'pl',));
        }

        // de__RG__adminUsers
        if ($pathinfo === '/de/admin/users') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::usersAdminAction',  '_locale' => 'de',  '_route' => 'de__RG__adminUsers',);
        }

        // en__RG__adminUsers
        if ($pathinfo === '/admin/users') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::usersAdminAction',  '_locale' => 'en',  '_route' => 'en__RG__adminUsers',);
        }

        // fr__RG__adminUsers
        if ($pathinfo === '/fr/admin/users') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::usersAdminAction',  '_locale' => 'fr',  '_route' => 'fr__RG__adminUsers',);
        }

        // pl__RG__adminUsers
        if ($pathinfo === '/pl/admin/users') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::usersAdminAction',  '_locale' => 'pl',  '_route' => 'pl__RG__adminUsers',);
        }

        // de__RG__adminSupply
        if ($pathinfo === '/de/admin/supply') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::supplyAdminAction',  '_locale' => 'de',  '_route' => 'de__RG__adminSupply',);
        }

        // en__RG__adminSupply
        if ($pathinfo === '/admin/supply') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::supplyAdminAction',  '_locale' => 'en',  '_route' => 'en__RG__adminSupply',);
        }

        // fr__RG__adminSupply
        if ($pathinfo === '/fr/admin/supply') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::supplyAdminAction',  '_locale' => 'fr',  '_route' => 'fr__RG__adminSupply',);
        }

        // pl__RG__adminSupply
        if ($pathinfo === '/pl/admin/supply') {
            return array (  '_controller' => 'AppBundle\\Controller\\AdminController::supplyAdminAction',  '_locale' => 'pl',  '_route' => 'pl__RG__adminSupply',);
        }

        // de__RG__sample
        if (0 === strpos($pathinfo, '/de/sample') && preg_match('#^/de/sample/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__sample')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::sampleAction',  '_locale' => 'de',));
        }

        // en__RG__sample
        if (0 === strpos($pathinfo, '/sample') && preg_match('#^/sample/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__sample')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::sampleAction',  '_locale' => 'en',));
        }

        // fr__RG__sample
        if (0 === strpos($pathinfo, '/fr/sample') && preg_match('#^/fr/sample/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__sample')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::sampleAction',  '_locale' => 'fr',));
        }

        // pl__RG__sample
        if (0 === strpos($pathinfo, '/pl/sample') && preg_match('#^/pl/sample/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__sample')), array (  '_controller' => 'AppBundle\\Controller\\AdminController::sampleAction',  '_locale' => 'pl',));
        }

        // de__RG__cart
        if ($pathinfo === '/de/cart') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::cartAction',  '_locale' => 'de',  '_route' => 'de__RG__cart',);
        }

        // en__RG__cart
        if ($pathinfo === '/cart') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::cartAction',  '_locale' => 'en',  '_route' => 'en__RG__cart',);
        }

        // fr__RG__cart
        if ($pathinfo === '/fr/cart') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::cartAction',  '_locale' => 'fr',  '_route' => 'fr__RG__cart',);
        }

        // pl__RG__cart
        if ($pathinfo === '/pl/cart') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::cartAction',  '_locale' => 'pl',  '_route' => 'pl__RG__cart',);
        }

        // de__RG__addToCart
        if (0 === strpos($pathinfo, '/de/cart/add') && preg_match('#^/de/cart/add/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__addToCart')), array (  '_controller' => 'AppBundle\\Controller\\CartController::addToCartAction',  '_locale' => 'de',));
        }

        // en__RG__addToCart
        if (0 === strpos($pathinfo, '/cart/add') && preg_match('#^/cart/add/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__addToCart')), array (  '_controller' => 'AppBundle\\Controller\\CartController::addToCartAction',  '_locale' => 'en',));
        }

        // fr__RG__addToCart
        if (0 === strpos($pathinfo, '/fr/cart/add') && preg_match('#^/fr/cart/add/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__addToCart')), array (  '_controller' => 'AppBundle\\Controller\\CartController::addToCartAction',  '_locale' => 'fr',));
        }

        // pl__RG__addToCart
        if (0 === strpos($pathinfo, '/pl/cart/add') && preg_match('#^/pl/cart/add/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__addToCart')), array (  '_controller' => 'AppBundle\\Controller\\CartController::addToCartAction',  '_locale' => 'pl',));
        }

        // de__RG__deleteFromCart
        if (0 === strpos($pathinfo, '/de/cart/delete') && preg_match('#^/de/cart/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__deleteFromCart')), array (  '_controller' => 'AppBundle\\Controller\\CartController::deleteFromCartAction',  '_locale' => 'de',));
        }

        // en__RG__deleteFromCart
        if (0 === strpos($pathinfo, '/cart/delete') && preg_match('#^/cart/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__deleteFromCart')), array (  '_controller' => 'AppBundle\\Controller\\CartController::deleteFromCartAction',  '_locale' => 'en',));
        }

        // fr__RG__deleteFromCart
        if (0 === strpos($pathinfo, '/fr/cart/delete') && preg_match('#^/fr/cart/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__deleteFromCart')), array (  '_controller' => 'AppBundle\\Controller\\CartController::deleteFromCartAction',  '_locale' => 'fr',));
        }

        // pl__RG__deleteFromCart
        if (0 === strpos($pathinfo, '/pl/cart/delete') && preg_match('#^/pl/cart/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__deleteFromCart')), array (  '_controller' => 'AppBundle\\Controller\\CartController::deleteFromCartAction',  '_locale' => 'pl',));
        }

        // de__RG__clearCart
        if ($pathinfo === '/de/cart/clear') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::clearCartAction',  '_locale' => 'de',  '_route' => 'de__RG__clearCart',);
        }

        // en__RG__clearCart
        if ($pathinfo === '/cart/clear') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::clearCartAction',  '_locale' => 'en',  '_route' => 'en__RG__clearCart',);
        }

        // fr__RG__clearCart
        if ($pathinfo === '/fr/cart/clear') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::clearCartAction',  '_locale' => 'fr',  '_route' => 'fr__RG__clearCart',);
        }

        // pl__RG__clearCart
        if ($pathinfo === '/pl/cart/clear') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::clearCartAction',  '_locale' => 'pl',  '_route' => 'pl__RG__clearCart',);
        }

        // de__RG__summaryCart
        if ($pathinfo === '/de/cart/summary') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::summaryCartAction',  '_locale' => 'de',  '_route' => 'de__RG__summaryCart',);
        }

        // en__RG__summaryCart
        if ($pathinfo === '/cart/summary') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::summaryCartAction',  '_locale' => 'en',  '_route' => 'en__RG__summaryCart',);
        }

        // fr__RG__summaryCart
        if ($pathinfo === '/fr/cart/summary') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::summaryCartAction',  '_locale' => 'fr',  '_route' => 'fr__RG__summaryCart',);
        }

        // pl__RG__summaryCart
        if ($pathinfo === '/pl/cart/summary') {
            return array (  '_controller' => 'AppBundle\\Controller\\CartController::summaryCartAction',  '_locale' => 'pl',  '_route' => 'pl__RG__summaryCart',);
        }

        // de__RG__homepage
        if (rtrim($pathinfo, '/') === '/de') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'de__RG__homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_locale' => 'de',  '_route' => 'de__RG__homepage',);
        }

        // en__RG__homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'en__RG__homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_locale' => 'en',  '_route' => 'en__RG__homepage',);
        }

        // fr__RG__homepage
        if (rtrim($pathinfo, '/') === '/fr') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'fr__RG__homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_locale' => 'fr',  '_route' => 'fr__RG__homepage',);
        }

        // pl__RG__homepage
        if (rtrim($pathinfo, '/') === '/pl') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'pl__RG__homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_locale' => 'pl',  '_route' => 'pl__RG__homepage',);
        }

        // de__RG__order
        if ($pathinfo === '/de/order') {
            return array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderAction',  '_locale' => 'de',  '_route' => 'de__RG__order',);
        }

        // en__RG__order
        if ($pathinfo === '/order') {
            return array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderAction',  '_locale' => 'en',  '_route' => 'en__RG__order',);
        }

        // fr__RG__order
        if ($pathinfo === '/fr/order') {
            return array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderAction',  '_locale' => 'fr',  '_route' => 'fr__RG__order',);
        }

        // pl__RG__order
        if ($pathinfo === '/pl/order') {
            return array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderAction',  '_locale' => 'pl',  '_route' => 'pl__RG__order',);
        }

        // de__RG__orderList
        if ($pathinfo === '/de/order/list') {
            return array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderListAction',  '_locale' => 'de',  '_route' => 'de__RG__orderList',);
        }

        // en__RG__orderList
        if ($pathinfo === '/order/list') {
            return array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderListAction',  '_locale' => 'en',  '_route' => 'en__RG__orderList',);
        }

        // fr__RG__orderList
        if ($pathinfo === '/fr/order/list') {
            return array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderListAction',  '_locale' => 'fr',  '_route' => 'fr__RG__orderList',);
        }

        // pl__RG__orderList
        if ($pathinfo === '/pl/order/list') {
            return array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderListAction',  '_locale' => 'pl',  '_route' => 'pl__RG__orderList',);
        }

        // de__RG__orderDetails
        if (0 === strpos($pathinfo, '/de/order/details') && preg_match('#^/de/order/details/(?P<orderId>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__orderDetails')), array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderDetailsAction',  '_locale' => 'de',));
        }

        // en__RG__orderDetails
        if (0 === strpos($pathinfo, '/order/details') && preg_match('#^/order/details/(?P<orderId>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__orderDetails')), array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderDetailsAction',  '_locale' => 'en',));
        }

        // fr__RG__orderDetails
        if (0 === strpos($pathinfo, '/fr/order/details') && preg_match('#^/fr/order/details/(?P<orderId>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__orderDetails')), array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderDetailsAction',  '_locale' => 'fr',));
        }

        // pl__RG__orderDetails
        if (0 === strpos($pathinfo, '/pl/order/details') && preg_match('#^/pl/order/details/(?P<orderId>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__orderDetails')), array (  '_controller' => 'AppBundle\\Controller\\OrderController::orderDetailsAction',  '_locale' => 'pl',));
        }

        // de__RG__showproducts
        if ($pathinfo === '/de/products') {
            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::showProductsAction',  '_locale' => 'de',  '_route' => 'de__RG__showproducts',);
        }

        // en__RG__showproducts
        if ($pathinfo === '/products') {
            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::showProductsAction',  '_locale' => 'en',  '_route' => 'en__RG__showproducts',);
        }

        // fr__RG__showproducts
        if ($pathinfo === '/fr/products') {
            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::showProductsAction',  '_locale' => 'fr',  '_route' => 'fr__RG__showproducts',);
        }

        // pl__RG__showproducts
        if ($pathinfo === '/pl/products') {
            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::showProductsAction',  '_locale' => 'pl',  '_route' => 'pl__RG__showproducts',);
        }

        // de__RG__addproduct
        if ($pathinfo === '/de/products/add') {
            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::addProductAction',  '_locale' => 'de',  '_route' => 'de__RG__addproduct',);
        }

        // en__RG__addproduct
        if ($pathinfo === '/products/add') {
            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::addProductAction',  '_locale' => 'en',  '_route' => 'en__RG__addproduct',);
        }

        // fr__RG__addproduct
        if ($pathinfo === '/fr/products/add') {
            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::addProductAction',  '_locale' => 'fr',  '_route' => 'fr__RG__addproduct',);
        }

        // pl__RG__addproduct
        if ($pathinfo === '/pl/products/add') {
            return array (  '_controller' => 'AppBundle\\Controller\\ProductController::addProductAction',  '_locale' => 'pl',  '_route' => 'pl__RG__addproduct',);
        }

        // de__RG__showproductdetails
        if (0 === strpos($pathinfo, '/de/products/details') && preg_match('#^/de/products/details/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__showproductdetails')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::showProductDetailsAction',  '_locale' => 'de',));
        }

        // en__RG__showproductdetails
        if (0 === strpos($pathinfo, '/products/details') && preg_match('#^/products/details/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__showproductdetails')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::showProductDetailsAction',  '_locale' => 'en',));
        }

        // fr__RG__showproductdetails
        if (0 === strpos($pathinfo, '/fr/products/details') && preg_match('#^/fr/products/details/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__showproductdetails')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::showProductDetailsAction',  '_locale' => 'fr',));
        }

        // pl__RG__showproductdetails
        if (0 === strpos($pathinfo, '/pl/products/details') && preg_match('#^/pl/products/details/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__showproductdetails')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::showProductDetailsAction',  '_locale' => 'pl',));
        }

        // de__RG__editproduct
        if (0 === strpos($pathinfo, '/de/products/edit') && preg_match('#^/de/products/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__editproduct')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::editProductAction',  '_locale' => 'de',));
        }

        // en__RG__editproduct
        if (0 === strpos($pathinfo, '/products/edit') && preg_match('#^/products/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__editproduct')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::editProductAction',  '_locale' => 'en',));
        }

        // fr__RG__editproduct
        if (0 === strpos($pathinfo, '/fr/products/edit') && preg_match('#^/fr/products/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__editproduct')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::editProductAction',  '_locale' => 'fr',));
        }

        // pl__RG__editproduct
        if (0 === strpos($pathinfo, '/pl/products/edit') && preg_match('#^/pl/products/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__editproduct')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::editProductAction',  '_locale' => 'pl',));
        }

        // de__RG__deleteproduct
        if (0 === strpos($pathinfo, '/de/products/delete') && preg_match('#^/de/products/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__deleteproduct')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::deleteProductAction',  '_locale' => 'de',));
        }

        // en__RG__deleteproduct
        if (0 === strpos($pathinfo, '/products/delete') && preg_match('#^/products/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__deleteproduct')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::deleteProductAction',  '_locale' => 'en',));
        }

        // fr__RG__deleteproduct
        if (0 === strpos($pathinfo, '/fr/products/delete') && preg_match('#^/fr/products/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__deleteproduct')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::deleteProductAction',  '_locale' => 'fr',));
        }

        // pl__RG__deleteproduct
        if (0 === strpos($pathinfo, '/pl/products/delete') && preg_match('#^/pl/products/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__deleteproduct')), array (  '_controller' => 'AppBundle\\Controller\\ProductController::deleteProductAction',  '_locale' => 'pl',));
        }

        // de__RG__shop
        if (rtrim($pathinfo, '/') === '/de/shop') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'de__RG__shop');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\ShopController::shopAction',  '_locale' => 'de',  '_route' => 'de__RG__shop',);
        }

        // en__RG__shop
        if (rtrim($pathinfo, '/') === '/shop') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'en__RG__shop');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\ShopController::shopAction',  '_locale' => 'en',  '_route' => 'en__RG__shop',);
        }

        // fr__RG__shop
        if (rtrim($pathinfo, '/') === '/fr/shop') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'fr__RG__shop');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\ShopController::shopAction',  '_locale' => 'fr',  '_route' => 'fr__RG__shop',);
        }

        // pl__RG__shop
        if (rtrim($pathinfo, '/') === '/pl/shop') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'pl__RG__shop');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\ShopController::shopAction',  '_locale' => 'pl',  '_route' => 'pl__RG__shop',);
        }

        // de__RG__shopproductinfo
        if (0 === strpos($pathinfo, '/de/shop/details') && preg_match('#^/de/shop/details/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__shopproductinfo')), array (  '_controller' => 'AppBundle\\Controller\\ShopController::showProductInfoAction',  '_locale' => 'de',));
        }

        // en__RG__shopproductinfo
        if (0 === strpos($pathinfo, '/shop/details') && preg_match('#^/shop/details/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__shopproductinfo')), array (  '_controller' => 'AppBundle\\Controller\\ShopController::showProductInfoAction',  '_locale' => 'en',));
        }

        // fr__RG__shopproductinfo
        if (0 === strpos($pathinfo, '/fr/shop/details') && preg_match('#^/fr/shop/details/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__shopproductinfo')), array (  '_controller' => 'AppBundle\\Controller\\ShopController::showProductInfoAction',  '_locale' => 'fr',));
        }

        // pl__RG__shopproductinfo
        if (0 === strpos($pathinfo, '/pl/shop/details') && preg_match('#^/pl/shop/details/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__shopproductinfo')), array (  '_controller' => 'AppBundle\\Controller\\ShopController::showProductInfoAction',  '_locale' => 'pl',));
        }

        // de__RG__fos_user_security_login
        if ($pathinfo === '/de/login') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_de__RG__fos_user_security_login;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_security_login',);
        }
        not_de__RG__fos_user_security_login:

        // en__RG__fos_user_security_login
        if ($pathinfo === '/login') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_en__RG__fos_user_security_login;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_security_login',);
        }
        not_en__RG__fos_user_security_login:

        // fr__RG__fos_user_security_login
        if ($pathinfo === '/fr/login') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fr__RG__fos_user_security_login;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_security_login',);
        }
        not_fr__RG__fos_user_security_login:

        // pl__RG__fos_user_security_login
        if ($pathinfo === '/pl/login') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_pl__RG__fos_user_security_login;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_security_login',);
        }
        not_pl__RG__fos_user_security_login:

        // de__RG__fos_user_security_check
        if ($pathinfo === '/de/login_check') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_de__RG__fos_user_security_check;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_security_check',);
        }
        not_de__RG__fos_user_security_check:

        // en__RG__fos_user_security_check
        if ($pathinfo === '/login_check') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_en__RG__fos_user_security_check;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_security_check',);
        }
        not_en__RG__fos_user_security_check:

        // fr__RG__fos_user_security_check
        if ($pathinfo === '/fr/login_check') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_fr__RG__fos_user_security_check;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_security_check',);
        }
        not_fr__RG__fos_user_security_check:

        // pl__RG__fos_user_security_check
        if ($pathinfo === '/pl/login_check') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_pl__RG__fos_user_security_check;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_security_check',);
        }
        not_pl__RG__fos_user_security_check:

        // de__RG__fos_user_security_logout
        if ($pathinfo === '/de/logout') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_de__RG__fos_user_security_logout;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_security_logout',);
        }
        not_de__RG__fos_user_security_logout:

        // en__RG__fos_user_security_logout
        if ($pathinfo === '/logout') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_en__RG__fos_user_security_logout;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_security_logout',);
        }
        not_en__RG__fos_user_security_logout:

        // fr__RG__fos_user_security_logout
        if ($pathinfo === '/fr/logout') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fr__RG__fos_user_security_logout;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_security_logout',);
        }
        not_fr__RG__fos_user_security_logout:

        // pl__RG__fos_user_security_logout
        if ($pathinfo === '/pl/logout') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_pl__RG__fos_user_security_logout;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_security_logout',);
        }
        not_pl__RG__fos_user_security_logout:

        // de__RG__fos_user_profile_show
        if (rtrim($pathinfo, '/') === '/de/profile') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_de__RG__fos_user_profile_show;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'de__RG__fos_user_profile_show');
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_profile_show',);
        }
        not_de__RG__fos_user_profile_show:

        // en__RG__fos_user_profile_show
        if (rtrim($pathinfo, '/') === '/profile') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_en__RG__fos_user_profile_show;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'en__RG__fos_user_profile_show');
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_profile_show',);
        }
        not_en__RG__fos_user_profile_show:

        // fr__RG__fos_user_profile_show
        if (rtrim($pathinfo, '/') === '/fr/profile') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fr__RG__fos_user_profile_show;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'fr__RG__fos_user_profile_show');
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_profile_show',);
        }
        not_fr__RG__fos_user_profile_show:

        // pl__RG__fos_user_profile_show
        if (rtrim($pathinfo, '/') === '/pl/profile') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_pl__RG__fos_user_profile_show;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'pl__RG__fos_user_profile_show');
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_profile_show',);
        }
        not_pl__RG__fos_user_profile_show:

        // de__RG__fos_user_profile_edit
        if ($pathinfo === '/de/profile/edit') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_de__RG__fos_user_profile_edit;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_profile_edit',);
        }
        not_de__RG__fos_user_profile_edit:

        // en__RG__fos_user_profile_edit
        if ($pathinfo === '/profile/edit') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_en__RG__fos_user_profile_edit;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_profile_edit',);
        }
        not_en__RG__fos_user_profile_edit:

        // fr__RG__fos_user_profile_edit
        if ($pathinfo === '/fr/profile/edit') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fr__RG__fos_user_profile_edit;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_profile_edit',);
        }
        not_fr__RG__fos_user_profile_edit:

        // pl__RG__fos_user_profile_edit
        if ($pathinfo === '/pl/profile/edit') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_pl__RG__fos_user_profile_edit;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_profile_edit',);
        }
        not_pl__RG__fos_user_profile_edit:

        // de__RG__fos_user_registration_register
        if (rtrim($pathinfo, '/') === '/de/register') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_de__RG__fos_user_registration_register;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'de__RG__fos_user_registration_register');
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_registration_register',);
        }
        not_de__RG__fos_user_registration_register:

        // en__RG__fos_user_registration_register
        if (rtrim($pathinfo, '/') === '/register') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_en__RG__fos_user_registration_register;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'en__RG__fos_user_registration_register');
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_registration_register',);
        }
        not_en__RG__fos_user_registration_register:

        // fr__RG__fos_user_registration_register
        if (rtrim($pathinfo, '/') === '/fr/register') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fr__RG__fos_user_registration_register;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'fr__RG__fos_user_registration_register');
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_registration_register',);
        }
        not_fr__RG__fos_user_registration_register:

        // pl__RG__fos_user_registration_register
        if (rtrim($pathinfo, '/') === '/pl/register') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_pl__RG__fos_user_registration_register;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'pl__RG__fos_user_registration_register');
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_registration_register',);
        }
        not_pl__RG__fos_user_registration_register:

        // de__RG__fos_user_registration_check_email
        if ($pathinfo === '/de/register/check-email') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_de__RG__fos_user_registration_check_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_registration_check_email',);
        }
        not_de__RG__fos_user_registration_check_email:

        // en__RG__fos_user_registration_check_email
        if ($pathinfo === '/register/check-email') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_en__RG__fos_user_registration_check_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_registration_check_email',);
        }
        not_en__RG__fos_user_registration_check_email:

        // fr__RG__fos_user_registration_check_email
        if ($pathinfo === '/fr/register/check-email') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fr__RG__fos_user_registration_check_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_registration_check_email',);
        }
        not_fr__RG__fos_user_registration_check_email:

        // pl__RG__fos_user_registration_check_email
        if ($pathinfo === '/pl/register/check-email') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_pl__RG__fos_user_registration_check_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_registration_check_email',);
        }
        not_pl__RG__fos_user_registration_check_email:

        // de__RG__fos_user_registration_confirm
        if (0 === strpos($pathinfo, '/de/register/confirm') && preg_match('#^/de/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_de__RG__fos_user_registration_confirm;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',  '_locale' => 'de',));
        }
        not_de__RG__fos_user_registration_confirm:

        // en__RG__fos_user_registration_confirm
        if (0 === strpos($pathinfo, '/register/confirm') && preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_en__RG__fos_user_registration_confirm;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',  '_locale' => 'en',));
        }
        not_en__RG__fos_user_registration_confirm:

        // fr__RG__fos_user_registration_confirm
        if (0 === strpos($pathinfo, '/fr/register/confirm') && preg_match('#^/fr/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fr__RG__fos_user_registration_confirm;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',  '_locale' => 'fr',));
        }
        not_fr__RG__fos_user_registration_confirm:

        // pl__RG__fos_user_registration_confirm
        if (0 === strpos($pathinfo, '/pl/register/confirm') && preg_match('#^/pl/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_pl__RG__fos_user_registration_confirm;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',  '_locale' => 'pl',));
        }
        not_pl__RG__fos_user_registration_confirm:

        // de__RG__fos_user_registration_confirmed
        if ($pathinfo === '/de/register/confirmed') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_de__RG__fos_user_registration_confirmed;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_registration_confirmed',);
        }
        not_de__RG__fos_user_registration_confirmed:

        // en__RG__fos_user_registration_confirmed
        if ($pathinfo === '/register/confirmed') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_en__RG__fos_user_registration_confirmed;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_registration_confirmed',);
        }
        not_en__RG__fos_user_registration_confirmed:

        // fr__RG__fos_user_registration_confirmed
        if ($pathinfo === '/fr/register/confirmed') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fr__RG__fos_user_registration_confirmed;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_registration_confirmed',);
        }
        not_fr__RG__fos_user_registration_confirmed:

        // pl__RG__fos_user_registration_confirmed
        if ($pathinfo === '/pl/register/confirmed') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_pl__RG__fos_user_registration_confirmed;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_registration_confirmed',);
        }
        not_pl__RG__fos_user_registration_confirmed:

        // de__RG__fos_user_resetting_request
        if ($pathinfo === '/de/resetting/request') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_de__RG__fos_user_resetting_request;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_resetting_request',);
        }
        not_de__RG__fos_user_resetting_request:

        // en__RG__fos_user_resetting_request
        if ($pathinfo === '/resetting/request') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_en__RG__fos_user_resetting_request;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_resetting_request',);
        }
        not_en__RG__fos_user_resetting_request:

        // fr__RG__fos_user_resetting_request
        if ($pathinfo === '/fr/resetting/request') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fr__RG__fos_user_resetting_request;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_resetting_request',);
        }
        not_fr__RG__fos_user_resetting_request:

        // pl__RG__fos_user_resetting_request
        if ($pathinfo === '/pl/resetting/request') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_pl__RG__fos_user_resetting_request;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_resetting_request',);
        }
        not_pl__RG__fos_user_resetting_request:

        // de__RG__fos_user_resetting_send_email
        if ($pathinfo === '/de/resetting/send-email') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_de__RG__fos_user_resetting_send_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_resetting_send_email',);
        }
        not_de__RG__fos_user_resetting_send_email:

        // en__RG__fos_user_resetting_send_email
        if ($pathinfo === '/resetting/send-email') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_en__RG__fos_user_resetting_send_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_resetting_send_email',);
        }
        not_en__RG__fos_user_resetting_send_email:

        // fr__RG__fos_user_resetting_send_email
        if ($pathinfo === '/fr/resetting/send-email') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_fr__RG__fos_user_resetting_send_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_resetting_send_email',);
        }
        not_fr__RG__fos_user_resetting_send_email:

        // pl__RG__fos_user_resetting_send_email
        if ($pathinfo === '/pl/resetting/send-email') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_pl__RG__fos_user_resetting_send_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_resetting_send_email',);
        }
        not_pl__RG__fos_user_resetting_send_email:

        // de__RG__fos_user_resetting_check_email
        if ($pathinfo === '/de/resetting/check-email') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_de__RG__fos_user_resetting_check_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_resetting_check_email',);
        }
        not_de__RG__fos_user_resetting_check_email:

        // en__RG__fos_user_resetting_check_email
        if ($pathinfo === '/resetting/check-email') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_en__RG__fos_user_resetting_check_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_resetting_check_email',);
        }
        not_en__RG__fos_user_resetting_check_email:

        // fr__RG__fos_user_resetting_check_email
        if ($pathinfo === '/fr/resetting/check-email') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_fr__RG__fos_user_resetting_check_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_resetting_check_email',);
        }
        not_fr__RG__fos_user_resetting_check_email:

        // pl__RG__fos_user_resetting_check_email
        if ($pathinfo === '/pl/resetting/check-email') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_pl__RG__fos_user_resetting_check_email;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_resetting_check_email',);
        }
        not_pl__RG__fos_user_resetting_check_email:

        // de__RG__fos_user_resetting_reset
        if (0 === strpos($pathinfo, '/de/resetting/reset') && preg_match('#^/de/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_de__RG__fos_user_resetting_reset;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'de__RG__fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',  '_locale' => 'de',));
        }
        not_de__RG__fos_user_resetting_reset:

        // en__RG__fos_user_resetting_reset
        if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_en__RG__fos_user_resetting_reset;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'en__RG__fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',  '_locale' => 'en',));
        }
        not_en__RG__fos_user_resetting_reset:

        // fr__RG__fos_user_resetting_reset
        if (0 === strpos($pathinfo, '/fr/resetting/reset') && preg_match('#^/fr/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fr__RG__fos_user_resetting_reset;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fr__RG__fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',  '_locale' => 'fr',));
        }
        not_fr__RG__fos_user_resetting_reset:

        // pl__RG__fos_user_resetting_reset
        if (0 === strpos($pathinfo, '/pl/resetting/reset') && preg_match('#^/pl/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_pl__RG__fos_user_resetting_reset;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'pl__RG__fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',  '_locale' => 'pl',));
        }
        not_pl__RG__fos_user_resetting_reset:

        // de__RG__fos_user_change_password
        if ($pathinfo === '/de/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_de__RG__fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_locale' => 'de',  '_route' => 'de__RG__fos_user_change_password',);
        }
        not_de__RG__fos_user_change_password:

        // en__RG__fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_en__RG__fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_locale' => 'en',  '_route' => 'en__RG__fos_user_change_password',);
        }
        not_en__RG__fos_user_change_password:

        // fr__RG__fos_user_change_password
        if ($pathinfo === '/fr/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fr__RG__fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_locale' => 'fr',  '_route' => 'fr__RG__fos_user_change_password',);
        }
        not_fr__RG__fos_user_change_password:

        // pl__RG__fos_user_change_password
        if ($pathinfo === '/pl/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_pl__RG__fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_locale' => 'pl',  '_route' => 'pl__RG__fos_user_change_password',);
        }
        not_pl__RG__fos_user_change_password:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
