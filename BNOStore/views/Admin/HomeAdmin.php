<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png" />
    <link rel="stylesheet" href="http://localhost:8080/BNOStore/views/Admin/HomeAdmin.css?v=<?php echo time(); ?>" />
    <title>Home Admin</title>

</head>
<body>
    <!--header-->
    <div class="header">
        <!--menu header-->
        <div class="menu_header">
            <a class="a_menu_header" href="index.php?action=Admin">Trang chủ</a>
            <a class="a_menu_header" href="">Tin tức</a>
            <a class="a_menu_header" href="index.php?action=QuanLyLoaisp">Sản phẩm</a>
            <a class="a_menu_header" href="">Kết nối</a>
        </div>
        <!--menu header 2-->
        <div style="width:auto;margin:auto;margin-right:3px;display:flex;">
            <div class="menu_header_2">
                <a class="a_menu_header_2" href="">Thông báo</a>
                <a class="a_menu_header_2" href="">Hỗ trợ</a>
                <a style="color:turquoise;font-size:20px;font-weight:bold;margin-top:-3px;margin-left:6px;margin-right:9px;display:block;">|</a>
            </div>
            <!---->
            <nav style="width:auto;margin:auto;margin-right:70px;color:white;display:flex;">
                <?php if (isset($_SESSION['username'])): ?>
                    <span style="color:white;margin:auto;margin-right:10px;margin-top:-2px;color:red">👤 <?php echo $_SESSION['username']; ?></span>
                    <div style="display:flex">
                        <p style="margin:auto;margin-top:-2px;">【 </p>
                        <a class="a_menu_header_2" href="index.php?action=Logout">Đăng Xuất</a>
                        <p style="margin:auto;margin-top:-2px;"> 】</p>
                    </div>
                <?php else: ?>
                    <button class="a_menu_header_2" id="bt_login" style="font-size:17px;border:none;background:none;outline:none;cursor:pointer;"> Đăng Nhập</button>
                <?php endif; ?>
            </nav>
        </div>
    </div>

    <!--content-->
    <div class="content">
        <!--menu trái-->
        <div class="menu_trai">
            <img class="logo-menu" src="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png"/>
            <a class="bt_menu_trai" href="index.php?action=QuanLyLoaisp">Quản lý loại sản phẩm</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyTheLoai">Quản lý thể loại</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLySanPham">Quản lý sản phẩm</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyNguoiDung">Quản lý người dùng</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyBanHang">Quản lý bán hàng</a>
        </div>
    </div>

</body>
</html>