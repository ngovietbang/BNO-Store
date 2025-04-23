<?php
session_start();
// Nếu chưa đăng nhập
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
else{
    if($_SESSION['role'] != 'Shipper'){
        header('Location: index.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <!--shipper-->
    <meta charset="UTF-8" />
    <title>BNO Store</title>
    <link rel="icon" href="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png" />
    <link rel="stylesheet" href="http://localhost:8080/BNOStore/views/NhanSu/nhansu.css?v=<?php echo time(); ?>" />
</head>
<body>
    <!--khung-->
    <div class="khung">

        <!--header-->
        <div class="header">
            <!--menu header-->
            <div class="menu_header">
                <a class="a_menu_header" href="http://localhost:8080/BNOStore?action=Shipper">Trang chủ</a>
                <a class="a_menu_header" href="#">Tin tức</a>
                <a class="a_menu_header" href="#">Sản phẩm</a>
                <a class="a_menu_header" href="#">Kết nối</a>
                <a class="a_menu_header" id="head-taikhoan" href="index.php?action=ShipperDonHangChoGiao&tentk=<?php echo $_SESSION['tentk'] ?? ''; ?>">Đơn hàng chờ giao</a>
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
                        <button class="a_menu_header_2" id="bt_login"> Đăng Nhập</button>
                    <?php endif; ?>
                </nav>
            </div>
        </div>

        <!--phần tìm kiếm-->
        <div class="header2">
            <!--logo-->
            <a class="a_logo" href="http://localhost:8080/BNOStore?action=Shipper">
                <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/logoweb2.png" class="logo_img" />
            </a>
            <!--find-->
            <form class="find_header" method="get" action="index.php">
                <input type="hidden" name="action" value="ShipperTimKiemDonHang" />
                <input class="search" type="text" placeholder="Tìm kiếm đơn hàng" name="keyword" value="<?php echo $_GET['keyword'] ?? ''; ?>" />
                <button class="bt-timkiem" type="submit">Tìm kiếm</button>
            </form>
        </div>

        <!--Phan danh cho shipper-->
        <div class="donhang-home">
            <h1>Đơn hàng đề xuất</h1>
            <!--grid-->
            <div class="dh-div1">
                <?php
                foreach ($rowDonHang as $row) { ?>
                    <!--item-->
                    <div class="dh-div2">
                        <div class="dh-div3">
                            <p id="dh-div3-ngaydat">Ngày đặt hàng: <?php echo $row['ngaydathang']; ?></p>
                            <p>Tên sản phẩm: <?php echo $row['tensp']; ?></p>
                            <p>Giá bán: <span><?php echo $row['giaban']; ?></span></p>
                            <p>Số lượng mua: <?php echo $row['soluongmua']; ?></p>
                            <p>Phí vận chuyển: <span><?php echo $row['giaban']; ?></span></p>
                            <p>Phương thức thanh toán: <?php echo $row['phuongthucthanhtoan']; ?></p>
                            <p>Tổng tiền: <span style="color:red"><?php echo $row['tongtien']; ?></span></p>
                            <p>Người nhận: <?php echo $row['hovaten']; ?></p>
                            <p>Số điện thoại: <?php echo $row['sdt']; ?></p>
                            <p>Địa chỉ giao hàng: <?php echo $row['diachigiaohang']; ?></p>
                            <p>Trạng thái: <span><?php echo $row['trangthai']; ?></span></p>
                        </div>
                        <div class="dh-div4">
                            <a class="dh-div4-action1" onclick="return nhandon();" href="index.php?action=ShipperNhanDonHang&iddh=<?php echo $row['iddh']; ?>">Nhận đơn hàng</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--end sp-->
            <div class="end"></div>
        </div>
        <!--script action-->
        <script>
            //action nhan don
            function nhandon() {
                return confirm("Bạn có muốn nhận đơn hàng này?");
            }
        </script>


        <!--footer-->
        <div class="footer">
            <!--footer 1 -->
            <div class="footer1">
                <!--cham soc kh-->
                <div class="f-div1 cskh">
                    <!--hom thu cskh-->
                    <div class="f-div2">
                        <h1>Hòm thư CSKH</h1>
                        <p>Admin: admin_bno@bnostore.com</p>
                        <p>CSKH chủ động: cskh_bno@bnostore.com</p>
                        <p>Kênh giải đáp: giaidap_bno@bnostore.com</p>
                        <p>GQKN: gqkn_bno@bnostore.com</p>
                    </div>
                    <!--giai dap truc tuyen-->
                    <div class="f-div2">
                        <h1>Kênh giải đáp trực tuyến</h1>
                        <p>Kênh hỗ trợ: 18009999</p>
                        <p>Kênh giải đáp: 18008888</p>
                        <p>Kênh khác: 18007777</p>
                    </div>
                    <!--cach lien lac khac-->
                    <div class="f-div2">
                        <h1>Cách liên lạc khác</h1>
                        <p>Hợp tác: pr_bno@bnostore.com</p>
                        <p>SĐT liên hệ: 098198198</p>
                    </div>
                </div>
                <!--phuong thuc thanh toan va van chuyen-->
                <div class="f-div1 pt-vt">
                    <!--phuong thuc thanh toan-->
                    <div class="f-div2" style="margin-left:0;">
                        <h1>Thanh toán</h1>
                        <!---->
                        <div class="f-div3">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/visa.png" />
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/tt1.png" />
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/jcb.png" />
                        </div>
                        <!---->
                        <div class="f-div3">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/ae.png" />
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/tt2.png" />
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/tg.png" />
                        </div>
                    </div>
                    <!--van chuyen-->
                    <div class="f-div2" style="margin-right:0;">
                        <h1>Vận chuyển</h1>
                        <!---->
                        <div class="f-div3">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/1.png" />
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/2.png" />
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/3.png" />
                        </div>
                        <!---->
                        <div class="f-div3">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/4.png" />
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/5.png" />
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/6.png" />
                        </div>
                    </div>
                </div>

                <!--contact-->
                <div class="f-div1 contact" style="gap:20px;flex-direction:column; margin-top:100px;">
                    <h2>Contact</h2>
                    <div class="f-div1-div">
                        <a href="" class="f-div1-a">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/fb.png" />
                        </a>
                        <a href="" class="f-div1-a">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/inta.png" />
                        </a>
                        <a href="" class="f-div1-a">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/tw.png" />
                        </a>
                        <a href="" class="f-div1-a">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/hoyo.png" />
                        </a>
                    </div>
                </div>

            </div>

            <!--final footer-->
            <div class="final-footer">
                <!--logo -->
                <div class="f2-div1" style="width:130px;height:60px;margin-top:30px;">
                    <img class="img1" alt="image" src="http://localhost:8080/BNOStore/views/HomeImage/icon/slogan1.png" />
                </div>
                <!--chinh sach-->
                <div class="f2-div1">
                    <a href="">Chính sách bảo mật</a>
                    <a href="">Điều khoản người dùng</a>
                    <a href="">Giới thiệu công ty</a>
                    <a href="">Liên hệ chúng tôi</a>
                    <a href="">Trung tâm trợ giúp</a>
                </div>
                <!--slogan-->
                <div class="f2-div1" style="width:340px;height:100px;margin-top:40px;">
                    <img class="img2" src="http://localhost:8080/BNOStore/views/HomeImage/icon/logoweb1.png" />
                </div>
                <!--coppy right-->
                <div class="f2-div1">
                    <p>Copyright © BNOStore. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>