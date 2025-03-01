<?php

class DbConnect {
    private static string $host = '127.0.0.1';
    private static string $db = 'gp_base';
    private static string $user = 'root';
    private static string $pass = '';
    private static string $charset = 'utf8mb4';

    private static ?PDO $instance = null;

    // Private constructor to prevent direct instantiation
    private function __construct() {}

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserializing of the singleton
    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }

    // Singleton method to get database connection
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                
                self::$instance = new PDO($dsn, self::$user, self::$pass, $options);
            } catch (PDOException $e) {
                // Log error or handle appropriately
                throw new \Exception("Database connection error: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    // Optional: Method to close the connection
    public static function closeConnection() {
        self::$instance = null;
    }
}