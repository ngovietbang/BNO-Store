-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 31, 2025 lúc 08:46 PM
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
(134, 'gfh', 'views/viewLoaisp/LoaispImg/image (2).png', 'fghf'),
(137, '121', 'views/viewLoaisp/LoaispImg/image (6).png', '121'),
(140, '23', 'views/viewLoaisp/LoaispImg/469899018_908207968079625_1702150764539500547_n.jpg', '23'),
(141, '233', 'views/viewLoaisp/LoaispImg/camelia.jpg', '23'),
(145, 'vbnvbn', 'views/viewLoaisp/LoaispImg/2.jpg', 'vbvnvbnvbnvbn'),
(146, 'bn', 'views/viewLoaisp/LoaispImg/image (4).png', 'bn');

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
  `roles` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `tentk`, `matkhau`, `hovaten`, `ngaysinh`, `gioitinh`, `diachi`, `cccd`, `sdt`, `email`, `roles`) VALUES
(1, '1', '1', 'bang', '0000-00-00', 'Nam', 'my hung', '001204047799', 971617004, 'bang@gmail.com', 'User'),
(3, '2', '2', 'lan', '0000-00-00', 'nu', 'BAC gia=ng', '111111111', 111111111, 'nam@gmail.com', 'Admin'),
(4, '3', '3', 'bang ngo', '0000-00-00', 'Nu', 'Bhat ', '5555551', 55555555, 'n@gmail.com', 'User'),
(6, 's', 's', 'ssss', '2025-03-20', 'Nam', 'sadasdasd', '65645645', 0, 'asdasdasasd', 'Shipper');

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
  MODIFY `idLoaisp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `idsp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `idTheloai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sanpham_loaisp` FOREIGN KEY (`loaisp`) REFERENCES `loaisanpham` (`loaisp`),
  ADD CONSTRAINT `fk_sanpham_tentheloai` FOREIGN KEY (`tentheloai`) REFERENCES `theloai` (`tentheloai`);

--
-- Các ràng buộc cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD CONSTRAINT `fk_theloai_loaisp` FOREIGN KEY (`loaisp`) REFERENCES `loaisanpham` (`loaisp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
