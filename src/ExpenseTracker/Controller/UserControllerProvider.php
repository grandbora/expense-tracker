<?php
namespace ExpenseTracker\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use ExpenseTracker\Model\User;
use ExpenseTracker\Model\Api;

class UserControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->before(function (Request $request) {
            if (0 !== strpos($request->headers->get('Content-Type'), 'application/json')) 
                return;

            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        });

        $controllers->post('/', function (Request $request, Application $app) {
            $api = new Api($app['buzz']);
            $user = new User($api);

            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $user->setEmail($email);
            $user->setPassword($password);

            if (false === $user->authenticate()) {
                return $app->json(array(), 401); 
            }

            $response = $app->json($user, 201);
            $response->headers->setCookie(new Cookie(
                'authToken', 
                $user->getAuthToken(),
                0,
                '/',
                null,
                false,
                false
            ));

            return $response;
        });

        return $controllers;
    }
}
