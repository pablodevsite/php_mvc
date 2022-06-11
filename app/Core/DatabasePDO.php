<?php
namespace App\Core;

class DatabasePDO {

    public \PDO $conn; //connection to db
    public int $last_rowcount; //row affected by the last query

    public function __construct() 
    {
        $dbhost = getenv('DB_HOST');
        $dbport = getenv('DB_PORT');
        $dbuser = getenv('DB_USERNAME');
        $dbpwd = getenv('DB_PASSWORD');
        $dbname = getenv('DB_DATABASE');

        if(!empty($dbname))
        {
            try {
                $dsn = "mysql:host=$dbhost;dbname=$dbname;port=$dbport;charset=utf8";
                $this->pdo = new \PDO($dsn,$dbuser,$dbpwd, [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_EMULATE_PREPARES => false
                ]);
            } catch (\PDOException $pe) {
                die("Could not connect to the database $dbname :" . $pe->getMessage());
            } 
        }
        
    }


    function db_query($sql, $par = array(), bool $bOneRow = false) : array
    {
        $data = [];    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($par); 

        if($bOneRow)
        {	
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);	
            $this->last_rowcount = 1;
        }
        else
        {
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);		
            $this->last_rowcount = $stmt->rowCount();
        }
    
        return $data;
    }
}

