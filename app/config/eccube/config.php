<?php
return [
    'auth_magic' => getenv("AUTH_MAGIC"),
    'password_hash_algos' => 'sha256',
    'shop_name' => getenv("SHOP_NAME"),
    'force_ssl' => getenv("FORCE_SSL"),
    'cookie_lifetime' => '0',
    'locale' => 'ja',
    'timezone' => 'Asia/Tokyo',
    'eccube_install' => 1
];
