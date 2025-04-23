-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 22, 2025 lúc 08:49 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bnostore`
--
CREATE DATABASE IF NOT EXISTS `bnostore` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bnostore`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `iddh` int(20) NOT NULL,
  `id` int(20) DEFAULT NULL,
  `idsp` int(20) DEFAULT NULL,
  `hovaten` varchar(100) DEFAULT NULL,
  `sdt` int(20) DEFAULT NULL,
  `diachigiaohang` varchar(200) DEFAULT NULL,
  `tensp` varchar(200) DEFAULT NULL,
  `giaban` int(20) DEFAULT NULL,
  `soluongmua` int(20) DEFAULT NULL,
  `phivanchuyen` int(20) DEFAULT NULL,
  `phuongthucthanhtoan` varchar(100) DEFAULT NULL,
  `tongtien` decimal(18,0) DEFAULT NULL,
  `trangthai` varchar(100) DEFAULT NULL,
  `ngaydathang` date DEFAULT NULL,
  `ngaytacdong` datetime DEFAULT NULL,
  `usertacdong` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`iddh`, `id`, `idsp`, `hovaten`, `sdt`, `diachigiaohang`, `tensp`, `giaban`, `soluongmua`, `phivanchuyen`, `phuongthucthanhtoan`, `tongtien`, `trangthai`, `ngaydathang`, `ngaytacdong`, `usertacdong`) VALUES
(25, 28, 27, 'Ngô Viết Bằng', 971617004, 'mỹ hưng, thanh oai, Hà nội', 'Light novel \"Thám tử đã chết\" tập 6', 65000, 1, 35000, 'Thanh toán khi nhận hàng', 100000, 'Hoàn thành', '2025-04-21', '2025-04-23 01:44:33', 'bno_sp4_hn'),
(26, 28, 28, 'Ngô Viết Bằng', 971617004, 'mỹ hưng, thanh oai, Hà nội', 'Truyện \"Nhà có năm nàng dâu\" tập 1', 25000, 3, 35000, 'Ví momo', 110000, 'Đã hủy', '2025-04-22', '2025-04-22 01:12:01', '2'),
(27, 28, 26, 'Ngô Viết Bằng', 971617004, 'mỹ hưng, thanh oai, Hà nội', 'Light novel \"Thiên sứ nhà bên\" tập 3', 60000, 1, 25000, 'Thanh toán khi nhận hàng', 85000, 'Đã hủy', '2025-04-22', '2025-04-22 01:11:25', '2'),
(28, 28, 25, 'Ngô Viết Bằng', 971617004, 'mỹ hưng, thanh oai, Hà nội', 'Light novel \"Eighty six\" tập 1 - bản giới hạn', 80000, 1, 25000, 'Thanh toán khi nhận hàng', 105000, 'Đã hủy', '2025-04-22', '2025-04-22 01:08:58', NULL),
(29, 28, 26, 'Ngô Viết Bằng', 971617004, 'mỹ hưng, thanh oai, Hà nội', 'Light novel \"Thiên sứ nhà bên\" tập 3', 60000, 1, 25000, 'Thanh toán khi nhận hàng', 85000, 'Hoàn thành', '2025-04-22', '2025-04-23 01:44:40', 'bno_sp4_hn'),
(30, 29, 29, 'Trần Văn B', 2147483647, 'Quảng Nam', 'Truyện \"Nhà có năm nàng dâu\" tập 14', 25000, 45, 35000, 'Ví momo', 1160000, 'Đang giao hàng', '2025-04-22', '2025-04-23 01:44:22', 'bno_sp4_hn'),
(31, 29, 26, 'Trần Văn B', 2147483647, 'Quảng Nam', 'Light novel \"Thiên sứ nhà bên\" tập 3', 60000, 3, 35000, 'Ví momo', 215000, 'Đang xử lý', '2025-04-22', '2025-04-23 01:43:37', '2'),
(32, 29, 25, 'Trần Văn B', 2147483647, 'Quảng Nam', 'Light novel \"Eighty six\" tập 1 - bản giới hạn', 80000, 9, 35000, 'Ví momo', 755000, 'Đang xử lý', '2025-04-22', '2025-04-23 01:43:35', '2'),
(33, 29, 29, 'Trần Văn B', 2147483647, 'Quảng Nam', 'Truyện \"Nhà có năm nàng dâu\" tập 14', 25000, 6, 25000, 'Ví momo', 175000, 'Đang xử lý', '2025-04-22', '2025-04-23 01:43:34', '2'),
(34, 28, 35, 'Ngô Viết Bằng', 971617004, 'mỹ hưng, thanh oai, Hà nội', 'Truyện \"Nhà có năm nàng dâu\" tập 13', 26000, 8, 35000, 'Thanh toán khi nhận hàng', 243000, 'Đang giao hàng', '2025-04-22', '2025-04-23 01:35:05', 'bno_sp4_hn'),
(35, 28, 34, 'Ngô Viết Bằng', 971617004, 'mỹ hưng, thanh oai, Hà nội', 'Light novel \"Eighty six\" tập 6', 76000, 4, 25000, 'Thanh toán khi nhận hàng', 329000, 'Đang giao hàng', '2025-04-22', '2025-04-23 01:34:50', 'bno_sp4_hn'),
(36, 28, 31, 'Ngô Viết Bằng', 971617004, 'mỹ hưng, thanh oai, Hà nội', 'Light novel \"Attack on titan\" tập 17', 90000, 6, 25000, 'Ví momo', 565000, 'Đang giao hàng', '2025-04-22', '2025-04-23 01:35:23', 'bno_sp4_hn'),
(37, 29, 29, 'Trần Văn B', 2144, 'Quảng Nam', 'Truyện \"Nhà có năm nàng dâu\" tập 14', 25000, 4, 25000, 'Ví momo', 125000, 'Đang giao hàng', '2025-04-23', '2025-04-23 01:34:52', 'bno_sp4_hn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `idLoaisp` int(11) NOT NULL,
  `loaisp` varchar(50) NOT NULL,
  `anh` varchar(200) DEFAULT NULL,
  `ghichu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`idLoaisp`, `loaisp`, `anh`, `ghichu`) VALUES
(160, 'Truyện tranh', 'views/viewLoaisp/LoaispImg/s11.jpg', ''),
(162, 'Light novel', 'views/viewLoaisp/LoaispImg/s7.jpg', 'bao gồm cả tiểu thuyết tự sáng tác'),
(165, 'Poster', 'views/viewLoaisp/LoaispImg/s10.jpg', ''),
(166, 'Mô hình', 'views/viewLoaisp/LoaispImg/s9.jpg', ''),
(167, 'Móc khóa', 'views/viewLoaisp/LoaispImg/s8.jpg', '');

--
-- Bẫy `loaisanpham`
--
DELIMITER $$
CREATE TRIGGER `update_theloai_loaisp` AFTER UPDATE ON `loaisanpham` FOR EACH ROW BEGIN
    UPDATE theloai
    SET loaisp = NEW.loaisp
    WHERE loaisp = OLD.loaisp;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `idsp` int(11) NOT NULL,
  `tensp` varchar(200) NOT NULL,
  `loaisp` varchar(50) NOT NULL,
  `tentheloai` varchar(50) NOT NULL,
  `giaban` decimal(18,0) NOT NULL,
  `soluong` int(11) NOT NULL,
  `anh` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`idsp`, `tensp`, `loaisp`, `tentheloai`, `giaban`, `soluong`, `anh`) VALUES
(25, 'Light novel \"Eighty six\" tập 1 - bản giới hạn', 'Light novel', 'Action', 80000, 45, './views/viewSanPham/SanPhamImg/4.jpg'),
(26, 'Light novel \"Thiên sứ nhà bên\" tập 3', 'Light novel', 'Romance', 60000, 78, './views/viewSanPham/SanPhamImg/2.jpg'),
(27, 'Light novel \"Thám tử đã chết\" tập 6', 'Light novel', 'Action', 65000, 66, './views/viewSanPham/SanPhamImg/12.jpg'),
(28, 'Truyện \"Nhà có năm nàng dâu\" tập 1', 'Truyện tranh', 'Tình cảm', 25000, 45, './views/viewSanPham/SanPhamImg/14.jpg'),
(29, 'Truyện \"Nhà có năm nàng dâu\" tập 14', 'Truyện tranh', 'Tình cảm', 25000, 56, './views/viewSanPham/SanPhamImg/15.jpg'),
(30, 'Truyện \"Nhà có năm nàng dâu\" tập 13', 'Truyện tranh', 'Tình cảm', 26000, 67, './views/viewSanPham/SanPhamImg/16.jpg'),
(31, 'Light novel \"Attack on titan\" tập 17', 'Light novel', 'Action', 90000, 78, './views/viewSanPham/SanPhamImg/1.jpg'),
(32, 'Light novel \"Eighty six\" tập 4 bản giới hạn', 'Light novel', 'Action', 120000, 12, './views/viewSanPham/SanPhamImg/5.jpg'),
(33, 'Light novel \"Eighty six\" tập 5', 'Light novel', 'Action', 800000, 56, './views/viewSanPham/SanPhamImg/6.jpg'),
(34, 'Light novel \"Eighty six\" tập 6', 'Light novel', 'Action', 76000, 14, './views/viewSanPham/SanPhamImg/7.jpg'),
(35, 'Truyện \"Nhà có năm nàng dâu\" tập 13', 'Truyện tranh', 'Tình cảm', 26000, 56, './views/viewSanPham/SanPhamImg/16.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `idTheloai` int(11) NOT NULL,
  `loaisp` varchar(50) DEFAULT NULL,
  `tentheloai` varchar(50) NOT NULL,
  `anh` varchar(200) DEFAULT NULL,
  `ghichu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`idTheloai`, `loaisp`, `tentheloai`, `anh`, `ghichu`) VALUES
(10, 'Truyện tranh', 'Isekai2', 'views/viewTheLoai/TheLoaiImg/t6.jpg', 'Mang ý nghĩa \"thế giới khác\". Đối với thể loại này, nhân vật chính thường sống lại (trọng sinh) về q'),
(22, 'Light novel', 'Tự sáng tác', 'views/viewTheLoai/TheLoaiImg/s7.jpg', ''),
(24, 'Truyện tranh', 'Hành động', 'views/viewTheLoai/TheLoaiImg/t5.jpg', ''),
(25, 'Truyện tranh', 'Phưu lưu', 'views/viewTheLoai/TheLoaiImg/t4.jpg', ''),
(27, 'Truyện tranh', 'Tình cảm', 'views/viewTheLoai/TheLoaiImg/t3.jpg', ''),
(28, 'Truyện tranh', 'Drama', 'views/viewTheLoai/TheLoaiImg/t2.jpg', ''),
(30, 'Truyện tranh', 'Kinh dị', 'views/viewTheLoai/TheLoaiImg/t1.jpg', ''),
(31, 'Light novel', 'Action', 'views/viewTheLoai/TheLoaiImg/t9.jpg', ''),
(33, 'Light novel', 'Romance', 'views/viewTheLoai/TheLoaiImg/t8.jpg', ''),
(36, 'Light novel', 'Isekai', 'views/viewTheLoai/TheLoaiImg/t7.jpg', 'Mang ý nghĩa \"thế giới khác\". Đối với thể loại này, nhân vật chính thường sống lại (trọng sinh) về q'),
(39, 'Truyện tranh', 'Đời thường', 'views/viewTheLoai/TheLoaiImg/', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongkedoanhthu`
--

CREATE TABLE `thongkedoanhthu` (
  `idtkdt` int(11) NOT NULL,
  `thoigian` date DEFAULT NULL,
  `iddh` int(11) DEFAULT NULL,
  `tongsanluong` int(11) DEFAULT NULL,
  `tongdoanhthu` decimal(18,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongkesanpham`
--

CREATE TABLE `thongkesanpham` (
  `idtksp` int(11) NOT NULL,
  `thoigian` date DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `giaban` decimal(18,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `tentk` varchar(40) NOT NULL,
  `matkhau` varchar(40) NOT NULL,
  `hovaten` varchar(50) NOT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` varchar(5) DEFAULT NULL,
  `diachi` varchar(100) NOT NULL,
  `cccd` varchar(30) DEFAULT NULL,
  `sdt` int(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `roles` varchar(10) DEFAULT NULL,
  `anh` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `tentk`, `matkhau`, `hovaten`, `ngaysinh`, `gioitinh`, `diachi`, `cccd`, `sdt`, `email`, `roles`, `anh`) VALUES
(13, '2', '2', '2', '2025-05-09', 'Nam', '2', '2', 2, '2', 'Admin', 'views/viewUser/UserImg/z4588741908487_ea819e6e2a63b8c2f0903b52386e736b.jpg'),
(28, 'b', 'b', 'Ngô Viết Bằng', '2004-07-28', 'Nam', 'mỹ hưng, thanh oai, Hà nội', 'null', 971617004, '', 'User', 'views/viewUser/UserImg/488256815_671949602057936_668134177625528842_n.jpg'),
(29, '3', '3', 'Trần Văn B', '1998-12-31', 'Nữ', 'Quảng Nam', 'null', 2144, '', 'User', 'views/viewUser/UserImg/ds3.jpg'),
(30, 'bno_sp4_hn', '1', 'Minh', '1987-11-23', 'Nam', 'Hà nội', '55555555555', 666666, '4@gmail.com', 'Shipper', 'views/viewUser/UserImg/ayaka.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`iddh`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`idLoaisp`),
  ADD UNIQUE KEY `idLoaisp` (`idLoaisp`),
  ADD UNIQUE KEY `loaisp` (`loaisp`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`idsp`),
  ADD UNIQUE KEY `idsp` (`idsp`),
  ADD KEY `fk_sanpham_loaisp` (`loaisp`),
  ADD KEY `fk_sanpham_theloai` (`tentheloai`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`idTheloai`),
  ADD UNIQUE KEY `idTheloai` (`idTheloai`),
  ADD UNIQUE KEY `tentheloai` (`tentheloai`),
  ADD KEY `fk_theloai_loaisp` (`loaisp`);

--
-- Chỉ mục cho bảng `thongkedoanhthu`
--
ALTER TABLE `thongkedoanhthu`
  ADD PRIMARY KEY (`idtkdt`);

--
-- Chỉ mục cho bảng `thongkesanpham`
--
ALTER TABLE `thongkesanpham`
  ADD PRIMARY KEY (`idtksp`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `tentk` (`tentk`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `iddh` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `idLoaisp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `idsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `idTheloai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `thongkedoanhthu`
--
ALTER TABLE `thongkedoanhthu`
  MODIFY `idtkdt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thongkesanpham`
--
ALTER TABLE `thongkesanpham`
  MODIFY `idtksp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sanpham_loaisp` FOREIGN KEY (`loaisp`) REFERENCES `loaisanpham` (`loaisp`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sanpham_theloai` FOREIGN KEY (`tentheloai`) REFERENCES `theloai` (`tentheloai`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD CONSTRAINT `fk_theloai_loaisp` FOREIGN KEY (`loaisp`) REFERENCES `loaisanpham` (`loaisp`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
