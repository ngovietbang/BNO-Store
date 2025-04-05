<?php
require_once('./models/Connection.php');
class Theloai{
    public $idtheloai;
    public $loaisp;
    public $tentheloai;
    public $anh;
    public $ghichu;
    private $conn;

    //goi ket noi
    public function __construct(){
        $connect = new Connection();
        $this->conn = $connect->getConnection();
    }

    //hien thi the loai
    public function ShowTheLoai(){
        $query = "Select * From theloai Order BY idTheloai DESC";
        $smtp = $this->conn->prepare($query);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //lay id the loai
    public function getIdTheLoai($idTheLoai)
    {
        $smtp = $this->conn->prepare("SELECT * FROM theloai WHERE idTheloai = ?");
        $smtp->execute([$idTheLoai]);
        return $smtp->fetch(PDO::FETCH_ASSOC);
    }

    //xoa the loai
    public function XoaTheLoai($idTheLoai){
        $query = "Delete From theloai Where idTheloai = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $idTheLoai);
        return $smtp->execute();
    }

    //them the loai
    public function ThemTheLoai(){
        $query = "Insert Into theloai Values(:id, :loaisp, :tentheloai, :anh, :ghichu)";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $this->idtheloai);
        $smtp->bindParam(":loaisp", $this->loaisp);
        $smtp->bindParam(":tentheloai", $this->tentheloai);
        $smtp->bindParam(":anh", $this->anh);
        $smtp->bindParam(":ghichu", $this->ghichu);
        return $smtp->execute();
    }

    //sua the loai khong sua anh
    public function SuaTheLoaiNoImg($id){
        $query = "Update theloai Set tentheloai = :tentheloai, ghichu = :ghichu Where idTheloai = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $id);
        $smtp->bindParam(":tentheloai", $this->tentheloai);
        $smtp->bindParam(":ghichu", $this->ghichu);
        return $smtp->execute();
    }

    //sua the loai co sua anh
    public function SuaTheLoaiHaveImg($id)
    {
        $query = "Update theloai Set tentheloai = :tentheloai, anh = :anh, ghichu = :ghichu Where idTheloai = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":id", $id);
        $smtp->bindParam(":tentheloai", $this->tentheloai);
        $smtp->bindParam(":anh", $this->anh);
        $smtp->bindParam(":ghichu", $this->ghichu);
        return $smtp->execute();
    }

    //tim kiem the loai
    public function TimKiemTheLoai($tentheloai){
        $query = "Select * From theloai Where tentheloai LIKE :tentheloai ORDER BY idTheloai DESC";
        $smtp = $this->conn->prepare($query);
        $tentheloai = "%" . $tentheloai . "%";
        $smtp->bindParam(":tentheloai", $tentheloai, PDO::PARAM_STR);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //hien thi the loai theo loai san pham
    public function HienThiTheoLoaisp($loaisp){
        $query = "Select * From theloai Where loaisp = :loaisp";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":loaisp",$loaisp);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

}