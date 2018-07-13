<?php

namespace Plugin\Book\Entity;

use Plugin\Book\Entity\BookCartItem;

class BookCart extends \Eccube\Entity\AbstractEntity
{
    private $CartItems;

    public function __construct()
    {
        $this->CartItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setCartItem(BookCartItem $AddCartItem)
    {
        $classId = $AddCartItem->getClassId();
        $this->CartItems[$classId] = $AddCartItem;
        return $this;
    }

    public function setCartItem_Bak(BookCartItem $AddCartItem)
    {
        $find = false;
        foreach ($this->CartItems as $CartItem) {
            if ($CartItem->getClassId() === $AddCartItem->getClassId()) {
                $find = true;
                $CartItem->setStatus($AddCartItem->getStatus());
            }
        }
        if (!$find) {
            $this->addCartItem($AddCartItem);
        }
        return $this;
    }

    public function addCartItem(BookCartItem $CartItem)
    {
        $this->CartItems[] = $CartItem;
        return $this;
    }

    public function getCartItems()
    {
        return $this->CartItems;
    }

    public function getCartItem($classId)
    {
        return $this->CartItems[$classId];
    }

    public function setStatus($classId, $status)
    {
        $cartItem = $this->CartItems[$classId];
        $cartItem->setStatus($status);
    }

    public function removeCartItem($classId)
    {
        $cartItem = $this->CartItems[$classId];
        unset($this->CartItems[$classId]);
    }

}

