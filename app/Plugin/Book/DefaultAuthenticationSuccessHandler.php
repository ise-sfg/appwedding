<?php
 
namespace Plugin\Book;
 
use Eccube\Application;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler as BaseDefaultAuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\HttpUtils;
 
class DefaultAuthenticationSuccessHandler extends BaseDefaultAuthenticationSuccessHandler
{
    /**
     * @var Application
     */
    private $app;
 
    public function __construct(Application $app, HttpUtils $httpUtils, array $options = array())
    {
        parent::__construct($httpUtils, $options);
        $this->app = $app;
    }
 
    public function onAuthenticationSuccess( Request $request, TokenInterface $token)
    {
        // ログイン後に実行したいプログラムはここに書く
        $id = $token->getUser()->getId();
        dump($token);
        $this->app['monolog']->debug('Login: '.$id);
 
 
        return parent::onAuthenticationSuccess($request, $token);
    }
}
