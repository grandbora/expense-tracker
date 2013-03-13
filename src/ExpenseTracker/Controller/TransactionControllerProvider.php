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

        $controllers->get('/', function (Request $request, Application $app) {
            $authToken = $request->query->get('authToken');
            if (null === $authToken) {
                return $app->json(array(), 401); 
            }

            $api = new Api($app['buzz']);
            $transactionList = new TransactionList($api);
            $transactionList->setAuthToken($authToken);

            if (false === $transactionList->fetch()) {
                return $app->json(array(), 401); 
            }

            return $app->json($transactionList, 201);
        });

        return $controllers;
    }
}
