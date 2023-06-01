<?php
namespace Src;

use Src\Database;

class Models
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
        $sql = "INSERT INTO users (firstname, lastname, phone, email, password) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password')";;
        $result = $this->db->query($sql);
    }

    public function login($email, $password)
    {
        $emailLogin = $this->db->escapeString($email);
        $passwordLogin = $this->db->escapeString($password);

        $sql = "SELECT * FROM {$this->table} WHERE email = '$emailLogin' AND password = '$passwordLogin'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return true;
        }

        return false;
    }
}