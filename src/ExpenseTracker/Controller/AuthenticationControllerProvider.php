<?php
namespace ExpenseTracker\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

class AuthenticationControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/AA', function (Application $app) {
            return $app['twig']->render('index.twig');
        });

        return $controllers;
    }
}