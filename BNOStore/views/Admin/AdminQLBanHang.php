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
    <!--quan ly ban hang-->
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
                <!--thong bao-->
                <a class="a_menu_header_2 menu-thongbao" id="menu-thongbao">
                    <img src="http://localhost:8080/BNOStore/views/HomeImage/icon/thongbao.png" />
                    <span>Thông báo</span>
                    <p class="so-thongbao" id="so-thongbao"></p>
                </a>
                <div class="menu-hienthi-thongbao" id="hien-thi-thong-bao">
                    <!---->
                </div>
                <!--script hien thi thong bao-->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const bta = document.getElementById("menu-thongbao");
                        const div1 = document.getElementById("hien-thi-thong-bao");

                        let isVisible = false;

                        bta.addEventListener("click", function (e) {
                            e.preventDefault();//
                            isVisible = !isVisible;
                            div1.style.display = isVisible ? "flex" : "none";
                        });

                        document.addEventListener("click", function (e) {
                            // Nếu click không phải vào button hoặc popup thì ẩn
                            if (!div1.contains(e.target) && !bta.contains(e.target)) {
                                div1.style.display = "none";
                                isVisible = false;
                            }
                        });
                    });
                </script>
                <!--script cap nhat so thong bao theo realtime-->
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        function loadThongBao() {
                            const xhr = new XMLHttpRequest();
                            xhr.open("GET", "index.php?action=LayThongBao", true);

                            xhr.onload = function () {
                                if (this.status == 200) {
                                    let response = this.responseText.trim();  // Loại bỏ khoảng trắng thừa

                                    if (response) {
                                        // Nếu có dữ liệu hợp lệ trong phản hồi, parse và xử lý
                                        try {
                                            let data = JSON.parse(response);
                                            // Cập nhật HTML và số lượng
                                            document.getElementById("hien-thi-thong-bao").innerHTML = data.html;
                                            let sotb = data.count;
                                            if (sotb == "") {
                                                document.getElementById("so-thongbao").style.display = "none";
                                            }
                                            else {
                                                document.getElementById("so-thongbao").style.display = "flex";
                                                document.getElementById("so-thongbao").textContent = sotb;
                                            }
                                        } catch (e) {
                                            console.error('Lỗi phân tích JSON:', e);  // Nếu dữ liệu không hợp lệ
                                        }
                                    } else {
                                        // Nếu phản hồi trống, không làm gì hoặc log nhẹ
                                        console.log('Không có thông báo mới.');
                                    }
                                } else {
                                    console.error('Lỗi tải dữ liệu:', this.status);  // Nếu có lỗi với mã trạng thái
                                }
                            };

                            xhr.send();
                        }


                        // Gọi hàm 1 lần khi trang load
                        loadThongBao();

                        // Tùy chọn: gọi lại mỗi 10 giây
                        setInterval(loadThongBao, 10000);
                    });
                </script>
                <!---->
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
    <div class="content content-donhang">
        <!--menu trái-->
        <div class="menu_trai menu-trai-donhang">
            <img class="logo-menu" src="http://localhost:8080/BNOStore/views/HomeImage/image/logo.png" style="width: 70px; height: 70px; margin: 0; margin: auto; margin-bottom: 20px; margin-top: 10px" />
            <!---->
            <a class="bt_menu_trai" href="index.php?action=QuanLyLoaisp">Quản lý loại sản phẩm</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyTheLoai">Quản lý thể loại</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLySanPham">Quản lý sản phẩm</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyNguoiDung">Quản lý người dùng</a>
            <a class="bt_menu_trai" href="index.php?action=QuanLyBanHang" style="background-color:#96440f;">Quản lý bán hàng</a>
            <!----><button id="bt-themloaisp" class="menu-con">Tổng hợp thống kê</button>
            <!----><button id="bt-themloaisp" class="menu-con">Quản lý phản ánh</button>
            <!----><button id="bt-themloaisp" class="menu-con">Xử lý giao việc</button>
        </div>

        <!--dữ liệu-->
        <div id="donhang" class="donhang">
            <!---->
            <!--nut close-->
            <span class="close">&times;</span>
            <!--tim kiem-->
            <form action="index.php?" method="get" class="admin-tim-kiem timkiem-donhang" id="form_search">
                <input type="hidden" name="action" value="AdminTimKiemDonHang" />
                <input style="width:700px;" id="search" type="text" placeholder="Tìm kiếm đơn hàng theo ID đơn hàng, tên sản phẩm, tên người dùng đặt hàng, ngày đặt hàng, ngày tác động" class="input-timkiem" name="keyword" value="<?php echo $_GET['keyword'] ?? ''; ?>" />
                <button class="bt-timkiem" id="bt_search" type="submit">Tìm kiếm</button>
            </form>
            <!--dữ liệu hiển thị -->
            <div class="hienthi-div">
                <!---->
                <?php
                foreach ($rowDonHang as $row) { ?>
                    <div class="hienthi-div1">
                        <!--id don hang-->
                        <div class="hienthi-div2">
                            <p>ID đơn hàng: </p>
                            <span><?php echo $row['iddh']; ?></span>
                        </div>
                        <!--user id-->
                        <div class="hienthi-div2">
                            <p>User ID: </p>
                            <span><?php echo $row['id']; ?></span>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p>Họ và tên: </p>
                            <span style="color:black"><?php echo $row['hovaten']; ?></span>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p>Số điện thoại: </p>
                            <span style="color:black"><?php echo $row['sdt']; ?></span>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p title="<?php echo htmlspecialchars($row['diachigiaohang']); ?>">Địa chỉ giao hàng: <?php echo $row['diachigiaohang']; ?></p>
                        </div>
                        <!--id sp-->
                        <div class="hienthi-div2">
                            <p>ID sản phẩm: </p>
                            <span><?php echo $row['idsp']; ?></span>
                        </div>
                        <!--tên sản phẩm-->
                        <div class="hienthi-div2">
                            <p title="<?php echo htmlspecialchars($row['tensp']); ?>">Tên sản phẩm: <?php echo $row['tensp']; ?></p>
                        </div>
                        <!--giá bán-->
                        <div class="hienthi-div2">
                            <p>Giá bán: </p>
                            <span style="color:black"><?php echo $row['giaban']; ?></span>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p>Số lượng mua: <?php echo $row['soluongmua']; ?></p>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p>Phí vận chuyển: </p>
                            <span style="color:black"><?php echo $row['phivanchuyen']; ?></span>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p>Phương thức thanh toán: <?php echo $row['phuongthucthanhtoan']; ?></p>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p>Tổng tiền: </p>
                            <span style="color:black"><?php echo $row['tongtien']; ?></span>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p>Ngày đặt hàng: <?php echo $row['ngaydathang']; ?></p>
                        </div>
                        <!--trang thai-->
                        <div class="hienthi-div2">
                            <p>Trạng thái: </p>
                            <span class="trang-thai"><?php echo $row['trangthai']; ?></span>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p>Ngày tác động: <?php echo $row['ngaytacdong']; ?></p>
                        </div>
                        <!---->
                        <div class="hienthi-div2">
                            <p>User tác động: </p>
                            <span><?php echo $row['usertacdong']; ?></span>
                        </div>
                        <!--action-->
                        <div class="hienthi-div3">
                            <a class="bt-action1" href="index.php?action=AdminHuyDonHang&iddh=<?php echo $row['iddh']; ?>" onclick="return XacNhanHuy();">Hủy đơn hàng</a>
                            <a class="bt-action2" href="index.php?action=AdminTiepNhanDon&iddh=<?php echo $row['iddh']; ?>" onclick="return tiepnhan();">Tiếp nhận đơn</a>
                            <a class="bt-action3" href="index.php?action=AdminXoaDonHang&iddh=<?php echo $row['iddh']; ?>" onclick="return xoa();">Xóa đơn hàng</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--script an hien cac nut action-->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const div1 = document.querySelectorAll(".hienthi-div1");

                    div1.forEach(item => {
                        let bthuydon = item.querySelector(".bt-action1");
                        let bttiepnhan = item.querySelector(".bt-action2");
                        let btxoa = item.querySelector(".bt-action3");
                        let trangthai = item.querySelector(".trang-thai").textContent.trim();
                        let trangthaitext = item.querySelector(".trang-thai");
                        //
                        if (trangthai === "Chờ xác nhận") {
                            bttiepnhan.style.display = "flex";
                        }
                        else if (trangthai !== "Đã hủy") {
                            bthuydon.style.display = "flex";
                        }
                        else if (trangthai === "Đã hủy") {
                            trangthaitext.style.color = "gray";
                            btxoa.style.display = "flex";
                        }
                        else if (trangthai === "Hoàn thành") {
                            trangthaitext.style.color = "green";
                        }
                        else {
                            bttiepnhan.style.display = "none";
                            bthuydon.style.display = "none";
                        }

                    });
                });
            </script>
            <!--script action-->
            <script>
                //xac nhan huy don
                function XacNhanHuy() {
                    return confirm("Bạn có chắc chắn muốn hủy đơn hàng này không?");
                }
                //xac nhan tiep nhan don
                function tiepnhan() {
                    return confirm("Tiếp nhận đơn hàng này?");
                }
                //xac nhan xoa
                function xoa() {
                    return confirm("Xác nhận xóa đơn hàng này?");
                }
            </script>

            <!--scrip phan chia don hang-->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const products = document.querySelectorAll(".hienthi-div1");
                    const pagination = document.getElementById("pagi");
                    const prevBtn = document.getElementById("truoc");
                    const nextBtn = document.getElementById("sau");

                    const itemsPerPage = 10;
                    const totalPages = Math.ceil(products.length / itemsPerPage);
                    let currentPage = 0;

                    function showPage(page) {
                        if (page < 0 || page >= totalPages) return;

                        products.forEach(product => product.style.display = "none");

                        for (let i = page * itemsPerPage; i < (page + 1) * itemsPerPage && i < products.length; i++) {
                            products[i].style.display = "block";
                        }
                        document.querySelectorAll(".pagi-button").forEach((btn, index) => {
                            btn.classList.toggle("active", index === page);
                        });
                        currentPage = page;
                    }
                    function createPagination() {
                        pagination.innerHTML = "";
                        for (let i = 0; i < totalPages; i++) {
                            let button = document.createElement("button");
                            button.textContent = i + 1;
                            button.classList.add("pagi-button");
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
            <!-- Phần phân trang -->
            <div id="phantrang-container">
                <button id="truoc">❮</button>
                <div id="pagi"></div>
                <button id="sau">❯</button>
            </div>

        </div>
    </div>

    <!--script mở, đóng form-->
    <script>
        // Đóng modal khi nhấn vào dấu "X"
        document.querySelector(".close").addEventListener("click", function () {
            let modal = document.getElementById("donhang");
            modal.classList.remove("show"); // Xóa class để chạy hiệu ứng ẩn
            setTimeout(() => {
                modal.style.display = "none"; // Ẩn hẳn modal sau hiệu ứng
                document.getElementById("bt-themloaisp").style.display = "none";
            }, 0); // Trùng với thời gian transition (0.4s)
        });
    </script>


</body>
</html>