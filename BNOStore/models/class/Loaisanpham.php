<?php
require_once('./models/Connection.php');
class Loaisanpham{
    public $idloaisp;
    public $loaisp;
    public $anh;
    public $ghichu;
    private $conn;

    //goi ket noi
    public function __construct(){
        $connect = new Connection();
        $this->conn = $connect->getConnection();
    } 

    //hien thi loaisp
    public function ShowLoaisp(){
        $query = "Select * From loaisanpham Order by idloaisp DESC";
        $smtp = $this->conn->prepare($query);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //lay id loai sp
    public function getIdLoaisp($idloaisp){
        $smtp = $this->conn->prepare("SELECT * FROM loaisanpham WHERE idLoaisp = ?");
        $smtp->execute([$idloaisp]);
        return $smtp->fetch(PDO::FETCH_ASSOC);
    }


    //xoa loai sp
    public function DeleteLoaisp($idLoaisp){
        $query = "Delete From loaisanpham Where idLoaisp = :id ";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $idLoaisp);
        return $smtp->execute();
    }

    //them loai sp
    public function ThemLoaisp(){
        $query = "Insert Into loaisanpham Values(:id, :loaisp, :anh, :ghichu)";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $this->idloaisp);
        $smtp->bindParam(":loaisp", $this->loaisp);
        $smtp->bindParam(":anh", $this->anh);
        $smtp->bindParam(":ghichu", $this->ghichu);
        return $smtp->execute();
    }

    //sua loaisp co sua anh
    public function UpdateLoaispHaveImg($idLoaisp){
        $query = "Update loaisanpham Set loaisp = :loaisp, anh = :anh, ghichu=:ghichu Where idloaisp = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $idLoaisp);
        $smtp->bindParam(":loaisp", $this->loaisp);
        $smtp->bindParam(":anh", $this->anh);
        $smtp->bindParam(":ghichu", $this->ghichu);
        return $smtp->execute();
    }

    //sua loaisp ko sua anh
    public function UpdateLoaispNoImg($idLoaisp)
    {
        $query = "Update loaisanpham Set loaisp = :loaisp, ghichu=:ghichu Where idloaisp = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $idLoaisp);
        $smtp->bindParam(":loaisp", $this->loaisp);
        $smtp->bindParam(":ghichu", $this->ghichu);
        return $smtp->execute();
    }

    // loi khi them loai san pham da co trong csdl
    public function ktLoaisp($loaisp){
        $query = "Select * From loaisanpham where loaisp = :loaisp";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":loaisp", $loaisp);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

}