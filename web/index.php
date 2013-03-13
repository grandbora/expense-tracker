<?php
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use ExpenseTracker\Controller\IndexControllerProvider;
use ExpenseTracker\Controller\UserControllerProvider;

require_once __DIR__.'/../app/bootstrap.php';

$app = new Application();
$app['debug'] = true;

$app->register(new TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__).'/src/ExpenseTracker/View',
));

$app->mount('/', new IndexControllerProvider());
$app->mount('/user', new UserControllerProvider());

$app->run();
