<?php

namespace Plugin\Book\Entity;

class BookCartItem extends \Eccube\Entity\AbstractEntity
{
    private $class_id;
    private $status;

    public function __construct()
    {
    }

    public function __sleep()
    {
        return array('class_id', 'status');
    }

    public function setClassId($class_id)
    {
        $this->class_id = $class_id;
        return $this;
    }

    public function getClassId()
    {
        return $this->class_id;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
}

