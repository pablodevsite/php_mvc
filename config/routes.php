<?php

use \App\Controller\HomeController;
use \App\Controller\ComingSoonController;


return [
	'get' => [
		'' => [HomeController::class, 'index'],
		'/formtest' => [HomeController::class, 'formtest'],
		'/coming-soon' => [ComingSoonController::class, 'index'],
	],
	'post' => [
		'/formtest' => [HomeController::class, 'formtest_post'],
	]
];
