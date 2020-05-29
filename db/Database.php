<?php
require_once 'config.php';

class Database extends config
{

    /**
     * Constructor
     * Database connection is established in the public constructor, to prevent multiple object initialisation.
     */
    public function __construct()
    {
        try {
            // Initialize PDO database
            $this->conn = new PDO("mysql:host=" . self::$DB_HOST . ";dbname=" . self::$DB_NAME, self::$DB_USER, self::$DB_PASS);
        } catch(PDOException $e) {
            echo "Foutmelding connectie met de database: </br>";
            echo $e->getMessage();
        }
    }

    /**
     * @return \App\db\PDO
     */
    public function getmyDB()
    {
        if ($this->conn instanceof PDO)
        {
            return $this->conn;
        }
    }

    /**
     * getInstance()
     * The Database object is created from within the class itself
     * only if the class has no instance.
     * @return instance
     */
    public static function getInstance() {
        if(self::$_instance == null) {
            // No instance, then create one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getConnection() {
        return static::$connection;
    }

    /**
     * __clone()
     * is an empty magic method to prevent duplication of connection
     */
    public function __clone() { }



}
