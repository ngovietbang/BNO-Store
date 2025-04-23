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
?>
<!DOCTYPE html>
<html>
<head>
    <!--chi tiet sp-->
    <meta charset="UTF-8" />
    <title>BNO Store</title>
    <link rel="icon" href="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png" />
    <link rel="stylesheet" href="http://localhost:8080/BNOStore/views/Home.css?v=<?php echo time(); ?>" />
    <!--reload trang-->
    <script>
        window.addEventListener("pageshow", function (event) {
            if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
                // Ép reload lại trang
                window.location.reload();
            }
        });
    </script>
</head>
<body>

    <!---->
    <div class="khung" id="khung">
        <!--header-->
        <div class="header">
            <!--menu header-->
            <div class="menu_header">
                <a class="a_menu_header" href="http://localhost:8080/BNOStore">Trang chủ</a>
                <a class="a_menu_header" href="">Tin tức</a>
                <a class="a_menu_header" href="">Sản phẩm</a>
                <a class="a_menu_header" href="">Kết nối</a>
                <a class="a_menu_header" id="head-taikhoan" href="index.php?action=HomeProfile&id=<?php echo $_SESSION['id'] ?? ''; ?>" style="display:none;">Tài khoản</a>
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
            <form class="find_header" method="get" action="index.php">
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


        <!--đăng nhập-->
        <!--form login-->
        <form method="post" action="index.php?action=Login" class="form_login" id="form_login">
            <!---->
            <div class="model_form_login">
                <!--nut close-->
                <span class="close">&times;</span>
                <!--logo bno store-->
                <div class="logo-dangnhap">
                    <img class="" src="http://localhost:8080/BNOStore/views/HomeImage/icon/logoweb2.png" />
                </div>
                <!---->
                <h2>Đăng nhập</h2>
                <!--username-->
                <div class="">
                    <input class="input-dangnhap" type="text" placeholder="Tên tài khoản/Email" name="tentk" required />
                </div>
                <!--mật khẩu-->
                <div class="">
                    <input class="input-dangnhap" type="password" placeholder="Mật khẩu" name="matkhau" required />
                </div>
                <!--submit-->
                <input type="submit" name="submit" value="Đăng nhập" class="bt_submit_login" />
                <!--url-->
                <input type="hidden" name="redirect_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                <!--đăng ký, quên mật khẩu-->
                <div style="display:flex;margin:auto;width:384px;margin-top:20px;">
                    <a class="quen_mat_khau" href="">Quyên mật khẩu</a>
                    <a id="dang-ky" class="dang_ky">Đăng ký</a>
                </div>
                <!---->
                <div class="text-phuong-thuc-dn">Phương thức đăng nhập khác</div>
                <!--cac phuong thuc dang nhap khac-->
                <div class="third-login">
                    <!--google-->
                    <div class="item-third-login google"></div>
                    <!--apple-->
                    <div class="item-third-login apple"></div>
                    <!--facebook-->
                    <div class="item-third-login facebook"></div>
                    <!--twitter-->
                    <div class="item-third-login twitter"></div>
                </div>
            </div>
        </form>

        <!--script mo form dang ky-->
        <script>
            document.querySelector("#dang-ky").addEventListener("click", function () {
                let modal1 = document.getElementById("form-register");
                modal1.style.display = "flex"; // Hiển thị modal ngay nhưng opacity vẫn 0
                let modal2 = document.getElementById("form_login");
                modal2.classList.remove("show"); // Xóa class để chạy hiệu ứng ẩn
                setTimeout(() => {
                    modal1.classList.add("show"); // Thêm class để chạy hiệu ứng
                }, 10); // Chờ 10ms để đảm bảo display đã cập nhật
                setTimeout(() => {
                    modal2.style.display = "none"; // Ẩn hẳn modal sau hiệu ứng
                }, 400); // Trùng với thời gian transition (0.4s)
            });

        </script>

        <!--đăng ký-->
        <!--form register-->
        <form method="post" action="index.php?action=DangKy" class="form_login form_register" id="form-register" enctype="multipart/form-data">
            <!---->
            <div class="model_form_login" style="height:700px;">
                <!--nut close-->
                <span class="close close-register">&times;</span>
                <!--logo bno store-->
                <div class="logo-dangnhap">
                    <img class="" src="http://localhost:8080/BNOStore/views/HomeImage/icon/logoweb2.png" />
                </div>
                <!---->
                <h2>Đăng Ký</h2>
                <!--div relative-->
                <div class="dk-relative">
                    <!--div1 tk va mat khau-->
                    <div class="dangky-div1" id="dk-1">
                        <!--username-->
                        <div class="">
                            <input class="input-dangnhap" type="text" placeholder="Tên tài khoản/Email" name="tentk" required />
                        </div>
                        <!--mật khẩu-->
                        <div class="">
                            <input class="input-dangnhap" type="password" placeholder="Mật khẩu" name="matkhau" required />
                        </div>
                        <!--xác nhận mật khẩu-->
                        <div class="">
                            <input class="input-dangnhap" type="password" placeholder="Xác nhận mật khẩu" name="xacnhanmatkhau" required />
                        </div>
                        <!--submit-->
                        <!--<input type="submit" name="submit" value="Đăng Ký" class="bt_submit_login" id="bt-dang-ky" />-->
                        <button id="bt-next-1" class="bt_submit_login bt-next-1" type="button">Đăng ký</button>
                    </div>
                    <!--div ho va ten, ngay sinh, gioi tinh-->
                    <div class="dangky-div1" id="dk-2">
                        <!--ho va ten-->
                        <div class="">
                            <input class="input-dangnhap" type="text" placeholder="Họ và tên" name="hovaten" required />
                        </div>
                        <!--ngay sinh-->
                        <div class="">
                            <input class="input-dangnhap" type="date" placeholder="Ngày sinh" name="ngaysinh" required />
                        </div>
                        <!--gioi tinh-->
                        <div class="">
                            <select class="input-dangnhap" name="gioitinh">
                                <option value="">--Chọn giới tính--</option>
                                <option>Nam</option>
                                <option>Nữ</option>
                            </select>
                        </div>
                        <!---->
                        <div class="dk-2-bt">
                            <button id="bt-pre-2" class="bt_submit_login bt-pre bt-pre-2" type="button">Quay lại</button>
                            <button id="bt-next-2" class="bt_submit_login bt-next bt-next-2" type="button">Tiếp theo</button>
                        </div>
                    </div>
                    <!--dia chi, sdt, anh-->
                    <div class="dangky-div1" id="dk-3">
                        <!--dia chi-->
                        <div class="">
                            <input class="input-dangnhap" type="text" placeholder="Địa chỉ" name="diachi" required />
                        </div>
                        <!--sdt-->
                        <div class="">
                            <input class="input-dangnhap" type="number" placeholder="Số điện thoại" name="sdt" required />
                        </div>
                        <!--anh-->
                        <div class="">
                            <input type="file" id="file-select-dk" name="anh" />
                        </div>
                        <!---->
                        <div class="dk-2-bt">
                            <button id="bt-pre-3" class="bt_submit_login bt-pre" type="button">Quay lại</button>
                            <input id="bt-next-3" class="bt_submit_login bt-next" type="submit" name="submit" value="Đăng ký" />
                        </div>
                    </div>
                </div>

                <!--đã có tk -> dng nhap-->
                <div style="display:flex;margin:auto;width:384px;margin-top:20px;">
                    <p class="" style="margin: auto; margin-right: 4px;">Đã có tài khoản? </p>
                    <a class="dang_ky" id="bt-dang-nhap" style="margin: auto; margin-left: 4px;">Đăng Nhập</a>
                </div>
                <!---->
                <div class="text-phuong-thuc-dn">Phương thức đăng nhập khác</div>
                <!--cac phuong thuc dang nhap khac-->
                <div class="third-login">
                    <!--google-->
                    <div class="item-third-login google"></div>
                    <!--apple-->
                    <div class="item-third-login apple"></div>
                    <!--facebook-->
                    <div class="item-third-login facebook"></div>
                    <!--twitter-->
                    <div class="item-third-login twitter"></div>
                </div>
            </div>
        </form>

        <!--script chuyen dien thong tin tiep theo-->
        <script>
            //click div 1
            document.querySelectorAll('.bt-next-1').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    const form = button.closest('div'); // Tìm form gần nhất chứa nút
                    if (!form) return; // Nếu không tìm thấy form thì dừng

                    const inputs = form.querySelectorAll('input[required]');
                    let isValid = true;

                    inputs.forEach(function (field) {
                        if (field.value.trim() === '') {
                            field.style.border = "1px solid red"; // đặt border cho từng field
                            isValid = false;

                        } else {
                            field.style.border = ""; // reset border nếu đúng
                        }
                    });

                    if (isValid) {
                        // Nếu hợp lệ thì chuyển sang dk-2
                        let modal = document.getElementById("dk-2");
                        modal.style.display = "flex";
                        modal.classList.add("show");

                        let modal2 = document.getElementById("dk-1");
                        modal2.classList.remove("show");
                        modal2.style.display = "none";
                    }

                });
            });
            //div2 click
            //quay lai 2
            document.getElementById('bt-pre-2').addEventListener('click', function () {
                //
                let modal = document.getElementById("dk-1");
                modal.style.display = "flex";
                modal.classList.add("show");
                //an
                let modal2 = document.getElementById("dk-2");
                modal2.classList.remove("show");
                modal2.style.display = "none";
            });
            //next 2
            document.querySelectorAll('.bt-next-2').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    const form = button.closest('#dk-2'); // Tìm form gần nhất chứa nút
                    if (!form) return; // Nếu không tìm thấy form thì dừng

                    const inputs = form.querySelectorAll('input[required]');
                    let isValid = true;

                    inputs.forEach(function (field) {
                        if (field.value.trim() === '') {
                            field.style.border = "1px solid red"; // đặt border cho từng field
                            isValid = false;

                        } else {
                            field.style.border = ""; // reset border nếu đúng
                        }
                    });

                    if (isValid) {
                        let modal = document.getElementById("dk-3");
                        modal.style.display = "flex";
                        modal.classList.add("show");
                        //an
                        let modal2 = document.getElementById("dk-2");
                        modal2.classList.remove("show");
                        modal2.style.display = "none";
                    }
                });
            });

            //div3 click
            document.getElementById('bt-pre-3').addEventListener('click', function () {
                //
                let modal = document.getElementById("dk-2");
                modal.style.display = "flex";
                modal.classList.add("show");
                //an
                let modal2 = document.getElementById("dk-3");
                modal2.classList.remove("show");
                modal2.style.display = "none";
            });

            //
        </script>

        <!--script chuyen form dang nhap-->
        <script>
            document.getElementById("bt-dang-nhap").addEventListener("click", function () {
                let modal = document.getElementById("form_login");
                modal.style.display = "flex";
                setTimeout(() => {
                    modal.classList.add("show");
                }, 10);
                //dong form register
                let modal2 = document.getElementById("form-register");
                modal2.classList.remove("show");
                setTimeout(() => {
                    modal2.style.display = "none";
                }, 400);
                //reset
                document.getElementById("form-register").reset();
                //hien
                let dk1 = document.getElementById("dk-1");
                dk1.style.display = "flex";
                dk1.classList.add("show");
                //an
                let dk2 = document.getElementById("dk-2");
                dk2.classList.remove("show");
                dk2.style.display = "none";
                //
                let dk3 = document.getElementById("dk-3");
                dk3.classList.remove("show");
                dk3.style.display = "none";
                //
                let inputs = document.querySelectorAll('input[required]');
                inputs.forEach(function (input) {
                    input.style.border = ""; // Reset lại nếu hợp lệ
                });

            });
        </script>

        <!--script mở, đóng form login-->
        <script>
            //
            const btlogin = document.getElementById("bt_login");
            if (btlogin) {
                document.getElementById("bt_login").addEventListener("click", function () {
                    let modal = document.getElementById("form_login");
                    modal.style.display = "flex"; // Hiển thị modal ngay nhưng opacity vẫn 0
                    setTimeout(() => {
                        modal.classList.add("show"); // Thêm class để chạy hiệu ứng
                    }, 10); // Chờ 10ms để đảm bảo display đã cập nhật
                });
            }
            //document.getElementById("bt_login").addEventListener("click", function () {
            //    let modal = document.getElementById("form_login");
            //    modal.style.display = "flex"; // Hiển thị modal ngay nhưng opacity vẫn 0
            //    setTimeout(() => {
            //        modal.classList.add("show"); // Thêm class để chạy hiệu ứng
            //    }, 10); // Chờ 10ms để đảm bảo display đã cập nhật
            //});

            // Đóng modal khi nhấn vào dấu "X"
            document.querySelector(".close").addEventListener("click", function () {
                let modal = document.getElementById("form_login");
                modal.classList.remove("show"); // Xóa class để chạy hiệu ứng ẩn
                setTimeout(() => {
                    modal.style.display = "none"; // Ẩn hẳn modal sau hiệu ứng
                }, 400); // Trùng với thời gian transition (0.4s)
            });

            // Đóng dang ky khi nhấn vào dấu "X"
            document.querySelector(".close-register").addEventListener("click", function () {
                let modal = document.getElementById("form-register");
                modal.classList.remove("show"); // Xóa class để chạy hiệu ứng ẩn
                setTimeout(() => {
                    modal.style.display = "none"; // Ẩn hẳn modal sau hiệu ứng
                }, 400); // Trùng với thời gian transition (0.4s)
                //reset
                document.getElementById("form-register").reset();
                //hien
                let dk1 = document.getElementById("dk-1");
                dk1.style.display = "flex";
                dk1.classList.add("show");
                //an
                let dk2 = document.getElementById("dk-2");
                dk2.classList.remove("show");
                dk2.style.display = "none";
                //
                let dk3 = document.getElementById("dk-3");
                dk3.classList.remove("show");
                dk3.style.display = "none";
                //
                let inputs = document.querySelectorAll('input[required]');
                inputs.forEach(function (input) {
                    input.style.border = ""; // Reset lại nếu hợp lệ
                });
            });
        </script>
        <!--thong bao-->
        <div class="thongbao" id="thongbao">
            <p class="head-thongbao">Message</p>
            <p id="thongbao-text"></p>
        </div>
        <div class="model-thongbao" id="model-thongbao"></div>

        <!--script thuc hien dang ky-->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById("form-register").addEventListener("submit", function (event) {
                    event.preventDefault(); // Ngừng việc gửi form mặc định

                    var formData = new FormData(this); // Lấy dữ liệu từ form

                    fetch("index.php?action=DangKy", {
                        method: "POST",
                        body: formData
                    })
                        .then(response => response.json()) // Chuyển đổi phản hồi thành JSON
                        .then(data => {
                            if (data.status === "success") {
                                // Hiển thị thông báo thành công
                                document.getElementById("thongbao").style.display = "flex";
                                document.getElementById("model-thongbao").style.display = "flex";
                                document.getElementById("thongbao-text").textContent = "Đăng ký tài khoản thành công!";

                                // Sau 3 giây, chuyển hướng người dùng
                                setTimeout(function () {
                                    window.location.href = "http://localhost:8080/BNOStore/index.php"; // Thay đổi URL chuyển hướng
                                }, 2000); // Chờ 3 giây trước khi chuyển hướng
                            }
                            else {
                                console.error('Lỗi: '); // In thông báo lỗi nếu có
                            }
                        })
                        .catch(function (error) {
                            console.error('Lỗi khi gửi yêu cầu:', error);
                        });
                });
            });
        </script>

        <!--hien thi chi tiet san pham-->
        <div class="home-chitiet-sp" id="home-chi-tiet-sp">
            <!---->
            <div class="chitiet-head"></div>
            <!--grid-->
            <div class="chitiet-div1" id="chitiet-sp">
                <?php
                foreach ($rowSanPham as $row) { ?>
                    <!--item-->
                    <div class="chitiet-div2">
                        <!--anh -->
                        <div class="chitiet-div3">
                            <img src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                        </div>
                        <!---->
                        <div class="chitiet-div4">
                            <p class="ct-p1"><u>Mall</u><?php echo $row['tensp']; ?></p>
                            <p class="ct-p2" id="giaban"><small><u>đ</u></small><?php echo $row['giaban']; ?></p>
                            <!--Vận chuyển-->
                            <div class="vanchuyen">
                                <label>Giao hàng tiêu chuẩn</label>
                                <p><small><u>đ</u></small>25000</p>
                            </div>
                            <!--phien ban-->
                            <div class="phienban">
                                <label>Phiên bản</label>
                                <div class="pb">
                                    <button type="button" class="pb-bt">Bản đặc biệt</button>
                                    <button type="button" class="pb-bt">Bản thường</button>
                                </div>
                            </div>
                            <!--so luong-->
                            <div class="soluong">
                                <label>Số lượng</label>
                                <input type="number" value="1" id="soluong" />
                                <p>Còn lại <?php echo $row['soluong']; ?> sản phẩm </p>
                            </div>
                            <!---->
                            <div class="mua">
                                <button type="button" class="them-gio-hang">Thêm vào giỏ</button>
                                <button type="button" class="mua-ngay" id="bt-mua">Mua ngay</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!--mota-->
            <div class="mota">
                <!---->
                <div class="chitiet-head head-mota"></div>
                <!---->
                <div class="mota-div1">
                    <h1>Mô tả sản phẩm</h1>
                    <!---->
                    <?php
                    foreach ($rowSanPham as $row) { ?>
                        <div class="mota-div2">
                            <p>Truyện tranh</p>
                            <p>Mã serial: 8000000000000</p>
                            <p>Tác giả: </p>
                            <p>Dịch giả:</p>
                            <p>Giá bìa:</p>
                            <p>Loại bìa:</p>
                            <p>Khổ sách:</p>
                            <p>Số trang:</p>
                            <p>Quà tặng:</p>
                            <p>Sách có màng co</p>
                            <p>Loại sản phẩm: <?php echo $row['loaisp'] ?></p>
                            <p>Thể loại: <?php echo $row['tentheloai'] ?></p>
                            <p>Đối tượng:</p>
                            <p>Nhà xuất bản: </p>
                            <p>Năm xuất bản: 2025</p>
                            <p>Số tập: </p>
                            <p>Giới thiệu nội dung: </p>
                        </div>
                        <!--anh-->
                        <div class="mota-div2 mota-div2-img">
                            <p>Ảnh bìa: </p>
                            <img src="http://localhost:8080/BNOStore/<?php echo $row['anh'] ?>" />
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--end sp-->
            <div class="end-chitiet"></div>
        </div>

        <!--mua san pham-->
        <!--form mua san pham----------------------------------------------------------------------------------------------------->
        <form class="form-mua-sp" id="form-mua-sp" method="post" action="index.php?action=DatHang">
            <!--start-->
            <div class="chitiet-head head-mua"></div>
            <!--thong tin chi tiet-->
            <div class="mua-chitiet">
                <!-- chi tiet trai-->
                <div class="mua-chitiet-left">
                    <!--dia chi va ten nguoi nhan-->
                    <?php
                    $user = new User();
                    $tentk = $_SESSION['tentk'];
                    $rowUser = $user->GetUser($tentk);
                    foreach ($rowUser as $row) { ?>
                        <!-- dia chi giao hang-->
                        <div class="mua-chitiet-left-div1">
                            <!--iduser-->
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" /><!-- POST: id user ********************************************************-->
                            <!---->
                            <label class="mua-chitiet-left-div1-label">Địa chỉ giao hàng</label>
                            <!---->
                            <div class="mua-chitiet-left-div2">
                                <input class="mua-chitiet-left-div2-input" type="text" name="hovaten" value="<?php echo $row['hovaten']; ?>" readonly /><!-- POST: hovaten *********************-->
                                <input class="mua-chitiet-left-div2-input" type="text" name="sdt" value="<?php echo $row['sdt']; ?>" readonly style="margin-left:10px;" /><!-- POST: sdt *******-->
                            </div>
                            <!---->
                            <div class="mua-chitiet-left-div2" style="margin-bottom:20px;">
                                <label class="icon-nharieng">Nhà riêng</label>
                                <input class="mua-chitiet-left-div2-input nha-rieng" type="text" name="diachi" value="<?php echo $row['diachi'] ?>" readonly /><!-- POST: dia chi giao hang*******-->
                            </div>
                        </div>
                        <!--phuong thuc van chuyen-->
                        <div class="mua-chitiet-left-div1" style="margin-top:25px;">
                            <!--tùy chọn giao hàng-->
                            <label class="mua-chitiet-left-div1-label">Tùy chọn giao hàng</label>
                            <!---->
                            <div class="tuy-chon-giao-hang-div1">
                                <!---->
                                <label class="tuy-chon-giao-hang">
                                    <input class="radio-tuychon-giaohang" type="radio" name="tuychongiaohang" checked value="25000" /><!-- POST: phivanchuyen ********************************************************-->
                                    <!---->
                                    <span class="tuy-chon-giao-hang-1">
                                        <span class="tuy-chon-giao-hang-2">
                                            <span class="tuy-chon-giao-hang-2-span1"><small><u>đ</u></small> 25000</span>
                                            <span class="tuy-chon-giao-hang-2-span2">Giao hàng tiêu chuẩn</span>
                                        </span>
                                        <!---->
                                        <span class="tuy-chon-giao-hang-2">
                                            <span class="tuy-chon-giao-hang-2-span3">Đảm bảo nhận hàng vào <span id="ngaydat-span1"></span></span>
                                        </span>
                                    </span>
                                </label>
                                <!---->
                                <label class="tuy-chon-giao-hang">
                                    <input class="radio-tuychon-giaohang" type="radio" name="tuychongiaohang" value="35000" /><!-- POST: phivanchuyen ********************************************************-->
                                    <!---->
                                    <span class="tuy-chon-giao-hang-1">
                                        <span class="tuy-chon-giao-hang-2">
                                            <span class="tuy-chon-giao-hang-2-span1"><small><u>đ</u></small> 35000</span>
                                            <span class="tuy-chon-giao-hang-2-span2">Giao hàng siêu tốc</span>
                                        </span>
                                        <!---->
                                        <span class="tuy-chon-giao-hang-2">
                                            <span class="tuy-chon-giao-hang-2-span3">Đảm bảo nhận hàng vào <span id="ngaydat-span2"></span></span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    <?php } ?>
                    <!--chi tiet san pham mua-->
                    <div class="mua-chitiet-left-div1" style="margin-top:25px;">
                        <label class="mua-chitiet-left-div1-label">Thông tin chi tiết</label>
                        <?php
                        foreach ($rowSanPham as $row) { ?>
                            <!--id san pham-->
                            <input type="hidden" name="idsp" value="<?php echo $row['idsp']; ?>" /><!-- POST: idsp ********************************************************-->
                            <!---->
                            <div class="mua-chitiet-left-sp" style="margin-top:25px">
                                <img src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                                <div class="mua-chitiet-left-sp-div1">
                                    <p id="chitiet-tensp"><?php echo $row['tensp'] ?></p>
                                    <input type="hidden" name="tensp" value="<?php echo htmlspecialchars($row['tensp'], ENT_QUOTES, 'UTF-8'); ?>" /> <!-- POST: tensp ********************************************************-->
                                    <p id="chitiet-giaban"><small><u>đ</u></small><?php echo $row['giaban']; ?></p>
                                    <input type="hidden" name="giaban" value="<?php echo $row['giaban']; ?>" /> <!-- POST: giaban ********************************************************-->
                                </div>
                            </div>
                            <!--div 2-->
                            <div class="mua-chitiet-left-sp2">
                                <p id="">Số lượng mua: <span id="soluong-mua"></span></p>
                                <input type="hidden" name="soluongmua" value="" id="post-soluong-mua" /><!-- POST: soluongmua ********************************************************-->
                            </div>
                        <?php } ?>
                    </div>
                    <!--scrip so luong mua-->
                    <script>
                        document.getElementById('bt-mua').addEventListener('click', function () {
                            let soluongmua = document.getElementById('soluong').value;
                            document.getElementById('soluong-mua').textContent = soluongmua;
                            document.getElementById('post-soluong-mua').value = soluongmua;
                        });
                    </script>
                </div>
                <!--chi tiet phai-->
                <div class="mua-chitiet-right">
                    <!--phuong thuc thanh toan-->
                    <div class="mua-chitiet-right-div1">
                        <h4>Phương thức thanh toán</h4>
                        <!--thanh toan khi nhan hang-->
                        <label class="mua-chitiet-right-div1-label" style="margin-top:25px;">
                            <span style="display:flex"><img src="http://localhost:8080/BNOStore/views/HomeImage/icon/cash.jpg" /> Thanh toán khi nhận hàng</span>
                            <input type="radio" checked name="phuongthucthanhtoan" value="Thanh toán khi nhận hàng" /><!-- POST: phuongthucthanhtoan ********************************************************-->
                            <span id="end-span1">Thanh toán khi nhận hàng</span>
                        </label>
                        <!--thanh toan online-->
                        <label class="mua-chitiet-right-div1-label" style="margin-bottom:20px;">
                            <span style="display:flex"><img src="http://localhost:8080/BNOStore/views/HomeImage/icon/cash.png" /> Ví momo</span>
                            <input type="radio" name="phuongthucthanhtoan" value="Ví momo" /><!-- POST: phuong thuc thanh toan ********************************************************-->
                            <span id="end-span1">Liên kết ví momo</span>
                        </label>
                    </div>
                    <!--tong tien-->
                    <div class="mua-chitiet-right-div1" style="margin-top:25px;">
                        <h4>Thông tin đơn hàng</h4>
                        <!---->
                        <div class="mua-chitiet-right-div2" style="margin-top:29px;">
                            <p>Tạm tính (<span id="tam-tinh"></span> sản phẩm)</p>
                            <div class="tong-tien">
                                <small><u>đ</u></small>
                                <p id="tong-tien-sl"></p>
                            </div>
                        </div>
                        <!---->
                        <div class="mua-chitiet-right-div2">
                            <p>Phí vận chuyển</p>
                            <div class="tong-tien">
                                <small><u>đ</u></small>
                                <p id="tong-tien-vc"></p>
                            </div>
                        </div>
                        <!---->
                        <div class="mua-chitiet-right-div2" style="border-top:1px solid #808080;margin-top:30px;display:flex">
                            <p id="text-tong-cong">Tổng cộng: </p>
                            <input class="input-tongtien" type="text" name="tongtien" id="tongtien" value="" readonly /><!-- POST: tong tien ********************************************************-->
                            <small id="tongtien-d"><u>đ</u></small>
                        </div>
                    </div>

                    <!--scrip cho ngay lap-->
                    <input type="hidden" name="ngaylap" id="ngaylap-input" /><!-- POST: ngaylap ********************************************************-->
                    <script>
                        //
                        document.addEventListener("DOMContentLoaded", function () {
                            const today3 = new Date();
                            const yyyyToday3 = today3.getFullYear();
                            const mmToday3 = String(today3.getMonth() + 1).padStart(2, '0');
                            const ddToday3 = String(today3.getDate()).padStart(2, '0');
                            const ngaydathang1 = `${yyyyToday3}-${mmToday3}-${ddToday3}`;

                            document.getElementById('ngaylap-input').value = ngaydathang1;
                        });
                    </script>

                    <!--script cho tong tien***-->
                    <!--scrip so luong mua-->
                    <script>
                        document.getElementById('bt-mua').addEventListener('click', function () {
                            //so luong mua
                            let soluongmua = document.getElementById('soluong').value;
                            document.getElementById('tam-tinh').textContent = soluongmua;
                            //gia ban
                            let giaban = document.getElementById('giaban').textContent;
                            giaban = giaban.replace(/[^\d.]/g, ''); // loại bỏ ký tự không phải số
                            document.getElementById('tong-tien-sl').textContent = parseInt(giaban) * parseInt(soluongmua);
                            //
                            updatePhiVanChuyen();
                        });
                        //
                        // Lấy tất cả radio có name="tuychongiaohang"
                        let radios = document.querySelectorAll('input[name="tuychongiaohang"]');
                        let phivanchuyen = 0;
                        // Hàm cập nhật phí vận chuyển
                        function updatePhiVanChuyen() {
                            let tiensoluong = document.getElementById('tong-tien-sl').textContent;
                            let selected = document.querySelector('input[name="tuychongiaohang"]:checked');
                            if (selected) {
                                phivanchuyen = parseInt(selected.value);
                                document.getElementById('tong-tien-vc').textContent = phivanchuyen;

                                // tính lại tổng tiền
                                let giatri = parseInt(tiensoluong) + parseInt(phivanchuyen);
                                let format = giatri.toLocaleString('vi-VN'); // hoặc 'en-US'
                                document.getElementById('tongtien').value = format;
                            }
                        }
                        // Gắn sự kiện change cho từng radio
                        radios.forEach(function (radio) {
                            radio.addEventListener('change', updatePhiVanChuyen);
                        });
                        // Gọi ngay khi trang load để hiển thị giá trị mặc định
                        window.addEventListener('DOMContentLoaded', updatePhiVanChuyen);

                    </script>

                </div>
            </div>


            <!--bt-->
            <div class="mua-div-end">
                <button class="mua-div-end-bt-huy" type="button" id="bt-mua-huy">Quay lại</button>
                <button class="mua-div-end-bt-mua" type="submit" name="submitDathang" id="bt-mua-xac-nhan">Đặt hàng</button>
            </div>
            <!--end sp-->
            <div class="end-chitiet"></div>
        </form>

        <!--script lay ngay hien tai-->
        <script>
            window.onload = function () {
                // Biến 1: Ngày hiện tại
                const today = new Date();
                const yyyyToday = today.getFullYear();
                const mmToday = String(today.getMonth() + 1).padStart(2, '0');
                const ddToday = String(today.getDate()).padStart(2, '0');
                const ngaydathang = `${yyyyToday}-${mmToday}-${ddToday}`;

                // Biến 2: Ngày hiện tại + 2
                const future = new Date(today); // Tạo bản sao để không làm thay đổi today
                future.setDate(future.getDate() + 2);
                const yyyyFuture = future.getFullYear();
                const mmFuture = String(future.getMonth() + 1).padStart(2, '0');
                const ddFuture = String(future.getDate()).padStart(2, '0');
                const ngaydukien = `${yyyyFuture}-${mmFuture}-${ddFuture}`;

                // Biến 3: Ngày hiện tại + 3
                const future2 = new Date(today); // Tạo bản sao để không làm thay đổi today
                future2.setDate(future2.getDate() + 3);
                const yyyyFuture2 = future2.getFullYear();
                const mmFuture2 = String(future2.getMonth() + 1).padStart(2, '0');
                const ddFuture2 = String(future2.getDate()).padStart(2, '0');
                const ngaydukien2 = `${yyyyFuture2}-${mmFuture2}-${ddFuture2}`;

                // Gán vào input
                //document.getElementById('ngaydat-span1').textContent = ngaydukien2;
                //document.getElementById('ngaydat-span2').textContent = ngaydukien;
                //
                const span1 = document.getElementById("ngaydat-span1");
                const span2 = document.getElementById("ngaydat-span2");
                if (span1) {
                    span1.textContent = ngaydukien2;
                }
                if (span2) {
                    span2.textContent = ngaydukien;
                }
            }
        </script>


        <!--script mua san pham -------------------------------------------------------------------------------------------><!--important-->
        <script>
            //
            document.getElementById('bt-mua').addEventListener('click', function () {
                //neu chua dang nhap
                let $username = <?php echo isset($_SESSION['username']) ? '"' . $_SESSION['username'] . '"' : '""'; ?>;
                //
                if ($username == '') {
                    //
                    let modal = document.getElementById("form_login");
                    modal.style.display = "flex";
                    setTimeout(() => {
                        modal.classList.add("show");
                    }, 10);
                }
                else {
                    let modal1 = document.getElementById("form-mua-sp");
                    modal1.style.display = "flex";

                    let modal2 = document.getElementById("home-chi-tiet-sp");
                    modal2.style.display = "none";
                }
                //di chuyển đến div
                const target = document.getElementById("khung");
                target.scrollIntoView({ behavior: 'smooth' }); // Cuộn mượt
            });
            //hủy mua
            document.getElementById('bt-mua-huy').addEventListener('click', function () {
                //
                let modal1 = document.getElementById("form-mua-sp");
                modal1.reset();
                modal1.style.display = "none";

                let modal2 = document.getElementById("home-chi-tiet-sp");
                modal2.style.display = "flex";
                //
                //di chuyển đến div
                const target = document.getElementById("khung");
                target.scrollIntoView({ behavior: 'smooth' }); // Cuộn mượt
            });
            //

        </script>

        <!-- xác nhận trước khi đặt hàng **************************************************************************-->
        <!-- Hộp thoại xác nhận -->
        <!-- Hộp xác nhận -->
        <div id="confirmBox" style="display:none">
            <div class="confirm-dialog">
                <p class="confirm-text">Bạn có chắc chắn muốn đặt hàng?</p>
                <div class="confirm-buttons">
                    <button id="confirmYes" class="btn btn-yes">Xác nhận</button>
                    <button id="confirmNo" class="btn btn-no">Hủy</button>
                </div>
            </div>
        </div>
        <!-- Js-->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById("form-mua-sp");
                const confirmBox = document.getElementById("confirmBox");
                const confirmYes = document.getElementById("confirmYes");
                const confirmNo = document.getElementById("confirmNo");

                let confirmed = false;

                form.addEventListener("submit", function (e) {
                    if (!confirmed) {
                        e.preventDefault();
                        confirmBox.style.display = "flex";
                    }
                });

                confirmYes.addEventListener("click", function () {
                    confirmBox.style.display = "none";
                    confirmed = true;
                    form.submit();
                });

                confirmNo.addEventListener("click", function () {
                    confirmBox.style.display = "none";
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