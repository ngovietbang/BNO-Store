<?php
require_once('./models/Connection.php');

class User{
    public $id;
    public $tentk;
    public $matkhau;
    public $hovaten;
    public $ngaysinh;
    public $gioitinh;
    public $diachi;
    public $cccd;
    public $sdt;
    public $email;
    public $roles;
    private $conn;

    //gọi kết nối
    public function __construct(){
        $connect = new Connection();
        $this->conn = $connect->getConnection();
    }

    //Login
    public function Login($tentk, $matkhau){
        $query = "Select * From users Where tentk = :tentk and matkhau = :matkhau";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":tentk", $tentk);
        $smtp->bindParam(":matkhau", $matkhau);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

}