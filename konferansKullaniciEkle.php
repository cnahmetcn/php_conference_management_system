<?php
include_once ("veritabaniBaglantisi.php");
include_once ("Session.php");
include_once ("siniflar/konferansTablosuDuzenle.php");
$konferansKullaniciEkleTablo = new konferansTablosuDuzenle;

if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1 || $session->_read($_SESSION["girisKullaniciId"]) == 2) {
        $konferansGuncelleSorgu = $baglanti->prepare("SELECT konferansChair FROM konferanslar WHERE konferansId = :konferansId AND konferansSilindi = 0");
        $konferansGuncelleSorgu->bindParam(':konferansId', $_REQUEST['koGuncelle'], PDO::PARAM_STR);
        $konferansGuncelleSorgu->execute();
        $kullaniciErisim = 0;
		if($session->_read($_SESSION["girisKullaniciId"]) == 1 && $session->_read3($_SESSION["girisKullaniciId"]) == NULL) {
			$kullaniciErisim = 1;
		}
        if ($konferansGuncelleSorgu->rowCount() > 0) {
            while ($rowKonferans = $konferansGuncelleSorgu->fetch(PDO::FETCH_ASSOC)) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansChair']);
                $konferansKullanicilarkarakter = 0;
                $kullanici = NULL;
                if ($rowKonferans['konferansChair'] != NULL) {
                    foreach ($konferansKullanicilarDizi as $item) {
                        if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                            $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                        } else {
                            if ($kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                $kullaniciErisim++;
                            } else {
                                if ($kullanici == $session->_read2($_SESSION['girisKullaniciId'])) {
                                    $kullaniciErisim++;
                                }
                            }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                }
            }
        }
        if ($kullaniciErisim == 1) {
            $kaydedilecekKullaniciId[0] = $_REQUEST['kOlmayanId'];
            $kaydedilecekKullaniciRol = $_REQUEST['kOlmayanRol'];
            $kaydedilecekKonferansId = $_REQUEST['koGuncelle'];
            $kRol = array();
            $kString = NULL;
            $sorguKKaydet = $baglanti->prepare("SELECT konferansId, konferansChair, konferansAuthor, konferansReviewer, konferansReader FROM konferanslar WHERE konferansId = :konferansId");
            $sorguKKaydet->bindParam(':konferansId', $kaydedilecekKonferansId, PDO::PARAM_STR);
            $sorguKKaydet->execute();
            if ($sorguKKaydet->rowCount() > 0) {
                while ($rowKullanici = $sorguKKaydet->fetch(PDO::FETCH_ASSOC)) {
                    if ($kaydedilecekKullaniciRol == 2) {
                        $kRol = $konferansKullaniciEkleTablo->kullaniciId($rowKullanici['konferansChair'], $baglanti);
                    } else if ($kaydedilecekKullaniciRol == 3) {
                        $kRol = $konferansKullaniciEkleTablo->kullaniciId($rowKullanici['konferansAuthor'], $baglanti);
                    } else if ($kaydedilecekKullaniciRol == 4) {
                        $kRol = $konferansKullaniciEkleTablo->kullaniciId($rowKullanici['konferansReviewer'], $baglanti);
                    } else if ($kaydedilecekKullaniciRol == 5) {
                        $kRol = $konferansKullaniciEkleTablo->kullaniciId($rowKullanici['konferansReader'], $baglanti);
                    }
                }
            }
            $kSonuc = array_merge($kRol, $kaydedilecekKullaniciId);
            sort($kSonuc);

            for ($indeks = 0; $indeks < count($kSonuc); $indeks++) {
                $kString .= $kSonuc[$indeks];
                $kString .= "|";
            }
            if ($kaydedilecekKullaniciRol == 2) {
                $sorguKKaydet2 = $baglanti->prepare("UPDATE konferanslar SET konferansChair = ? WHERE konferansId = ?");
            } else if ($kaydedilecekKullaniciRol == 3) {
                $sorguKKaydet2 = $baglanti->prepare("UPDATE konferanslar SET konferansAuthor = ? WHERE konferansId = ?");
            } else if ($kaydedilecekKullaniciRol == 4) {
                $sorguKKaydet2 = $baglanti->prepare("UPDATE konferanslar SET konferansReviewer = ? WHERE konferansId = ?");
            } else if ($kaydedilecekKullaniciRol == 5) {
                $sorguKKaydet2 = $baglanti->prepare("UPDATE konferanslar SET konferansReader = ? WHERE konferansId = ?");
            }
            $sorguKKaydet2->execute(array($kString, $kaydedilecekKonferansId));
            if ($sorguKKaydet2 == TRUE)
                header("Location: index.php?sayfa=konferansKullaniciGuncelle&koGuncelle=$kaydedilecekKonferansId");
            else
                echo "Veritabanı sorgu hatası";
        }
    }
}