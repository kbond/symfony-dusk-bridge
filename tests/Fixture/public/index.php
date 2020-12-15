<?php

use Symfony\Bridge\Dusk\Tests\Fixture\Kernel;
use Symfony\Component\HttpFoundation\Request;

require \dirname(__DIR__).'/../../vendor/autoload.php';

$kernel = new Kernel('test', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
