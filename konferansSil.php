<?php
include_once ("veritabaniBaglantisi.php");
include_once ("Session.php");

if (@$session->_read($_SESSION["girisKullaniciId"]) == 1) {
    $konferansAd = NULL;
    $konferansSil = $baglanti->prepare("SELECT konferansAd FROM konferanslar WHERE konferansId = :konferansId");
    $konferansSil->bindParam(':konferansId', $_REQUEST['kSil'], PDO::PARAM_STR);
    $konferansSil->execute();
    if ($konferansSil->rowCount() > 0) {
        while ($rowKonferans = $konferansSil->fetch(PDO::FETCH_ASSOC)) {
            $konferansAd = $rowKonferans['konferansAd'];
        }
    }

    $konferansSil = $baglanti->prepare("UPDATE konferanslar SET konferansSilindi = 1 WHERE konferansId = :konferansId");
    $konferansSil->bindParam(':konferansId', $_REQUEST['kSil'], PDO::PARAM_STR);
    $guncelle = $konferansSil->execute();

    if ($guncelle == TRUE) {
        header("Location: index.php?sayfa=konferanslar");
    }
}
?>