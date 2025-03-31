<?php
require_once('./models/Connection.php');

class Product{
    public $idsp;
    public $tensp;
    public $loaisp;
    public $tentheloai;
    public $giaban;
    public $soluong;
    private $conn;

    //goi ket noi
    public function __construct(){
        $connect = new Connection();
        $this->conn = $connect->getConnection();
    }

    //show sanpham 
    public function HienThiSP(){
        $query = "Select * From sanpham";
        $smtp = $this->conn->prepare($query);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //

}