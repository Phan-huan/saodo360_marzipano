-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 30, 2023 lúc 04:02 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `saodo360`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '4297f44b13955235245b2497399d7a93');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuvuc`
--

CREATE TABLE `khuvuc` (
  `id` int(100) NOT NULL,
  `tenkhuvuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khuvuc`
--

INSERT INTO `khuvuc` (`id`, `tenkhuvuc`) VALUES
(1, 'TỔNG QUAN KHUÔN VIÊN CỔNG TRƯỜNG'),
(2, 'GIẢNG ĐƯỜNG A'),
(3, 'THƯ VIỆN'),
(4, 'NHÀ B'),
(5, 'HỘI TRƯỜNG'),
(6, 'KHU TIỆN ÍCH'),
(7, 'XƯỞNG KHOA ĐIỆN'),
(8, 'XƯỞNG KHOA Ô TÔ'),
(9, 'XƯỞNG KHOA MAY & THỜI TRANG'),
(10, 'XƯỞNG KHOA THỰC PHẨM & HÓA HỌC'),
(11, 'XƯỞNG KHOA CƠ KHÍ'),
(12, 'XƯỞNG KHOA CÔNG NGHỆ THÔNG TIN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vitri`
--

CREATE TABLE `vitri` (
  `id` int(100) NOT NULL,
  `id_data` varchar(100) NOT NULL,
  `id_khuvuc` int(100) NOT NULL,
  `tenvitri` varchar(100) NOT NULL,
  `hinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `vitri`
--

INSERT INTO `vitri` (`id`, `id_data`, `id_khuvuc`, `tenvitri`, `hinhanh`) VALUES
(1, '0-khuvuccongtruong', 1, 'Khu vực cổng trường', '0-khuvuccongtruong.jpg'),
(2, '21-nha_a_sanh', 2, 'Sảnh nhà A', 'temp.jpg'),
(3, '9-nha_a_phonghoithao', 2, 'Phòng hội thảo', 'temp.jpg'),
(4, '7-nha_a_phongdaotao', 2, 'Phòng đào tạo', 'temp.jpg'),
(5, '15-nha_a_phongtuyensinh', 2, 'Phòng tuyển sinh', 'temp.jpg'),
(6, '12-nha_a_phongquantri', 2, 'Phòng quản trị', 'temp.jpg'),
(7, '24-sanhtruocthuvien', 3, 'Sảnh trước thư viện', '24-sanhtruocthuvien.jpg'),
(8, '28-trungtamthuvien', 3, 'Trung tâm thư viện', '28-trungtamthuvien.jpg'),
(9, '22-nha_b_sanhtruoc', 4, 'Sảnh trước nhà B', '22-nha_b_sanhtruoc.jpg'),
(10, '18-nha_b_sanhchinh', 4, 'Sảnh chính nhà B', '18-nha_b_sanhchinh.jpg'),
(11, '13-nha_b_phongtochuchanhchinh', 4, 'Phòng tổ chức hành chính', '13-nha_b_phongtochuchanhchinh.jpg'),
(12, '10-nha_b_phonghop', 4, 'Phòng họp nhà B', '10-nha_b_phonghop.jpg'),
(13, '19-nha_b_tang4_kgstkhoakinhte', 4, 'Không gian sáng tạo khoa kinh tế', '19-nha_b_tang4_kgstkhoakinhte.jpg'),
(14, '20-nha_b_tang5_kgstkhoadulichngoaingu', 4, 'Không gian sáng tạo khoa du lịch & ngoại ngữ', '20-nha_b_tang5_kgstkhoadulichngoaingu.jpg'),
(15, '14-nha_b_phongtruyenthong', 4, 'Phòng truyền thống', '14-nha_b_phongtruyenthong.jpg'),
(16, '11-nha_b_phongmay', 4, 'Phòng máy nhà B', '11-nha_b_phongmay.jpg'),
(17, '23-sanhtruochoitruong_daiphunnuoc', 5, 'Sảnh trước hội trường & đài phun nước', '23-sanhtruochoitruong_daiphunnuoc.jpg'),
(18, '27-trungtamhoitruong', 5, 'Trung tâm hội trường', '27-trungtamhoitruong.jpg'),
(19, '6-nhadanang', 6, 'Nhà đa năng', '6-nhadanang.jpg'),
(20, '29-sanbongda', 6, 'Sân bóng đá', '29-sanbongda.jpg'),
(21, '16-sanbongchuyenngoaitroi', 6, 'Sân bóng chuyền', 'temp.jpg'),
(22, '17-sanbongrongoaitroi', 6, 'Sân bóng rổ', '17-sanbongrongoaitroi.jpg'),
(23, '26-santhethao_theducdungcungoaitroi', 6, 'Sân thể dục & thể thao ngoài trời', '26-santhethao_theducdungcungoaitroi.jpg'),
(24, '1-cangtin', 6, 'Căng tin', 'temp.jpg'),
(25, '5-khuvuckituc', 6, 'Khu vực kí túc xá', '5-khuvuckituc.jpg'),
(26, '30-xdien_kgstkhoadien', 7, 'Không gian sáng tạo khoa điện', '30-xdien_kgstkhoadien.jpg'),
(27, '31-xdien_hanhlang', 7, 'Hành lang xưởng khoa điện', '31-xdien_hanhlang.jpg'),
(28, '32-xdien_phongthuchanh', 7, 'Phòng thực hành xưởng điện', '32-xdien_phongthuchanh.jpg'),
(29, '3-xmay_sanh', 9, 'Sảnh khoa may & thời trang', '3-xmay_sanh.jpg'),
(30, '25-xmay_trungtam', 9, 'Trung tâm xưởng may', '25-xmay_trungtam.jpg'),
(31, '2-xtin_hanhlang', 12, 'Hành lang xưởng khoa CNTT', '2-xtin_hanhlang.jpg'),
(32, '4-xtin_khonggiansangtao', 12, 'Không gian sáng tạo khoa CNTT', '4-xtin_khonggiansangtao.jpg'),
(33, '8-xtin_phongmay', 12, 'Phòng máy tính xưởng CNTT', '8-xtin_phongmay.jpg'),
(38, '33-demo', 1, 'aaa', '27-trungtamhoitruong.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khuvuc`
--
ALTER TABLE `khuvuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vitri`
--
ALTER TABLE `vitri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `khuvuc`
--
ALTER TABLE `khuvuc`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `vitri`
--
ALTER TABLE `vitri`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
