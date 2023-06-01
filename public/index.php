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
        $sql = "SELECT firstname, lastname FROM {$this->table} WHERE id = $id";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function register()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "INSERT INTO users (firstname, lastname, phone, email, password) WHERE NOT EXISTS VALUES ('$firstname', '$lastname', '$phone', '$email', '$password')";;
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
$getUser = new User();
// $users = $user->getAllUsers();
// var_dump($users);
$userById = $getUser->getUserById(1);

foreach ($userById as $user) {
    echo "$user <br>";
}

if (isset($_POST)) {
    $getUser->register();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <input type="text" name="firstname">
        <input type="text" name="lastname">
        <input type="number" name="phone">
        <input type="email" name="email">
        <input type="password" name="password">
        <button type="submit">Отправить</button>
    </form>
</body>

</html>