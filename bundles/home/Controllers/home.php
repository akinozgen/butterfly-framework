<?php

namespace Butterfly\Bundles\Home\Controllers;

use Butterfly\Bundles\Home\Models\LoginPost;
use Butterfly\Bundles\Home\Models\LoginPostFactory;
use Butterfly\Bundles\Home\Models\SpecificationsFactory;
use Butterfly\Bundles\Home\Models\UserFactory;
use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;
use Butterfly\System\Session;

class Home extends ActiveClass
{

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
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\LoginPost');
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\User');

        if ($request->isPost()) {
            $loginPostFactory = new LoginPostFactory();
            $userFactory = new UserFactory();
            $data = $loginPostFactory->get($request);

            $login = $userFactory->getByRequest($data);

            if ($login) {
                $userFactory->login($login);
            } else {
                $this->getSessions()->add(new Session('error', 'Kullanıcı adı veya şifre hatalı.'));
            }
        }

        echo $this->getTwig()->render('home/home/sub/login.twig');
    }

}