-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Haz 2017, 22:31:36
-- Sunucu sürümü: 5.7.14
-- PHP Sürümü: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `konferansyonetimsistemi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `emailler`
--

CREATE TABLE `emailler` (
  `emailId` int(11) NOT NULL,
  `gonderenId` int(11) NOT NULL,
  `alanId` int(11) NOT NULL,
  `emailKonu` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `emailTitle` text COLLATE utf8_turkish_ci NOT NULL,
  `emailTarih` int(10) UNSIGNED NOT NULL,
  `emailOkundu` char(1) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `emailSilindi` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `emailler`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `konferanslar`
--

CREATE TABLE `konferanslar` (
  `konferansId` int(11) NOT NULL,
  `konferansAd` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `konferansIsim` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `konferansChair` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `konferansAuthor` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `konferansReviewer` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `konferansReader` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `konferansSilindi` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `konferanslar`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `konferanslarbilgi`
--

CREATE TABLE `konferanslarbilgi` (
  `konferansBilgiId` int(11) NOT NULL,
  `konferansId` int(11) DEFAULT NULL,
  `konferansAd` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `konferansTanim` text COLLATE utf8_turkish_ci,
  `konferansTarih` text COLLATE utf8_turkish_ci,
  `konferansKonum` text COLLATE utf8_turkish_ci,
  `konferansIletisim` text COLLATE utf8_turkish_ci,
  `konferansIlkTarih` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `konferansSonTarih` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `konferansSubmissionIlkTarih` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `konferansSubmissionSonTarih` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `konferansErisim` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `konferanslarbilgi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kullaniciId` int(11) NOT NULL,
  `kullaniciAd` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciSifre` varchar(2000) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciIsim1` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciIsim2` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kullaniciSoyisim` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciCinsiyet` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kullaniciMail` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciWebsite` varchar(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kullaniciTelefon` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kullaniciAdres` varchar(500) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kullaniciUniversite` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kullaniciUnvan` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kullaniciBiyografi` text COLLATE utf8_turkish_ci,
  `kullaniciRol` int(1) NOT NULL DEFAULT '6',
  `kullaniciKey` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `kullaniciSilindi` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reviewler`
--

CREATE TABLE `reviewler` (
  `reviewId` int(11) NOT NULL,
  `reviewYorum` text COLLATE utf8_turkish_ci,
  `reviewPuan` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `reviewToplamPuan` float DEFAULT NULL,
  `reviewerId` int(11) DEFAULT NULL,
  `submissionId` int(11) DEFAULT NULL,
  `konferansId` int(11) DEFAULT NULL,
  `reviewTarih` int(11) UNSIGNED DEFAULT NULL,
  `submissionDegisti` int(1) NOT NULL DEFAULT '0',
  `reviewSilindi` char(1) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `reviewler`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `access` int(10) UNSIGNED DEFAULT NULL,
  `lastaccess` int(10) UNSIGNED DEFAULT NULL,
  `data` text COLLATE utf8_turkish_ci,
  `data2` text COLLATE utf8_turkish_ci,
  `data3` text COLLATE utf8_turkish_ci,
  `data4` text COLLATE utf8_turkish_ci,
  `ip` varchar(32) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sessions`
--

INSERT INTO `sessions` (`id`, `access`, `lastaccess`, `data`, `data2`, `data3`, `data4`, `ip`) VALUES
(10, 1497433836, 1497523836, '1', '10', '2', '31', '::1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `submissionlar`
--

CREATE TABLE `submissionlar` (
  `submissionId` int(11) NOT NULL,
  `submissionAd` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `submissionTur` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `submissionBoyut` int(250) DEFAULT NULL,
  `submissionMd5` text COLLATE utf8_turkish_ci NOT NULL,
  `submissionTitle` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL,
  `submissionAbstract` text COLLATE utf8_turkish_ci,
  `submissionKeyword` text COLLATE utf8_turkish_ci,
  `submissionTarih` int(10) UNSIGNED DEFAULT NULL,
  `submissionKabul` char(1) COLLATE utf8_turkish_ci DEFAULT '0',
  `submissionYorumId` int(11) DEFAULT NULL,
  `submissionYorum` text COLLATE utf8_turkish_ci,
  `kullaniciId` int(11) NOT NULL,
  `konferansId` int(11) NOT NULL,
  `submissionSilindi` char(1) COLLATE utf8_turkish_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `submissionlar`
--

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `emailler`
--
ALTER TABLE `emailler`
  ADD PRIMARY KEY (`emailId`);

--
-- Tablo için indeksler `konferanslar`
--
ALTER TABLE `konferanslar`
  ADD PRIMARY KEY (`konferansId`),
  ADD UNIQUE KEY `konferansAd` (`konferansAd`);

--
-- Tablo için indeksler `konferanslarbilgi`
--
ALTER TABLE `konferanslarbilgi`
  ADD PRIMARY KEY (`konferansBilgiId`),
  ADD UNIQUE KEY `konferansAd` (`konferansAd`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kullaniciId`),
  ADD UNIQUE KEY `kullaniciAd` (`kullaniciAd`),
  ADD UNIQUE KEY `kullaniciMail` (`kullaniciMail`);

--
-- Tablo için indeksler `reviewler`
--
ALTER TABLE `reviewler`
  ADD PRIMARY KEY (`reviewId`);

--
-- Tablo için indeksler `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `submissionlar`
--
ALTER TABLE `submissionlar`
  ADD PRIMARY KEY (`submissionId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `emailler`
--
ALTER TABLE `emailler`
  MODIFY `emailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- Tablo için AUTO_INCREMENT değeri `konferanslar`
--
ALTER TABLE `konferanslar`
  MODIFY `konferansId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Tablo için AUTO_INCREMENT değeri `konferanslarbilgi`
--
ALTER TABLE `konferanslarbilgi`
  MODIFY `konferansBilgiId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kullaniciId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Tablo için AUTO_INCREMENT değeri `reviewler`
--
ALTER TABLE `reviewler`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `submissionlar`
--
ALTER TABLE `submissionlar`
  MODIFY `submissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
