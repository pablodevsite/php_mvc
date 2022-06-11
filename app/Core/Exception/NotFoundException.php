<?php
namespace App\Core\Exception;

class NotFoundException extends \Exception {

    public function __construct(
        string $message = 'Page not found!',
        int $code = 404
    ) {
        parent::__construct($message, $code);
    }

}