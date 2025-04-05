<?php
require_once('./models/Connection.php');

class SanPham{
    public $idsp;
    public $tensp;
    public $loaisp;
    public $tentheloai;
    public $giaban;
    public $soluong;
    public $anh;
    private $conn;

    //goi ket noi
    public function __construct(){
        $connect = new Connection();
        $this->conn = $connect->getConnection();
    }

    //show sanpham 
    public function HienThiSP(){
        $query = "Select * From sanpham Order By idsp DESC";
        $smtp = $this->conn->prepare($query);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //them san pham
    public function TheSanPham(){
        $query = "INSERT INTO sanpham VALUES(:id, :tensp, :loaisp, :tentheloai, :giaban, :soluong, :anh)";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $this->idsp);
        $smtp->bindParam(":tensp", $this->tensp);
        $smtp->bindParam(":loaisp", $this->loaisp);
        $smtp->bindParam(":tentheloai", $this->tentheloai);
        $smtp->bindParam(":giaban", $this->giaban);
        $smtp->bindParam(":soluong", $this->soluong);
        $smtp->bindParam(":anh", $this->anh);
        return $smtp->execute();
    }

    //xoa san pham
    public function XoaSanPham($idsp){
        $query = "DELETE From sanpham Where idsp = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $idsp);
        return $smtp->execute();
    }

    //lay id san pham
    public function getIdSanPham($idsp){
        $query = "select * From sanpham Where idsp = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $idsp);
        $smtp->execute();
        return $smtp->fetch(PDO::FETCH_ASSOC);
    }

    //sua san pham khong sua anh
    public function SuaSanPhamNoImg($idsp){
        $query = "Update sanpham Set tensp = :tensp, giaban = :giaban, soluong = :soluong Where idsp = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $idsp);
        $smtp->bindParam(":tensp", $this->tensp);
        $smtp->bindParam(":soluong", $this->soluong);
        $smtp->bindParam(":giaban", $this->giaban);
        return $smtp->execute();
    }

    //sua san pham co sua anh
    public function SuaSanPhamHaveImg($idsp)
    {
        $query = "Update sanpham Set tensp = :tensp, giaban = :giaban, soluong = :soluong, anh = :anh Where idsp = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $idsp);
        $smtp->bindParam(":tensp", $this->tensp);
        $smtp->bindParam(":soluong", $this->soluong);
        $smtp->bindParam(":giaban", $this->giaban);
        $smtp->bindParam(":anh", $this->anh);
        return $smtp->execute();
    }

    //tim kiem sp
    public function TimKiemSp($tensp){
        $query = "Select * From sanpham Where tensp LIKE :tensp ORDER BY idsp DESC";
        $smtp = $this->conn->prepare($query);
        $tensp = "%" . $tensp . "%";
        $smtp->bindParam(":tensp", $tensp);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

}