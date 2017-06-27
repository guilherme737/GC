<?php

namespace SlimRest;

use Illuminate\Database\Capsule\Manager as Capsule;

class App2 {

    public $app;
    public $database;
    public $container;

    function __construct($configuracao) {

        $this->app = new \Slim\App(array(
            'addContentLengthHeader' => false,
            'debug' => true
        ));

        // configure error logger
        $this->registerErrorLogger();

        $this->registrarBancoDados($configuracao['database']);
    }

    public function route($verb, $route, $callback) {

        if (in_array($verb, ['get', 'put', 'post', 'delete']))
            return $this->app->$verb($route, $callback);

        throw new \Exception('Invalid HTTP verb');
    }

    function run() {
        $this->app->run();
    }

    function registerErrorLogger() {

        $this->app->getContainer()['Logger'] = function($container) {
            $logger = new \Monolog\Logger('logger');
            $filename = 'log/error.log';
            $stream = new \Monolog\Handler\StreamHandler($filename, \Monolog\Logger::DEBUG);
            $fingersCrossed = new \Monolog\Handler\FingersCrossedHandler(
                    $stream, \Monolog\Logger::ERROR);
            $logger->pushHandler($fingersCrossed);
            return $logger;
        };

        $this->app->getContainer()['errorHandler'] = function ($c) {
            return new \SlimRest\ErrorHandler($c['Logger']);
        };

        $this->app->getContainer()['notFoundHandler'] = function ($container) {
            return function ($request, $response) use ($container) {
                return $this->response($container['response'], json_encode(['msg' => 'Resource Not Found']), 404);
            };
        };
    }

    public function response($response, $data = '', $status = 200, $type = 'application/json') {
        return $response->withStatus($status)->withHeader('Content-type', 'application/json')->write($data);
    }

    public function registrarBancoDados($configuracaoBancoDados) {
        $capsule = new Capsule;
        $capsule->addConnection($configuracaoBancoDados);
        $capsule->bootEloquent();
    }

}
