<?php
include_once ("veritabaniBaglantisi.php");
include_once ("Session.php");
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1) {
        $kullaniciId = $session->_read2($_SESSION["girisKullaniciId"]);
		$kGiris = $baglanti->prepare("UPDATE sessions SET data3 = :kullaniciOlarakRol, data4 = :kullaniciOlarakId WHERE data2 = :kullaniciId");
		$kGiris->bindParam(':kullaniciOlarakRol', $_REQUEST['kGiris'], PDO::PARAM_STR);
		$kGiris->bindParam(':kullaniciOlarakId', $_REQUEST['kGiris2'], PDO::PARAM_STR);
		$kGiris->bindParam(':kullaniciId', $kullaniciId, PDO::PARAM_STR);
		$_SESSION['girisKullaniciIsim1'] = $_REQUEST['kGiris3'];
		$guncelle = $kGiris->execute();
		if ($guncelle == TRUE) {
			header("Location: index.php?sayfa=roller");
		}
    }
}