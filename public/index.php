<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

$router = new Router();

$router->comprobarRutas(); //valida el tipo de request sea get o post