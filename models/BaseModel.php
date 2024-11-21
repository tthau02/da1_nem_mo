<?php

class BaseModel
{
    public $conn = null;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost; dbname=da1-nhom2; charset=utf8; port=3306", "root", "");
        } catch (PDOException $e) {
            echo "Lỗi kết nối CSDL: " . $e->getMessage();
        }
    }
}
