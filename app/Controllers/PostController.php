<?php

namespace App\Controllers;

use App\Models;

class PostController extends Models
{
    public $table = 'posts';

    public function index()
    {
        return $this->getAllPosts();
    }

    public function create($title, $user_id, $description, $image=null)
    {
        $sql = "INSERT INTO {$this->table} (title, user_id, description, image) VALUES ('$title', '$user_id', '$description', '$image')";
        $result = $this->db->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id=$id";
        $result = $this->db->query($sql);
    }
}
