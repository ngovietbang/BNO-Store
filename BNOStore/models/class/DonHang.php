<?php
require_once('./models/Connection.php');

class DonHang{
    public $iddh; //id don hang
    public $id; //id user
    public $idsp; //id san pham
    public $hovaten; //ten khach hang
    public $sdt;
    public $diachigiaohang;
    public $tensp; //ten san pham
    public $giaban;
    public $soluongmua;
    public $phivanchuyen;
    public $phuongthucthanhtoan;
    public $tongtien;
    public $trangthai;
    public $ngaydathang;
    public $ngaytacdong;
    public $usertacdong;
    private $conn;

    //
    public function __construct(){
        $connect = new Connection();
        $this->conn = $connect->getConnection();
    }

    //
    public function ThemDonHang(){
        $query = "Insert Into donhang Values(:iddh, :id, :idsp, :hovaten, :sdt, :diachigiaohang, :tensp, :giaban, :soluongmua, 
                  :phivanchuyen, :phuongthucthanhtoan, :tongtien, :trangthai, :ngaydathang, :ngaytacdong, :usertacdong)";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":iddh", $this->iddh);
        $smtp->bindParam(":id",$this->id);
        $smtp->bindParam(":idsp",$this->idsp);
        $smtp->bindParam(":hovaten",$this->hovaten);
        $smtp->bindParam(":sdt",$this->sdt);
        $smtp->bindParam(":diachigiaohang",$this->diachigiaohang);
        $smtp->bindParam(":tensp",$this->tensp);
        $smtp->bindParam(":giaban",$this->giaban);
        $smtp->bindParam(":soluongmua",$this->soluongmua);
        $smtp->bindParam(":phivanchuyen",$this->phivanchuyen);
        $smtp->bindParam(":phuongthucthanhtoan",$this->phuongthucthanhtoan);
        $smtp->bindParam(":tongtien",$this->tongtien);
        $smtp->bindParam(":trangthai",$this->trangthai);
        $smtp->bindParam(":ngaydathang",$this->ngaydathang);
        $smtp->bindParam(":ngaytacdong",$this->ngaytacdong);
        $smtp->bindParam(":usertacdong",$this->usertacdong);
        return $smtp->execute();
    }

    //hien thi don hang theo id nguoi dung
    public function HienThiDonHangById($id){
        $query = "Select * From donhang INNER JOIN sanpham on donhang.idsp = sanpham.idsp Where id = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam("id", $id); //id user
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //cập nhật trạng thái đơn hàng theo iddh
    public function CapNhatTrangThai($iddh,$trangthai,$ngaytacdong, $usertacdong){
        $query = "Update donhang Set trangthai = :trangthai, ngaytacdong = :ngaytacdong, usertacdong = :usertacdong Where iddh = :iddh";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":iddh", $iddh);
        $smtp->bindParam(":trangthai", $trangthai);
        $smtp->bindParam(":ngaytacdong", $ngaytacdong);
        $smtp->bindParam(":usertacdong", $usertacdong);
        return $smtp->execute();
    }

    //hien thi don hang theo trang thai 
    public function HienThiDonHangByTrangThai($trangthai){
        $query = "Select donhang.*, sanpham.anh AS sanpham_anh, users.tentk From donhang INNER JOIN users on donhang.id = users.id 
                  INNER JOIN sanpham on donhang.idsp = sanpham.idsp Where trangthai = :trangthai ORDER BY donhang.ngaytacdong DESC";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":trangthai", $trangthai);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //admin tim kiem don hang theo iddonhang
    public function TimKiemDonHangById($iddh){
        $query = "Select * From donhang INNER JOIN sanpham on donhang.idsp = sanpham.idsp Where iddh = :id";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam("id", $iddh);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //hien thi tat ca don hang
    public function HienThiDonHang(){
        $query = "Select * From donhang INNER JOIN sanpham on donhang.idsp = sanpham.idsp ORDER BY FIELD(trangthai, 'Yêu cầu hủy', 'Chờ xác nhận', 'Đang xử lý') DESC, iddh DESC";
        $smtp = $this->conn->prepare($query);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //admin tim kiem don hang
    public function TimKiemDonHang($keyword)
    {
        $query = "SELECT * FROM donhang 
              WHERE iddh LIKE :tuKhoa
                 OR tensp LIKE :tuKhoa
                 OR idsp LIKE :tuKhoa
                 OR hovaten LIKE :tuKhoa
                 OR sdt LIKE :tuKhoa
                 OR diachigiaohang LIKE :tuKhoa
                 OR trangthai LIKE :tuKhoa
                 OR usertacdong LIKE :tuKhoa Order By FIELD(trangthai, 'Yêu cầu hủy', 'Chờ xác nhận', 'Đang xử lý') DESC, iddh DESC";

        $smtp = $this->conn->prepare($query);
        $keyword = "%$keyword%";
        $smtp->bindParam(":tuKhoa", $keyword);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //hien thi don hang trang shipper
    public function ShipperHienThiDonHang(){
        $query = "Select * From donhang Where trangthai = :trangthai Order By ngaytacdong ASC";
        $smtp = $this->conn->prepare($query);
        $trangthai = "Đang xử lý";
        $smtp->bindParam(":trangthai", $trangthai);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //shipper nhan don hang va cap nhat trang thai
    public function ShipperNhanDonHang($iddh, $trangthai, $ngaytacdong, $usertacdong){
        $query = "Update donhang Set trangthai = :trangthai, ngaytacdong = :ngaytacdong, usertacdong = :usertacdong Where iddh = :iddh";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":iddh", $iddh);
        $smtp->bindParam(":trangthai", $trangthai);
        $smtp->bindParam(":ngaytacdong", $ngaytacdong);
        $smtp->bindParam(":usertacdong", $usertacdong);
        return $smtp->execute();
    }

    //shipper hien thi don hang cho giao
    public function ShipperDonHangChoGiao($usertacdong)
    {
        $query = "Select * From donhang Where usertacdong = :usertacdong Order By ngaytacdong DESC";
        $smtp = $this->conn->prepare($query);
        $smtp->bindParam(":usertacdong", $usertacdong);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

    //shipper tim kiem don hang
    public function ShipperTimKiemDonHang($keyword)
    {
        $query = "SELECT * FROM donhang 
                 WHERE trangthai = 'Đang xử lý' AND (
                     iddh LIKE :tuKhoa
                     OR tensp LIKE :tuKhoa
                     OR idsp LIKE :tuKhoa
                     OR hovaten LIKE :tuKhoa
                     OR sdt LIKE :tuKhoa
                     OR diachigiaohang LIKE :tuKhoa
                     OR usertacdong LIKE :tuKhoa )
                 ORDER BY ngaytacdong DESC";


        $smtp = $this->conn->prepare($query);
        $keyword = "%$keyword%";
        $smtp->bindParam(":tuKhoa", $keyword);
        $smtp->execute();
        return $smtp->fetchAll(PDO::FETCH_ASSOC);
    }

}