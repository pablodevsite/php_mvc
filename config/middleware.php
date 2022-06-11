<?php
use App\Middleware\MaintenanceMiddleware;
use App\Middleware\ProfileMiddleware;

return [
    '' => [MaintenanceMiddleware::class, []], 
    '/formtest' => [MaintenanceMiddleware::class, ProfileMiddleware::class, ["arg1", "arg2"]],
];