<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once('./models/class/DonHang.php');

class DonHangController
{
    //them don hang
    public function ThemDonHang()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $donhang = new DonHang();
            //
            $donhang->id = intval($_POST['id']); //id user
            $donhang->hovaten = $_POST['hovaten'];
            $donhang->sdt = intval($_POST['sdt']);
            $donhang->diachigiaohang = $_POST['diachi'];
            $donhang->idsp = intval($_POST['idsp']); //id san pham
            $donhang->tensp = $_POST['tensp'];
            $donhang->giaban = intval($_POST['giaban']);
            $donhang->soluongmua = intval($_POST['soluongmua']);
            $donhang->phivanchuyen = intval($_POST['tuychongiaohang']);
            $donhang->phuongthucthanhtoan = $_POST['phuongthucthanhtoan'];
            $donhang->tongtien = intval(str_replace('.', '', $_POST['tongtien']));
            // ngay lap
            $ngaylap = $_POST['ngaylap']; // lấy chuỗi
            $donhang->ngaydathang = date('Y-m-d', strtotime($ngaylap)); // ép kiểu
            $donhang->ngaytacdong = date('Y-m-d', strtotime($ngaylap)); // ép kiểu
            //đặt trạng thái
            $donhang->trangthai = "Chờ xác nhận";
            $donhang->usertacdong = $_SESSION['tentk'];

            $result = $donhang->ThemDonHang();
            if ($result) {
                header('location:index.php?action=HomeOrder&id=' . $donhang->id);
                exit();
            }
        }
    }

    //hien thi don hang theo id user
    public function HienThiDonHangById()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id']; //id user
            $donhang = new DonHang();
            return $donhang->HienThiDonHangById($id);
        }
    }

    //yeu cau huy don hang cua kh
    public function YeuCauHuyDonHang()
    {
        if (isset($_GET['iddh'])) {
            $donhang = new DonHang();
            $iddh = $_GET['iddh'];
            $trangthai = "Yêu cầu hủy";
            session_start();
            $usertacdong = $_SESSION['tentk'];
            $ngaytd = date("Y-m-d H:i:s");
            $donhang->CapNhatTrangThai($iddh, $trangthai, $ngaytd, $usertacdong);
            //quay lai trang truoc
            header('Location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    //admin xac nhan huy don hang
    public function XacNhanHuyDonHang()
    {
        if (isset($_GET['iddh'])) {
            $donhang = new DonHang();
            $iddh = $_GET['iddh'];
            $trangthai = "Đã hủy";
            session_start();
            $usertacdong = $_SESSION['tentk'];
            $ngaytd = date("Y-m-d H:i:s");
            $donhang->CapNhatTrangThai($iddh, $trangthai, $ngaytd, $usertacdong);
            //quay lai trang truoc
            header('Location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    //admin tiep nhan don
    public function TiepNhanDon()
    {
        if (isset($_GET['iddh'])) {
            $donhang = new DonHang();
            $iddh = $_GET['iddh'];
            $trangthai = "Đang xử lý";
            session_start();
            $usertacdong = $_SESSION['tentk'];
            $ngaytd = date("Y-m-d H:i:s");
            $donhang->CapNhatTrangThai($iddh, $trangthai, $ngaytd, $usertacdong);
            //quay lai trang truoc
            header('Location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    //admin hien thi tat ca don hang
    public function AdminHienThiDonHang(){
        $donhang = new DonHang();
        return $donhang->HienThiDonHang();
    }

    //admin hien thi thong bao yeu cau huy
    public function HienThiThongBaoHuy()
    {
        $donhang = new DonHang();
        $trangthai = "Yêu cầu hủy";
        $row = $donhang->HienThiDonHangByTrangThai($trangthai);
        if (!empty($row)) {
            return $donhang->HienThiDonHangByTrangThai($trangthai);
        }
    }
    //lay thong bao
    public function LayThongBao()
    {
        if (isset($_GET['action']) && $_GET['action'] == 'LayThongBao') {
            $donhang = new DonHang();
            $trangthai = "Yêu cầu hủy";
            $row1 = $donhang->HienThiDonHangByTrangThai($trangthai);
            if (!empty($row1)) {
                $dem = 0;
                $html = '<h1>Yêu cầu mới nhận</h1>';
                foreach ($row1 as $row) {
                    $html .= '
                            <div class="chitiet-thongbao">
                                <p class="thongbao-ngay-tacdong">Ngày yêu cầu: ' . $row['ngaytacdong'] . '</p>
                                <div class="chitiet-thongbao-div1"> 
                                   <img src="http://localhost:8080/BNOStore/' . $row['sanpham_anh'] . '" />
                                   <div class="chitiet-thongbao-div2">
                                       <p>User: <span style="color:#00ffff">' . $row['tentk'] . '</span></p>
                                       <p>Message: yêu cầu hủy đơn hàng</p>
                                       <p>ID đơn hàng: <span style="color:#00ffff">' . $row['iddh'] . '</span></p>
                                   </div> 
                                </div>
                                <a href="index.php?action=AdminTimKiemDonHangById&iddh=' . $row['iddh'] . '">Xem chi tiết</a>
                            </div>';
                    $dem++;
                }

                // Trả về JSON
                echo json_encode([
                    "html" => $html,
                    "count" => $dem
                ]);

            }
        }
    }

    //admin tim kiem don hang theo id don hang
    public function TimKiemDonHangById(){
        if(isset($_GET['iddh'])){
            $iddh = $_GET['iddh'];
            $donhang = new DonHang();
            return $donhang->TimKiemDonHangById($iddh);
        }
    }

    //admin tim kiem don hang theo da tim kiem
    public function AdminTimKiemDonHang(){
        if(isset($_GET['keyword'])){
            $keyword = $_GET['keyword'];
            $donhang = new DonHang();
            return $donhang->TimKiemDonHang($keyword);
        }
    }

    //shiper-------------------------------------------------------------------
    //hien thi don hang tren trang shipper
    public function ShipperHienThiDonHang(){
        $donhang = new DonHang();
        return $donhang->ShipperHienThiDonHang();
    }
    //shipper nhan don hang
    public function ShipperNhanDonHang(){
        if (isset($_GET['iddh'])) {
            $donhang = new DonHang();
            $iddh = $_GET['iddh'];
            $trangthai = "Đang giao hàng";
            session_start();
            $usertacdong = $_SESSION['tentk'];
            $ngaytd = date("Y-m-d H:i:s");
            $donhang->ShipperNhanDonHang($iddh, $trangthai, $ngaytd, $usertacdong);
            //quay lai trang truoc
            header('Location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    //shipper don hang cho giao
    public function ShipperDonHangChoGiao()
    {
        if (isset($_GET['tentk'])) {
            $donhang = new DonHang();
            $usertacdong = $_GET['tentk'];
            return $donhang->ShipperDonHangChoGiao($usertacdong);
        }
    }

    //shipper dong don hang
    public function ShipperDongDonHang()
    {
        if (isset($_GET['iddh'])) {
            $donhang = new DonHang();
            $iddh = $_GET['iddh'];
            $trangthai = "Hoàn thành";
            session_start();
            $usertacdong = $_SESSION['tentk'];
            $ngaytd = date("Y-m-d H:i:s");
            $donhang->ShipperNhanDonHang($iddh, $trangthai, $ngaytd, $usertacdong);
            //quay lai trang truoc
            header('Location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    //shippẻ tim kiem don hang
    public function ShipperTimKiemDonHang(){
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $donhang = new DonHang();
            return $donhang->ShipperTimKiemDonHang($keyword);
        }
    }


}