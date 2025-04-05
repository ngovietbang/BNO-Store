<?php
require_once('./controllers/UserController.php');
require_once('./controllers/SanPhamController.php');
require_once('./controllers/LoaispController.php');
require_once('./controllers/TheLoaiController.php');

$action = isset($_GET['action']) ? $_GET['action'] : "";
$userCtrl = new UserController();
$sanphamCtrl = new SanPhamController();
$loaispController = new LoaispController();
$theloaiController = new TheLoaiController();

switch($action){

    //trở về trang chủ
    case 'Home':
        $vloaisp = $loaispController->ShowLoaisp();
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
    
    //mo form admin quan ly nguoi dung
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


//phần loại sp
    //hien thi loai sp
    case 'ShowLoaisp':
        $loaispController->ShowLoaisp();
        break;
    //mo form quan ly loai sp
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
    //mở trang quản lý thể loại
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
    //mo form quan ly san pham
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


    //mặc định khi vào trang
    default:
        $vloaisp = $loaispController->ShowLoaisp();
        require_once('./views/Home.php');
        break;
}