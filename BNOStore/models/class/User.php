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
    public $anh;
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

    //hien thi user
    public function HienThiUser(){
        $query = "Select * From users ORDER BY id DESC";
        $smtp = $this->conn->prepare($query);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //them user
    public function ThemUser(){
        $query = "Insert Into users Values(:id, :tentk, :matkhau, :hovaten, :ngaysinh, :gioitinh, :diachi, :cccd, :sdt, :email, :roles, :anh)";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $this->id);
        $smtp->bindParam(":tentk", $this->tentk);
        $smtp->bindParam(":matkhau", $this->matkhau);
        $smtp->bindParam(":hovaten", $this->hovaten);
        $smtp->bindParam(":ngaysinh", $this->ngaysinh);
        $smtp->bindParam(":gioitinh", $this->gioitinh);
        $smtp->bindParam(":diachi", $this->diachi);
        $smtp->bindParam(":cccd", $this->cccd);
        $smtp->bindParam(":sdt", $this->sdt);
        $smtp->bindParam(":email", $this->email);
        $smtp->bindParam(":roles", $this->roles);
        $smtp->bindParam(":anh", $this->anh);
        return $smtp->execute();
    }

    //xoa user
    public function XoaUser($id){
        $query = "Delete From users Where id=:id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $id);
        return $smtp->execute();
    }

    //lay id user
    public function getIdUser($id){
        $query = "Select * From users Where id = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $id);
        $smtp->execute();
        return $smtp->fetch(PDO::FETCH_ASSOC);
    }

    //sua user khong sua anh
    public function SuaUserNoImg($id){
        $query = "Update users Set matkhau = :matkhau, hovaten = :hovaten, ngaysinh = :ngaysinh, gioitinh = :gioitinh, diachi = :diachi, cccd = :cccd, sdt = :sdt WHERE id = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $this->id);
        $smtp->bindParam(":matkhau", $this->matkhau);
        $smtp->bindParam(":hovaten", $this->hovaten);
        $smtp->bindParam(":ngaysinh", $this->ngaysinh);
        $smtp->bindParam(":gioitinh", $this->gioitinh);
        $smtp->bindParam(":diachi", $this->diachi);
        $smtp->bindParam(":cccd", $this->cccd);
        $smtp->bindParam(":sdt", $this->sdt);
        return $smtp->execute();
    }

    //sua user co sua anh
    public function SuaUserHaveImg($id)
    {
        $query = "Update users Set matkhau = :matkhau, hovaten = :hovaten, ngaysinh = :ngaysinh, gioitinh = :gioitinh, diachi = :diachi, cccd = :cccd, sdt = :sdt, anh = :anh WHERE id = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $this->id);
        $smtp->bindParam(":matkhau", $this->matkhau);
        $smtp->bindParam(":hovaten", $this->hovaten);
        $smtp->bindParam(":ngaysinh", $this->ngaysinh);
        $smtp->bindParam(":gioitinh", $this->gioitinh);
        $smtp->bindParam(":diachi", $this->diachi);
        $smtp->bindParam(":cccd", $this->cccd);
        $smtp->bindParam(":sdt", $this->sdt);
        $smtp->bindParam(":anh", $this->anh);
        return $smtp->execute();
    }

}