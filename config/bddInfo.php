<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 22/03/2019
 * Time: 14:54
 */

class bddInfo {
    static private $host = "localhost";
    static private $dbName = "tournament-manager";
    static private $username = "tournament-manager";
    static private $password = "XheNZ6932sH38SGi";

    public static function getHost() { return self::$host; }
    public static function getDbName() { return self::$dbName; }
    public static function getUsername() { return self::$username; }
    public static function getPassword() { return self::$password; }

    public static function setHost($host) { self::$host = $host; }
    public static function setDbName($dbName) { self::$dbName = $dbName; }
    public static function setUsername($username) { self::$username = $username; }
    public static function setPassword($password) { self::$password = $password; }
}