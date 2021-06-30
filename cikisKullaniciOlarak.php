<?php
include_once ("veritabaniBaglantisi.php");
include_once ("Session.php");
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1) {
        $kullaniciId = $session->_read2($_SESSION["girisKullaniciId"]);
        $_SESSION['girisKullaniciIsim1'] = $_SESSION['girisKullaniciIsim1Yedek'];
        $kullaniciOlarakCikisYap = NULL;
        $kGiris = $baglanti->prepare("UPDATE sessions SET data3 = :kullaniciOlarakRol, data4 = :kullaniciOlarakId WHERE data2 = :kullaniciId");
        $kGiris->bindParam(':kullaniciOlarakRol', $kullaniciOlarakCikisYap, PDO::PARAM_STR);
        $kGiris->bindParam(':kullaniciOlarakId', $kullaniciOlarakCikisYap, PDO::PARAM_STR);
        $kGiris->bindParam(':kullaniciId', $kullaniciId, PDO::PARAM_STR);
        $guncelle = $kGiris->execute();
        if ($guncelle == TRUE) {
            header("Location: index.php?sayfa=roller");
        }
    }
}