<?php

require_once "vendor/autoload.php";

$configuracoes = require 'app/config/configuracoes.php';


$app = new \SlimRest\App2($configuracoes);

// Register Entity Resource
// init resources
new \SlimRest\Auth\AuthAPI($app);
new \SlimRest\membro\MembroAPI($app);
new \SlimRest\Celula\CelulaAPI($app);
new \SlimRest\FrequenciaCelula\FrequenciaCelulaAPI($app);
// end init resources

$app->run();
