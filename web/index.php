<?php
use ExpenseTracker\Controller\IndexControllerProvider;
use ExpenseTracker\Controller\AuthenticationControllerProvider;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__).'/src/ExpenseTracker/View',
));

$app->mount('/', new IndexControllerProvider());
$app->mount('/', new AuthenticationControllerProvider());

$app->run();
