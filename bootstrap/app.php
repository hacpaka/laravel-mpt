<?php
/*
|--------------------------------------------------------------------------
| Load The Shared Functions
|--------------------------------------------------------------------------
|
| WARNING! These functions are significant for the bundle life
| and can not be overloaded.
|
*/

include 'shared.php';

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = defined('UNIT_PATH')
	? new App\Custom\Unit(dirname(__DIR__), UNIT_PATH)
	: new App\Custom\Standard(dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
	Illuminate\Contracts\Http\Kernel::class,
	defined('UNIT_NAMESPACE') ? (UNIT_NAMESPACE . 'Kernel') : App\Http\Kernel::class
);

$app->singleton(
	Illuminate\Contracts\Console\Kernel::class,
	defined('UNIT_NAMESPACE') ? (UNIT_NAMESPACE . 'Console\Kernel') : App\Console\Kernel::class
);

$app->singleton(
	Illuminate\Contracts\Debug\ExceptionHandler::class,
	App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
