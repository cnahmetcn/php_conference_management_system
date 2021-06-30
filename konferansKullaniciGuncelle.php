<style>
    .konferanstable {font-family:arial, sans-serif; font-size:70%; border-collapse:collapse; width:48%; float:left; margin-right:4%;}
    .konferanstable td, .konferanstable th {border:1px solid #323232; text-align:left; padding:8px; overflow:hidden;}
    .konferanstable tr:first-child {background-color:#dddddd;}

    .konferansKullaniciEkletable {font-family:arial, sans-serif; font-size:70%; border-collapse:collapse; width:48%}
    .konferansKullaniciEkletable td, .konferansKullaniciEkletable th {border:1px solid #323232; text-align:left; padding:8px; width:auto; overflow:hidden}
    .konferansKullaniciEkletable tr:first-child {background-color:#dddddd}

    .geriButonuLink{border:1px solid #323232; border-radius:2px 2px; background-color:#323232;color:#ddd; padding:10px 20px; text-decoration:none;}
    .geriButonuLink:hover{border:1px solid #323232; background-color:#ddd; color:#323232;}
</style>
<?php
include("veritabaniBaglantisi.php");
include_once ("Session.php");
include_once ("siniflar/konferansTablosuDuzenle.php");
$kullaniciTablosu = new konferansTablosuDuzenle;
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1 || $session->_read($_SESSION["girisKullaniciId"]) == 2) {
        if (@($_SESSION['konferansTabloSirala3'] != 2 && $_SESSION['konferansTabloSirala3'] != 22 && $_SESSION['konferansTabloSirala3'] != 3 && $_SESSION['konferansTabloSirala3'] != 33 && $_SESSION['konferansTabloSirala3'] != 4 && $_SESSION['konferansTabloSirala3'] != 44)) {
            $_SESSION['konferansTabloSirala3'] = 2;
        }
        if (@($_SESSION['konferansTabloSirala4'] != 5 && $_SESSION['konferansTabloSirala4'] != 55 && $_SESSION['konferansTabloSirala4'] != 6 && $_SESSION['konferansTabloSirala4'] != 66 && $_SESSION['konferansTabloSirala4'] != 7 && $_SESSION['konferansTabloSirala4'] != 77)) {
            $_SESSION['konferansTabloSirala4'] = 5;
        }
        if (@($_SESSION['siralamaTuru3'] != 1 && $_SESSION['siralamaTuru3'] != 2 && $_SESSION['siralamaTuru3'] != 3)) {
            $_SESSION['siralamaTuru3'] = 0;
        }
        if (@($_SESSION['siralamaTuru4'] != 1 && $_SESSION['siralamaTuru4'] != 2 && $_SESSION['siralamaTuru4'] != 3)) {
            $_SESSION['siralamaTuru4'] = 0;
        }
        if (@$_GET['s'] == '2') {
            if ($_SESSION['konferansTabloSirala3'] != 2) {
                $_SESSION['konferansTabloSirala3'] = 2;
                $_SESSION['siralamaTuru3'] = 1;
            } else {
                $_SESSION['konferansTabloSirala3'] = 22;
                $_SESSION['siralamaTuru3'] = 1;
            }
            header("Location: index.php?sayfa=konferansKullaniciGuncelle&koGuncelle=$_SESSION[koGuncelle]");
        } else if (@$_GET['s'] == '3') {
            if ($_SESSION['konferansTabloSirala3'] != 3) {
                $_SESSION['konferansTabloSirala3'] = 3;
                $_SESSION['siralamaTuru3'] = 1;
            } else {
                $_SESSION['konferansTabloSirala3'] = 33;
                $_SESSION['siralamaTuru3'] = 1;
            }
            header("Location: index.php?sayfa=konferansKullaniciGuncelle&koGuncelle=$_SESSION[koGuncelle]");
        } else if (@$_GET['s'] == '4') {
            if ($_SESSION['konferansTabloSirala3'] != 4) {
                $_SESSION['konferansTabloSirala3'] = 4;
                $_SESSION['siralamaTuru3'] = 1;
            } else {
                $_SESSION['konferansTabloSirala3'] = 44;
                $_SESSION['siralamaTuru3'] = 1;
            }
            header("Location: index.php?sayfa=konferansKullaniciGuncelle&koGuncelle=$_SESSION[koGuncelle]");
        } else if (@$_GET['s'] == '5') {
            if ($_SESSION['konferansTabloSirala4'] != 5) {
                $_SESSION['konferansTabloSirala4'] = 5;
                $_SESSION['siralamaTuru4'] = 1;
            } else {
                $_SESSION['konferansTabloSirala4'] = 55;
                $_SESSION['siralamaTuru4'] = 1;
            }
            header("Location: index.php?sayfa=konferansKullaniciGuncelle&koGuncelle=$_SESSION[koGuncelle]");
        } else if (@$_GET['s'] == '6') {
            if ($_SESSION['konferansTabloSirala4'] != 6) {
                $_SESSION['konferansTabloSirala4'] = 6;
                $_SESSION['siralamaTuru4'] = 1;
            } else {
                $_SESSION['konferansTabloSirala4'] = 66;
                $_SESSION['siralamaTuru4'] = 1;
            }
            header("Location: index.php?sayfa=konferansKullaniciGuncelle&koGuncelle=$_SESSION[koGuncelle]");
        } else if (@$_GET['s'] == '7') {
            if ($_SESSION['konferansTabloSirala4'] != 7) {
                $_SESSION['konferansTabloSirala4'] = 7;
                $_SESSION['siralamaTuru4'] = 1;
            } else {
                $_SESSION['konferansTabloSirala4'] = 77;
                $_SESSION['siralamaTuru4'] = 1;
            }
            header("Location: index.php?sayfa=konferansKullaniciGuncelle&koGuncelle=$_SESSION[koGuncelle]");
        }

        if (@$session->_read($_SESSION["girisKullaniciId"]) == 1 && ($session->_read3($_SESSION["girisKullaniciId"]) == NULL || $session->_read4($_SESSION["girisKullaniciId"]) == NULL)) {
            $chairSayisi = 1;
            $konferansIsmi = NULL;
            $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair, konferansAuthor, konferansReviewer, konferansReader FROM konferanslar WHERE konferansId = :konferansId");
            $sorgu->bindParam(':konferansId', $_REQUEST['koGuncelle'], PDO::PARAM_STR);
            $sorgu->execute();
            if ($sorgu->rowCount() > 0) {
                while ($rowKullanici = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    $chairSayisi = $kullaniciTablosu->kullaniciSayisi($rowKullanici['konferansChair'], $baglanti);
                    $konferansIsmi = $rowKullanici['konferansIsim'];
                }
            }
            $_SESSION['koGuncelle'] = $_REQUEST['koGuncelle'];
            $konferansGuncellenenId = $_REQUEST['koGuncelle'];
            echo "<a href='index.php?sayfa=konferanslar' class='geriButonuLink'>Geri</a>";
            echo "<a style='margin-left:50px; border:1px solid #323232; border-radius:2px 2px; background-color:#323232; color:#ddd; padding:10px 25px'>" . $konferansIsmi . "</a><br/><br/>";
            echo "<table class='konferanstable'>";
            echo "<tr>";
            echo "<th colspan='5' style='text-align:center'>KAYITLI KULLANICILAR</th>";
            echo "</tr>";
            echo "<tr>";
            echo "<th style='background-color:#dddddd'>ROLLER</th>";
            echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=2'>Kullanıcı Adı</a></th>";
            echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=3'>İsim</a></th>";
            echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=4'>Soyisim</a></th>";
            echo "<th style='background-color:#dddddd'></th>";
            echo "</tr>";
            echo "<tr>";
            echo "<th rowspan=\"$chairSayisi\" style='background-color:#dddddd'>CHAIR</th>";
            echo "</tr>";
            $sorgu->execute();
            if ($sorgu->rowCount() > 0) {
                while ($rowKullanici = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    $siralamaTur = $_SESSION['siralamaTuru3'];
                    echo $kullaniciTablosu->kullaniciKonferansGuncelle($rowKullanici['konferansChair'], $baglanti, $session->_read2($_SESSION['girisKullaniciId']), $_SESSION['konferansTabloSirala3'], $siralamaTur, $konferansGuncellenenId);
                    --$siralamaTur;
                }
            }
            echo "</table>";


            $kayitliKullanicilar = array();
            $kayitliOlmayanKullanicilarAd = array();
            $kayitliOlmayanKullanicilarIsim1 = array();
            $kayitliOlmayanKullanicilarSoyisim = array();
            $kayitliOlmayanKullanicilarId = array();
            $kayitliOlmayanKullanicilarRol = array();
            $kChair = array();
            $kAuthor = array();
            $kReader = array();
            $kViewer = array();
            $kullanicikarakteri = 0;
            $eslesti = 0;
            $sorguKOlan = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair, konferansAuthor, konferansReviewer, konferansReader FROM konferanslar WHERE konferansId = :konferansId");
            $sorguKOlan->bindParam(':konferansId', $_REQUEST['koGuncelle'], PDO::PARAM_STR);
            $sorguKOlan->execute();
            if ($sorguKOlan->rowCount() > 0) {
                while ($rowKullanici = $sorguKOlan->fetch(PDO::FETCH_ASSOC)) {
                    $kChair = $kullaniciTablosu->kullaniciId($rowKullanici['konferansChair'], $baglanti);
                    $kAuthor = $kullaniciTablosu->kullaniciId($rowKullanici['konferansAuthor'], $baglanti);
                    $kReader = $kullaniciTablosu->kullaniciId($rowKullanici['konferansReviewer'], $baglanti);
                    $kViewer = $kullaniciTablosu->kullaniciId($rowKullanici['konferansReader'], $baglanti);
                }
            }
            $kayitliKullanicilar = array_merge($kChair, $kAuthor, $kReader, $kViewer);
            sort($kayitliKullanicilar);
            $sorguKOlan2 = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciRol FROM kullanicilar");
            $sorguKOlan2->execute();
            if ($sorguKOlan2->rowCount() > 0) {
                while ($rowKullanici = $sorguKOlan2->fetch(PDO::FETCH_ASSOC)) {
                    if ($kayitliKullanicilar != NULL || $rowKullanici['kullaniciRol'] != 1) {
                        for ($indeks = 0; $indeks < count($kayitliKullanicilar); $indeks++) {
                            if ($rowKullanici['kullaniciId'] == $kayitliKullanicilar[$indeks] || $rowKullanici['kullaniciRol'] == 1) {
                                $eslesti++;
                            }
                        }
                    } else
                        $eslesti++;
                    if ($eslesti == 0) {
                        $kayitliOlmayanKullanicilarAd[$kullanicikarakteri] = $rowKullanici['kullaniciAd'];
                        $kayitliOlmayanKullanicilarIsim1[$kullanicikarakteri] = $rowKullanici['kullaniciIsim1'];
                        $kayitliOlmayanKullanicilarSoyisim[$kullanicikarakteri] = $rowKullanici['kullaniciSoyisim'];
                        $kayitliOlmayanKullanicilarId[$kullanicikarakteri] = $rowKullanici['kullaniciId'];
                        $kayitliOlmayanKullanicilarRol[$kullanicikarakteri] = $rowKullanici['kullaniciRol'];
                        $kullanicikarakteri++;
                    }
                    $eslesti = 0;
                }
            }
            $kayitliOlmayanChairSayisi = 1;
            $kayitliOlmayanAuthorSayisi = 1;
            $kayitliOlmayanReaderSayisi = 1;
            $kayitliOlmayanViewerSayisi = 1;
            foreach ($kayitliOlmayanKullanicilarRol as $item) {
                if ($item == 2)
                    ++$kayitliOlmayanChairSayisi;
                else if ($item == 3)
                    ++$kayitliOlmayanAuthorSayisi;
                else if ($item == 4)
                    ++$kayitliOlmayanReaderSayisi;
                else if ($item == 5)
                    ++$kayitliOlmayanViewerSayisi;
            }
            array_multisort($kayitliOlmayanKullanicilarId, SORT_ASC, $kayitliOlmayanKullanicilarRol);
            echo "<table class='konferansKullaniciEkletable'>";
            echo "<tr>";
            echo "<th colspan='5' style='text-align:center'>KAYITLI OLMAYAN KULLANICILAR</th>";
            echo "</tr>";
            echo "<tr>";
            echo "<th style='background-color:#dddddd'>ROLLER</th>";
            echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=5'>Kullanıcı Adı</a></th>";
            echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=6'>İsim</a></th>";
            echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=7'>Soyisim</a></th>";
            echo "<th style='background-color:#dddddd'></th>";
            echo "</tr>";
            $siralamaTur4 = $_SESSION['siralamaTuru4'];
            echo $kullaniciTablosu->kullaniciKonferansKayitliOlmayan($kayitliOlmayanChairSayisi, $kayitliOlmayanKullanicilarRol, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, "CHAIR", 2, $_SESSION['konferansTabloSirala4'], $siralamaTur4, $konferansGuncellenenId);
            echo "</table>";


        } else if (@$session->_read($_SESSION["girisKullaniciId"]) == 2 || ($session->_read3($_SESSION["girisKullaniciId"]) == 2 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
            $konferansGuncelleSorgu = $baglanti->prepare("SELECT konferansChair FROM konferanslar WHERE konferansId = :konferansId AND konferansSilindi = 0");
            $konferansGuncelleSorgu->bindParam(':konferansId', $_REQUEST['koGuncelle'], PDO::PARAM_STR);
            $konferansGuncelleSorgu->execute();
            $kullaniciErisim = 0;
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
                                }
                                else {
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

                $chairSayisi = 1;
                $readerSayisi = 1;
                $authorSayisi = 1;
                $viewerSayisi = 1;
                $konferansIsmi = NULL;
                $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair, konferansAuthor, konferansReviewer, konferansReader FROM konferanslar WHERE konferansId = :konferansId");
                $sorgu->bindParam(':konferansId', $_REQUEST['koGuncelle'], PDO::PARAM_STR);
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanici = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $chairSayisi = $kullaniciTablosu->kullaniciSayisi($rowKullanici['konferansChair'], $baglanti);
                        $authorSayisi = $kullaniciTablosu->kullaniciSayisi($rowKullanici['konferansAuthor'], $baglanti);
                        $readerSayisi = $kullaniciTablosu->kullaniciSayisi($rowKullanici['konferansReviewer'], $baglanti);
                        $viewerSayisi = $kullaniciTablosu->kullaniciSayisi($rowKullanici['konferansReader'], $baglanti);
                        $konferansIsmi = $rowKullanici['konferansIsim'];
                    }
                }
                if ($chairSayisi > 2)
                    $chairSayisi -= 1;
                $_SESSION['koGuncelle'] = $_REQUEST['koGuncelle'];
                $konferansGuncellenenId = $_REQUEST['koGuncelle'];
                echo "<a href='index.php?sayfa=konferanslar' class='geriButonuLink'>Geri</a>";
                echo "<a style='margin-left:50px; border:1px solid #323232; border-radius:2px 2px; background-color:#323232; color:#ddd; padding:10px'>" . $konferansIsmi . "</a><br/><br/>";
                echo "<table class='konferanstable'>";
                echo "<tr>";
                echo "<th colspan='5' style='text-align:center'>KAYITLI KULLANICILAR</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th style='background-color:#dddddd'>ROLLER</th>";
                echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=2'>Kullanıcı Adı</a></th>";
                echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=3'>İsim</a></th>";
                echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=4'>Soyisim</a></th>";
                echo "<th style='background-color:#dddddd'></th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th rowspan=\"$chairSayisi\" style='background-color:#dddddd'>CHAIR</th>";
                echo "</tr>";
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanici = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $siralamaTur = $_SESSION['siralamaTuru3'];
                        if ($session->_read4($_SESSION['girisKullaniciId']) != NULL) {
                            $kullanici = $session->_read4($_SESSION['girisKullaniciId']);
                        } else {
                            $kullanici = $session->_read2($_SESSION['girisKullaniciId']);
                        }
                        echo $kullaniciTablosu->kullaniciKonferansGuncelle($rowKullanici['konferansChair'], $baglanti, $kullanici, $_SESSION['konferansTabloSirala3'], $siralamaTur, $konferansGuncellenenId);
                        --$siralamaTur;
                    }
                }
                echo "<tr>";
                echo "<th rowspan=\"$authorSayisi\" style='background-color:#dddddd'>AUTHOR</th>";
                echo "</tr>";
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanici = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $siralamaTur = $_SESSION['siralamaTuru3'];
                        if ($session->_read4($_SESSION['girisKullaniciId']) != NULL) {
                            $kullanici = $session->_read4($_SESSION['girisKullaniciId']);
                        } else {
                            $kullanici = $session->_read2($_SESSION['girisKullaniciId']);
                        }
                        echo $kullaniciTablosu->kullaniciKonferansGuncelle($rowKullanici['konferansAuthor'], $baglanti, $kullanici, $_SESSION['konferansTabloSirala3'], $siralamaTur, $konferansGuncellenenId);
                        --$siralamaTur;
                    }
                }
                echo "<tr>";
                echo "<th rowspan=\"$readerSayisi\" style='background-color:#dddddd'>REVIEWER</th>";
                echo "</tr>";
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanici = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $siralamaTur = $_SESSION['siralamaTuru3'];
                        if ($session->_read4($_SESSION['girisKullaniciId']) != NULL) {
                            $kullanici = $session->_read4($_SESSION['girisKullaniciId']);
                        } else {
                            $kullanici = $session->_read2($_SESSION['girisKullaniciId']);
                        }
                        echo $kullaniciTablosu->kullaniciKonferansGuncelle($rowKullanici['konferansReviewer'], $baglanti, $kullanici, $_SESSION['konferansTabloSirala3'], $siralamaTur, $konferansGuncellenenId);
                        --$siralamaTur;
                    }
                }
                echo "<tr>";
                echo "<th rowspan=\"$viewerSayisi\" style='background-color:#dddddd'>READER</th>";
                echo "</tr>";
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanici = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $siralamaTur = $_SESSION['siralamaTuru3'];
                        if ($session->_read4($_SESSION['girisKullaniciId']) != NULL) {
                            $kullanici = $session->_read4($_SESSION['girisKullaniciId']);
                        } else {
                            $kullanici = $session->_read2($_SESSION['girisKullaniciId']);
                        }
                        echo $kullaniciTablosu->kullaniciKonferansGuncelle($rowKullanici['konferansReader'], $baglanti, $kullanici, $_SESSION['konferansTabloSirala3'], $siralamaTur, $konferansGuncellenenId);
                        --$siralamaTur;
                    }
                }
                echo "</table>";


                $kayitliKullanicilar = array();
                $kayitliOlmayanKullanicilarAd = array();
                $kayitliOlmayanKullanicilarIsim1 = array();
                $kayitliOlmayanKullanicilarSoyisim = array();
                $kayitliOlmayanKullanicilarId = array();
                $kayitliOlmayanKullanicilarRol = array();
                $kChair = array();
                $kAuthor = array();
                $kReader = array();
                $kViewer = array();
                $kullanicikarakteri = 0;
                $eslesti = 0;
                $sorguKOlan = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair, konferansAuthor, konferansReviewer, konferansReader FROM konferanslar WHERE konferansId = :konferansId");
                $sorguKOlan->bindParam(':konferansId', $_REQUEST['koGuncelle'], PDO::PARAM_STR);
                $sorguKOlan->execute();
                if ($sorguKOlan->rowCount() > 0) {
                    while ($rowKullanici = $sorguKOlan->fetch(PDO::FETCH_ASSOC)) {
                        $kChair = $kullaniciTablosu->kullaniciId($rowKullanici['konferansChair'], $baglanti);
                        $kAuthor = $kullaniciTablosu->kullaniciId($rowKullanici['konferansAuthor'], $baglanti);
                        $kReader = $kullaniciTablosu->kullaniciId($rowKullanici['konferansReviewer'], $baglanti);
                        $kViewer = $kullaniciTablosu->kullaniciId($rowKullanici['konferansReader'], $baglanti);
                    }
                }
                $kayitliKullanicilar = array_merge($kChair, $kAuthor, $kReader, $kViewer);
                sort($kayitliKullanicilar);
                $sorguKOlan2 = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciRol FROM kullanicilar");
                $sorguKOlan2->execute();
                if ($sorguKOlan2->rowCount() > 0) {
                    while ($rowKullanici = $sorguKOlan2->fetch(PDO::FETCH_ASSOC)) {
                        if ($kayitliKullanicilar != NULL || $rowKullanici['kullaniciRol'] != 1) {
                            for ($indeks = 0; $indeks < count($kayitliKullanicilar); $indeks++) {
                                if ($rowKullanici['kullaniciId'] == $kayitliKullanicilar[$indeks] || $rowKullanici['kullaniciRol'] == 1) {
                                    $eslesti++;
                                }
                            }
                        } else
                            $eslesti++;
                        if ($eslesti == 0) {
                            $kayitliOlmayanKullanicilarAd[$kullanicikarakteri] = $rowKullanici['kullaniciAd'];
                            $kayitliOlmayanKullanicilarIsim1[$kullanicikarakteri] = $rowKullanici['kullaniciIsim1'];
                            $kayitliOlmayanKullanicilarSoyisim[$kullanicikarakteri] = $rowKullanici['kullaniciSoyisim'];
                            $kayitliOlmayanKullanicilarId[$kullanicikarakteri] = $rowKullanici['kullaniciId'];
                            $kayitliOlmayanKullanicilarRol[$kullanicikarakteri] = $rowKullanici['kullaniciRol'];
                            $kullanicikarakteri++;
                        }
                        $eslesti = 0;
                    }
                }
                $kayitliOlmayanChairSayisi = 1;
                $kayitliOlmayanAuthorSayisi = 1;
                $kayitliOlmayanReaderSayisi = 1;
                $kayitliOlmayanViewerSayisi = 1;
                foreach ($kayitliOlmayanKullanicilarRol as $item) {
                    if ($item == 2)
                        ++$kayitliOlmayanChairSayisi;
                    else if ($item == 3)
                        ++$kayitliOlmayanAuthorSayisi;
                    else if ($item == 4)
                        ++$kayitliOlmayanReaderSayisi;
                    else if ($item == 5)
                        ++$kayitliOlmayanViewerSayisi;
                }
                array_multisort($kayitliOlmayanKullanicilarId, SORT_ASC, $kayitliOlmayanKullanicilarRol);
                echo "<table class='konferansKullaniciEkletable'>";
                echo "<tr>";
                echo "<th colspan='5' style='text-align:center'>KAYITLI OLMAYAN KULLANICILAR</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th style='background-color:#dddddd'>ROLLER</th>";
                echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=5'>Kullanıcı Adı</a></th>";
                echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=6'>İsim</a></th>";
                echo "<th style='background-color:#dddddd'><a href='index.php?sayfa=konferansKullaniciGuncelle&s=7'>Soyisim</a></th>";
                echo "<th style='background-color:#dddddd'></th>";
                echo "</tr>";
                $siralamaTur4 = $_SESSION['siralamaTuru4'];
                echo $kullaniciTablosu->kullaniciKonferansKayitliOlmayan($kayitliOlmayanChairSayisi, $kayitliOlmayanKullanicilarRol, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, "CHAIR", 2, $_SESSION['konferansTabloSirala4'], $siralamaTur4, $konferansGuncellenenId);
                echo $kullaniciTablosu->kullaniciKonferansKayitliOlmayan($kayitliOlmayanAuthorSayisi, $kayitliOlmayanKullanicilarRol, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, "AUTHOR", 3, $_SESSION['konferansTabloSirala4'], $siralamaTur4, $konferansGuncellenenId);
                echo $kullaniciTablosu->kullaniciKonferansKayitliOlmayan($kayitliOlmayanReaderSayisi, $kayitliOlmayanKullanicilarRol, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, "REVIEWER", 4, $_SESSION['konferansTabloSirala4'], $siralamaTur4, $konferansGuncellenenId);
                echo $kullaniciTablosu->kullaniciKonferansKayitliOlmayan($kayitliOlmayanViewerSayisi, $kayitliOlmayanKullanicilarRol, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, "READER", 5, $_SESSION['konferansTabloSirala4'], $siralamaTur4, $konferansGuncellenenId);
                echo "</table>";
            }

        }
    } else {
        echo "Erişim engellendi.";
    }
} else {
    echo "Giriş yapınız.";
}

?>