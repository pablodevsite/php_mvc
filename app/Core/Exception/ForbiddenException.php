<?php
namespace App\Core\Exception;

class ForbiddenException extends \Exception {

    public function __construct(
        string $message = 'Forbidden',
        int $code = 403
    ) {
        parent::__construct($message, $code);
    }

}