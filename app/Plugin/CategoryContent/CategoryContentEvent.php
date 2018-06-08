<?php

namespace Plugin\CategoryContent;

use Eccube\Event\EventArgs;

class CategoryContentEvent
{
    /** @var \Eccube\Application $app */
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function onAdminProductCategoryIndexInit(EventArgs $event)
    {
        dump(111);
    }
}

