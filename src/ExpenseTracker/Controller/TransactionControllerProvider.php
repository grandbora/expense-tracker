<?php
namespace ExpenseTracker\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class TransactionControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Request $request, Application $app) {
            $authToken = $request->request->get('authToken');

            if (null === $authToken) {
                return $app->json(array(), 401); 
            }

            $api = new Api($app['buzz']);

            //$api->fetch


        });

        return $controllers;
    }
}
