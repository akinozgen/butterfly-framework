-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 25 Haz 2017, 18:33:09
-- Sunucu sürümü: 10.1.24-MariaDB
-- PHP Sürümü: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `butterfly`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `tags` text NOT NULL,
  `author` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `image`, `tags`, `author`, `created`) VALUES
(3, 'Neyiz?', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n\r\n<p>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n\r\n<p>\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n', 'http://localhost/butterfly-framework/public/uploads/blog-medium-5_1498408735.jpg', 'neyiz,  kimiz,  neden varız', 13, '2017-06-25 16:45:22'),
(4, 'Anımsatıcı Kelebek', '<p>İşte burası senin alanın</p>\r\n', 'http://localhost/butterfly-framework/public/uploads/product-1_1498409199.jpg', 'neyiz,  kimiz,  neden varız', 13, '2017-06-25 16:46:39'),
(5, 'Ne İşe Yararız?', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n', 'http://localhost/butterfly-framework/public/uploads/pie-85-yellow_1498409911.png', 'neyiz,  kimiz,  neden varız', 13, '2017-06-25 16:58:31'),
(6, 'Nasıl Bir Şey?', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur aut, dolorem magni nostrum quae sit totam voluptates? Assumenda blanditiis dolores impedit iure, labore provident quos tenetur. Illum, nostrum, quis?</p>\r\n', 'http://localhost/butterfly-framework/public/uploads/avatar-1_1498413830.jpg', 'neyiz, kimiz, neden varız', 13, '2017-06-25 18:03:50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `specifications`
--

CREATE TABLE `specifications` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `specifications`
--

INSERT INTO `specifications` (`id`, `title`, `description`, `created`) VALUES
(1, '\\Yapı\\OOP', 'Php oop yapısı sayesinde kısa zamanda modüler ve takım çalışmasına yatkın projeler, modüller ve eklentiler yazabilirsiniz. Bundle sistemi sayesinde her geliştirici projenin farklı bir noktası ile meşgul olabilir.', '2017-06-25 10:59:54'),
(2, 'CLI Tool', 'Butterfly cli aracı sayesinde bundle oluşturma, silme, kontrol etme, controller oluşturma silme ve route oluturma silm işlemleri gibi uzun sürmesi gereken işlemleri tek satır ile terminalinizden kolayca gerçekleştirebilirsiniz.', '2017-06-25 10:59:54'),
(3, 'Görsel Döküman ', 'Son derece anlaşılır, görseller ve örnekler ile desteklenmiş döküman ile kolay bir şekilde hemen öğrenip geliştirmeye başlayabilirsiniz.', '2017-06-25 10:59:54');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `last_login`) VALUES
(13, 'akin.ozgen17@gmail.com', 'Akın Özgen', 'd0a24c0cb9fa1e4ee12ef17bf9f9a1de', '2017-06-25 10:01:15'),
(18, 'akinozgen17@outlook.com', 'r0b0c0p', '6765cdc9254f720d8470e3ea2da8741c', '2017-06-25 14:18:12');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `specifications`
--
ALTER TABLE `specifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
