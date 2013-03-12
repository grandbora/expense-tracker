<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => dirname(__DIR__).'/src/View',
));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig');
});

$app->run();
