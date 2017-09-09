<?php

session_start();

if ( ! isset($rootDir)) {
    $rootDir = __DIR__ . '/..';
}

$paths = [
    'root'      => $rootDir,
    'config'    => $rootDir . '/app/config.php',
    'templates' => $rootDir . '/templates',
    'cache'     => $rootDir . '/cache',
    'routes'    => $rootDir . '/app/routes'
];

require $rootDir . '/vendor/autoload.php';

$app = new \Slim\Slim(require $paths['config']);

// Set the charset
$app->contentType('text/html; charset=utf-8');

// Register the database.
$app->container->singleton('db', function ($container) {

    // App configuration (config.php).
    $config = $container['settings'];

    return new Database(
        'mysql:host=' . $config['db.host'] . ';dbname=' . $config['db.name'],
        $config['db.username'],
        $config['db.password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]
    );

});

// App is installed, isn't it?
if (array_diff($app->db->getCurrentTables(), ['articles'])) {
    $app->db->createTables();
}

// Configure Twig.
$view = $app->view();

$view->setTemplatesDirectory($paths['templates']);

$view->parserOptions = array(
    'debug' => true,
    'cache' => $paths['cache']
);

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

// Configure routes.
\Slim\Route::setDefaultConditions([
    'id' => '[0-9]+'
]);

require $paths['routes'] . '/home.php';

foreach (['create', 'store', 'show', 'edit', 'update', 'destroy'] as $route) {
    require $paths['routes'] . '/articles/' . $route . '.php';
}

// Run the app
$app->run();