<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__ . '/../')
);
unset($app->availableBindings['validator']);

$app->register('Jenssegers\Mongodb\MongodbServiceProvider');

$app->withFacades();

$app->withEloquent();

$app->configure('database');
$app->configure('tokens');
$app->configure('applicationable');
/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([
    App\Http\Middleware\JsonMiddleware::class
]);

$app->routeMiddleware([
    'auth.consumer' => App\Http\Middleware\AuthTokenConsumer::class,
    'auth.admin' => App\Http\Middleware\AuthTokenAdmin::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(Nebo15\REST\ServiceProvider::class);
$app->register(Nebo15\Changelog\ServiceProvider::class);
$app->register(App\Providers\ValidationServiceProvider::class);
$app->register(Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
$app->register(App\Providers\BugsnagServiceProvider::class);

# Waiting for SaaS
//$app->register(Nebo15\LumenOauth2\Providers\ServiceProvider::class);
//$app->register(Nebo15\LumenApplicationable\ServiceProvider::class);
// $app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->group([], function ($app) {
    require __DIR__ . '/../app/Http/routes.php';
});

return $app;
