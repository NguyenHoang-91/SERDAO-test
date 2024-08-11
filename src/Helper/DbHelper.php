<?php

namespace App\Helper;

use Doctrine\DBAL\DriverManager;

class DbHelper
{
    public static function getConnection()
    {
        $connectionParams = [
            'dbname' => 'symfony',
            'user' => 'symfony',
            'password' => '',
            'host' => 'mariadb',
            'driver' => 'pdo_mysql',
        ];
        return DriverManager::getConnection($connectionParams);
    }
    public static function executeRequest($sql)
    {
        $connection = self::getConnection();
        $stmt = $connection->prepare($sql);
        return $stmt->executeQuery()->fetchAllAssociative();
    }
}