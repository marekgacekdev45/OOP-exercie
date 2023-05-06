<?php

class User
{

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function findAllUsers()
    {
        return self::findThisQuery("SELECT * FROM users");
    }

    public static function findByID($userID)
    {
        global $database;
        $resultArray = self::findThisQuery("SELECT * FROM users WHERE id=$userID LIMIT 1");

        if (!empty($resultArray)) {
            $firstItem = array_shift($resultArray);
            return $firstItem;
        } else {
            return false;
        }
    }


    public static function findThisQuery($sql)
    {
        global $database;
        $resultSet = $database->query($sql);
        $objectArray = array();

        while ($row = mysqli_fetch_array($resultSet)) {
            $objectArray[] = self::instantiation($row);
        }

        return $objectArray;
    }


    public static function verifyUser($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * from users WHERE username = '{$username}' AND password ='{$password}' LIMIT 1";

        $resultArray = self::findThisQuery($sql);

        if (!empty($resultArray)) {
            $firstItem = array_shift($resultArray);
            return $firstItem;
        } else {
            return false;
        }
    }


    public static function instantiation($record)
    {
        $object = new self();

        foreach ($record as $attribute => $value) {
            if ($object->hasAttribute($attribute)) {
                $object->$attribute = $value;
            }
        }

        return $object;
    }

    private function hasAttribute($attribute)
    {
        $objectProperties = get_object_vars($this);

        return property_exists($this, $attribute);
    }
}