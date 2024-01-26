<?php

include "config.php";
class Login extends Database
{

    function __construct()
    {
        parent::__construct();
    }
    // Tambahkan fungsi loginUser
    function loginUser($username, $password)
    {
        // Gunakan $this->con untuk mendapatkan koneksi database

        // Lakukan validasi login dan query ke database
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            // Login berhasil
            return true;
        } else {
            // Login gagal
            return false;
        }
    }

    function getUserType($username)
    {
        $query = "SELECT user_type FROM users WHERE username = '$username'";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['user_type'];
        }

        return null;
    }

    function getUserEmail($username)
    {
        $query = "SELECT email FROM users WHERE username = '$username'";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['email'];
        }

        return null;
    }

    function checkUsernameExists($username)
    {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->con->query($query);

        return $result->num_rows > 0;
    }
}
