<?php



use App\Router;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Router.php';
require __DIR__ . '/../src/Model/DB_Connect.php';
require __DIR__ . '/../DB_Config.php';

session_start();

Debug::enable();

try {
    Router::Route();
} catch (ReflectionException $e) {
}