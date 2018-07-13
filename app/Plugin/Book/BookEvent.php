<?php

namespace Plugin\Book;

use Eccube\Event\EventArgs;
use Plugin\Book\Entity\BookCart;
use Plugin\Book\Entity\BookCartItem;

class BookEvent
{
    const ORDER_STATUS_ITEM_NAME = 'plg_order_status';

    /** @var \Eccube\Application $app */
    private $app;
    private $session;
    private $bookCart;
    private $pepe;
    
    public function __construct($app)
    {
        $this->app = $app;
        $this->session = $app['session'];

        if ($this->session->has('bookCart')) {
            $this->bookCart = $this->session->get('bookCart');
        } else {
            $this->bookCart = new BookCart();
        }
    }

    public function onProductDetailInit(EventArgs $event)
    {
        // フォームの追加
        // FormBuilderの取得
        $builder = $event->getArgument('builder');
        // 項目の追加
        $builder->add(
            self::ORDER_STATUS_ITEM_NAME,
            'text',
            array(
                'required' => false,
                'label' => false,
                'mapped' => false,
                'attr' => array(
                    'placeholder' => 'コンテンツを入力してください(HTMLタグ使用可)',
                ),
            )
        );

        // 初期値を設定
        $builder->get(self::ORDER_STATUS_ITEM_NAME)->setData('xyz');
    }

    // 商品詳細
    public function onProductDetailComplete(EventArgs $event)
    {
        $product = $event->getArgument('Product');
        $form = $event->getArgument('form');
        $productId = $product->getId();
        $productClassId = $form['product_class_id']->getData();
        $status = $form[self::ORDER_STATUS_ITEM_NAME]->getData();

        log_info('#############################################');
        // dump($form);
        // dump($status);
        //        log_info($this->bookCart);
        if ($this->session->has('bookCart')) {
            $this->bookCart = $this->session->get('bookCart');
            $cartItems = $this->bookCart->getCartItems();
            if (!is_null($cartItems)) {
                // log_info(cartItems[0]->getStatus());
                log_info('%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%');
                $cartItem = $cartItems[$productClassId];
                if (!is_null($cartItem)) {
                    // dump($cartItem);
                    log_info($cartItem->getStatus());
                }
                // log_info($cartItem->getStatus());
                log_info('%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%');
            }
        }
        log_info('#############################################');
        
        $bookCartItem = new BookCartItem();
        $bookCartItem->setClassId($productClassId);
        $bookCartItem->setStatus($status);
        $this->bookCart->setCartItem($bookCartItem);
        $this->session->set('bookCart', $this->bookCart);
        
        // log_info($productClassId);
        // log_info($product->getName());
        // log_info($form['mode']->getData());
    }

    // カートの商品を削除
    public function onCartRemoveComplete(EventArgs $event)
    {
        $productClassId = $event->getArgument('productClassId');
        $this->bookCart->removeCartItem($productClassId);
    }

    // 購入完了
    public function onShoppingConfirmComplete(EventArgs $event)
    {
        $order = $event->getArgument('Order');
        dump($order);
    }
}
