<?php

namespace Plugin\Book\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;

class BookController
{
    public function index(Application $app, Request $request)
    {
        return $app->render('Book/Resource/template/book.twig', array());
    }

    public function getInfo(Application $app, Request $request)
    {
        $PlgOrderDetail = $app['book.repository.plg_order_detail']->find(1);
        $name = $app['user'];
//        $name = htmlspecialchars($request->get('name'));
        $result = array('name'=>$name['id'], 'color'=>$name['name01'], 'pear'=>$PlgOrderDetail->getStatus());
        log_info($result);
        return $app->json($result);
    }
}

