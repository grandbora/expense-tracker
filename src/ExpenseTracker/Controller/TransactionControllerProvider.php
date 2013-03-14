<?php
namespace ExpenseTracker\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use ExpenseTracker\Model\TransactionList;
use ExpenseTracker\Model\Transaction;
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

            if (0 !== strpos($request->headers->get('Content-Type'), 'application/json')) 
                return;

            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
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
            $created = $request->request->get('created');
            $amount = $request->request->get('amount');
            $merchant = $request->request->get('merchant');

            $api = new Api($app['buzz']);
            $transaction = new Transaction($api);
            $transaction->setAuthToken($request->cookies->get('authToken'));
            $transaction->setCreated($created);
            $transaction->setAmount($amount);
            $transaction->setMerchant($merchant);

            if (false === $transaction->save()) {
                return $app->json(array(), 401); 
            }

            return $app->json(array(), 201);
        });

        return $controllers;
    }
}
