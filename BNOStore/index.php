<?php
require_once('./controllers/UserController.php');
require_once('./controllers/SanPhamController.php');
require_once('./controllers/LoaispController.php');
require_once('./controllers/TheLoaiController.php');
require_once('./controllers/DonHangController.php');

$action = isset($_GET['action']) ? $_GET['action'] : "";
$userCtrl = new UserController();
$sanphamCtrl = new SanPhamController();
$loaispController = new LoaispController();
$theloaiController = new TheLoaiController();
$donhangCtrl = new DonHangController();

switch($action){

    //trở về trang chủ----
    case 'Home':
        $vloaisp = $loaispController->ShowLoaisp();
        $rowSanPham = $sanphamCtrl->HienThiSP();
        require_once('./views/Home.php');
        break;

//phần user
    //login - đăng nhập
    case 'Login':
        $userCtrl->Login();
        break;

    //logout - đăng xuất
    case 'Logout':
        $userCtrl->Logout();
        break;
    
    //admin đăng nhập
    case 'Admin':
        include('./views/Admin/HomeAdmin.php'); 
        break;
    
    //mo form admin quan ly nguoi dung-----------------------------------------
    case 'QuanLyNguoiDung':
        $rowUser = $userCtrl->HienThiUser();
        include('./views/Admin/AdminQLNguoiDung.php');
        break;
    //them nguoi dung
    case 'ThemUser':
        $userCtrl->ThemUser();
        break;
    //xoas user
    case 'XoaUser':
        $userCtrl->XoaUser();
        break;
    //lay id user
    case 'getIdUser':
        $userCtrl->getIdUser();
        break;
    //sua user
    case 'SuaUser':
        $userCtrl->SuaUser();
        break;
    //tim kiem user
    case 'TimKiemUser':
        $rowUser = $userCtrl->TimKiemUser();
        include('./views/Admin/AdminQLNguoiDung.php');
        break;
    //dang ky
    case 'DangKy':
        $userCtrl->dangky();
        break;
    //hien thi home profile user
    case 'HomeProfile':
        $rowUser = $userCtrl->getUserById();
        include('./views/HomeProfile.php');
        break;
    //hien thi home order cua user
    case 'HomeOrder':
        $rowUser = $userCtrl->getUserById();
        $rowDonHang = $donhangCtrl->HienThiDonHangById();
        include('./views/HomeOrder.php');
        break;


//phần loại sp
    //hien thi loai sp
    case 'ShowLoaisp':
        $loaispController->ShowLoaisp();
        break;
    //mo form quan ly loai sp----------------------------------------------------------
    case 'QuanLyLoaisp':
        $vloaisp = $loaispController->ShowLoaisp(); //hien thi loai sp
        include('./views/Admin/AdminQLLoaisp.php');
        break;
    //xóa loại sp
    case 'DeleteLoaisp':
        $loaispController->DeleteLoaisp();
        break;
    //them loaisp 
    case 'ThemLoaisp':
        $loaispController->ThemLoaisp();
        include('./views/Admin/AdminQLLoaisp.php');
        break;
    //lấy id loaisp
    case 'GetIdLoaisp':
        $loaispController->getIdLoaisp();
        break;
    //sua loai sp
    case 'UpdateLoaisp':
        $loaispController->UpdateLoaisp();
        break;
    //tim kiem loaisp
    case 'TimKiemLoaisp':
        $vloaisp = $loaispController->TimKiemLoaisp(); //hien thi loai sp
        include('./views/Admin/AdminQLLoaisp.php');
        break;



//phần thể loại
    //hiển thị thể loại
    case 'ShowTheLoai':
        $theloaiController->ShowTheLoai();
        break;
    //mở trang quản lý thể loại------------------------------------------------
    case 'QuanLyTheLoai':
        $vloaisp = $loaispController->ShowLoaisp();//hien thi loai sp
        $rowTheLoai = $theloaiController->ShowTheLoai();
        include('./views/Admin/AdminQLTheLoai.php');
        break;
    //xoa the loai
    case 'XoaTheLoai':
        $theloaiController->XoaTheLoai();
        break;
    //them the loai
    case 'ThemTheLoai':
        $theloaiController->ThemTheLoai();
        break;
    //tim kiem the loai
    case 'TimKiemTheLoai':
        $vloaisp = $loaispController->ShowLoaisp(); //hien thi loai sp
        $rowTheLoai = $theloaiController->TimKIemTheLoai();
        include('./views/Admin/AdminQLTheLoai.php');
        break;
    //get id the loai 
    case 'getIdTheLoai':
        $theloaiController->getIdTheLoai();
        break;
    //cap nhat the loai
    case 'SuaTheLoai':
        $theloaiController->SuaTheLoai();
        break;
    //hien thi the loai theo loaisp
    case 'HienThiTheLoaiTheoLoaisp':
        $theloaiController->HienThiTheoLoaisp();
        break;


//phần sản phẩm
    //admin mo form quan ly san pham-----------------------------------
    case 'QuanLySanPham':
        $vloaisp = $loaispController->ShowLoaisp();
        $rowSanPham = $sanphamCtrl->HienThiSP();
        include('./views/Admin/AdminQLSanPham.php');
        break;
    //them san pham
    case 'ThemSanPham':
        $sanphamCtrl->ThemSanPham();
        break;
    //xoa san pham
    case 'XoaSanPham':
        $sanphamCtrl->XoaSanPham();
        break;
    //lay id san pham
    case 'getIdSanPham':
        $sanphamCtrl->getIdSanPham();
        break;
    //sua san pham
    case 'SuaSanPham':
        $sanphamCtrl->SuaSanPham();
        break;
    //tim kiem san pham
    case 'TimKiemSanPham':
        $vloaisp = $loaispController->ShowLoaisp();
        $rowSanPham = $sanphamCtrl->TimKiemSp();
        include('./views/Admin/AdminQLSanPham.php');
        break;
    //hien thi chi tiet san pham khi nhan vao
    case 'ChiTietSp':
        $rowSanPham = $sanphamCtrl->ChiTietSp();
        include('./views/HomeChiTietSp.php');
        break;
    //home tim kiem san pham
    case 'HomeTimKiemSp':
        $rowSanPham = $sanphamCtrl->DaTimKiem();
        include('./views/HomeTimKiem.php');
        break;


//phần đơn hàng
    //admin mo trang quan ly ban hang-------------------------
    case 'QuanLyBanHang':
        $rowDonHang = $donhangCtrl->AdminHienThiDonHang();
        $rowThongBao = $donhangCtrl->HienThiThongBaoHuy();
        include('./views/Admin/AdminQLBanHang.php');
        break;
    //admin tim kiem don hang
    case 'AdminTimKiemDonHang':
        $rowThongBao = $donhangCtrl->HienThiThongBaoHuy();
        $rowDonHang = $donhangCtrl->AdminTimKiemDonHang();
        include('./views/Admin/AdminQLBanHang.php');
        break;
    //admin lay thong bao
    case 'LayThongBao':
        $donhangCtrl->LayThongBao();
        break;
    //admin xem chi tiet don hang theo iddh ma kh yeu cau
    case 'AdminTimKiemDonHangById':
        $rowThongBao = $donhangCtrl->HienThiThongBaoHuy();
        $rowDonHang = $donhangCtrl->TimKiemDonHangById();
        include('./views/Admin/AdminQLBanHang.php');
        break;
    //dat hang
    case 'DatHang':
        $donhangCtrl->ThemDonHang();
        break;
    //kh yeu cau huy don
    case 'HomeHuyDonHang':
        $donhangCtrl->YeuCauHuyDonHang();
        break;
    //admin xac nhan huy don hang
    case 'AdminHuyDonHang':
        $donhangCtrl->XacNhanHuyDonHang();
        break;
    //admin tiep nhan don
    case 'AdminTiepNhanDon':
        $donhangCtrl->TiepNhanDon();
        break;



//------------phần nhân sự----------------------------------------------------
    //---------Shipper dang nhap--------------
    case 'Shipper':
        $rowDonHang = $donhangCtrl->ShipperHienThiDonHang();
        include('./views/NhanSu/Shipper/HomeShipper.php');
        break;
    //shipper nhan don hang
    case 'ShipperNhanDonHang':
        $donhangCtrl->ShipperNhanDonHang();
        break;
    //trang shipper kiem tra don hang
    case 'ShipperDonHangChoGiao':
        $rowDonHang = $donhangCtrl->ShipperDonHangChoGiao();
        include('./views/NhanSu/Shipper/ShipperDonHang.php');
        break;
    //shipper tim kiem don hang
    case 'ShipperTimKiemDonHang':
        $rowDonHang = $donhangCtrl->ShipperTimKiemDonHang();
        include('./views/NhanSu/Shipper/HomeShipper.php');
        break;
    //shipper dong don hang
    case 'ShipperDongDonHang':
        $donhangCtrl->ShipperDongDonHang();
        break;


    //mặc định khi vào trang--------------------------------------
    default:
        $vloaisp = $loaispController->ShowLoaisp();
        $rowSanPham = $sanphamCtrl->HienThiSP();
        require_once('./views/Home.php');
        break;
}