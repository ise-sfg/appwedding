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

    public function updateOrderStatus(Application $app, Request $request)
    {
        $status = $request->request->get('orderStatus');
//        dump($status);
        $productVlassId = $request->request->get('productVlassId');
//        dump($productVlassId);


        $session = $app['session'];
        if ($session->has('bookCart')) {
            $bookCart = $session->get('bookCart');
            $bookCart->setStatus($productVlassId, $status);
//            $session->set('bookCart', $bookCart);
        }
        

        return $app->redirect($app->url('cart'));
    }

    public function uploadImage(Application $app, Request $request)
    {
        return $app->render('Book/Resource/template/upload_image.twig', array());
    }

    public function doUploadImage(Application $app, Request $request)
    {
        $upload = './plugin/book/upload/001.jpg';
        if(move_uploaded_file($_FILES['file_upload']['tmp_name'], $upload)){
//            dump('アップロード完了');
        }else{
//            dump('アップロード失敗');
        }
        return $app->redirect($app->url('book_uploadimage'));
    }
}

