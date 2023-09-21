<?php
class Base
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    protected $database = "caribecargo";
    protected $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->database);

        // Chequea la conexion
        if ($this->mysqli->connect_error) {
            die("ERROR DE CONEXIÓN: " . $this->mysqli->connect_error);
        }
    }

    public function __destruct()
    {
        $this->mysqli->close();    
    }
}