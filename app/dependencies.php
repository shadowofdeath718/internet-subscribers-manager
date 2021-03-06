<?php
// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

// Database
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// Flash messages
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages;
};


// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// Get auth
$container['auth'] = function ($c) {
    $settings = $c->get('settings');
    $admin_auth = $settings['auth'];
    return $admin_auth;
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------

$container[App\controllers\HomeAction::class] = function ($c) {
    return new App\controllers\HomeAction($c->get('view'), $c->get('logger'), $c->get('db'));
};

$container[App\controllers\PlansManager::class] = function ($c) {
    return new App\controllers\PlansManager($c->get('view'), $c->get('logger'), $c->get('db'));
};

$container[App\controllers\SubscribersManager::class] = function ($c) {
    return new App\controllers\SubscribersManager($c->get('view'), $c->get('logger'), $c->get('db'));
};


$container[App\controllers\LoginAction::class] = function ($c) {
    return new App\controllers\LoginAction($c->get('view'), $c->get('logger'), $c->get('db'), $c->get('auth'));
};

$container[App\controllers\LogoutAction::class] = function ($c) {
    return new App\controllers\LogoutAction($c->get('view'), $c->get('logger'));
};

$container[App\controllers\AddPlan::class] = function ($c) {
    return new App\controllers\AddPlan($c->get('view'), $c->get('logger'), $c->get('db'));
};

$container[App\controllers\DeletePlan::class] = function ($c) {
    return new App\controllers\DeletePlan($c->get('view'), $c->get('logger'), $c->get('db'));
};

$container[App\controllers\AddSubscriber::class] = function ($c) {
    return new App\controllers\AddSubscriber($c->get('view'), $c->get('logger'), $c->get('db'));
};

$container[App\controllers\DeleteCustomer::class] = function ($c) {
    return new App\controllers\DeleteCustomer($c->get('view'), $c->get('logger'), $c->get('db'));
};
