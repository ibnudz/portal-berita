<?php

include "config.php";
class Category extends Database
{
    public function getAllCategories()
    {
        $query = "SELECT * FROM category";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getTotalCategories()
    {
        $query = "SELECT COUNT(*) AS total_categories FROM category";
        $result = $this->con->query($query);
        $row = $result->fetch_assoc();
        return $row['total_categories'];
    }
}

class Subcategory extends Database
{
    public function getAllSubcategories()
    {
        $query = "SELECT * FROM subcategory";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getTotalSubcategories()
    {
        $query = "SELECT COUNT(*) AS total_subcategories FROM subcategory";
        $result = $this->con->query($query);
        $row = $result->fetch_assoc();
        return $row['total_subcategories'];
    }
}

class Post extends Database
{
    public function getAllPosts()
    {
        $query = "SELECT * FROM posts";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getTotalPosts()
    {
        $query = "SELECT COUNT(*) AS total_posts FROM posts";
        $result = $this->con->query($query);
        $row = $result->fetch_assoc();
        return $row['total_posts'];
    }
}
