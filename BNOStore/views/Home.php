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
    <meta charset="UTF-8" />
    <title>BNO Store</title>
    <link rel="icon" href="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png" />
    <link rel="stylesheet" href="http://localhost:8080/BNOStore/views/Home.css?v=<?php echo time(); ?>" />
</head>
<body>
    <!--khung-->
    <div class="khung">

        <!--header-->
        <div class="header">
            <!--menu header-->
            <div class="menu_header">
                <a class="a_menu_header" href="http://localhost:8080/BNOStore">Trang chủ</a>
                <a class="a_menu_header" href="">Tin tức</a>
                <a class="a_menu_header" href="">Sản phẩm</a>
                <a class="a_menu_header" href="">Kết nối</a>
                <a class="a_menu_header" id="head-taikhoan" href="index.php?action=HomeProfile&id=<?php echo $_SESSION['id'] ?? ''; ?>" style="display:none" >Tài khoản</a>
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
                <input class="search" type="text" placeholder="Tìm kiếm sản phẩm" name="keyword" value="" />
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


        <!--content 1: banner ngang-->
        <div class="content1">
            <!--banner ngang 1 (banner lớn)-->
            <div class="banner_ngang1">
                <img style="width:100%;height:100%;" src="http://localhost:8080/BNOStore/views/HomeImage/image/s1.jpg" />
                <img style="width:100%;height:100%;" src="http://localhost:8080/BNOStore/views/HomeImage/image/s2.jpg" />
            </div>
            <!--banner ngang 2 (2 banner nho)-->
            <div class="banner_ngang2">
                <div class="banner_ngang2_div1">
                    <img style="width:100%;height:190px;margin:auto;margin-top:0;" src="http://localhost:8080/BNOStore/views/HomeImage/image/s3.jpg" />
                    <img style="width:100%;height:190px;margin:auto;margin-bottom:0;" src="http://localhost:8080/BNOStore/views/HomeImage/image/s4.jpg" />
                </div>
                <div class="banner_ngang2_div1">
                    <img style="width:100%;height:190px;margin:auto;margin-top:0;" src="http://localhost:8080/BNOStore/views/HomeImage/image/s5.jpg" />
                    <img style="width:100%;height:190px;margin:auto;margin-bottom:0;" src="http://localhost:8080/BNOStore/views/HomeImage/image/s6.jpg" />
                </div>
            </div>
        </div>

        <!--content 2: danh muc san pham-->
        <!---->
        <div class="danhmuc-loaisp">
            <!--category container-->
            <h2>DANH MỤC</h2>
            <div class="danhmuc">
                <!--category wrapper-->
                <button class="bt left">&#10094;</button><!--scroll btn left-->
                <div class="danhmuc-slider">
                    <!--category slider-->
                    <?php
                    $chunks = array_chunk($vloaisp, 20); // Chia nhóm, mỗi nhóm 20 sản phẩm (10/cột x 2 dòng)
                    foreach ($chunks as $chunk) { ?>
                        <div class="trang-loaisp">
                            <!--category page-->
                            <?php foreach ($chunk as $row) { ?>
                                <a class="loaisp-item" href="index.php?action=HomeTimKiemSp&keyword=<?php echo $row['loaisp']; ?>">
                                    <!--category item-->
                                    <img class="img-loaisp-item" src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                                    <p title="<?php echo $row['loaisp']; ?>" class="text-loaisp-item"><?php echo $row['loaisp']; ?></p>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <button class="bt right">&#10095;</button><!--scroll bt right-->
            </div>
        </div>
        <!--script dành cho hiển thị loại sản phẩm theo trang, chỉ hiển thị 2 dòng và mỗi dòng 10 loaisp-->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const categorySlider = document.querySelector(".danhmuc-slider");
                const leftBtn = document.querySelector(".bt.left");
                const rightBtn = document.querySelector(".bt.right");
                const pages = document.querySelectorAll(".trang-loaisp");
                let index = 0;

                // Ẩn nút trái khi mới vào trang
                leftBtn.style.display = "none";

                rightBtn.addEventListener("click", () => {
                    if (index < pages.length - 1) {
                        index++;
                        categorySlider.style.transform = `translateX(-${index * 100}%)`;

                        // Hiển thị nút trái khi nhấn phải
                        leftBtn.style.display = "block";
                    }
                    // Nếu đến trang cuối, ẩn nút phải
                    if (index === pages.length - 1) {
                        rightBtn.style.display = "none";
                    }
                });

                leftBtn.addEventListener("click", () => {
                    if (index > 0) {
                        index--;
                        categorySlider.style.transform = `translateX(-${index * 100}%)`;

                        // Hiển thị nút phải khi nhấn trái
                        rightBtn.style.display = "block";
                    }
                    // Nếu quay lại trang đầu, ẩn nút trái
                    if (index === 0) {
                        leftBtn.style.display = "none";
                    }
                });
            });
        </script>


        <!--hien thi san pham-->
        <div class="home-hien-thi-sp">
            <h1>Gợi ý hôm nay</h1>
            <!--grid-->
            <div class="sp-div1">
                <?php
                foreach ($rowSanPham as $row) { ?>
                    <!--item-->
                    <a class="sp-div2" href="index.php?action=ChiTietSp&idsp=<?php echo $row['idsp']; ?>">
                        <img src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                        <span class="p1" title="<?php echo htmlspecialchars($row['tensp']); ?>"><?php echo $row['tensp'] ?></span>
                        <span class="p2" title="<?php echo htmlspecialchars($row['giaban']); ?>"><small><u>đ</u></small><?php echo $row['giaban'] ?></span>
                    </a>
                <?php } ?>
            </div>
            <!--end sp-->
            <div class="end-sp"></div>
        </div>



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