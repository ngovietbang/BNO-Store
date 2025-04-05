-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 05, 2025 lúc 08:14 PM
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
(109, 'bcvbcv', 'views/viewLoaisp/LoaispImg/camelia.jpg', 'cvbcvbcvbcvb'),
(111, 'ee', 'views/viewLoaisp/LoaispImg/image (6).png', 'erẻ'),
(118, 'bvb', 'views/viewLoaisp/LoaispImg/4.jpg', 'vbvb'),
(119, 'xvcvxcv', 'views/viewLoaisp/LoaispImg/Isis.jpg', 'xcvxcv'),
(122, 'g', 'views/viewLoaisp/LoaispImg/kurumi.jpg', 'g'),
(124, '3', 'views/viewLoaisp/LoaispImg/466785948_491872603892517_7482667785213021824_n.jpg', '3'),
(132, 'the shore', 'views/viewLoaisp/LoaispImg/the shore.jpg', 'sdsaa'),
(134, 'gfh', 'views/viewLoaisp/LoaispImg/camelia.jpg', 'fghf'),
(137, 'ddddd', 'views/viewLoaisp/LoaispImg/kurumi.jpg', 'ddddd'),
(141, '233', 'views/viewLoaisp/LoaispImg/camelia.jpg', '23'),
(147, 'vbvb', 'views/viewLoaisp/LoaispImg/image (3).png', 'vb'),
(148, 'cccc', 'views/viewLoaisp/LoaispImg/camelia.jpg', 'cc'),
(149, 'ccvbvbdgbdfg', 'views/viewLoaisp/LoaispImg/image (6).png', 'dfb'),
(150, 'thjtjy', 'views/viewLoaisp/LoaispImg/sea.jpg', 'ytjytj'),
(151, 'gbnbvbn', 'views/viewLoaisp/LoaispImg/6.jpg', 'hgmhgmhgm'),
(152, 'nvbbn', 'views/viewLoaisp/LoaispImg/image (5).png', 'xcxcv'),
(153, 'mmn', 'views/viewLoaisp/LoaispImg/image (3).png', ''),
(154, 'bbbbbb', 'views/viewLoaisp/LoaispImg/10.jpg', ''),
(155, 'zvzaddewq', 'views/viewLoaisp/LoaispImg/5.jpg', ''),
(156, 'cxczxczxc', 'views/viewLoaisp/LoaispImg/1369591.png', 'zxczxc'),
(157, 'bbvcbvcb', 'views/viewLoaisp/LoaispImg/Isis.jpg', ''),
(158, 'mhmjmjmjmjm', 'views/viewLoaisp/LoaispImg/image44.png', ''),
(159, 'get', 'views/viewLoaisp/LoaispImg/470200274_511790928567351_3102948158618603393_n.jpg', 'áđá'),
(160, 'v', 'views/viewLoaisp/LoaispImg/image (4).png', ''),
(162, 'bawng 2', 'views/viewLoaisp/LoaispImg/image (6).png', 'fghgfh');

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
  `tensp` varchar(50) NOT NULL,
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
(1, '15ẻ12', 'bawng 2', 'camelya', 333, 3333, 'views/viewSanPham/SanPhamImg/image (2).png'),
(2, 'vcbvbnvbnbv', 'bawng 2', 'nvbn', 10000, 32354, './views/viewSanPham/SanPhamImg/10.jpg'),
(3, 'fsdf', 'bawng 2', 'camelya', 6456, 2147483647, './views/viewSanPham/SanPhamImg/3.jpg'),
(4, '76476756', 'bawng 2', 'nvbn', 56765765, 76576576, './views/viewSanPham/SanPhamImg/image44.png'),
(7, '6546', 'v', 'zxcv', 546, 767, 'views/viewSanPham/SanPhamImg/the shore.jpg'),
(8, '7856', 'v', 'cvbcvb', 898, 8989, './views/viewSanPham/SanPhamImg/image (4).png'),
(9, '567', 'v', 'zxcv', 899, 99999, 'views/viewSanPham/SanPhamImg/1369591.png'),
(10, 'yui', 'bawng 2', 'camelya', 768768, 99999, 'views/viewSanPham/SanPhamImg/5.jpg'),
(11, 'yuiy', 'bawng 2', 'nvbn', 899, 898989, 'views/viewSanPham/SanPhamImg/2.jpg'),
(12, '4', 'bawng 2', 'camelya', 4, 4, './views/viewSanPham/SanPhamImg/camelia.jpg'),
(15, 'bbbbbb', 'bawng 2', 'camelya', 12323, 12133, 'views/viewSanPham/SanPhamImg/image (6).png');

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
(2, 'nvbbn', 'bcvbcvb', 'views/viewTheLoai/TheLoaiImg/7.jpg', 'cvbcvb'),
(4, 'nvbbn', 'vxcvx', 'views/viewTheLoai/TheLoaiImg/image (3).png', 'bbbb'),
(6, 'v', 'zxcv', 'views/viewTheLoai/TheLoaiImg/6.jpg', 'xcv'),
(10, 'v', 'cvbcvb', 'views/viewTheLoai/TheLoaiImg/camelia.jpg', 'cbcvbvc'),
(11, 'v', 'cvbvcb', 'views/viewTheLoai/TheLoaiImg/O5w7dEuk-wallha.com.png', 'cvbcvb'),
(13, 'v', 'vcbcvbnvvbm', 'views/viewTheLoai/TheLoaiImg/4.jpg', 'vmvmmvmb'),
(15, 'get', 'vbnvbnvbnvb', 'views/viewTheLoai/TheLoaiImg/image (2).png', 'vbnvbnvbn'),
(17, 'bbvcbvcb', 'cvbcvbcvb', 'views/viewTheLoai/TheLoaiImg/Isis.jpg', 'sdf'),
(20, 'bawng 2', 'camelya', 'views/viewTheLoai/TheLoaiImg/image44.png', 'cvvcv'),
(22, 'bawng 2', 'nvbn', 'views/viewTheLoai/TheLoaiImg/466785948_491872603892517_7482667785213021824_n.jpg', '');

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
  `sdt` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `roles` varchar(10) DEFAULT NULL,
  `anh` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `tentk`, `matkhau`, `hovaten`, `ngaysinh`, `gioitinh`, `diachi`, `cccd`, `sdt`, `email`, `roles`, `anh`) VALUES
(6, 's', '555555558899', 'âdbvcxbcxzc', '2022-02-25', 'Nam', '334', '345', 11114455, 'asdasdasasd', 'Shipper', './views/viewUser/UserImg/6.jpg'),
(8, 'dfgdfg', '2222', 'fsdfds', '0322-03-12', 'Nam', 'dd', '123123', 123123, 'sa', 'Admin', './views/viewUser/UserImg/image (2).png'),
(9, 'asdasdasdasdasdasd', '111', 'bang  332', '2004-07-28', 'Nam', '1', '2', 3, 'afafasdasd', 'Admin', './views/viewUser/UserImg/image44.png'),
(10, 'xcvxcvxcv', '3333333333333333333333333333333333333333', 'nbam', '2025-01-29', 'Nữ', 'vbvb', '13421', 234, 'vbnbnvbn', 'Kế toán', 'views/viewUser/UserImg/10.jpg'),
(11, 'vt', '55555555', 'asd', '2025-04-09', 'Nam', 'fgh', '324', 324, 'erg345', 'Nhân viên ', 'views/viewUser/UserImg/the shore.jpg'),
(12, '1', '1', 'ngo viet bang', '2004-07-28', 'Nam', 'ha noi', '00120404', 971617, '1@gmail.com', 'Admin', 'views/viewUser/UserImg/1.jpg'),
(13, '2', '2', '2', '2025-05-09', 'Nam', '2', '2', 2, '2', 'Admin', 'views/viewUser/UserImg/z4588741908487_ea819e6e2a63b8c2f0903b52386e736b.jpg'),
(16, '4', '4', '4444444444444444444', '2025-04-01', 'Nữ', '44', '44', 44, '44', 'User', 'views/viewUser/UserImg/11.png');

--
-- Chỉ mục cho các bảng đã đổ
--

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
  ADD KEY `fk_sanpham_tentheloai` (`tentheloai`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`idTheloai`),
  ADD UNIQUE KEY `idTheloai` (`idTheloai`),
  ADD UNIQUE KEY `tentheloai` (`tentheloai`),
  ADD KEY `fk_theloai_loaisp` (`loaisp`);

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
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `idLoaisp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `idsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `idTheloai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sanpham_loaisp` FOREIGN KEY (`loaisp`) REFERENCES `loaisanpham` (`loaisp`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sanpham_tentheloai` FOREIGN KEY (`tentheloai`) REFERENCES `theloai` (`tentheloai`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD CONSTRAINT `fk_theloai_loaisp` FOREIGN KEY (`loaisp`) REFERENCES `loaisanpham` (`loaisp`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
