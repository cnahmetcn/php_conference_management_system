<style>
    .konferansGoruntule{display:table}
    .iptalButonu2{position:relative; float:right; margin-left:10px; border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#323232; color:#eee; text-decoration:none}
    .iptalButonu2:hover{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#ddd; color:#323232}

</style>
<?php
include("veritabaniBaglantisi.php");
include_once ("Session.php");

if (@($_SESSION['konferansTabloSiralaAnasayfa'] != 1 && $_SESSION['konferansTabloSiralaAnasayfa'] != 11)) {
    $_SESSION['konferansTabloSiralaAnasayfa'] = 1;
}
if (@$_GET['s'] == '1') {
    if ($_SESSION['konferansTabloSiralaAnasayfa'] != 11)
        $_SESSION['konferansTabloSiralaAnasayfa'] = 11;
    else
        $_SESSION['konferansTabloSiralaAnasayfa'] = 1;
    header("Location: index.php");
}
$konferansId = $_REQUEST['kGiris'];
if(@$session->_read($_SESSION["girisKullaniciId"]) == 1 || @$session->_read($_SESSION["girisKullaniciId"]) == 2 || @$session->_read($_SESSION["girisKullaniciId"]) == 3 || @$session->_read($_SESSION["girisKullaniciId"]) == 4 || @$session->_read($_SESSION["girisKullaniciId"]) == 5){
    echo "<a href='index?sayfa=submissionGoruntule&kGiris=$konferansId' class='iptalButonu2'>Submission</a>";
}
echo "<a href='index?sayfa=konferansGoruntuleIletisim&kGiris=$konferansId' class='iptalButonu2'>İletişim</a>";
echo "<a href='index?sayfa=konferansGoruntuleKonum&kGiris=$konferansId' class='iptalButonu2'>Konum</a>";
echo "<a href='index?sayfa=konferansGoruntuleOnemliTarih&kGiris=$konferansId' class='iptalButonu2'>Önemli Tarihler</a>";
echo "<a href='index.php' class='iptalButonu2'>Geri</a>";

if (@$session->_read($_SESSION["girisKullaniciId"]) == 1 && @$session->_read3($_SESSION["girisKullaniciId"]) == NULL) {
    $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim, kb.konferansTanim, kb.konferansTarih, kb.konferansKonum, kb.konferansIletisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId WHERE k.konferansId = :konferansId AND k.konferansSilindi = 0");
    $sorgu->bindParam(':konferansId', $_REQUEST['kGiris'], PDO::PARAM_STR);
    $sorgu->execute();
    if ($sorgu->rowCount() > 0) {
        while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIsim'] . "</div>";
            echo "<br/><br/><div class='konferansGoruntule'>" . $rowKonferans['konferansTanim'] . "</div>";
            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansTarih'] . "</div>";
            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansKonum'] . "</div>";
            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIletisim'] . "</div>";
        }
    }
}  else if (@$session->_read($_SESSION["girisKullaniciId"]) == 2 || @($session->_read3($_SESSION["girisKullaniciId"]) != NULL && $session->_read4($_SESSION["girisKullaniciId"]) != NULL) || @$session->_read($_SESSION["girisKullaniciId"]) == 3 || @$session->_read($_SESSION["girisKullaniciId"]) == 4 || @$session->_read($_SESSION["girisKullaniciId"]) == 5) {
    $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim, kb.konferansTanim, kb.konferansTarih, kb.konferansKonum, kb.konferansIletisim, k.konferansChair, k.konferansAuthor, k.konferansReviewer, k.konferansReader, kb.konferansErisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId WHERE k.konferansId = :konferansId AND k.konferansSilindi = 0");
    $sorgu->bindParam(':konferansId', $_REQUEST['kGiris'], PDO::PARAM_STR);
    $sorgu->execute();
    if ($sorgu->rowCount() > 0) {
        while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            $konferansKullanicilarDizi = NULL;
            if (@$session->_read($_SESSION["girisKullaniciId"]) == 2 || @$session->_read3($_SESSION["girisKullaniciId"]) == 2) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansChair']);
            } else if (@$session->_read($_SESSION["girisKullaniciId"]) == 3 || @$session->_read3($_SESSION["girisKullaniciId"]) == 3) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansAuthor']);
            } else if (@$session->_read($_SESSION["girisKullaniciId"]) == 4 || @$session->_read3($_SESSION["girisKullaniciId"]) == 4) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansReviewer']);
            } else if (@$session->_read($_SESSION["girisKullaniciId"]) == 5 || @$session->_read3($_SESSION["girisKullaniciId"]) == 5) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansReader']);
            }
            $konferansKullanicilarkarakter = 0;
            $kullanici = NULL;
            $kullaniciBulundu = 0;
            if ($konferansKullanicilarDizi != NULL) {
                foreach ($konferansKullanicilarDizi as $item) {
                    if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                        $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                    } else {
                        if ($kullanici == $session->_read2($_SESSION['girisKullaniciId']) || $kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIsim'] . "</div>";
                            echo "<br/><br/><div class='konferansGoruntule'>" . $rowKonferans['konferansTanim'] . "</div>";
                            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansTarih'] . "</div>";
                            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansKonum'] . "</div>";
                            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIletisim'] . "</div>";
                            $kullaniciBulundu = 1;
                        }
                        $kullanici = NULL;
                    }
                    $konferansKullanicilarkarakter++;
                }
                if ($kullaniciBulundu == 0 && $rowKonferans['konferansErisim'] == 1) {
                    echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIsim'] . "</div>";
                    echo "<br/><br/><div class='konferansGoruntule'>" . $rowKonferans['konferansTanim'] . "</div>";
                    echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansTarih'] . "</div>";
                    echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansKonum'] . "</div>";
                    echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIletisim'] . "</div>";
                }
            } else if ($rowKonferans['konferansErisim'] == 1) {
                echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIsim'] . "</div>";
                echo "<br/><br/><div class='konferansGoruntule'>" . $rowKonferans['konferansTanim'] . "</div>";
                echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansTarih'] . "</div>";
                echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansKonum'] . "</div>";
                echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIletisim'] . "</div>";
            }
        }
    }
} else {
    $sorgu = $baglanti->prepare("SELECT k.konferansIsim, kb.konferansTanim, kb.konferansTarih, kb.konferansKonum, kb.konferansIletisim, kb.konferansErisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId WHERE k.konferansId = :konferansId AND kb.konferansErisim = 1 AND k.konferansSilindi = 0");
    $sorgu->bindParam(':konferansId', $_REQUEST['kGiris'], PDO::PARAM_STR);
    $sorgu->execute();
    if ($sorgu->rowCount() > 0) {
        while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIsim'] . "</div>";
            echo "<br/><br/><div class='konferansGoruntule'>" . $rowKonferans['konferansTanim'] . "</div>";
            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansTarih'] . "</div>";
            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansKonum'] . "</div>";
            echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIletisim'] . "</div>";
        }
    }
}

?>