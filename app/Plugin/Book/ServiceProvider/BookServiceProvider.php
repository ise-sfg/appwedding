<?php

namespace Plugin\Book\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class BookServiceProvider implements ServiceProviderInterface
{
    private $app;

    public function register(BaseApplication $app)
    {
		$this->app = $app;
    	$app->match('/bookpage', 'Plugin\Book\Controller\BookController::index')->bind('book_index');
    	$app->match('/getinfo', 'Plugin\Book\Controller\BookController::getInfo')->bind('book_getinfo');
    	$app->match('/updateOrderStatus', 'Plugin\Book\Controller\BookController::updateOrderStatus')->bind('updateOrderStatus');
    	$app->match('/uploadimage', 'Plugin\Book\Controller\BookController::uploadImage')->bind('book_uploadimage');
    	$app->match('/douploadimage', 'Plugin\Book\Controller\BookController::doUploadImage')->bind('book_douploadimage');
        
        $app['book.repository.plg_order_detail'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\Book\Entity\PlgOrderDetail');
        });

        $app['security.authentication.success_handler.customer'] = $app->share(function ()  {
            $handler = new \Plugin\Book\DefaultAuthenticationSuccessHandler(
                $this->app,
                $this->app['security.http_utils'],
                $this->app['security.firewalls']['customer']['form']
            );
            $handler->setProviderKey('customer');

            return $handler;
        });

    }

    public function boot(BaseApplication $app)
    {
    }
}

