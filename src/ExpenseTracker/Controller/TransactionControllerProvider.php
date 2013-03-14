<?php
namespace ExpenseTracker\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use ExpenseTracker\Model\TransactionList;
use ExpenseTracker\Model\Api;

class TransactionControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->before(function (Request $request) {
            if (false === $request->cookies->has('authToken')) {
                return $app->json(array(), 401); 
            }
        });

        $controllers->get('/', function (Request $request, Application $app) {
            $api = new Api($app['buzz']);
            $transactionList = new TransactionList($api);
            $transactionList->setAuthToken($request->cookies->get('authToken'));

            if (false === $transactionList->fetch()) {
                return $app->json(array(), 401); 
            }

            return $app->json($transactionList, 201);
        });

        $controllers->post('/', function (Request $request, Application $app) {
            $authToken = $request->cookies->get('authToken');
            
        });

        return $controllers;
    }
}
