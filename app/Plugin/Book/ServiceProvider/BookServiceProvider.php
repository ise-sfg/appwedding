<?php

namespace Plugin\Book\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class BookServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
    	$app->match('/bookpage', 'Plugin\Book\Controller\BookController::index')->bind('book_index');
    	$app->match('/getinfo', 'Plugin\Book\Controller\BookController::getInfo')->bind('book_getinfo');

        $app['book.repository.plg_order_detail'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\Book\Entity\PlgOrderDetail');
        });

    }

    public function boot(BaseApplication $app)
    {
    }
}

