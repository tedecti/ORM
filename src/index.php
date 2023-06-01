<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        return $this->connection->query($sql);
    }

    public function close()
    {
        $this->connection->close();
    }
}

class Model
{
    public $table;
    public $db;

    public function __construct()
    {
        $this->db = new Database('localhost', 'root', '', 'orm');
        $this->db->connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }

        return [];
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = $id";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function register()
    {
        $sql = "INSERT INTO users (firstname, lastname, phone, email, password) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password')";;
        $result = $this->db->query($sql);

        
    }
}

class User extends Model
{
    public $table = 'users';

    public function getAllUsers()
    {
        return $this->getAll();
    }

    public function getUserById($id)
    {
        return $this->getById($id);
    }
}
$user = new User();
// $users = $user->getAllUsers();
// var_dump($users);

$userById = $user->getUserById(1);
var_dump($userById);
