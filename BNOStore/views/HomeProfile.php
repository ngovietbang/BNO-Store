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
                        <a class="profile-trai-div4" href="index.php?action=HomeProfile&id=<?php echo $_SESSION['id'] ?? ''; ?>" style="color:#ff0000;" >
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/user.png" />
                            <span>Tài khoản của tôi</span>
                        </a>
                        <!--ho so-->
                        <button type="button" class="bt-profile-trai" id="bt-hoso">Hồ sơ</button>
                        <!--dia chi-->
                        <button type="button" class="bt-profile-trai" id="bt-dc">Địa chỉ</button>
                        <!--doi mat khau-->
                        <button type="button" class="bt-profile-trai" id="bt-dmk">Đổi mật khẩu</button>
                    </div>
                    <!--don hang-->
                    <div class="profile-trai-div3">
                        <a class="profile-trai-div4" href="index.php?action=HomeOrder&id=<?php echo $_SESSION['id'] ?? ''; ?>">
                            <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/order.png" />
                            <span>Đơn hàng</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--profile phai-->
            <div class="profile-phai">
                <!--div hoso-->
                <form class="profile-phai-div1" id="div-hoso" method="post" enctype="multipart/form-data" action="index.php?action=HomeUpdateUser&id=<?php echo $_SESSION['id']; ?>">
                    <h1>Hồ sơ của tôi</h1>
                    <!---->
                    <div class="profile-phai-div2">
                        <!---->
                        <?php
                        foreach ($rowUser as $row) { ?>
                            <!--phan trai thong tin-->
                            <div class="profile-phai-div3">
                                <!--tentk-->
                                <div class="profile-phai-div4">
                                    <p>Tên tài khoản:</p>
                                    <span><?php echo $row['tentk']; ?></span>
                                </div>
                                <!--ho va ten-->
                                <div class="profile-phai-div4">
                                    <p>Họ và tên:</p>
                                    <input class="profile-phai-div4-input" type="text" name="hovaten" value="<?php echo $row['hovaten']; ?>" required placeholder="Nhập họ và tên" />
                                </div>
                                <!--ngay sinh-->
                                <div class="profile-phai-div4">
                                    <p>Ngày sinh:</p>
                                    <input class="profile-phai-div4-input" type="date" name="ngaysinh" value="<?php echo $row['ngaysinh']; ?>" required />
                                </div>
                                <!--gioi tinh-->
                                <div class="profile-phai-div4">
                                    <p>Giới tính:</p>
                                    <div class="profile-phai-div5">
                                        <label>
                                            <input type="radio" name="gioitinh"
                                                <?php if ($row['gioitinh'] == "Nam")
                                                    echo "checked"; ?> /> Nam
                                        </label>
                                        <label>
                                            <input type="radio" name="gioitinh"
                                                <?php if ($row['gioitinh'] == "Nữ")
                                                    echo "checked"; ?> /> Nữ
                                        </label>
                                        <label>
                                            <input type="radio" name="gioitinh"
                                                <?php if ($row['gioitinh'] == "Khác" || $row['gioitinh'] == '')
                                                    echo "checked"; ?> /> Khác
                                        </label>
                                    </div>
                                </div>
                                <!--so dt-->
                                <div class="profile-phai-div4">
                                    <p>Số điện thoại:</p>
                                    <input class="profile-phai-div4-input" type="number" name="sdt" value="<?php echo $row['sdt']; ?>" required placeholder="Nhập số điện thoại" />
                                </div>
                                <!--email-->
                                <div class="profile-phai-div4">
                                    <p>Email:</p>
                                    <input class="profile-phai-div4-input" type="text" name="email" value="<?php echo $row['email']; ?>" placeholder="Email" />
                                </div>

                            </div>
                            <!--phan phai anh-->
                            <div class="profile-phai-div6">
                                <img src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" id="preview-anh" data-src-goc="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                                <input id="input-file-anh" type="file" name="anh" />
                                <label for="input-file-anh">Chọn ảnh</label>
                            </div>
                            <!--script hien thi anh-->
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const input = document.getElementById('input-file-anh');
                                    const img = document.getElementById('preview-anh');

                                    if (!input || !img) return;

                                    input.addEventListener('change', e => {
                                        const file = e.target.files[0];
                                        if (file) {
                                            const reader = new FileReader();
                                            reader.onload = ev => (img.src = ev.target.result);
                                            reader.readAsDataURL(file);
                                        }
                                    });

                                    input.closest('form')?.addEventListener('reset', () => {
                                        setTimeout(() => (img.src = img.dataset.srcGoc), 0);
                                    });
                                });
                            </script>

                        <?php } ?>
                    </div>
                    <!--submit-->
                    <input type="submit" name="submit" class="bt-capnhat" value="Cập nhật" />
                </form>
                <!--div dia chi-->
                <form class="profile-phai-div1" id="div-diachi" method="post" action="index.php?action=HomeUpdateDiachi&id=<?php echo $_SESSION['id'] ?? ''; ?>">
                    <h1>Địa chỉ của tôi</h1>
                    <!---->
                    <div class="profile-phai-div2">
                        <?php
                        foreach ($rowUser as $row) { ?>
                            <!--phan trai thong tin-->
                            <div class="profile-phai-div7">
                                <!--dia chi-->
                                <div class="profile-phai-div8">
                                    <p>Địa chỉ <span class="small-p">* Đây là địa chỉ nhận hàng của bạn, hãy kiểm tra chính xác thông tin</span></p>
                                    <div class="profile-phai-div9">
                                        <span><?php echo $row['hovaten']; ?></span>
                                        <span>(+84) <?php echo $row['sdt']; ?></span>
                                    </div>
                                    <input type="text" name="diachi" value="<?php echo $row['diachi'] ?>" required placeholder="Nhập địa chỉ" />
                                </div>
                                <!---->
                                <div class="icon-macdinh">Mặc định</div>
                            </div>
                        <?php } ?>
                    </div>
                    <!--submit-->
                    <input type="submit" name="submit" class="bt-capnhat" value="Cập nhật" />
                </form>
                <!--div doi mat khau-->
                <form class="profile-phai-div1" id="div-doimatkhau" method="post" action="index.php?action=HomeUpdateMatKhau&id=<?php echo $_SESSION['id'] ?? ''; ?>">
                    <h1>Đổi mật khẩu</h1>
                    <!---->
                    <div class="profile-phai-div10">
                        <!---->
                        <div class="profile-phai-div11">
                            <p>Mật khẩu:</p>
                            <input type="password" name="matkhau" placeholder="Nhập mật khẩu ban đầu" required />
                        </div>
                        <!---->
                        <div class="profile-phai-div11">
                            <p class="">Mật khẩu mới:</p>
                            <input type="password" name="matkhaumoi" placeholder="Nhập mật khẩu mới" required />
                        </div>
                        <!---->
                        <div class="profile-phai-div11">
                            <p class="">Xác nhận mật khẩu:</p>
                            <input type="password" name="xacnhanmatkhau" placeholder="Xác nhận mật khẩu mới" required />
                        </div>
                    </div>
                    <!--submit-->
                    <input type="submit" name="submit" class="bt-capnhat" value="Đổi mật khẩu" style="width:110px;"/>
                </form>
            </div>
        </div>
        <!--script chuyen doi cac menu-->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                //
                let bt1 = document.getElementById("bt-hoso");
                bt1.style.color = "#ffa827";
                let bt2 = document.getElementById("bt-dc");
                let bt3 = document.getElementById("bt-dmk");
                //
                let div1 = document.getElementById("div-hoso");
                let div2 = document.getElementById("div-diachi");
                let div3 = document.getElementById("div-doimatkhau");
                //hoso
                bt1.addEventListener("click", function () {
                    div1.style.display = "flex";
                    div2.style.display = "none";
                    div3.style.display = "none";
                    //
                    bt1.style.color = "#ffa827";
                    bt2.style.color = "#aeaeae";
                    bt3.style.color = "#aeaeae";
                    //
                    div2.reset();
                    div3.reset();
                });
                //dia chi
                bt2.addEventListener("click", function () {
                    div2.style.display = "flex";
                    div1.style.display = "none";
                    div3.style.display = "none";
                    //
                    bt2.style.color = "#ffa827";
                    bt1.style.color = "#aeaeae";
                    bt3.style.color = "#aeaeae";
                    //
                    div1.reset();
                    div3.reset();
                });
                //doi mk
                bt3.addEventListener("click", function () {
                    div3.style.display = "flex";
                    div1.style.display = "none";
                    div2.style.display = "none";
                    //
                    bt3.style.color = "#ffa827";
                    bt1.style.color = "#aeaeae";
                    bt2.style.color = "#aeaeae";
                    //
                    div1.reset();
                    div2.reset();
                });
            });
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