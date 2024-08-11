<?php
namespace App\Services;

use App\Helper\DbHelper;

class UserService
{
    public function __construct()
    {
        $tableExistsQuery = "SELECT * FROM information_schema.tables WHERE table_schema = 'symfony' AND table_name = 'user' LIMIT 1;";
        $tableExists = DbHelper::executeRequest($tableExistsQuery);
        if (empty($tableExists)) {
            $createTableQuery = "CREATE TABLE user (id int, data varchar(255))";
            DbHelper::executeRequest($createTableQuery);
        }
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM user;";
        $result = DbHelper::executeRequest($query);
        if ($result != null) {
            return $result;
        }
    }

    public function addUser($firstName, $lastName, $address)
    {
        if (!empty($firstName) && !empty($lastName) && !empty($address)) {
            $query = "INSERT INTO user(id, data) values(" . time() . ", '" . $firstName . " - " . $lastName . " - " . $address . "');";
        }
        DbHelper::executeRequest($query);
    }

    public function deleteUser($id)
    {
        if (!empty($id)) {
            $query = "DELETE FROM user WHERE id = " . $id;
        }
        DbHelper::executeRequest($query);
    }
}