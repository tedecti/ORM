<?php

namespace App\Controllers;

use App\Models;

class PostController extends Models
{
    public $table = 'posts';

    public function index() {
        return $this->getAllPosts();
    }

    public function create($title, $description, $image) {
        $sql = "INSERT INTO {$this->table} (title, description, image) VALUES ('$title', '$description', '$image')";
        $result = $this->db->query($sql);
        
    }

}