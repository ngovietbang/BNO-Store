<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <!--quan ly san pham-->
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
        <div class="menu_trai">
            <img class="logo-menu" src="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png" style="width: 70px; height: 70px; margin: 0; margin: auto; margin-bottom: 20px; margin-top: 10px" />
            <!---->
            <a class="bt_menu_trai" href="index.php?action=QuanLyLoaisp">Quản lý loại sản phẩm</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyTheLoai">Quản lý thể loại</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLySanPham" style="background-color:#96440f;">Quản lý sản phẩm</a>
            <!----><button id="bt-themloaisp" class="menu-con">Thêm sản phẩm</button>
            <a class="bt_menu_trai" href="index.php?action=QuanLyNguoiDung">Quản lý người dùng</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyBanHang">Quản lý bán hàng</a>
        </div>

        <!--dữ liệu-->
        <!--loaisp--><!--hien thi loai sp-->
        <div id="loaisp" class="loaisp">
            <!---->
            <div class="model_loaisp">
                <!--nut close-->
                <span class="close">&times;</span>
                <!--tim kiem loai sp-->
                <form action="index.php?action=TimKiemSanPham" method="post" class="admin-tim-kiem" id="form_search">
                    <input id="search" type="text" placeholder="Nhập sản phẩm cần tìm kiếm" class="input-timkiem" name="timkiemtensp" />
                    <button class="bt-timkiem" id="bt_search" type="submit">Tìm kiếm</button>
                </form>
                <!--dữ liệu hiển thị loại sp-->
                <div id="show_loaisp" class="show_loaisp">
                    <!---->
                    <?php
                    foreach ($rowSanPham as $index => $row) { ?>
                        <div id="sanpham_<?php echo $row['idsp']; ?>" class="dulieu_loaisp loaisp-item" data-page="<?php echo floor($index / 10); ?>" style="height: 259px;">
                            <img style="width:100px;height:80px;margin:auto;margin-top:4px;" src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                            <div style="display:flex;flex-direction:column;margin:auto;height:auto">
                                <p>ID: <span style="color:red"><?php echo $row['idsp']; ?></span></p>
                                <p title="<?php echo $row['loaisp']; ?>">Loại sản phẩm: <span style="color:red"><?php echo $row['loaisp']; ?></span></p>
                                <p title="<?php echo $row['tentheloai']; ?>">Tên thể loại: <span style="color:red;"><?php echo $row['tentheloai']; ?></span></p>
                                <p title="<?php echo htmlspecialchars($row['tensp']); ?>">Tên sản phẩm: <span style="color:red;"><?php echo $row['tensp']; ?></span></p>
                                <p title="<?php echo $row['giaban']; ?>">Giá bán: <span style="color:red;"><?php echo $row['giaban']; ?> VND</span></p>
                                <p title="<?php echo $row['soluong']; ?>">Số lượng: <span style="color:red;"><?php echo $row['soluong']; ?></span></p>
                            </div>
                            <div style="display:flex;margin:auto">
                                <a class="bt_xoa" href="#" data-id="<?php echo $row['idsp']; ?>">Xóa</a>
                                <button id="bt_sua" class="bt_sua" data-id="<?php echo $row['idsp']; ?>" style="border:none;cursor:pointer;">Sửa</button>
                            </div>
                        </div>
                    <?php } ?>
                    <!--ajax xử lý xóa mà không tải lại trang-->
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            document.querySelectorAll(".bt_xoa").forEach(button => {
                                button.addEventListener("click", function (e) {
                                    e.preventDefault();

                                    let dataId = this.getAttribute("data-id");
                                    let divToRemove = document.getElementById("sanpham_" + dataId);

                                    if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                                        fetch("index.php?action=XoaSanPham", {
                                            method: "POST",
                                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                            body: "idsp=" + dataId
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
            <!---->
            <form id="form-themloaisp" class="themsp" method="post" action="index.php?action=ThemSanPham" enctype="multipart/form-data">
                <span class="close close-themloaisp">&times;</span>
                <h2>Thêm Sản Phẩm</h2>
                <!--loaisp-->
                <div class="container-themloaisp">
                    <label style="margin:auto;margin-left:20px;">Loại sản phẩm:</label>
                    <select name="loaisp" id="loaisp-h" class="input-them" style="font-size:13.2px;width:254px; height:34px;" required>
                        <option value="">-- Chọn loại sản phẩm --</option>
                        <?php
                        foreach ($vloaisp as $row2) { ?>
                            <option><?php echo $row2['loaisp'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!--ten the loai-->
                <div class="container-themloaisp">
                    <label style="margin: auto; margin-left: 20px;">Tên thể loại:</label>
                    <select name="tentheloai" id="theloai-h" class="input-them" style="font-size:13.2px;width:254px; height:34px;" required>
                        <option value="">-- Chọn thể loại --</option>
                    </select>
                </div>
                <!--ten sp-->
                <div class="container-themloaisp">
                    <label style="margin: auto; margin-left: 20px;">Tên sản phẩm:</label>
                    <input class="input-them" id="tensp" type="text" name="tensp" placeholder="Tên sản phẩm" required />
                </div>
                <!--gia ban-->
                <div class="container-themloaisp">
                    <label style="margin: auto; margin-left: 20px;">Giá bán:</label>
                    <input class="input-them" id="giaban" type="number" name="giaban" placeholder="Giá bán" required />
                </div>
                <!--so luong-->
                <div class="container-themloaisp">
                    <label style="margin: auto; margin-left: 20px;">Số lượng:</label>
                    <input class="input-them" id="soluong" type="number" name="soluong" placeholder="Số lượng" required />
                </div>
                <!--anh-->
                <div class="container-themloaisp">
                    <label style="margin: auto; margin-left: 20px;">Hình ảnh:</label>
                    <input id="file-select" type="file" name="anh" />
                </div>

                <!---->
                <input id="bt-submit" class="bt-them" type="submit" name="submit" value="Thêm" />
            </form>

            <!--scrip hien thi the loai theo loai sp-->
            <script>
                document.getElementById("loaisp-h").addEventListener("change", function () {
                    let loaisp = this.value;
                    // Xóa danh sách thể loại cũ
                    let theLoaiSelect = document.getElementById("theloai-h");
                    theLoaiSelect.innerHTML = '<option value="">-- Chọn thể loại --</option>';

                    if (loaisp) {
                        fetch("index.php?action=HienThiTheLoaiTheoLoaisp&loaisp=" + loaisp)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    data.theloai.forEach(theloai => {
                                        let option = document.createElement("option");
                                        option.textContent = theloai.tentheloai;
                                        theLoaiSelect.appendChild(option);
                                    });
                                }
                            })
                            .catch(error => console.error("Lỗi:", error));
                    }
                });
            </script>

            <!--scrip kiem tra truoc khi submit-->
            <script>
                document.querySelector(".themsp").addEventListener("submit", function (event) {
                    let loaisp = document.getElementById("loaisp-h").value.trim();
                    let theloai = document.getElementById("theloai-h").value.trim();
                    let tensanpham = document.getElementById("tensp").value.trim();
                    let soluong = document.getElementById("soluong").value;
                    let giaban = document.getElementById("giaban").value;

                    if (loaisp === "" || theloai === "" || tensanpham === "" || soluong === "" || giaban === "") {
                        event.preventDefault(); // Ngăn không cho form submit
                        alert("Vui lòng điền đầy đủ thông tin!");
                    }

                    //gui ajax de kiem tra trung ten

                });
            </script>

            <!--form sua --><!--sua-->
            <form id="form-sualoaisp" method="post" action="index.php?action=SuaSanPham" enctype="multipart/form-data">
                <span class="close close-sualoaisp">&times;</span>
                <h2>Sửa Sản Phẩm</h2>
                <!--id-->
                <div class="container-sualoaisp">
                    <label style="margin:auto;margin-left:20px;">ID:</label>
                    <input id="idsp-sua" class="input-loaisp" type="text" name="idsp" required style="color:red;" readonly />
                </div>
                <!--loai sp-->
                <div class="container-sualoaisp">
                    <label style="margin:auto;margin-left:20px;">Loại sản phẩm:</label>
                    <input id="loaisp-sua" class="input-loaisp" type="text" name="loaisp" required readonly style="color:red;" />
                </div>
                <!--the loai-->
                <div class="container-sualoaisp">
                    <label style="margin:auto;margin-left:20px;">Thể loại:</label>
                    <input id="tentheloai-sua" class="input-loaisp" type="text" name="tentheloai" required readonly style="color:red;"/>
                </div>
                <!--ten san pham-->
                <div class="container-sualoaisp">
                    <label style="margin: auto; margin-left: 20px;">Tên sản phẩm:</label>
                    <input id="tensp-sua" class="input-loaisp" type="text" name="tensp" placeholder="Tên sản phẩm" required />
                </div>
                <!--gia ban-->
                <div class="container-sualoaisp">
                    <label style="margin: auto; margin-left: 20px;">Giá bán:</label>
                    <input id="giaban-sua" class="input-loaisp" type="number" name="giaban" placeholder="Giá bán" required />
                </div>
                <!--so luong-->
                <div class="container-sualoaisp">
                    <label style="margin: auto; margin-left: 20px;">Số lượng:</label>
                    <input id="soluong-sua" class="input-loaisp" type="number" name="soluong" placeholder="Số lượng" required />
                </div>
                <!--anh-->
                <div class="container-sualoaisp" style="height:150px">
                    <label style="margin: auto; margin-left: 20px;">Hình ảnh:</label>
                    <input id="file-select-sua" type="file" name="anh" style="display:none;" />
                    <div class="div-sua-chon-anh" style="display:flex;flex-direction:column;">
                        <img id="preview-anh" src="" />
                        <button id="bt-chon-anh" type="button">Chọn ảnh</button>
                    </div>
                </div>                
                <!---->
                <input id="bt-submit" class="bt-submit-sua" type="submit" name="submit" value="Sửa" />
            </form>

            <!--ajax sửa loaisp-->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    document.querySelectorAll(".bt_sua").forEach(button => {
                        button.addEventListener("click", function (e) {
                            e.preventDefault();

                            let dataId = this.getAttribute("data-id");
                            //gui ajax de lay du lieu loaisp
                            fetch("index.php?action=getIdSanPham&idsp=" + dataId)
                                .then(response => response.json())
                                .then(result => {
                                    if (result.success) {
                                        let data = result.data;
                                        document.getElementById("idsp-sua").value = data.idsp;
                                        document.getElementById("loaisp-sua").value = data.loaisp;
                                        document.getElementById("tentheloai-sua").value = data.tentheloai;
                                        document.getElementById("tensp-sua").value = data.tensp;
                                        document.getElementById("soluong-sua").value = data.soluong;
                                        document.getElementById("giaban-sua").value = data.giaban;
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

                    // submit mo form sửa loại sản phẩm bằng ajax
                    document.getElementById("form-sualoaisp").addEventListener("submit", function (e) {
                        let formdata = new FormData(this);
                        if (confirm("Xác nhận cập nhật sản phẩm này?")) {
                            //update
                            fetch("index.php?action=SuaSanPham", {
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

    <!--script mở, đóng form-->
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
            setTimeout(() => {
                modal.style.display = "none";
                document.getElementById("shadow").style.display = "none";
            }, 0);
        });
    </script>
</body>
</html>