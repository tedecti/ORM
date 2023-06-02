<?php

namespace App;

use App\Database;

class Models
{
    public $table;
    public $db;

    public function __construct()
    {
        $this->db = new Database('localhost', 'root', '', 'orm');
        $this->db->connect();
    }

    public function getAllUsers()
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
    
    public function getUserById($id)
    {
        $sql = "SELECT firstname, lastname FROM {$this->table} WHERE id = $id";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function getAllPosts()
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

    public function getPostById($id)
    {
        $sql = "SELECT title, description, image FROM {$this->table} WHERE id = $id";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

}
