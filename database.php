<?php

class database {
    private static $hostname = 'localhost';
    private static $username = 'root';
    private static $password = 'Kenc1k06';
    private static $dbname = 'students_db';

    private static $connect = null;

    public static function getConnection() {
        if (self::$connect === null) {
            try {
                self::$connect = new PDO("mysql:host=" . self::$hostname . ";dbname=" . self::$dbname, self::$username, self::$password);
                self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$connect;
    }
}
?>
