<?php

namespace Butterfly\Bundles\Home\Controllers;

use Butterfly\Bundles\Home\Models\LoginPostFactory;
use Butterfly\Bundles\Home\Models\RegisterPostFactory;
use Butterfly\Bundles\Home\Models\SpecificationsFactory;
use Butterfly\Bundles\Home\Models\UserFactory;
use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;
use Butterfly\System\Session;

class Home extends ActiveClass
{

    function __construct()
    {
        parent::__construct();
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\RegisterPost');
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\LoginPost');
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\User');
    }

    public function main(Parameters $parameters = null, Request $request = null) {
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\Specifications');

        $specsFactory = new SpecificationsFactory();

        $specs = $specsFactory->getAll();

        echo $this->getTwig()->render('home/home/sub/main.twig', [
            'title' => 'Main',
            'message' => 'Creating success',
            'specs' => $specs
        ]);
    }

    public function login(Parameters $parameters = null, Request $request = null) {

        if ($this->getSessions()->get('login')) {
            $this->getPath()->redirect_route('/');
        }

        if ($request->isPost() && $request->getPostValue('submit') == 'login') {
            $loginPostFactory = new LoginPostFactory();
            $userFactory = new UserFactory();
            $user = $loginPostFactory->get($request);

            $login = $userFactory->getByRequest($user);

            if ($login) {
                $userFactory->login($login);
                $this->getPath()->redirect_route('/');
            } else {
                $this->getSessions()->add(new Session('error', 'Kullanıcı adı veya şifre hatalı.'));
            }
        }

        if ($request->isPost() && $request->getPostValue('submit') == 'register') {
            $registerPostFactory = new RegisterPostFactory();
            $userFactory = new UserFactory();
            $user = $registerPostFactory->get($request);
            $result = $userFactory->set($user);

            if ($result) {
                $user = $userFactory->getByEmail($user->getEmail());
                $userFactory->login($user);
                $this->getPath()->redirect_route('/');
            } else {
                $this->getSessions()->add(new Session('error', 'Kayıt hatası. Hata: ' . $result->errorInfo()));
            }
        }

        echo $this->getTwig()->render('home/home/sub/login.twig');
    }

    public function logout() {
        session_destroy();
        $this->getPath()->redirect_route('/login');
    }

}