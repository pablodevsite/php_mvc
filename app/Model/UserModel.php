<?php
namespace App\Model;
use \App\Core\Model;

class UserModel extends Model {

    public function __construct(public \PDO $pdo) {
        parent::__construct($pdo);
    }

}