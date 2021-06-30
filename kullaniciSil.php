<?php
include_once ("veritabaniBaglantisi.php");
include_once ("Session.php");
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1) {
        $kSil = $baglanti->prepare("UPDATE kullanicilar SET kullaniciSilindi = 1 WHERE kullaniciId = :kullaniciId");
        $kSil->bindParam(':kullaniciId', $_REQUEST['kSil'], PDO::PARAM_STR);
        $guncelle = $kSil->execute();
        if ($guncelle == TRUE) {
            $session->_destroy($_REQUEST['kullaniciIdSil']);
            header("Location: index.php?sayfa=roller");
        }
    }
}
?>