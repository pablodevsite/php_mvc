<?php
namespace App\Core;

class Config {

    //load .env file
    //skil empty rows and rows starting with #
    public static function loadenv($envFile) {
        if(!is_file($envFile)) {
            echo $envFile . " is not a file";
            return false;
        }

        $handle = fopen($envFile, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                if(str_starts_with($line, "#") || empty($line)) continue;
                putenv($line);
            }
            fclose($handle);
        }
    }

    
    //load array configuration file inside config folder
    public static function loadconfig($dir) {
        if(!is_dir($dir)) {
            return false;
        }
        $conf = [];
        $files = scandir($dir);
        foreach($files as $file) {
            if($file === '.' || $file === '..') continue;
            $nomeFile = pathinfo($file, PATHINFO_FILENAME);
            $conf[$nomeFile] = include $dir.'/'.$file;
        }
        return $conf;
    }
    
}