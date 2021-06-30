<style>
    .konferanstable {font-family:aria, sans-serif; font-size:85%; border-collapse:collapse; width:100%;}
    .konferanstable td, .konferanstable th {border:1px solid #323232; text-align:left; padding:10px; width:auto; overflow:hidden;}
    .konferanstable tr:hover {background-color: #323232; color: #ddd;}
    .konferanstable tr:hover a{color:#ddd; text-decoration:none}
    .konferanstable tr:first-child {background-color:#ddd; word-wrap:break-word}
    .konferanstable tr:first-child:hover {background-color:#ddd;}
    .konferanstable tr:first-child:hover a:link{color:#0000EE; text-decoration:underline}
    .konferanstable tr:first-child:hover a:visited{color:#551A8B; text-decoration:underline}
</style>
<?php
include("veritabaniBaglantisi.php");
include_once ("Session.php");
$session->_gc();

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

if (@$session->_read($_SESSION["girisKullaniciId"]) == 1 && @$session->_read3($_SESSION["girisKullaniciId"]) == NULL) {
    $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId");
    if (@$_SESSION['konferansTabloSiralaAnasayfa'] == 1) {
        $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId ORDER BY k.konferansIsim");
    } else if (@$_SESSION['konferansTabloSiralaAnasayfa'] == 11) {
        $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId ORDER BY k.konferansIsim DESC");
    }
    echo "<table class='konferanstable'>";
    echo "<tr>";
    echo "<th><a href='index.php?sayfa=anasayfa&s=1'>KONFERANSLAR</a></th>";
    echo "</tr>";
    $sorgu->execute();
    if ($sorgu->rowCount() > 0) {
        while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=konferansGoruntule&kGiris=$rowKonferans[konferansId]'>" . $rowKonferans['konferansIsim'] . "</a></th>";
            echo "</tr>";
        }
    }
    echo "</table>";

}  else if (@$session->_read($_SESSION["girisKullaniciId"]) == 2 || @($session->_read3($_SESSION["girisKullaniciId"]) != NULL && $session->_read4($_SESSION["girisKullaniciId"]) != NULL) || @$session->_read($_SESSION["girisKullaniciId"]) == 3 || @$session->_read($_SESSION["girisKullaniciId"]) == 4 || @$session->_read($_SESSION["girisKullaniciId"]) == 5) {
    $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim, k.konferansChair, k.konferansAuthor, k.konferansReviewer, k.konferansReader, kb.konferansErisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId");
    if (@$_SESSION['konferansTabloSiralaAnasayfa'] == 1) {
        $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim, k.konferansChair, k.konferansAuthor, k.konferansReviewer, k.konferansReader, kb.konferansErisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId ORDER BY k.konferansIsim");
    } else if (@$_SESSION['konferansTabloSiralaAnasayfa'] == 11) {
        $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim, k.konferansChair, k.konferansAuthor, k.konferansReviewer, k.konferansReader, kb.konferansErisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId ORDER BY k.konferansIsim DESC");
    }
    echo "<table class='konferanstable'>";
    echo "<tr>";
    echo "<th><a href='index.php?sayfa=anasayfa&s=1'>KONFERANSLAR</a></th>";
    echo "</tr>";
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
                            echo "<tr>";
                            echo "<th><a href='index.php?sayfa=konferansGoruntule&kGiris=$rowKonferans[konferansId]'>" . $rowKonferans['konferansIsim'] . "</a></th>";
                            echo "</tr>";
                            $kullaniciBulundu = 1;
                        }
                        $kullanici = NULL;
                    }
                    $konferansKullanicilarkarakter++;
                }
                if ($kullaniciBulundu == 0 && $rowKonferans['konferansErisim'] == 1) {
                    echo "<tr>";
                    echo "<th><a href='index.php?sayfa=konferansGoruntule&kGiris=$rowKonferans[konferansId]'>" . $rowKonferans['konferansIsim'] . "</a></th>";
                    echo "</tr>";
                }
            } else if ($rowKonferans['konferansErisim'] == 1) {
                echo "<tr>";
                echo "<th><a href='index.php?sayfa=konferansGoruntule&kGiris=$rowKonferans[konferansId]'>" . $rowKonferans['konferansIsim'] . "</a></th>";
                echo "</tr>";
            }
        }
    }
    echo "</table>";
} else {
    $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim, kb.konferansErisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId WHERE kb.konferansErisim = 1");
    if (@$_SESSION['konferansTabloSiralaAnasayfa'] == 1) {
        $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim, kb.konferansErisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId WHERE kb.konferansErisim = 1 ORDER BY k.konferansIsim");
    } else if (@$_SESSION['konferansTabloSiralaAnasayfa'] == 11) {
        $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim, kb.konferansErisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId WHERE kb.konferansErisim = 1 ORDER BY k.konferansIsim DESC");
    }
    echo "<table class='konferanstable'>";
    echo "<tr>";
    echo "<th><a href='index.php?sayfa=anasayfa&s=1'>KONFERANSLAR</a></th>";
    echo "</tr>";
    $sorgu->execute();
    if ($sorgu->rowCount() > 0) {
        while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=konferansGoruntule&kGiris=$rowKonferans[konferansId]'>" . $rowKonferans['konferansIsim'] . "</a></th>";
            echo "</tr>";
        }
    }
    echo "</table>";
}

?>