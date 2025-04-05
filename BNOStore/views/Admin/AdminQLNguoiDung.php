<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <!--quan ly nguoi dung-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    <!--content-->
    <div class="content">
        <!--menu trái-->
        <div class="menu_trai menu-trai-user">
            <img class="logo-menu" src="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png" style="width: 70px; height: 70px; margin: 0; margin: auto; margin-bottom: 20px; margin-top: 10px" />
            <!---->
            <a class="bt_menu_trai" href="index.php?action=QuanLyLoaisp">Quản lý loại sản phẩm</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyTheLoai">Quản lý thể loại</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLySanPham">Quản lý sản phẩm</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyNguoiDung" style="background-color:#96440f;">Quản lý người dùng</a>
            <!----><button id="bt-themloaisp" class="menu-con">Thêm Người Dùng</button>
            <a class="bt_menu_trai" href="index.php?action=QuanLyBanHang">Quản lý bán hàng</a>
        </div>

        <!--dữ liệu-->
        <!--nguoi dung--><!--hien thi nguoi dung-->
        <div id="loaisp" class="loaisp admin-user">
            <!---->
            <div class="model_loaisp">
                <!--nut close-->
                <span class="close">&times;</span>
                <!--tim kiem loai sp-->
                <form action="index.php?action=TimKiemSanPham" method="post" class="admin-tim-kiem" id="form_search">
                    <input id="search" type="text" placeholder="Nhập họ tên người dùng cần tìm kiếm" class="input-timkiem" name="timkiem" />
                    <button class="bt-timkiem" id="bt_search" type="submit">Tìm kiếm</button>
                </form>
                <!--dữ liệu hiển thị nguoi dung-->
                <div id="show_loaisp" class="show_loaisp">
                    <!---->
                    <?php
                    foreach ($rowUser as $index => $row) { ?>
                        <div id="user_<?php echo $row['id']; ?>" class="dulieu_loaisp loaisp-item" data-page="<?php echo floor($index / 10); ?>" style="height: 380px;">
                            <img style="width:100px;height:80px;margin:auto;margin-top:4px;" src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                            <div style="display:flex;flex-direction:column;margin:auto;height:auto">
                                <p>ID: <span style="color:red"><?php echo $row['id']; ?></span></p>
                                <p title="<?php echo $row['tentk']; ?>">Tên tài khoản: <span class="kttentk" data-idtentk="<?php echo $row['id'] ?>" style="color:red"><?php echo $row['tentk']; ?></span></p>
                                <p style="display:flex;margin:auto;width:fit-content;max-width:195px;">Mật khẩu: <span style="color:red;margin:auto;margin-left:5px;height:9px;display:block;width:fit-content"><?php echo str_repeat("*", strlen($row['matkhau'])) ?></span></p>
                                <p title="<?php echo $row['hovaten']; ?>">Họ và tên: <span style="color:red;"><?php echo $row['hovaten']; ?></span></p>
                                <p title="<?php echo $row['ngaysinh']; ?>">Ngày sinh: <span style="color:red;"><?php echo $row['ngaysinh']; ?></span></p>
                                <p title="<?php echo $row['gioitinh']; ?>">Giới tính: <span style="color:red;"><?php echo $row['gioitinh']; ?></span></p>
                                <p title="<?php echo $row['diachi']; ?>">Địa chỉ: <span style="color:red;"><?php echo $row['diachi']; ?></span></p>
                                <p title="<?php echo $row['cccd']; ?>">Số CCCD: <span style="color:red;"><?php echo $row['cccd']; ?></span></p>
                                <p title="<?php echo $row['sdt']; ?>">Số điện thoại: <span style="color:red;"><?php echo $row['sdt']; ?></span></p>
                                <p title="<?php echo $row['email']; ?>">Email: <span style="color:red;"><?php echo $row['email']; ?></span></p>
                                <p title="<?php echo $row['roles']; ?>">Roles: <span style="color:red;"><?php echo $row['roles']; ?></span></p>
                            </div>
                            <div style="display:flex;margin:auto">
                                <a class="bt_xoa" href="#" data-id="<?php echo $row['id']; ?>">Xóa</a>
                                <button id="bt_sua" class="bt_sua" data-id="<?php echo $row['id']; ?>" style="border:none;cursor:pointer;">Sửa</button>
                            </div>
                        </div>
                    <?php } ?>
                    <!--ajax xử lý xóa mà không tải lại trang-->
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            document.querySelectorAll(".bt_xoa").forEach(button => {
                                button.addEventListener("click", function (e) {
                                    e.preventDefault();

                                    //kiem tra truoc khi sua
                                    let tentk = <?php echo json_encode($_SESSION['username']); ?>;
                                    // Tìm thẻ span chứa tên tài khoản trong cùng block
                                    let parentDiv = this.closest(".dulieu_loaisp");
                                    let spanTK = parentDiv.querySelector(".kttentk");
                                    let kttentk = spanTK.textContent.trim();
                                    let idtenTK = spanTK.dataset.idtentk;

                                    let dataId = this.getAttribute("data-id");
                                    let divToRemove = document.getElementById("user_" + dataId);
                                    //
                                    if (tentk == kttentk && idtenTK == dataId) {
                                        alert("Bạn đang đăng nhập bằng user này, thoát đăng nhập sau đó thực hiện lại với user khác!");
                                        return;
                                    }

                                    //
                                    if (confirm("Bạn có chắc chắn muốn xóa người dùng này?")) {
                                        fetch("index.php?action=XoaUser", {
                                            method: "POST",
                                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                            body: "id=" + dataId
                                        })
                                            .then(response => response.text())
                                            .then(result => {
                                                if (result.trim() === "success") {
                                                    divToRemove.remove(); // Xóa div hiển thị sản phẩm
                                                } else {
                                                    alert("Xóa thất bại!");
                                                }
                                            })
                                            .catch(error => console.error("Lỗi:", error));
                                    }
                                });
                            });
                        });
                    </script>

                    <!--phan trang-->
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const products = document.querySelectorAll(".loaisp-item");
                            const pagination = document.getElementById("pagination");
                            const prevBtn = document.getElementById("prev-page");
                            const nextBtn = document.getElementById("next-page");

                            const itemsPerPage = 10;
                            const totalPages = Math.ceil(products.length / itemsPerPage);
                            let currentPage = 0;

                            function showPage(page) {
                                if (page < 0 || page >= totalPages) return;

                                products.forEach(product => product.style.display = "none");

                                for (let i = page * itemsPerPage; i < (page + 1) * itemsPerPage && i < products.length; i++) {
                                    products[i].style.display = "flex";
                                }
                                document.querySelectorAll(".pagination-button").forEach((btn, index) => {
                                    btn.classList.toggle("active", index === page);
                                });
                                currentPage = page;
                            }
                            function createPagination() {
                                pagination.innerHTML = "";
                                for (let i = 0; i < totalPages; i++) {
                                    let button = document.createElement("button");
                                    button.textContent = i + 1;
                                    button.classList.add("pagination-button");
                                    if (i === 0) button.classList.add("active");

                                    button.addEventListener("click", function () {
                                        showPage(i);
                                    });
                                    pagination.appendChild(button);
                                }
                            }
                            prevBtn.addEventListener("click", () => showPage(currentPage - 1));
                            nextBtn.addEventListener("click", () => showPage(currentPage + 1));
                            createPagination();
                            showPage(0);
                        });
                    </script>
                </div>
                <!-- Phần phân trang -->
                <div id="pagination-container">
                    <button id="prev-page">❮</button>
                    <div id="pagination"></div>
                    <button id="next-page">❯</button>
                </div>
            </div>

            <!--them the loai--><!--them-->
            <!---->
            <div class="shadow" id="shadow"></div>
            <!--form them nguoi dung-->
            <form id="form-themloaisp" class="themuser" style="width:1200px;height:750px;" method="post" action="index.php?action=ThemUser" enctype="multipart/form-data">
                <span class="close close-themloaisp">&times;</span>
                <h2>Thêm Người Dùng</h2>
                <!---->
                <div class="" style="display:flex;margin:auto;margin-top:38px;margin-bottom:30px;">
                    <div class="" style="margin:auto;margin-right:60px;">
                        <!--ten tai khoan-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left: 0px;">Tên tài khoản:</label>
                            <input class="input-them them_user" id="tentk" type="text" name="tentk" placeholder="Tên tài khoản" required />
                        </div>
                        <!--mat khau-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0;">Mật khẩu:</label>
                            <input class="input-them them_user" id="matkhau" type="password" name="matkhau" placeholder="Mật khẩu" required />
                        </div>
                        <!--xac nhan mat khau-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0;">Xác nhận mật khẩu:</label>
                            <input class="input-them them_user" id="xacnhanmatkhau" type="password" name="xacnhanmatkhau" placeholder="Xác nhận mât khẩu" required />
                        </div>
                        <!--ho va ten-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0;">Họ và tên:</label>
                            <input class="input-them them_user" id="hovaten" type="text" name="hovaten" placeholder="Họ và tên" required />
                        </div>
                        <!--ngay sinh-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0;">Ngày sinh:</label>
                            <input class="input-them them_user" id="ngaysinh" type="date" name="ngaysinh" placeholder="Ngày sinh" required />
                        </div>
                        <!--gioi tinh-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0px;">Giới tính:</label>
                            <select name="gioitinh" class="input-them them_user" style="font-size:13.2px;width:254px; height:34px;">
                                <option value="">-- Chọn giới tính --</option>
                                <option>Nam</option>
                                <option>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <!---->
                    <div style="margin:auto;margin-left:60px;">
                        <!--dia chi-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto;margin-left:0;">Địa chỉ:</label>
                            <input class="input-them them_user" id="diachi" type="text" name="diachi" placeholder="Địa chỉ" required />
                        </div>
                        <!--so cccd-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left: 0;">Số CCCD/CMT:</label>
                            <input class="input-them them_user" id="cccd" type="text" name="cccd" placeholder="Số căn cước công dân/Chứng minh thư" required />
                        </div>
                        <!--sdt-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0px;">Số điện thoại:</label>
                            <input class="input-them them_user" id="sdt" type="number" name="sdt" placeholder="Số điện thoại" required />
                        </div>
                        <!--Email-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0px;">Email:</label>
                            <input class="input-them them_user" id="email" type="text" name="email" placeholder="Email" required />
                        </div>
                        <!--Roles-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0px;">Roles:</label>
                            <select name="roles" class="input-them them_user" style="font-size:13.2px;width:254px; height:34px;" required>
                                <option value="">-- Chọn roles --</option>
                                <option>Admin</option>
                                <option>User</option>
                                <option>Shipper</option>
                                <option>Kế toán</option>
                                <option>Nhân viên kho</option>
                            </select>
                        </div>
                        <!--anh-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left: 0px;">Hình ảnh:</label>
                            <input id="file-select" type="file" name="anh" style="width:253px;margin-right:0;" />
                        </div>
                    </div>
                </div>

                <!---->
                <input id="bt-submit" class="bt-them" type="submit" name="submit" value="Thêm" />
            </form>

            <!--scrip kiem tra truoc khi submit-->
            <script>
                document.querySelector(".themuser").addEventListener("submit", function (event) {
                    let matkhau = document.getElementById("matkhau").value.trim();
                    let xacnhanmk = document.getElementById("xacnhanmatkhau").value.trim();


                    if (matkhau != xacnhanmk) {
                        event.preventDefault(); // Ngăn không cho form submit
                        alert("Mật khẩu xác nhận không chính xác!");
                    }

                    //gui ajax de kiem tra trung ten

                });
            </script>

            <!--form sua --><!--sua-->
            <form id="form-sualoaisp" class="themuser suauser" style="width:1200px;height:750px;" method="post" action="index.php?action=SuaUser" enctype="multipart/form-data">
                <span class="close close-sualoaisp">&times;</span>
                <h2>Cập Nhật Người Dùng</h2>
                <!---->
                <div class="" style="display:flex;margin:auto;margin-top:38px;margin-bottom:30px;">
                    <div class="" style="margin:auto;margin-right:60px;">
                        <!--id-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left: 0px;">ID:</label>
                            <input class="input-them them_user" id="id-sua" type="text" name="id" placeholder="ID" required readonly style="color:red" />
                        </div>
                        <!--ten tai khoan-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left: 0px;">Tên tài khoản:</label>
                            <input class="input-them them_user" id="tentk-sua" type="text" name="tentk" placeholder="Tên tài khoản" required readonly style="color:red" />
                        </div>
                        <!--mat khau-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0;">Mật khẩu:</label>
                            <input class="input-them them_user" id="matkhau-sua" type="password" name="matkhau" placeholder="Mật khẩu" required />
                        </div>
                        <!--xac nhan mat khau-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0;">Xác nhận mật khẩu:</label>
                            <input class="input-them them_user" id="xacnhanmatkhau-sua" type="password" name="xacnhanmatkhau" placeholder="Xác nhận mât khẩu" required />
                        </div>
                        <!--ho va ten-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0;">Họ và tên:</label>
                            <input class="input-them them_user" id="hovaten-sua" type="text" name="hovaten" placeholder="Họ và tên" required />
                        </div>
                        <!--ngay sinh-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0;">Ngày sinh:</label>
                            <input class="input-them them_user" id="ngaysinh-sua" type="date" name="ngaysinh" placeholder="Ngày sinh" required />
                        </div>
                        <!--gioi tinh-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0px;">Giới tính:</label>
                            <select name="gioitinh" class="input-them them_user" style="font-size:13.2px;width:254px; height:34px;" id="gioitinh-sua">
                                <option value="">-- Chọn giới tính --</option>
                                <option>Nam</option>
                                <option>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <!---->
                    <div style="margin:auto;margin-left:60px;margin-top:0;">
                        <!--dia chi-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto;margin-left:0;">Địa chỉ:</label>
                            <input class="input-them them_user" id="diachi-sua" type="text" name="diachi" placeholder="Địa chỉ" required />
                        </div>
                        <!--so cccd-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left: 0;">Số CCCD/CMT:</label>
                            <input class="input-them them_user" id="cccd-sua" type="text" name="cccd" placeholder="Số căn cước công dân/Chứng minh thư" required />
                        </div>
                        <!--sdt-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0px;">Số điện thoại:</label>
                            <input class="input-them them_user" id="sdt-sua" type="number" name="sdt" placeholder="Số điện thoại" required />
                        </div>
                        <!--Email-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0px;">Email:</label>
                            <input class="input-them them_user" id="email-sua" type="text" name="email" placeholder="Email" required readonly style="color:red" />
                        </div>
                        <!--Roles-->
                        <div class="container-themloaisp container-themuser">
                            <label style="margin: auto; margin-left:0px;">Roles:</label>
                            <input class="input-them them_user" id="roles-sua" type="text" name="roles" placeholder="Roles" required readonly style="color:red" />
                        </div>
                        <!--anh-->
                        <div class="container-themloaisp container-themuser" style="height:150px">
                            <label style="margin: auto; margin-left: 0px;">Hình ảnh:</label>
                            <input id="file-select-sua" type="file" name="anh" style="display:none;" />
                            <div class="div-sua-chon-anh" style="display:flex;flex-direction:column;">
                                <img id="preview-anh" src="" />
                                <button id="bt-chon-anh" type="button">Chọn ảnh</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!---->
                <input id="bt-submit" class="bt-submit-sua" type="submit" name="submit" value="Cập nhật" />
            </form>

            <!--ajax sửa loaisp-->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    document.querySelectorAll(".bt_sua").forEach(button => {
                        button.addEventListener("click", function (e) {
                            e.preventDefault();

                            let dataId = this.getAttribute("data-id");
                            //gui ajax de lay du lieu loaisp
                            fetch("index.php?action=getIdUser&id=" + dataId)
                                .then(response => response.json())
                                .then(result => {
                                    if (result.success) {
                                        let data = result.data;
                                        document.getElementById("id-sua").value = data.id;
                                        document.getElementById("tentk-sua").value = data.tentk;
                                        document.getElementById("matkhau-sua").value = data.matkhau;
                                        document.getElementById("xacnhanmatkhau-sua").value = data.matkhau;
                                        document.getElementById("hovaten-sua").value = data.hovaten;
                                        document.getElementById("ngaysinh-sua").value = data.ngaysinh;
                                        document.getElementById("gioitinh-sua").value = data.gioitinh;
                                        document.getElementById("diachi-sua").value = data.diachi;
                                        document.getElementById("cccd-sua").value = data.cccd;
                                        document.getElementById("sdt-sua").value = data.sdt;
                                        document.getElementById("email-sua").value = data.email;
                                        document.getElementById("roles-sua").value = data.roles;
                                        //hien thị ảnh
                                        let imgPreview = document.getElementById("preview-anh");
                                        imgPreview.src = data.anh;
                                        imgPreview.style.display = "block"; // Hiển thị nếu đang ẩn

                                    } else {
                                        alert("Lỗi khi tải dữ liệu!");
                                    }
                                });

                            //mo form
                            let modal = document.getElementById("form-sualoaisp");
                            let modal2 = document.getElementById("shadow");
                            modal.style.display = "flex";
                            modal2.style.display = "flex";
                            setTimeout(() => {
                                modal.classList.add("show");
                                modal2.classList.add("show");
                            }, 1);
                            //
                        });
                    });

                    // submit sửa user bằng ajax
                    document.getElementById("form-sualoaisp").addEventListener("submit", function (e) {
                        //kiem tra truoc khi sua
                        let matkhau = document.getElementById("matkhau-sua").value.trim();
                        let xacnhanmk = document.getElementById("xacnhanmatkhau-sua").value.trim();
                        if (matkhau != xacnhanmk) {
                            e.preventDefault(); // Ngăn không cho form submit
                            alert("Mật khẩu xác nhận không chính xác!");
                            return;
                        }

                        let formdata = new FormData(this);
                        if (confirm("Xác nhận cập nhật người dùng này?")) {
                            //update
                            fetch("index.php?action=SuaUser", {
                                method: "POST",
                                //headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                body: formdata
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert("cập nhật thành công!");
                                    } else {
                                        e.preventDefault();
                                        alert("có lỗi xảy ra!");
                                    }
                                })
                                .catch(error => console.error("Lỗi:", error));
                        }
                    });
                });

                //script chọn ảnh
                document.addEventListener("DOMContentLoaded", function () {
                    //chon anh
                    let fileInput = document.getElementById("file-select-sua");
                    let btnChonAnh = document.getElementById("bt-chon-anh");
                    let imgPreview = document.getElementById("preview-anh");

                    // Khi nhấn nút "Chọn ảnh", mở file input
                    btnChonAnh.addEventListener("click", function () {
                        setTimeout(() => fileInput.click(), 0);
                    });

                    // Khi chọn ảnh, hiển thị ảnh lên preview
                    fileInput.addEventListener("change", function (event) {
                        let file = event.target.files[0];
                        if (file) {
                            let reader = new FileReader();
                            reader.onload = function (e) {
                                imgPreview.src = e.target.result;
                                imgPreview.style.display = "block"; // Hiển thị ảnh
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                });
            </script>


        </div>
    </div>

    <!--script mở, đóng form loaisp-->
    <script>
        // Đóng modal khi nhấn vào dấu "X"
        document.querySelector(".close").addEventListener("click", function () {
            let modal = document.getElementById("loaisp");
            modal.classList.remove("show"); // Xóa class để chạy hiệu ứng ẩn
            setTimeout(() => {
                modal.style.display = "none"; // Ẩn hẳn modal sau hiệu ứng
                document.getElementById("bt-themloaisp").style.display = "none";
            }, 0); // Trùng với thời gian transition (0.4s)
        });

        //mở form thêm sản phẩm
        document.getElementById("bt-themloaisp").addEventListener("click", function () {
            let modal = document.getElementById("form-themloaisp");
            let modal2 = document.getElementById("shadow");
            modal.style.display = "flex"; // Hiển thị modal ngay nhưng opacity vẫn 0
            modal2.style.display = "flex"; // Hiển thị modal ngay nhưng opacity vẫn 0
            setTimeout(() => {
                modal.classList.add("show"); // Thêm class để chạy hiệu ứng
                modal2.classList.add("show"); // Thêm class để chạy hiệu ứng
            }, 1); // Chờ 10ms để đảm bảo display đã cập nhật
        });

        // Đóng form them loai sp khi nhấn vào dấu "X"
        document.querySelector(".close-themloaisp").addEventListener("click", function () {
            let modal = document.getElementById("form-themloaisp");
            modal.classList.remove("show"); // Xóa class để chạy hiệu ứng ẩn
            setTimeout(() => {
                modal.style.display = "none"; // Ẩn hẳn modal sau hiệu ứng
                document.getElementById("shadow").style.display = "none";
            }, 0); // Trùng với thời gian transition (0.4s)
        });

        // Đóng form sua loaisp khi nhấn vào dấu "X"
        document.querySelector(".close-sualoaisp").addEventListener("click", function () {
            let modal = document.getElementById("form-sualoaisp");
            modal.classList.remove("show");
            const fileInput = document.getElementById('file-select-sua');
            fileInput.value = ''; // Xoá file đã chọn
            setTimeout(() => {
                modal.style.display = "none";
                document.getElementById("shadow").style.display = "none";
            }, 0);
        });
    </script>
</body>
</html>