<?php
require_once('./controllers/UserController.php');
require_once('./controllers/ProductController.php');
require_once('./controllers/LoaispController.php');

$action = isset($_GET['action']) ? $_GET['action'] : "";
$userCtrl = new UserController();
$productCtrl = new ProductController();
$loaispController = new LoaispController();

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



//phần thể loại
    //hiển thị thể loại
    case 'Hienthitheloai':
        break;



//phần sản phẩm
    //hien thi san pham
    case 'ShowProduct':
        $productCtrl->HienThiSP();
        break;



    //mặc định khi vào trang
    default:
        $vloaisp = $loaispController->ShowLoaisp();
        require_once('./views/Home.php');
        break;
}
