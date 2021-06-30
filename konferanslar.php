<style>
    .konferansEkleLink{border:1px solid #323232; border-radius:2px 2px; background-color:#323232; color:#ddd; padding:10px; text-decoration:none;}
    .konferansEkleLink:hover{border:1px solid #323232; background-color:#ddd; color:#323232;}

    .konferanstable {font-family:aria, sans-serif; font-size:85%; border-collapse:collapse; width:100%;}
    .konferanstable td, .konferanstable th {border:1px solid #323232; text-align:left; padding:5px; width:auto; overflow:hidden;}
    .konferanstable tr:hover {background-color: #323232; color: #ddd;}
    .konferanstable tr:hover a{color:#ddd; text-decoration:none}
    .konferanstable tr:first-child {background-color:#ddd; word-wrap:break-word}
    .konferanstable tr:nth-child(2) {background-color:#ddd}
    .konferanstable tr:first-child:hover {background-color:#ddd;}
    .konferanstable tr:nth-child(2):hover {background-color:#ddd;}
    .konferanstable tr:first-child:hover a:link{color:#0000EE; text-decoration:underline}
    .konferanstable tr:first-child:hover a:visited{color:#551A8B; text-decoration:underline}
    .konferanstable tr:nth-child(2):hover a:link{color:#0000EE; text-decoration:underline}
    .konferanstable tr:nth-child(2):hover a:visited{color:#551A8B; text-decoration:underline}

    .konferanstable2 {font-family:aria, sans-serif; font-size:85%; border-collapse:collapse; width:100%;}
    .konferanstable2 td, .konferanstable2 th {border:1px solid #323232; text-align:left; padding:10px; width:auto; overflow:hidden;}
    .konferanstable2 tr:hover {background-color: #323232; color: #ddd;}
    .konferanstable2 tr:hover a{color:#ddd; text-decoration:none}
    .konferanstable2 tr:first-child {background-color:#ddd; word-wrap:break-word}
    .konferanstable2 tr:first-child:hover {background-color:#ddd;}
    .konferanstable2 tr:first-child:hover a:link{color:#0000EE; text-decoration:underline}
    .konferanstable2 tr:first-child:hover a:visited{color:#551A8B; text-decoration:underline}

</style>
<?php
include("veritabaniBaglantisi.php");
include_once ("Session.php");
include_once ("siniflar/konferansTablosuDuzenle.php");
$kullaniciTablosu = new konferansTablosuDuzenle;
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1 || $session->_read($_SESSION["girisKullaniciId"]) == 2 || $session->_read($_SESSION["girisKullaniciId"]) == 3 || $session->_read($_SESSION["girisKullaniciId"]) == 4) {
        if (@($_SESSION['konferansTabloSirala'] != 2 && $_SESSION['konferansTabloSirala'] != 22 && $_SESSION['konferansTabloSirala'] != 3 && $_SESSION['konferansTabloSirala'] != 33 && $_SESSION['konferansTabloSirala'] != 4 && $_SESSION['konferansTabloSirala'] != 44 && $_SESSION['konferansTabloSirala'] != 5 && $_SESSION['konferansTabloSirala'] != 55 && $_SESSION['konferansTabloSirala'] != 6 && $_SESSION['konferansTabloSirala'] != 66 && $_SESSION['konferansTabloSirala'] != 7 && $_SESSION['konferansTabloSirala'] != 77 && $_SESSION['konferansTabloSirala'] != 8 && $_SESSION['konferansTabloSirala'] != 88 && $_SESSION['konferansTabloSirala'] != 9 && $_SESSION['konferansTabloSirala'] != 99 && $_SESSION['konferansTabloSirala'] != 10 && $_SESSION['konferansTabloSirala'] != 100 && $_SESSION['konferansTabloSirala'] != 11 && $_SESSION['konferansTabloSirala'] != 111 && $_SESSION['konferansTabloSirala'] != 12 && $_SESSION['konferansTabloSirala'] != 122 && $_SESSION['konferansTabloSirala'] != 13 && $_SESSION['konferansTabloSirala'] != 133)) {
            $_SESSION['konferansTabloSirala'] = 2;
        }
        if (@($_SESSION['konferansTabloSirala2'] != 1 && $_SESSION['konferansTabloSirala2'] != 11)) {
            $_SESSION['konferansTabloSirala2'] = 1;
        }
        if (@($_SESSION['siralamaTuru'] != 1 && $_SESSION['siralamaTuru'] != 2 && $_SESSION['siralamaTuru'] != 3 && $_SESSION['siralamaTuru'] != 4)) {
            $_SESSION['siralamaTuru'] = 0;
        }
        if (@$_GET['s'] == '1') {
            if ($_SESSION['konferansTabloSirala2'] != 11)
                $_SESSION['konferansTabloSirala2'] = 11;
            else
                $_SESSION['konferansTabloSirala2'] = 1;
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '2') {
            if ($_SESSION['konferansTabloSirala'] != 22) {
                $_SESSION['konferansTabloSirala'] = 22;
                $_SESSION['siralamaTuru'] = 1;
            } else {
                $_SESSION['konferansTabloSirala'] = 2;
                $_SESSION['siralamaTuru'] = 1;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '3') {
            if ($_SESSION['konferansTabloSirala'] != 33) {
                $_SESSION['konferansTabloSirala'] = 33;
                $_SESSION['siralamaTuru'] = 1;
            } else {
                $_SESSION['konferansTabloSirala'] = 3;
                $_SESSION['siralamaTuru'] = 1;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '4') {
            if ($_SESSION['konferansTabloSirala'] != 44) {
                $_SESSION['konferansTabloSirala'] = 44;
                $_SESSION['siralamaTuru'] = 1;
            } else {
                $_SESSION['konferansTabloSirala'] = 4;
                $_SESSION['siralamaTuru'] = 1;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '5') {
            if ($_SESSION['konferansTabloSirala'] != 55) {
                $_SESSION['konferansTabloSirala'] = 55;
                $_SESSION['siralamaTuru'] = 2;
            } else {
                $_SESSION['konferansTabloSirala'] = 5;
                $_SESSION['siralamaTuru'] = 2;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '6') {
            if ($_SESSION['konferansTabloSirala'] != 66) {
                $_SESSION['konferansTabloSirala'] = 66;
                $_SESSION['siralamaTuru'] = 2;
            } else {
                $_SESSION['konferansTabloSirala'] = 6;
                $_SESSION['siralamaTuru'] = 2;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '7') {
            if ($_SESSION['konferansTabloSirala'] != 77) {
                $_SESSION['konferansTabloSirala'] = 77;
                $_SESSION['siralamaTuru'] = 2;
            } else {
                $_SESSION['konferansTabloSirala'] = 7;
                $_SESSION['siralamaTuru'] = 2;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '8') {
            if ($_SESSION['konferansTabloSirala'] != 88) {
                $_SESSION['konferansTabloSirala'] = 88;
                $_SESSION['siralamaTuru'] = 3;
            } else {
                $_SESSION['konferansTabloSirala'] = 8;
                $_SESSION['siralamaTuru'] = 3;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '9') {
            if ($_SESSION['konferansTabloSirala'] != 99) {
                $_SESSION['konferansTabloSirala'] = 99;
                $_SESSION['siralamaTuru'] = 3;
            } else {
                $_SESSION['konferansTabloSirala'] = 9;
                $_SESSION['siralamaTuru'] = 3;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '10') {
            if ($_SESSION['konferansTabloSirala'] != 100) {
                $_SESSION['konferansTabloSirala'] = 100;
                $_SESSION['siralamaTuru'] = 3;
            } else {
                $_SESSION['konferansTabloSirala'] = 10;
                $_SESSION['siralamaTuru'] = 3;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '9') {
            if ($_SESSION['konferansTabloSirala'] != 111) {
                $_SESSION['konferansTabloSirala'] = 111;
                $_SESSION['siralamaTuru'] = 4;
            } else {
                $_SESSION['konferansTabloSirala'] = 11;
                $_SESSION['siralamaTuru'] = 4;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '9') {
            if ($_SESSION['konferansTabloSirala'] != 122) {
                $_SESSION['konferansTabloSirala'] = 122;
                $_SESSION['siralamaTuru'] = 4;
            } else {
                $_SESSION['konferansTabloSirala'] = 12;
                $_SESSION['siralamaTuru'] = 4;
            }
            header("Location: index.php?sayfa=konferanslar");
        } else if (@$_GET['s'] == '9') {
            if ($_SESSION['konferansTabloSirala'] != 133) {
                $_SESSION['konferansTabloSirala'] = 133;
                $_SESSION['siralamaTuru'] = 4;
            } else {
                $_SESSION['konferansTabloSirala'] = 13;
                $_SESSION['siralamaTuru'] = 4;
            }
            header("Location: index.php?sayfa=konferanslar");
        }

        if (@$session->_read($_SESSION["girisKullaniciId"]) == 1 && @$session->_read3($_SESSION["girisKullaniciId"]) == NULL) {
            echo "<a href='index.php?sayfa=konferansOlustur' class='konferansEkleLink'>Konferans Oluştur</a><br/><br/><br/>";
            $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair FROM konferanslar WHERE konferansSilindi = 0");
            if (@$_SESSION['konferansTabloSirala2'] == 1) {
                $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair FROM konferanslar WHERE konferansSilindi = 0 ORDER BY konferansIsim");
            } else if (@$_SESSION['konferansTabloSirala2'] == 11) {
                $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair FROM konferanslar WHERE konferansSilindi = 0 ORDER BY konferansIsim DESC");
            }
            echo "<table class='konferanstable'>";
            echo "<tr>";
            echo "<th rowspan='2'><a href='index.php?sayfa=konferanslar&s=1'>KONFERANSLAR</a></th>";
            echo "<th colspan='3'><a style='color:black;'>CHAIR</a></th>";
            echo "<th rowspan='2' colspan='2'></th>";
            echo "</tr>";
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=2'>Kullanıcı Adı</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=2'>İsim</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=2'>Soyisim</a></th>";
            echo "</tr>";
            $sorgu->execute();
            if ($sorgu->rowCount() > 0) {
                while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    $siralamaTur = $_SESSION['siralamaTuru'];
                    echo "<tr>";
                    echo "<th><a href='index.php?sayfa=konferansGoruntule&kGiris=$rowKonferans[konferansId]'>" . $rowKonferans['konferansIsim'] . "</a></th>";
                    echo $kullaniciTablosu->kullaniciAdIsim1Soyisim($rowKonferans['konferansChair'], $baglanti, $_SESSION['konferansTabloSirala'], $siralamaTur);
                    --$siralamaTur;
                    echo "<th><a href='index.php?sayfa=konferansKullaniciGuncelle&koGuncelle=$rowKonferans[konferansId]' style='margin-right:10px'>Düzenle</a></th>";
                    echo "<th><a href=\"konferansSil.php?kSil=$rowKonferans[konferansId]\" OnClick=\"return confirm('" . $rowKonferans['konferansIsim'] . " konferansını silmek istediğinize emin misiniz?');\">Sil</a></th>";
                    echo "</tr>";
                }
            }
            echo "</table>";

        } else if (@$session->_read($_SESSION["girisKullaniciId"]) == 2 || ($session->_read3($_SESSION["girisKullaniciId"]) == 2 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
            $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair, konferansAuthor, konferansReviewer, konferansReader FROM konferanslar WHERE konferansSilindi = 0");
            if (@$_SESSION['konferansTabloSirala2'] == 1) {
                $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair, konferansAuthor, konferansReviewer, konferansReader FROM konferanslar WHERE konferansSilindi = 0 ORDER BY konferansIsim");
            } else if (@$_SESSION['konferansTabloSirala2'] == 11) {
                $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair, konferansAuthor, konferansReviewer, konferansReader FROM konferanslar WHERE konferansSilindi = 0 ORDER BY konferansIsim DESC");
            }
            echo "<table class='konferanstable'>";
            echo "<tr>";
            echo "<th rowspan='2'><a href='index.php?sayfa=konferanslar&s=1'>KONFERANSLAR</a></th>";
            echo "<th colspan='3'><a style='color:black;'>CHAIR</a></th>";
            echo "<th colspan='3'><a style='color:black;'>AUTHOR</a></th>";
            echo "<th colspan='3'><a style='color:black;'>REVIEWER</a></th>";
            echo "<th colspan='3'><a style='color:black;'>READER</a></th>";
            echo "<th rowspan='2' colspan='3'></th>";
            echo "</tr>";
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=2'>Kullanıcı Adı</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=3'>İsim</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=4'>Soyisim</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=5'>Kullanıcı Adı</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=6'>İsim</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=7'>Soyisim</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=8'>Kullanıcı Adı</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=9'>İsim</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=10'>Soyisim</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=11'>Kullanıcı Adı</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=12'>İsim</a></th>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=13'>Soyisim</a></th>";
            echo "</tr>";
            $sorgu->execute();
            if ($sorgu->rowCount() > 0) {
                while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    $siralamaTur = $_SESSION['siralamaTuru'];
                    $konferansKullanicilarDizi = str_split($rowKonferans['konferansChair']);
                    $konferansKullanicilarkarakter = 0;
                    $kullanici = NULL;
                    if ($rowKonferans['konferansChair'] != NULL) {
                        foreach ($konferansKullanicilarDizi as $item) {
                            if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                                $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                            } else {
                                if ($kullanici == $session->_read2($_SESSION['girisKullaniciId']) || $kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                    echo "<tr>";
                                    echo "<th><a href='index.php?sayfa=konferansGoruntule&kGiris=$rowKonferans[konferansId]' title='$rowKonferans[konferansIsim]'>" . $rowKonferans['konferansIsim'] . "</a></th>";
                                    echo $kullaniciTablosu->kullaniciAdIsim1Soyisim($rowKonferans['konferansChair'], $baglanti, $_SESSION['konferansTabloSirala'], $siralamaTur);
                                    --$siralamaTur;
                                    echo $kullaniciTablosu->kullaniciAdIsim1Soyisim($rowKonferans['konferansAuthor'], $baglanti, $_SESSION['konferansTabloSirala'], $siralamaTur);
                                    --$siralamaTur;
                                    echo $kullaniciTablosu->kullaniciAdIsim1Soyisim($rowKonferans['konferansReviewer'], $baglanti, $_SESSION['konferansTabloSirala'], $siralamaTur);
                                    --$siralamaTur;
                                    echo $kullaniciTablosu->kullaniciAdIsim1Soyisim($rowKonferans['konferansReader'], $baglanti, $_SESSION['konferansTabloSirala'], $siralamaTur);
                                    --$siralamaTur;
                                    echo "<th><a href='index.php?sayfa=konferansGuncelle&koGuncelle=$rowKonferans[konferansId]' style='margin-right:10px'>Düzenle</a></th>";
                                    echo "<th><a href='index.php?sayfa=konferansKullaniciGuncelle&koGuncelle=$rowKonferans[konferansId]' style='margin-right:10px'>Roller</a></th>";
                                    echo "<th><a href='index.php?sayfa=review&koSubmission=$rowKonferans[konferansId]' style='margin-right:10px'>Submission</a></th>";
                                    echo "</tr>";
                                }
                                $kullanici = NULL;
                            }
                            $konferansKullanicilarkarakter++;
                        }
                    }
                }
            }
            echo "</table>";


        } else if (@$session->_read($_SESSION["girisKullaniciId"]) == 3 || ($session->_read3($_SESSION["girisKullaniciId"]) == 3 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
            $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansAuthor FROM konferanslar WHERE konferansSilindi = 0");
            if (@$_SESSION['konferansTabloSirala2'] == 1) {
                $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansAuthor FROM konferanslar WHERE konferansSilindi = 0 ORDER BY konferansIsim");
            } else if (@$_SESSION['konferansTabloSirala2'] == 11) {
                $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansAuthor FROM konferanslar WHERE konferansSilindi = 0 ORDER BY konferansIsim DESC");
            }
            echo "<table class='konferanstable2'>";
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=1'>KONFERANSLAR</a></th>";
            echo "<th></th>";
            echo "</tr>";
            $sorgu->execute();
            if ($sorgu->rowCount() > 0) {
                while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    $konferansKullanicilarDizi = str_split($rowKonferans['konferansAuthor']);
                    $konferansKullanicilarkarakter = 0;
                    $kullanici = NULL;
                    if ($rowKonferans['konferansAuthor'] != NULL) {
                        foreach ($konferansKullanicilarDizi as $item) {
                            if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                                $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                            } else {
                                if ($kullanici == $session->_read2($_SESSION['girisKullaniciId']) || $kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                    echo "<tr>";
                                    echo "<th><a href='index.php?sayfa=konferansGoruntule&kGiris=$rowKonferans[konferansId]' title='$rowKonferans[konferansIsim]'>" . $rowKonferans['konferansIsim'] . "</a></th>";
                                    echo "<th><a href='index.php?sayfa=submission&koSubmission=$rowKonferans[konferansId]' style='margin-right:10px'>Submission</a></th>";
                                    echo "</tr>";
                                }
                                $kullanici = NULL;
                            }
                            $konferansKullanicilarkarakter++;
                        }
                    }
                }
            }
            echo "</table>";


        } else if (@$session->_read($_SESSION["girisKullaniciId"]) == 4 || ($session->_read3($_SESSION["girisKullaniciId"]) == 4 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
            $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansReviewer FROM konferanslar WHERE konferansSilindi = 0");
            if (@$_SESSION['konferansTabloSirala2'] == 1) {
                $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansReviewer FROM konferanslar WHERE konferansSilindi = 0 ORDER BY konferansIsim");
            } else if (@$_SESSION['konferansTabloSirala2'] == 11) {
                $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansReviewer FROM konferanslar WHERE konferansSilindi = 0 ORDER BY konferansIsim DESC");
            }
            echo "<table class='konferanstable2'>";
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=konferanslar&s=1'>KONFERANSLAR</a></th>";
            echo "<th></th>";
            echo "</tr>";
            $sorgu->execute();
            if ($sorgu->rowCount() > 0) {
                while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    $konferansKullanicilarDizi = str_split($rowKonferans['konferansReviewer']);
                    $konferansKullanicilarkarakter = 0;
                    $kullanici = NULL;
                    if ($rowKonferans['konferansReviewer'] != NULL) {
                        foreach ($konferansKullanicilarDizi as $item) {
                            if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                                $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                            } else {
                                if ($kullanici == $session->_read2($_SESSION['girisKullaniciId']) || $kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                    echo "<tr>";
                                    echo "<th><a href='index.php?sayfa=konferansGoruntule&kGiris=$rowKonferans[konferansId]' title='$rowKonferans[konferansIsim]'>" . $rowKonferans['konferansIsim'] . "</a></th>";
                                    echo "<th><a href='index.php?sayfa=review&koSubmission=$rowKonferans[konferansId]' style='margin-right:10px'>Submission İncele</a></th>";
                                    echo "</tr>";
                                }
                                $kullanici = NULL;
                            }
                            $konferansKullanicilarkarakter++;
                        }
                    }
                }
            }
            echo "</table>";
        }
    } else {
        echo "Erişim engellendi.";
    }
} else {
    echo "Giriş yapınız.";
}

?>
