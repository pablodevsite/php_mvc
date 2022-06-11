<?php
//echo __DIR__;
require_once(__DIR__ . "/../app/helper.php");
gb_require_files("/app/Core/*.php");
gb_require_files("/app/Core/Exception/*.php");
gb_require_files("/app/Controller/*.php");
gb_require_files("/app/Middleware/*.php");
gb_require_files("/app/Model/*.php");


\App\Core\Config::loadenv(__DIR__.'/../.env');
$config = \App\Core\Config::loadconfig(__DIR__.'/../config');

(new \App\Core\Bootstrap($config))->run();