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
    <link rel="stylesheet" href="http://localhost:8080/BNOStore/views/Home.css" />
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

        <!--phần tìm kiếm-->
        <div class="header2">
            <!--logo-->
            <a class="a_logo" href="http://localhost:8080/BNOStore">
                <img src="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png" class="logo_img" />
            </a>
            <!--find-->
            <form class="find_header" method="post" action="index.php?action=HomeTimKiem">
                <input class="search" type="search" placeholder="Tìm kiếm sản phẩm" name="search" />
                <button type="submit" name="submit" >Tìm kiếm</button>
            </form>
        </div>


        <!--đăng nhập-->
        <!--form login-->
        <form method="post" action="index.php?action=Login" class="form_login" id="form_login">
            <!---->
            <div class="model_form_login">
                <!--nut close-->
                <span class="close">&times;</span>
                <!--logo bno store-->
                <img src="" />
                <!---->
                <h2>Đăng nhập</h2>
                <!--username-->
                <div class="">
                    <input type="text" placeholder="Tên tài khoản/Email" name="tentk" required style="width:384px;height:48px;
                       border-radius:10px;text-indent:10px;border:1.5px solid #dbd6d6;outline:none;background-color:#fafafc;
                       font-size:16px;margin-top:28px;" />
                </div>
                <!--mật khẩu-->
                <div class="">
                    <input type="password" placeholder="Mật khẩu" name="matkhau" required style="width:384px;height:48px;
                       border-radius:10px;text-indent:10px;border:1.5px solid #dbd6d6;outline:none;background-color:#fafafc;
                       font-size:16px;margin-top:23px;" />
                </div>
                <!--submit-->
                <input type="submit" name="submit" value="Đăng nhập" class="bt_submit_login" />
                <!--đăng ký, quên mật khẩu-->
                <div style="display:flex;margin:auto;width:384px;margin-top:20px;">
                    <a class="quen_mat_khau" href="">Quyên mật khẩu</a>
                    <a class="dang_ky" href="">Đăng ký</a>
                </div>

            </div>
        </form>

        <!--script mở, đóng form login-->
        <script>
            document.getElementById("bt_login").addEventListener("click", function () {
                let modal = document.getElementById("form_login");
                modal.style.display = "flex"; // Hiển thị modal ngay nhưng opacity vẫn 0
                setTimeout(() => {
                    modal.classList.add("show"); // Thêm class để chạy hiệu ứng
                }, 10); // Chờ 10ms để đảm bảo display đã cập nhật
            });

            // Đóng modal khi nhấn vào dấu "X"
            document.querySelector(".close").addEventListener("click", function () {
                let modal = document.getElementById("form_login");
                modal.classList.remove("show"); // Xóa class để chạy hiệu ứng ẩn
                setTimeout(() => {
                    modal.style.display = "none"; // Ẩn hẳn modal sau hiệu ứng
                }, 400); // Trùng với thời gian transition (0.4s)
            });

        </script>


        <!--content 1: banner ngang-->
        <div class="content1">
            <!--banner ngang 1 (banner lớn)-->
            <div class="banner_ngang1">
                <img style="width:100%;height:100%;" src="http://localhost:8080/BNOStore/views/HomeImage/image/25.jpg" />
            </div>
            <!--banner ngang 2 (2 banner nho)-->
            <div class="banner_ngang2">
                <img style="width:100%;height:190px;margin:auto;margin-top:0;" src="http://localhost:8080/BNOStore/views/HomeImage/image/24.jpg" />
                <img style="width:100%;height:190px;margin:auto;margin-bottom:0;" src="http://localhost:8080/BNOStore/views/HomeImage/image/23.jpg" />
            </div>
        </div>

        <!--content 2: danh muc san pham-->
        <!---->
        <div class="danhmuc-loaisp"> <!--category container-->
            <h2>DANH MỤC</h2>
            <div class="danhmuc"> <!--category wrapper-->
                <button class="bt left">&lt;</button> <!--scroll btn left-->
                <div class="danhmuc-slider"> <!--category slider-->
                    <?php
                    $chunks = array_chunk($vloaisp, 20); // Chia nhóm, mỗi nhóm 20 sản phẩm (10/cột x 2 dòng)
                    foreach ($chunks as $chunk) { ?>
                        <div class="trang-loaisp"> <!--category page-->
                            <?php foreach ($chunk as $row) { ?>
                                <div class="loaisp-item"> <!--category item-->
                                    <img src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                                    <p><?php echo $row['loaisp']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <button class="bt right">&gt;</button> <!--scroll bt right-->
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





        <!--footer-->
        <div class="footer">

        </div>


    </div>
</body>
</html>