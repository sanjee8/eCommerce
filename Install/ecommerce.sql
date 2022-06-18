-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 18 juin 2022 à 14:42
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `category` int(11) NOT NULL,
  `image` text NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `name`, `description`, `price`, `category`, `image`, `amount`) VALUES
(18, 'Galaxy S22 Ultra', 'SAMSUNG GALAXY S22 Ultra 128Go Noir  (sans KP)', 1432, 1, 'https://www.cdiscount.com/pdt2/1/4/0/1/700x700/sam8806092879140/rw/samsung-galaxy-s22-ultra-128go-noir-sans-kp.jpg', 9),
(19, 'Xiaomi 12', 'XIAOMI 12 256 Go BLEU', 870, 1, 'https://www.cdiscount.com/pdt2/5/6/b/1/700x700/xiaomi128256b/rw/xiaomi-12-256-go-bleu.jpg', 5),
(20, 'Huawei P30 Pro', 'HUAWEI P30 Pro 128 Go Bleu Mystique', 499, 1, 'https://www.cdiscount.com/pdt2/2/8/a/1/700x700/huaweip30pro128a/rw/huawei-p30-pro-128-go-bleu-mystique.jpg', 3),
(21, 'Realme 8', 'REALME 8 128 Go Noir 5G', 189, 1, 'https://www.cdiscount.com/pdt2/2/3/5/1/700x700/rea6941399047235/rw/realme-8-128-go-noir-5g.jpg', 4),
(22, 'PC Portable Gamer 15', 'PC Portable Gamer HP Pavilion Gaming 15-ec1018nf - 15\" FHD - Ryzen 5 - RAM 8 Go - Stockage 512 Go - GTX 1650Ti - Windows 10 - AZERTY', 599.99, 2, 'https://www.cdiscount.com/pdt2/8/n/f/1/550x550/hp15ec1018nf/rw/pc-portable-gamer-hp-pavilion-gaming-15-ec1018nf.jpg', 14),
(23, 'PC Portable 17', 'PC Portable HP 17-cp0059nf - 17\" HD - Ryzen 3 - RAM 4 Go - 256 Go - Windows 10 - AZERTY + Souris sans fil HP 200 noir', 399.99, 2, 'https://www.cdiscount.com/pdt2/x/6/w/1/550x550/bunhp17cp0059x6w/rw/pc-portable-hp-17-cp0059nf-17-hd-ryzen-3-ra.jpg', 30),
(24, 'PC Gamer - Acer Predator', 'PC Gamer - ACER Predator PO3-630 Clavier & Souris - Core i5-11400F - RAM 16 Go - Stockage 512 Go SSD - RTX 3070 - Windows 10', 1514.99, 2, 'https://www.cdiscount.com/pdt2/0/0/y/1/700x700/dge2cef00y/rw/pc-gamer-acer-predator-po3-630-clavier-souris.jpg', 5),
(25, 'PC Gamer - Vibox III-47', 'Vibox III-47 PC Gamer - Intel i7 10700F - RTX 3060 12Go - 16Go RAM - 1To NVMe - Win11 - WiFi', 1299.95, 2, 'https://www.cdiscount.com/pdt2/0/8/3/1/700x700/vib5057551883083/rw/vibox-iii-47-pc-gamer-intel-i7-10700f-rtx-3060.jpg', 2),
(26, 'PC Gamer Fierce', 'FIERCE PC GAMER - AMD Ryzen 3 3200G 4GHz - AMD VEGA 8 - 16Go 3200MHz - 1TB HD - Ã‰cran 24\" LED - WLAN - Windows 10 - WiFi - USB3.0', 679.9, 2, 'https://www.cdiscount.com/pdt2/1/6/0/1/700x700/fie5059411031160/rw/fierce-rgb-gaming-pc-bundle-amd-ryzen-3-3200g-4g.jpg', 4),
(17, 'iPhone 13 Pro Max', 'APPLE iPhone 13 Pro Max 128 Go Vert Alpin', 1259, 1, 'https://www.cdiscount.com/pdt2/e/e/n/1/700x700/ip13prom128green/rw/apple-iphone-13-pro-max-128-go-vert-alpin.jpg', 10),
(27, 'PC Gamer ASUS ROG', 'PC de Bureau Gamer ASUS ROG Strix GL10CE-51140F0290 - Intel Core i5-11400F - RAM 8 Go - SSD 512 Go - NVIDIA RTX 3060 12 Go - Sans OS', 1074, 2, 'https://www.cdiscount.com/pdt2/2/9/0/1/550x550/gl10ce51140f0290/rw/pc-de-bureau-gamer-asus-rog-strix-gl10ce-51140f029.jpg', 6),
(28, 'PC Gamer Acer Nitro', 'PC Gamer - ACER Nitro N50-620 Clavier & Souris - Core i5-11400F - RAM 16 Go - Stockage 512Go SSD - RTX 3060 - Windows 10', 1099.99, 2, 'https://www.cdiscount.com/pdt2/0/0/k/1/700x700/dge2def00k/rw/pc-gamer-acer-nitro-n50-620-clavier-souris-c.jpg', 6),
(29, 'PC Tout-en-un ASUS Vivo', 'PC Tout-en-un ASUS Vivo AIO V222GAK-WA229T - 21,5\" FHD - Intel Pentium J5040 - RAM 8Go - SSD 256Go - Clavier + Souris - Windows 10', 519.99, 2, 'https://www.cdiscount.com/pdt2/2/9/t/1/550x550/v222gakwa229t/rw/pc-tout-en-un-asus-vivo-aio-v222gak-wa229t-21-5.jpg', 8),
(30, 'PC Tout-en-un ASUS Zen', 'PC Tout-en-un ASUS Zen AIO 22 A5200WFAK-WA080T - 21.5\" FHD - Core i3-10110U - RAM 8Go - SSD 256Go - Windows 10 - Clavier + Souris', 599.99, 2, 'https://www.cdiscount.com/pdt2/8/0/t/1/700x700/a5200wfakwa080t/rw/pc-tout-en-un-asus-zen-aio-22-a5200wfak-wa080t-2.jpg', 6),
(31, 'PC Tout-en-un LENOVO Ideacentre', 'Ordinateur Tout-en-un - LENOVO Ideacentre 3 27ITL6 - 27\'\' FHD - i5-1135G7 - RAM 16Go - 512Go SSD - Windows 10 + Clavier souris', 1070.6, 2, 'https://www.cdiscount.com/pdt2/p/f/r/1/700x700/f0fw001pfr/rw/ordinateur-tout-en-un-lenovo-ideacentre-3-27itl6.jpg', 30),
(32, 'Ecran PC Gamer', 'Ecran PC Gamer ASUS VG248QG 24\" - TN - FHD (1920x1080) - 165Hz - 1 ms - G-Sync - FreeSync - HDMI - DVI - DisplayPort - Noir', 179.99, 5, 'https://www.cdiscount.com/pdt2/0/1/6/1/550x550/asu4718017119016/rw/ecran-pc-gamer-asus-vg248qg-24-tn-fhd-1920x1.jpg', 5),
(33, 'Ecran PC Gamer Acer', 'Ecran PC Gamer - ACER - Nitro XV253QPbmiiprzx - 24,5\" FHD - Dalle IPS - 1 MS - 165 Hz - HDMI/Display Port 1.2/Audio - AMD FreeSync', 229.99, 5, 'https://www.cdiscount.com/pdt2/p/0/4/1/700x700/umkx3eep04/rw/ecran-pc-gamer-acer-nitro-xv253qpbmiiprzx-24.jpg', 7),
(34, 'Ecran PC Gamer IncurvÃ© VIEWSONIC', 'Ecran PC Gamer IncurvÃ© - VIEWSONIC VX3218 - PC - MHD - 32\" FHD - Dalle VA - 1 ms - 165Hz - DisplayPort - AMD FreeSync', 219.99, 5, 'https://www.cdiscount.com/pdt2/m/h/d/1/550x550/vx3218pcmhd/rw/ecran-pc-gamer-incurve-viewsonic-vx3218-pc-m.jpg', 9);

-- --------------------------------------------------------

--
-- Structure de la table `basket`
--

DROP TABLE IF EXISTS `basket`;
CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `basket`
--

INSERT INTO `basket` (`id`, `user`, `product_id`) VALUES
(20, 1, 1),
(19, 1, 3),
(22, 1, 1),
(21, 1, 1),
(16, 1, 4),
(13, 1, 1),
(17, 1, 3),
(23, 1, 32),
(24, 1, 21);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Telephones'),
(2, 'Ordinateurs'),
(5, 'Ecrans');

-- --------------------------------------------------------

--
-- Structure de la table `contraintes`
--

DROP TABLE IF EXISTS `contraintes`;
CREATE TABLE IF NOT EXISTS `contraintes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contraintes`
--

INSERT INTO `contraintes` (`id`, `action`, `value`) VALUES
(1, 'articlesOrder', 'ascPrice');

-- --------------------------------------------------------

--
-- Structure de la table `history_orders`
--

DROP TABLE IF EXISTS `history_orders`;
CREATE TABLE IF NOT EXISTS `history_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_of` int(11) NOT NULL,
  `final_price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `history_orders`
--

INSERT INTO `history_orders` (`id`, `user_id`, `date_of`, `final_price`) VALUES
(8, 1, 1655556123, 373.99);

-- --------------------------------------------------------

--
-- Structure de la table `order_articles`
--

DROP TABLE IF EXISTS `order_articles`;
CREATE TABLE IF NOT EXISTS `order_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `order_articles`
--

INSERT INTO `order_articles` (`id`, `product_id`, `order_id`, `price`) VALUES
(10, 21, 8, 189),
(9, 32, 8, 179.99);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `date_register` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `date_register`, `nom`, `prenom`, `admin`) VALUES
(1, 'test@test.fr', '$2y$10$GGtFg29k8KoWwVzfiK1scOFJCpqty78Tb9dMsK6qt37mqrAqK2AZ2', 1653074445, 'test', 'allo', 0),
(3, 'sanjeeoff@gmail.com', '$2y$10$5HnA86apJh7v./GkeSSDFOK4bcgUoC/oj7TRigqFzP.V9uaf.5Fs.', 1653134253, 'sanjee', 'testman', 0),
(4, 'test@testt.fr', '$2y$10$YTdk3ELvJqK5mrVnTJZ48ephM1nozd2XRtqC53M7ax2q2ERp5xaeu', 1653134332, 'prout', 'testman', 0),
(5, 'admin@test.fr', '$2y$10$7fqoDdBH5WEgVO1rFzXIi.CYRoRhOjlqJbOOKacWaSlICxd0X0fS.', 1654515159, 'admin', 'admin', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
