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
use Butterfly\System\Validation;

class Home extends ActiveClass
{

    function __construct()
    {
        // Run ActiveClass::__construct(); for to be use libraries
        parent::__construct();
        // Load Models From \Butterfly\Bundles\Home\Models
        // IntelliJ and Most PHP Ide's can find these files while Ctrl+LeftClick on them
        // Thats why model name is too long
        // Thats for you ;)
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\RegisterPost');  //RegisterForm Fields
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\LoginPost');     //LoginForm Fields
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\User');          //UserManagement
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Home\\Models\\Specifications');//SpecicationsManagement
    }

    /**
     * @param Parameters|null $parameters
     * @param Request|null $request
     *
     * Route is /
     */
    public function main(Parameters $parameters = null, Request $request = null) {
        // Create SpecicationsManagement Instance From Specifications Model
        $specsFactory = new SpecificationsFactory();
        // Get All Specs From DB
        $specs = $specsFactory->getAll();
        // Render View
        echo $this->getTwig()->render('home/home/sub/main.twig', [
            'title' => 'Main',                  // Page Title Value
            'message' => 'Creating success',    // Page Message Value
            'specs' => $specs                   // Specs Value From DB
        ]);
    }

    /**
     * @param Parameters|null $parameters
     * @param Request|null $request
     *
     * Route is /login
     */
    public function login(Parameters $parameters = null, Request $request = null) {
        // Array for values of view
        $renderData = ['error' => []];
        // If user logged in then goto /
        if ($this->getSessions()->get('login')) {
            $this->getPath()->redirect_route('/');
        }
        // If user submitted login form
        if ($request->isPost() && $request->getPostValue('submit') == 'login') {
            // Handle Post Request For Login Form Fields
            $loginPostFactory = new LoginPostFactory();
            // Create User Management Instance
            $userFactory = new UserFactory();
            // Get LoginForm Post Values
            $user = $loginPostFactory->get($request);
            // Get User Instance Form DB by Post Request
            $login = $userFactory->getByRequest($user);
            // If requested user exists
            if ($login) {
                // Register Login Credentials To Session
                $userFactory->login($login);
                // Goto /
                $this->getPath()->redirect_route('/');
            } else {
                // Deploy Error Credential to Session
                // This will shown in twig files
                $this->getSessions()->add(new Session('error', 'Kullanıcı adı veya şifre hatalı.'));
            }
        }
        // If user submitted register form
        if ($request->isPost() && $request->getPostValue('submit') == 'register') {
            // Handle post requests from register form fields
            $registerPostFactory = new RegisterPostFactory();
            // Create user management instance
            $userFactory = new UserFactory();
            // Get register form post values
            $user = $registerPostFactory->get($request);
            // Create new validator instance
            $validator = new Validation();
            // Validate form fields
            $validate  = $validator->validate_email($user->getEmail())
                ->validate_pairs($user->getPassword(), $user->getRePassword())
                ->validate_length($user->getPassword(), 6, 20)
                ->get_results();// Commit Validator
            // If validation successed
            if ($validator->get_result()) {
                // Insert new user into DB
                $result = $userFactory->set($user);
                // If insertation success
                if ($result) {
                    // Get created user instance from its email
                    $user = $userFactory->getByEmail($user->getEmail());
                    // Do login with this user
                    $userFactory->login($user);
                    // Goto /
                    $this->getPath()->redirect_route('/');
                } else {
                    // Pass DB error to render data as array
                    $renderData['error'][] = 'Kayıt başarısız. Hata: ' . $this->getDatabase()->errorInfo();
                }
            } else {
                // Pass errors to render data
                $renderData['error'] = array_merge($renderData['error'], $validate);
            }
        }
        // Render view
        echo $this->getTwig()->render('home/home/sub/login.twig', $renderData);
    }

    /**
     * Route is /logout
     */
    public function logout() {
        // Remove all session data
        session_destroy();
        // Goto /login
        $this->getPath()->redirect_route('/login');
    }

}