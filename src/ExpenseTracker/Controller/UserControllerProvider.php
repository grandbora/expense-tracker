<?php
namespace ExpenseTracker\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

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
           $api = new Api();
           $user = new User($api);

           $email = $request->request->get('email');
           $password = $request->request->get('password');
           $user->setEmail($userName);
           $user->setPassword($password);

           $user->authenticate();

           return $app->json($user, 201);
        });

        return $controllers;
    }
}
