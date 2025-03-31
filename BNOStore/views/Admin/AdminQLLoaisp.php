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
            <!----><button id="bt-themloaisp" class="menu-con">Thêm loại sản phẩm</button>
            <a class="bt_menu_trai" href="">Quản lý thể loại</a>
            <a class="bt_menu_trai" href="">Quản lý sản phẩm</a>
            <a class="bt_menu_trai" href="">Quản lý người dùng</a>
            <a class="bt_menu_trai" href="">Quản lý bán hàng</a>
        </div>

        <!--dữ liệu-->
        <!--loaisp--><!--hien thi loai sp-->
        <div id="loaisp" class="loaisp">
            <!---->
            <div class="model_loaisp">
                <!--nut close-->
                <span class="close">&times;</span>
                <!--dữ liệu hiển thị loại sp-->
                <div id="show_loaisp" class="show_loaisp">
                    <!---->
                    <?php
                    foreach ($vloaisp as $index => $row) { ?>
                        <div id="loaisp_<?php echo $row['idLoaisp']; ?>" class="dulieu_loaisp loaisp-item" data-page="<?php echo floor($index / 10); ?>">
                            <img style="width:100px;height:80px;margin:auto;margin-top:4px;" src="http://localhost:8080/BNOStore/<?php echo $row['anh']; ?>" />
                            <div style="display:flex;flex-direction:column;margin:auto;height:auto">
                                <p style="margin:0;margin:auto;margin-top:3px;">ID: <span style="color:red"><?php echo $row['idLoaisp']; ?></span></p>
                                <p style="margin: 0; margin: auto; margin-top: 3px;">Loại Sản phẩm: <span style="color:red"><?php echo $row['loaisp']; ?></span></p>
                                <p style="margin: 0; margin: auto; margin-top: 3px;">Ghi chú: <span style="color:red;"><?php echo $row['ghichu']; ?></span></p>
                            </div>
                            <div style="display:flex;margin:auto">
                                <a class="bt_xoa" href="#" data-id="<?php echo $row['idLoaisp']; ?>">Xóa</a>
                                <button id="bt_sua" class="bt_sua" data-id="<?php echo $row['idLoaisp']; ?>" style="border:none;cursor:pointer;">Sửa</button>
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
                                    let divToRemove = document.getElementById("loaisp_" + dataId);

                                    if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                                        fetch("index.php?action=DeleteLoaisp", {
                                            method: "POST",
                                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
                                            body: "idLoaisp=" + dataId
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

            <!--them loaisp--><!--them-->
            <!---->
            <div class="shadow" id="shadow"></div>
            <!---->
            <form id="form-themloaisp" method="post" action="index.php?action=ThemLoaisp" enctype="multipart/form-data">
                <span class="close close-themloaisp">&times;</span>
                <h2>Thêm loại sản phẩm</h2>
                <!--loaisp-->
                <div class="container-themloaisp">
                    <label style="margin:auto;margin-left:20px;">Tên loại sản phẩm:</label>
                    <input type="text" name="loaisp" required style="width:250px;height:30px;border:1px solid #00ffff;margin:auto;
                           margin-right:20px;background-color:#443a3a;outline:none;color:white;border-radius:7px;text-indent:5px;"
                        placeholder="Nhập tên loại sản phẩm" />
                </div>
                <!--anh-->
                <div class="container-themloaisp">
                    <label style="margin: auto; margin-left: 20px;">Hình ảnh:</label>
                    <input id="file-select" type="file" name="anh" />
                </div>
                <!--ghi chu-->
                <div class="container-themloaisp">
                    <label style="margin: auto; margin-left: 20px;">Ghi chú:</label>
                    <input type="text" name="ghichu" style="width:250px;height:30px;border:1px solid #00ffff;margin:auto;
                           margin-right:20px;background-color:#443a3a;outline:none;color:white;border-radius:7px;text-indent:5px;"
                        placeholder="Ghi chú" />
                </div>
                <!---->
                <input id="bt-submit" class="bt-them" type="submit" name="submit" value="Thêm" />
            </form>

            <!--form sua san pham--><!--sua-->
            <form id="form-sualoaisp" method="post" action="index.php?action=UpdateLoaisp" enctype="multipart/form-data">
                <span class="close close-sualoaisp">&times;</span>
                <h2>Sửa loại sản phẩm</h2>
                <!--id loaisp-->
                <div class="container-sualoaisp">
                    <label style="margin:auto;margin-left:20px;">ID:</label>
                    <input id="idloaisp" class="input-loaisp" type="text" name="idloaisp" required style="color:red;font-weight:bold" />
                </div>
                <!--loaisp-->
                <div class="container-sualoaisp">
                    <label style="margin:auto;margin-left:20px;">Tên loại sản phẩm:</label>
                    <input id="sualoaisp" class="input-loaisp" type="text" name="loaisp" required placeholder="Nhập tên loại sản phẩm" />
                </div>
                <!--anh-->
                <div class="container-sualoaisp" style="height:150px">
                    <label style="margin: auto; margin-left: 20px;">Hình ảnh:</label>
                    <input id="file-select-sua" type="file" name="anh" style="display:none;" />
                    <div class="div-sua-chon-anh" style="display:flex;flex-direction:column;">
                        <img id="preview-anh" src="" style="width: 100px; height: 100px;max-height:100px; display: none;margin:auto;margin-right:89px;border-radius:6px;" />
                        <button id="bt-chon-anh" type="button" style="width: 90px; height: 30px; border: none; border-radius: 8px;
                                background-color: #242d77; color: white; margin: auto;margin-right:94px;margin-top:15px;cursor:pointer;">Chọn ảnh</button>
                    </div>
                </div>
                <!--ghi chu-->
                <div class="container-sualoaisp">
                    <label style="margin: auto; margin-left: 20px;">Ghi chú:</label>
                    <input id="suaGhiChuLoaisp" class="input-loaisp" type="text" name="ghichu" placeholder="Ghi chú" />
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
                            fetch("index.php?action=GetIdLoaisp&idloaisp=" + dataId)
                                .then(response => response.json())
                                .then(result => {
                                    if (result.success) {
                                        let data = result.data;
                                        document.getElementById("idloaisp").value = data.idLoaisp;
                                        document.getElementById("sualoaisp").value = data.loaisp;
                                        document.getElementById("suaGhiChuLoaisp").value = data.ghichu;
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

                    // submit form sửa loại sản phẩm bằng ajax
                    document.getElementById("form-sualoaisp").addEventListener("submit", function (e) {
                        let formdata = new FormData(this);
                        if(confirm("Xác nhận cập nhật loại sản phẩm này?")){
                            //update
                        fetch("index.php?action=UpdateLoaisp", {
                            method: "POST",
                            headers: { "Content-Type": "application/x-www-form-urlencoded" },
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
                            });
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
  //     //
  //     document.getElementById("bt_loaisp").addEventListener("click", function () {
  //         let modal = document.getElementById("loaisp");
  //         modal.style.display = "flex"; // Hiển thị modal ngay nhưng opacity vẫn 0
  //         setTimeout(() => {
  //             modal.classList.add("show"); // Thêm class để chạy hiệu ứng
  //         }, 1); // Chờ 10ms để đảm bảo display đã cập nhật
  //     });
  //
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