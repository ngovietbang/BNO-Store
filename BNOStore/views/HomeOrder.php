<?php
session_start();
//
if (isset($_SESSION['username'])) {
    //neu la user thuong
    if ($_SESSION['role'] == 'Admin') {
        header('location: index.php?action=Admin');
        exit();
    }
}
//
if (!isset($_SESSION['id'])) {
    header('location: index.php');
} else {
    $id = $_GET['id'] ?? "";
    if ($id != $_SESSION['id']) {
        header('location: index.php');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!--home order-->
    <meta charset="UTF-8" />
    <title>BNO Store</title>
    <link rel="icon" href="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png" />
    <link rel="stylesheet" href="http://localhost:8080/BNOStore/views/Home.css?v=<?php echo time(); ?>" />
</head>
<body>
    <!---->
    <div class="khung">
        <!--header-->
        <div class="header">
            <!--menu header-->
            <div class="menu_header">
                <a class="a_menu_header" href="http://localhost:8080/BNOStore">Trang chủ</a>
                <a class="a_menu_header" href="">Tin tức</a>
                <a class="a_menu_header" href="">Sản phẩm</a>
                <a class="a_menu_header" href="">Kết nối</a>
                <a class="a_menu_header" id="head-taikhoan" href="index.php?action=HomeProfile&id=<?php echo $_SESSION['id'] ?? ''; ?>" style="display:none">Tài khoản</a>
                <!--script hien thi but tai khoan-->
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const settk = "<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>";
                        const divtk = document.getElementById('head-taikhoan');

                        if (divtk) {
                            if (settk === "") {
                                divtk.style.display = "none";
                            } else {
                                divtk.style.display = "inline-block";
                            }
                        }
                    });
                </script>
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
            <a class="a_logo" href="http://localhost:8080/BNOStore">
                <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/logoweb2.png" class="logo_img" />
            </a>
            <!--find-->
            <form class="find_header" id="find-header" method="get" action="index.php">
                <input type="hidden" name="action" value="HomeTimKiemSp" />
                <input class="search" type="text" placeholder="Tìm kiếm sản phẩm" name="keyword" value="<?php echo $_GET['keyword'] ?? ''; ?>" />
                <button class="bt-timkiem" type="submit">Tìm kiếm</button>
            </form>

            <!--giỏ hàng-->
            <div class="gio-hang">
                <a class="gio-hang-a">
                    <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/shop.png" />
                </a>
            </div>
        </div>


        <!--profile user****************************************************************************************************************-->
        <div class="home-profile">
            <!--profile-trai-->
            <div class="profile-trai">
                <!--hien thi user va anh-->
                <div class="profile-trai-div1">
                    <?php
                    foreach ($rowUser as $row) { ?>
                        <img src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                        <p><?php echo $row['hovaten']; ?></p>
                    <?php } ?>
                </div>
                <!--cac thong tin-->
                <div class="profile-trai-div2">
                    <!--thong bao-->
                    <div class="profile-trai-div3">
                        <a class="profile-trai-div4" href="index.php?action=HomeNotication&id=<?php echo $_SESSION['id'] ?? ''; ?>">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/thongbao.png" />
                            <span>Thông báo</span>
                        </a>
                    </div>
                    <!--tai khoan-->
                    <div class="profile-trai-div3">
                        <!--main-->
                        <a class="profile-trai-div4" href="index.php?action=HomeProfile&id=<?php echo $_SESSION['id'] ?? ''; ?>">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/user.png" />
                            <span>Tài khoản của tôi</span>
                        </a>
                    </div>
                    <!--don hang-->
                    <div class="profile-trai-div3">
                        <a class="profile-trai-div4" href="index.php?action=HomeOrder&id=<?php echo $_SESSION['id'] ?? ''; ?>" style="color:#ff0000;">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/order.png" />
                            <span>Đơn hàng</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--profile phai-->
            <div class="profile-phai">
                <!--donhang-->
                <div class="profile-phai-div1" id="div-donhang">
                    <!--loc-->
                    <div class="donhang-div1">
                        <a id="loc-donhang-tatca" href="">Tất cả</a>
                        <a id="loc-donhang-choxacnhan" href="">Chờ xác nhận</a>
                        <a id="loc-donhang-dangxuly" href="">Đang xử lý</a>
                        <a id="loc-donhang-danggiaohang" href="">Đang giao hàng</a>
                        <a id="loc-donhang-yeucauhuy" href="">Yêu cầu hủy</a>
                        <a id="loc-donhang-hoanthanh" href="">Hoàn thành</a>
                        <a id="loc-donhang-dahuy" href="">Đã hủy</a>
                    </div>
                    <!--tim kiem-->
                    <form class="donhang-timkiem" method="get" action="">
                        <input type="text" name="timdonhang" placeholder="Tim kiếm đơn hàng theo ID đơn hàng, Tên sản phẩm, Ngày đặt hàng" />
                        <!---->
                        <button type="submit" name="" class="bt-timkiem-donhang">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/find.png" />
                        </button>
                    </form>
                    <!---->
                    <div class="donhang-div2">
                        <!---->
                        <?php
                        foreach ($rowDonHang as $row) { ?>
                            <!---->
                            <div class="donhang-div3" id="so-donhang">
                                <!--trang thai-->
                                <div class="donhang-div4">
                                    <p class="donhang-div4-p">Ngày đặt hàng: <?php echo $row['ngaydathang'] ?></p>
                                    <p class="donhang-div4-p2 trang-thai-dh"><?php echo $row['trangthai']; ?></p>
                                </div>
                                <!--anh va ten sp-->
                                <div class="donhang-div5">
                                    <img src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                                    <!---->
                                    <div class="donhang-div6">
                                        <div class="donhang-div7">
                                            <p><?php echo $row['tensp']; ?></p>
                                            <span><small><u>đ</u></small><?php echo $row['giaban']; ?></span>
                                        </div>
                                        <!--so luong mua-->
                                        <div class="donhang-div8">
                                            <p>Số lượng mua: </p>
                                            <span><?php echo $row['soluongmua']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!--tuy chon giao hang-->
                                <div class="donhang-div9">
                                    <div class="donhang-div10">
                                        <p>Phí vận chuyển: </p>
                                        <span><?php echo $row['phivanchuyen'] ?></span>
                                    </div>
                                    <!---->
                                    <div class="donhang-div10">
                                        <p>Phương thức thanh toán: </p>
                                        <span><?php echo $row['phuongthucthanhtoan'] ?></span>
                                    </div>
                                </div>
                                <!--tong tien và  action-->
                                <div class="donhang-div11">
                                    <!---->
                                    <div class="donhang-div12">
                                        <p>Thành tiền: </p>
                                        <span><?php echo number_format($row['tongtien'], 0, ',', '.'); ?><small><u>đ</u></small></span>
                                    </div>
                                    <!--huy-->
                                    <div class="donhang-div13">
                                        <a class="bt-huy-donhang" href="index.php?action=HomeHuyDonHang&iddh=<?php echo $row['iddh']; ?>" onclick="return XacNhanHuy();">Hủy đơn hàng</a>
                                        <a class="bt2-donhang">Liên hệ người bán</a>
                                        <a class="bt2-donhang">Đánh giá sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!---->
                    <div class="end-1"></div>
                </div>
            </div>
        </div>

        <!--script loc don hang-->
        <script>
            //loc don
            document.addEventListener("DOMContentLoaded", function () {
                const links = document.querySelectorAll('.donhang-div1 a');

                links.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();

                        // Reset tất cả nút
                        links.forEach(l => {
                            l.style.color = 'white';
                            l.style.borderBottom = 'none';
                        });

                        // Áp dụng style cho nút được nhấn
                        this.style.color = 'orange';
                        this.style.borderBottom = "2px solid red";
                    });
                });

                //Chọn mặc định nút đầu tiên
                window.addEventListener('DOMContentLoaded', () => {
                    if (links.length > 0) {
                        links[0].style.color = 'orange';
                        links[0].style.borderBottom = "2px solid red";
                    }
                });
            });
        </script>

        <!--script yêu cầu hủy đơn hàng-->
        <script>
            //hien thi nut huy
            document.addEventListener("DOMContentLoaded", function () {
                const donHangs = document.querySelectorAll(".donhang-div3");

                donHangs.forEach(item => {
                    let btHuy = item.querySelector(".bt-huy-donhang");
                    let trangthai = item.querySelector(".trang-thai-dh").textContent.trim();
                    let ttText = item.querySelector(".donhang-div4-p2");
                    //
                    if (trangthai === "Đang xử lý" || trangthai === "Chờ xác nhận") {
                        btHuy.style.display = "flex";
                    }
                    else {
                        btHuy.style.display = "none";
                    }
                    //
                    if (trangthai == "Hoàn thành") {
                        ttText.style.backgroundColor = "green";
                        ttText.style.color = "white";
                    }
                    else if (trangthai == "Đang xử lý" || trangthai == "Chờ xác nhận") {
                        ttText.style.backgroundColor = "yellow";
                        ttText.style.color = "black";
                    }
                    else if (trangthai == "Yêu cầu hủy") {
                        ttText.style.backgroundColor = "red";
                        ttText.style.color = "white";
                    }
                    else if (trangthai == "Đang giao hàng") {
                        ttText.style.backgroundColor = "#ba2acf";
                        ttText.style.color = "white";
                    }
                    else if (trangthai == "Đã hủy") {
                        ttText.style.backgroundColor = "#4e6267";
                        ttText.style.color = "orangered";
                    }

                });
            });

            //xac nhan huy
            function XacNhanHuy() {
                return confirm("Bạn có chắc chắn muốn hủy đơn hàng này không?");
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