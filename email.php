<style>
    .yeniMesajButonu{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#323232; color:#eee; text-decoration:none}
    .yeniMesajButonu:hover{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#ddd; color:#323232}
    .yeniMesajIptalButonu{position:relative; left:90px; top:-15px; border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#323232; color:#eee; text-decoration:none}
    .yeniMesajIptalButonu:hover{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#ddd; color:#323232}
    .emailYazmaAlani{display:none; width:100%}
    .emailYazmaAlani a{margin:5px 0px; width:100px; margin-right:20px}
    .emailYazmaAlani i{margin-left:5px; font-size: small; color: firebrick}
    .emailinput{margin:5px 0px; width:50%; background-color:#fff; padding:5px; border:1px solid #323232; border-radius:2px 2px}
    .emailtextbox{margin:5px 0px; width:100%; padding:5px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px}
    .emailgonderbuton{padding:3px 15px; margin-top:5px}

    .emailOkumaAlani{display:none; width:100%; margin-top:20px}
    .emailOkumaAlani b{font-size:20px;}
    .emailOkumaAlani i{font-size:13px}
    .emailOkumaAlani a{font-size:15px;}
    .emailOkumaAlani2 {border:1px solid; border-radius:2px 2px; padding:10px; margin:10px; background-color:#ddd; word-wrap:break-word}

    #emailGelen{list-style-type:none; float:left; min-width:100%; margin-bottom:30px; padding:0px;}
    #emailGelen li{text-align:center;}
    .emailUlA{text-decoration:none; color:#eee; display:block; background-color:#323232; border:1px solid #323232; padding:5px; cursor:pointer;}
    .emailUlA:hover{background-color:#eee; color:#323232; border:1px solid #323232;}
    #emailGelen ul{list-style-type:none; padding:0px;}

    #emailGonderilen{list-style-type:none; float:left; min-width:100%; margin-bottom:30px; padding:0px;}
    #emailGonderilen li{text-align:center;}
    #emailGonderilen ul{list-style-type:none; padding:0px;}

    .emailtable {font-family:aria, sans-serif; font-size:85%; border-collapse:collapse; width:100%; table-layout:fixed;}
    .emailtable td, .emailtable th {border:1px solid; text-align:left; padding:5px; overflow:hidden;}
    .emailtable tr:hover {background-color: #323232; color: #ddd}
    .emailtable tr:hover a{color:#ddd; text-decoration:none}
    .emailtable tr:first-child {background-color:#ddd; word-wrap:break-word}
    .emailtable tr:first-child:hover {background-color:#ddd;}
    .emailtable tr:first-child:hover a:link{color:#0000EE; text-decoration:underline}
    .emailtable tr:first-child:hover a:visited{color:#551A8B; text-decoration:underline}
    .emailtable2 {font-family:arial, sans-serif; font-size:85%; border-collapse:collapse; width:100%; table-layout:fixed;}
    .emailtable2 td, .emailtable2 th {border:1px solid; text-align:left; padding:5px; overflow:hidden}
    .emailtable2 tr:hover {background-color: #323232; color: #ddd}
    .emailtable2 tr:hover a{color:#ddd; text-decoration:none}
    .emailtable2 tr:first-child {background-color:#ddd; word-wrap:break-word}
    .emailtable2 tr:first-child:hover {background-color:#ddd;}
    .emailtable2 tr:first-child:hover a:link{color:#0000EE; text-decoration:underline}
    .emailtable2 tr:first-child:hover a:visited{color:#551A8B; text-decoration:underline}

</style>
<?php
include_once ("veritabaniBaglantisi.php");
include_once ("Session.php");

if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1 || $session->_read($_SESSION["girisKullaniciId"]) == 2 || $session->_read($_SESSION["girisKullaniciId"]) == 3 || $session->_read($_SESSION["girisKullaniciId"]) == 4 || $session->_read($_SESSION["girisKullaniciId"]) == 5 || $session->_read($_SESSION["girisKullaniciId"]) == 6) {
        echo "<a href='index.php?sayfa=mail&s=13' class='yeniMesajButonu'>Yeni Mesaj</a>";
        if (@$_GET['s'] == '1') {
            if ($_SESSION['emailGelenSirala'] != 1)
                $_SESSION['emailGelenSirala'] = 1;
            else
                $_SESSION['emailGelenSirala'] = 11;
            header("Location: index.php?sayfa=mail");
        }
        if (@$_SESSION['emailGelenSirala'] == 1) {
            echo "<style>.emailtable{display:none;}</style>";
        } else if (@$_SESSION['emailGelenSirala'] == 11) {
            echo "<style>.emailtable{display:table;}</style>";
        }
        if (@$_GET['s'] == '2') {
            if ($_SESSION['emailGonderilenSirala'] != 1)
                $_SESSION['emailGonderilenSirala'] = 1;
            else
                $_SESSION['emailGonderilenSirala'] = 11;
            header("Location: index.php?sayfa=mail");
        }
        if (@$_SESSION['emailGonderilenSirala'] == 1) {
            echo "<style>.emailtable2{display:none;}</style>";
        } else if (@$_SESSION['emailGonderilenSirala'] == 11) {
            echo "<style>.emailtable2{display:table;}</style>";
        }
        $yaziAlaniniGoster = 0;
        if (@$_GET['s'] == '13') {
            $yaziAlaniniGoster = 1;
        }
        if ($yaziAlaniniGoster == 1) {
            echo "<style>.emailYazmaAlani{display:block;}</style>";
            echo "<style>.emailGoruntulemeAlani{display:none;}</style>";
        }
        if (@$_GET['s'] == '3') {
            if ($_SESSION['emialTabloSirala1'] != 3)
                $_SESSION['emialTabloSirala1'] = 3;
            else
                $_SESSION['emialTabloSirala1'] = 33;
            header("Location: index.php?sayfa=mail");
        } else if (@$_GET['s'] == '4') {
            if ($_SESSION['emialTabloSirala1'] != 4)
                $_SESSION['emialTabloSirala1'] = 4;
            else
                $_SESSION['emialTabloSirala1'] = 44;
            header("Location: index.php?sayfa=mail");
        } else if (@$_GET['s'] == '5') {
            if ($_SESSION['emialTabloSirala1'] != 5)
                $_SESSION['emialTabloSirala1'] = 5;
            else
                $_SESSION['emialTabloSirala1'] = 55;
            header("Location: index.php?sayfa=mail");
        } else if (@$_GET['s'] == '6') {
            if ($_SESSION['emialTabloSirala1'] != 6)
                $_SESSION['emialTabloSirala1'] = 6;
            else
                $_SESSION['emialTabloSirala1'] = 66;
            header("Location: index.php?sayfa=mail");
        } else if (@$_GET['s'] == '7') {
            if ($_SESSION['emialTabloSirala1'] != 7)
                $_SESSION['emialTabloSirala1'] = 7;
            else
                $_SESSION['emialTabloSirala1'] = 77;
            header("Location: index.php?sayfa=mail");
        }

        if (@$_GET['s'] == '8') {
            if ($_SESSION['emialTabloSirala2'] != 3)
                $_SESSION['emialTabloSirala2'] = 3;
            else
                $_SESSION['emialTabloSirala2'] = 33;
            header("Location: index.php?sayfa=mail");
        } else if (@$_GET['s'] == '9') {
            if ($_SESSION['emialTabloSirala2'] != 4)
                $_SESSION['emialTabloSirala2'] = 4;
            else
                $_SESSION['emialTabloSirala2'] = 44;
            header("Location: index.php?sayfa=mail");
        } else if (@$_GET['s'] == '10') {
            if ($_SESSION['emialTabloSirala2'] != 5)
                $_SESSION['emialTabloSirala2'] = 5;
            else
                $_SESSION['emialTabloSirala2'] = 55;
            header("Location: index.php?sayfa=mail");
        } else if (@$_GET['s'] == '11') {
            if ($_SESSION['emialTabloSirala2'] != 6)
                $_SESSION['emialTabloSirala2'] = 6;
            else
                $_SESSION['emialTabloSirala2'] = 66;
            header("Location: index.php?sayfa=mail");
        } else if (@$_GET['s'] == '12') {
            if ($_SESSION['emialTabloSirala2'] != 7)
                $_SESSION['emialTabloSirala2'] = 7;
            else
                $_SESSION['emialTabloSirala2'] = 77;
            header("Location: index.php?sayfa=mail");
        }
        if (@$_SESSION['emialTabloSirala1'] == 3) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY k.kullaniciIsim1 ASC");
        } else if (@$_SESSION['emialTabloSirala1'] == 33) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY k.kullaniciIsim1 DESC");
        } else if (@$_SESSION['emialTabloSirala1'] == 4) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY k.kullaniciSoyisim ASC");
        } else if (@$_SESSION['emialTabloSirala1'] == 44) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY k.kullaniciSoyisim DESC");
        } else if (@$_SESSION['emialTabloSirala1'] == 5) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY k.kullaniciMail ASC");
        } else if (@$_SESSION['emialTabloSirala1'] == 55) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY k.kullaniciMail DESC");
        } else if (@$_SESSION['emialTabloSirala1'] == 6) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY e.emailKonu ASC");
        } else if (@$_SESSION['emialTabloSirala1'] == 66) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY e.emailKonu DESC");
        } else if (@$_SESSION['emialTabloSirala1'] == 7) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY e.emailTarih ASC");
        } else if (@$_SESSION['emialTabloSirala1'] == 77) {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY e.emailTarih DESC");
        } else {
            $emailSorgu = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailOkundu, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId ORDER BY e.emailTarih DESC");
        }
        if (@$_SESSION['emialTabloSirala2'] == 3) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY k.kullaniciIsim1 ASC");
        } else if (@$_SESSION['emialTabloSirala2'] == 33) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY k.kullaniciIsim1 DESC");
        } else if (@$_SESSION['emialTabloSirala2'] == 4) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY k.kullaniciSoyisim ASC");
        } else if (@$_SESSION['emialTabloSirala2'] == 44) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY k.kullaniciSoyisim DESC");
        } else if (@$_SESSION['emialTabloSirala2'] == 5) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY k.kullaniciMail ASC");
        } else if (@$_SESSION['emialTabloSirala2'] == 55) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY k.kullaniciMail DESC");
        } else if (@$_SESSION['emialTabloSirala2'] == 6) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY e.emailKonu ASC");
        } else if (@$_SESSION['emialTabloSirala2'] == 66) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY e.emailKonu DESC");
        } else if (@$_SESSION['emialTabloSirala2'] == 7) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY e.emailTarih ASC");
        } else if (@$_SESSION['emialTabloSirala2'] == 77) {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY e.emailTarih DESC");
        } else {
            $emailSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId ORDER BY e.emailTarih DESC");
        }

        $emailKonuHataMesaji = NULL;
        if (isset($_POST['emailalici2']) && isset($_POST['emailkonu2']) && isset($_POST['emailtitle2'])) {
            if($session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
                $emailGonderen = $session->_read4($_SESSION["girisKullaniciId"]);
            } else {
                $emailGonderen = $session->_read2($_SESSION["girisKullaniciId"]);
            }
            $emailAlici = $_POST['emailalici2'];
            $emailAliciSorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciMail = :kullaniciMail");
            $emailAliciSorgu->bindParam(':kullaniciMail', $emailAlici, PDO::PARAM_STR);
            $emailAliciSorgu->execute();
            if ($emailAliciSorgu->rowCount() > 0) {
                while ($rowAlici = $emailAliciSorgu->fetch(PDO::FETCH_ASSOC)) {
                    $emailAlici = $rowAlici['kullaniciId'];
					$emailAliciRol = $rowAlici['kullaniciRol'];
                }
            }
            $emailKonu = $_POST['emailkonu2'];
            $emailTitle = $_POST['emailtitle2'];
			
			$emailRolIzin = 0;
			if($session->_read($_SESSION["girisKullaniciId"]) == 1 || $session->_read($_SESSION["girisKullaniciId"]) == 2) {
				$emailRolIzin = 1;
			}
			if($session->_read($_SESSION["girisKullaniciId"]) == 1 && $session->_read3($_SESSION["girisKullaniciId"]) != NULL && $session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
				$emailRolIzin = 0;
			}
			if($emailRolIzin == 1) {
				if ($emailAlici != $emailGonderen) {
					$mailGonder = $baglanti->prepare("INSERT INTO emailler (gonderenId, alanId, emailKonu, emailTitle, emailTarih) VALUES(?,?,?,?,?)");
					$mailGonder->execute(array($emailGonderen, $emailAlici, $emailKonu, $emailTitle, time() + 10800));
					if ($mailGonder == TRUE)
						header("Location: index.php?sayfa=mail");
					else
						$emailKonuHataMesaji = "Mesaj gönderilemedi.";
				} else {
					$emailKonuHataMesaji = "Kendinize mesaj gönderemezsiniz.";
				}
			} else {
				if ($emailAlici != $emailGonderen) {
					if($emailAliciRol == 1 || $emailAliciRol == 2) {
						$mailGonder = $baglanti->prepare("INSERT INTO emailler (gonderenId, alanId, emailKonu, emailTitle, emailTarih) VALUES(?,?,?,?,?)");
						$mailGonder->execute(array($emailGonderen, $emailAlici, $emailKonu, $emailTitle, time() + 10800));
						if ($mailGonder == TRUE)
							header("Location: index.php?sayfa=mail");
						else
							$emailKonuHataMesaji = "Mesaj gönderilemedi.";
					} else {
						$emailKonuHataMesaji = "Sadece Admin ve Chair mesaj gönderebilirsiniz.";
					}
				} else {
					$emailKonuHataMesaji = "Kendinize mesaj gönderemezsiniz.";
				}
			}
        }
        $emailOkuMesajGonderen1 = NULL;
        $emailOkuMesajGonderenKonu1 = NULL;
        $emailOkuMesajGonderenMail1 = NULL;
        if (@$_GET['email2']) {
            $_SESSION['emailId'] = $_REQUEST['email2'];
            $emailOkuId = $_SESSION['emailId'];
            if($session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
                $emailOkuKullaniciId = $session->_read4($_SESSION["girisKullaniciId"]);
            } else {
                $emailOkuKullaniciId = $session->_read2($_SESSION["girisKullaniciId"]);
            }
            if($session->_read4($_SESSION["girisKullaniciId"]) == NULL) {
                $emailOkuSorgu3 = $baglanti->prepare("UPDATE emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId SET e.emailOkundu = 1 WHERE e.alanId = :kullaniciId AND e.emailId = :emailId");
                $emailOkuSorgu3->bindParam(':emailId', $emailOkuId, PDO::PARAM_STR);
                $emailOkuSorgu3->bindParam(':kullaniciId', $emailOkuKullaniciId, PDO::PARAM_STR);
                $emailOkuSorgu3->execute();
            }
            $emailOkuSorgu1 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId AND e.emailId = :emailId");
            $emailOkuSorgu1->bindParam(':emailId', $emailOkuId, PDO::PARAM_STR);
            $emailOkuSorgu1->bindParam(':kullaniciId', $emailOkuKullaniciId, PDO::PARAM_STR);
            $emailOkuSorgu1->execute();
            if ($emailOkuSorgu1->rowCount() > 0) {
                while ($rowEmail = $emailOkuSorgu1->fetch(PDO::FETCH_ASSOC)) {
                    $emailOkuMesajGonderenKonu1 = $rowEmail['emailKonu'];
                    $emailOkuMesajGonderenMail1 = $rowEmail['kullaniciMail'];
                    $emailOkuMesajGonderen1 = "\n\n\n___________________________________________________________________\n";
                    $emailOkuMesajGonderen1 .= "Konu: " . $rowEmail['emailKonu'] . "\n";
                    $emailOkuMesajGonderen1 .= "Gönderen: " . $rowEmail['kullaniciIsim1'] . " ";
                    $emailOkuMesajGonderen1 .= $rowEmail['kullaniciSoyisim'];
                    $emailOkuMesajGonderen1 .= " ( " . $rowEmail['kullaniciMail'] . " )\n\n";
                    $emailOkuMesajGonderen1 .= $rowEmail['emailTitle'];
                }
                echo "<style>.emailOkumaAlani{display:none}</style>";
                echo "<style>.emailYazmaAlani{display:block}</style>";
            } else {
                echo "<style>.emailYazmaAlani{display:none}</style>";
            }
        }
        if (@$_GET['email4']) {
            $_SESSION['emailId'] = $_REQUEST['email4'];
            $emailOkuId = $_SESSION['emailId'];
            if($session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
                $emailOkuKullaniciId = $session->_read4($_SESSION["girisKullaniciId"]);
            } else {
                $emailOkuKullaniciId = $session->_read2($_SESSION["girisKullaniciId"]);
            }
            $emailOkuSorgu5 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId AND e.emailId = :emailId");
            $emailOkuSorgu5->bindParam(':emailId', $emailOkuId, PDO::PARAM_STR);
            $emailOkuSorgu5->bindParam(':kullaniciId', $emailOkuKullaniciId, PDO::PARAM_STR);
            $emailOkuSorgu5->execute();
            if ($emailOkuSorgu5->rowCount() > 0) {
                while ($rowEmail = $emailOkuSorgu5->fetch(PDO::FETCH_ASSOC)) {
                    $emailOkuMesajGonderenKonu1 = $rowEmail['emailKonu'];
                    $emailOkuMesajGonderenMail1 = $rowEmail['kullaniciMail'];
                    $emailOkuMesajGonderen1 = "\n\n\n___________________________________________________________________\n";
                    $emailOkuMesajGonderen1 .= "Konu: " . $rowEmail['emailKonu'] . "\n";
                    $emailOkuMesajGonderen1 .= "Gönderen: " . $rowEmail['kullaniciIsim1'] . " ";
                    $emailOkuMesajGonderen1 .= $rowEmail['kullaniciSoyisim'];
                    $emailOkuMesajGonderen1 .= " ( " . $rowEmail['kullaniciMail'] . " )\n\n";
                    $emailOkuMesajGonderen1 .= $rowEmail['emailTitle'];
                }
                echo "<style>.emailOkumaAlani{display:none}</style>";
                echo "<style>.emailYazmaAlani{display:block}</style>";
            } else {
                echo "<style>.emailYazmaAlani{display:none}</style>";
            }
        }
        echo "<div class='emailYazmaAlani'>";
        echo "<a href='index.php?sayfa=mail' class='yeniMesajIptalButonu'>İptal</a><br/><br/><br/>";
        echo "<form action='' method='post'>";
        echo "<a>Kime: </a><br/><input class='emailinput' style='width:40%' type='text' name='emailalici2' value='$emailOkuMesajGonderenMail1'/><i>" . $emailKonuHataMesaji . "</i><br/><br/>";
        echo "<a>Konu: </a><br/><input class='emailinput' type='text' name='emailkonu2' value='$emailOkuMesajGonderenKonu1'/><br/><br/>";
        echo "<a>Mesaj: </a><br/><textarea rows='20' cols='138' class='emailtextbox' type='text' name='emailtitle2'>$emailOkuMesajGonderen1</textarea><br/>";
        echo "<input class='emailgonderbuton' type='submit' name='kayit' value='Gönder'/>";
        echo "</form>";
        echo "</div>";

        if (@$_GET['email']) {
            $_SESSION['emailId'] = $_REQUEST['email'];
            $emailOkuId = $_SESSION['emailId'];
            if($session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
                $emailOkuKullaniciId = $session->_read4($_SESSION["girisKullaniciId"]);
            } else {
                $emailOkuKullaniciId = $session->_read2($_SESSION["girisKullaniciId"]);
            }
            if($session->_read4($_SESSION["girisKullaniciId"]) == NULL) {
                $emailOkuSorgu3 = $baglanti->prepare("UPDATE emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId SET e.emailOkundu = 1 WHERE e.alanId = :kullaniciId AND e.emailId = :emailId");
                $emailOkuSorgu3->bindParam(':emailId', $emailOkuId, PDO::PARAM_STR);
                $emailOkuSorgu3->bindParam(':kullaniciId', $emailOkuKullaniciId, PDO::PARAM_STR);
                $emailOkuSorgu3->execute();
            }
            $emailOkuMesajKonu2 = NULL;
            $emailOkuMesajGonderen2 = NULL;
            $emailOkuMesajTitle2 = NULL;
            $emailOkuSorgu2 = $baglanti->prepare("SELECT e.emailId, e.gonderenId, e.alanId, e.emailKonu, e.emailTitle, e.emailTarih, e.emailSilindi, k.kullaniciIsim1, k.kullaniciSoyisim, k.kullaniciMail FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId AND e.emailId = :emailId");
            $emailOkuSorgu2->bindParam(':emailId', $emailOkuId, PDO::PARAM_STR);
            $emailOkuSorgu2->bindParam(':kullaniciId', $emailOkuKullaniciId, PDO::PARAM_STR);
            $emailOkuSorgu2->execute();
            if ($emailOkuSorgu2->rowCount() > 0) {
                while ($rowEmail = $emailOkuSorgu2->fetch(PDO::FETCH_ASSOC)) {
                    $emailOkuMesajKonu2 = $rowEmail['emailKonu'];
                    $emailOkuMesajGonderen2 .= $rowEmail['kullaniciIsim1'] . " ";
                    $emailOkuMesajGonderen2 .= $rowEmail['kullaniciSoyisim'];
                    $emailOkuMesajGonderen2 .= " ( " . $rowEmail['kullaniciMail'] . " )";
                    $emailOkuMesajTitle2 = nl2br($rowEmail['emailTitle']);
                }
                echo "<style>.emailYazmaAlani{display:none}</style>";
                echo "<style>.emailOkumaAlani{display:block}</style>";
            }
        }
        echo "<div class='emailOkumaAlani'>";
        echo "<a>Mesaj:</a><br/><div class='emailOkumaAlani2'><b>" . $emailOkuMesajKonu2 . "</b><br/><br/><i>" . $emailOkuMesajGonderen2 . "</i><br/><br/><a>" . $emailOkuMesajTitle2 . "</a></div>";
        echo "</div>";

        if($session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
            $emailKullaniciId = $session->_read4($_SESSION["girisKullaniciId"]);
        } else {
            $emailKullaniciId = $session->_read2($_SESSION["girisKullaniciId"]);
        }
        $emailSorgu->bindParam(':kullaniciId', $emailKullaniciId, PDO::PARAM_STR);
        $emailSorgu->execute();
        echo "<ul id='emailGelen'>";
        echo "<li><a href='index.php?sayfa=mail&s=1' class='emailUlA'>Gelen Mesajlar</a>";
        echo "<ul>";
        echo "<li>";
        echo "<table class='emailtable'>";
        echo "<tr>";
        echo "<th><a href='index.php?sayfa=mail&s=3'>Gönderen İsmi</a></th>";
        echo "<th><a href='index.php?sayfa=mail&s=4'>Gönderen Soyismi</a></th>";
        echo "<th><a href='index.php?sayfa=mail&s=5'>Gönderen E-Mail</a></th>";
        echo "<th><a href='index.php?sayfa=mail&s=6'>Konu</a></th>";
        echo "<th><a href='index.php?sayfa=mail&s=7'>Tarih</a></th>";
        echo "<th colspan='3'></th>";
        echo "</tr>";
        if ($emailSorgu->rowCount() > 0) {
            $mesajVarAmaGosterilmiyor = 1;
            while ($rowEmail = $emailSorgu->fetch(PDO::FETCH_ASSOC)) {
                $emailKullaniciEslesti = 0;
                $konferansKullanicilarDizi = str_split($rowEmail['emailSilindi']);
                $konferansKullanicilarkarakter = 0;
                $kullanici = NULL;
                if ($rowEmail['emailSilindi'] != NULL) {
                    foreach ($konferansKullanicilarDizi as $item) {
                        if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                            $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                        } else {
                            if($session->_read4($_SESSION['girisKullaniciId']) != NULL) {
                                if ($kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                    $emailKullaniciEslesti++;
                                }
                            } else {
                                if ($kullanici == $session->_read2($_SESSION['girisKullaniciId'])) {
                                    $emailKullaniciEslesti++;
                                }
                            }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                    if($emailKullaniciEslesti == 0) {
                        $mesajVarAmaGosterilmiyor--;
                        if ($rowEmail['emailOkundu'] == 0) {
                            echo "<tr style='background-color:dodgerblue'>";
                        } else {
                            echo "<tr>";
                        }
                        if (mb_strlen($rowEmail['kullaniciIsim1']) > 15) {
                            echo "<th title='" . $rowEmail['kullaniciIsim1'] . "'>" . mb_substr($rowEmail['kullaniciIsim1'], 0, 12) . "...</th>";
                        } else {
                            echo "<th>" . $rowEmail['kullaniciIsim1'] . "</th>";
                        }
                        if (mb_strlen($rowEmail['kullaniciSoyisim']) > 15) {
                            echo "<th title='" . $rowEmail['kullaniciSoyisim'] . "'>" . mb_substr($rowEmail['kullaniciSoyisim'], 0, 12) . "...</th>";
                        } else {
                            echo "<th>" . $rowEmail['kullaniciSoyisim'] . "</th>";
                        }
                        if (mb_strlen($rowEmail['kullaniciMail']) > 25) {
                            echo "<th title='" . $rowEmail['kullaniciMail'] . "'>" . mb_substr($rowEmail['kullaniciMail'], 0, 22) . "...</th>";
                        } else {
                            echo "<th>" . $rowEmail['kullaniciMail'] . "</th>";
                        }
                        if (mb_strlen($rowEmail['emailKonu']) > 15) {
                            echo "<th title='" . $rowEmail['emailKonu'] . "'>" . mb_substr($rowEmail['emailKonu'], 0, 12) . "...</th>";
                        } else {
                            echo "<th>" . $rowEmail['emailKonu'] . "</th>";
                        }
                        echo "<th>" . date("d.m.Y H:i", $rowEmail['emailTarih']) . "</th>";
                        echo "<th><a href='index.php?sayfa=mail&email=$rowEmail[emailId]'>Oku</a></th>";
                        echo "<th><a href='index.php?sayfa=mail&email2=$rowEmail[emailId]'>Yanıtla</a></th>";
                        echo "<th><a href=\"index.php?sayfa=mail&email3=$rowEmail[emailId]\" OnClick=\"return confirm('Mesajı silmek istediğinize emin misiniz?');\">Sil</a></th>";
                        echo "</tr>";
                    }
                } else {
                    $mesajVarAmaGosterilmiyor--;
                    if ($rowEmail['emailOkundu'] == 0) {
                        echo "<tr style='background-color:dodgerblue'>";
                    } else {
                        echo "<tr>";
                    }
                    if (mb_strlen($rowEmail['kullaniciIsim1']) > 15) {
                        echo "<th title='" . $rowEmail['kullaniciIsim1'] . "'>" . mb_substr($rowEmail['kullaniciIsim1'], 0, 12) . "...</th>";
                    } else {
                        echo "<th>" . $rowEmail['kullaniciIsim1'] . "</th>";
                    }
                    if (mb_strlen($rowEmail['kullaniciSoyisim']) > 15) {
                        echo "<th title='" . $rowEmail['kullaniciSoyisim'] . "'>" . mb_substr($rowEmail['kullaniciSoyisim'], 0, 12) . "...</th>";
                    } else {
                        echo "<th>" . $rowEmail['kullaniciSoyisim'] . "</th>";
                    }
                    if (mb_strlen($rowEmail['kullaniciMail']) > 25) {
                        echo "<th title='" . $rowEmail['kullaniciMail'] . "'>" . mb_substr($rowEmail['kullaniciMail'], 0, 22) . "...</th>";
                    } else {
                        echo "<th>" . $rowEmail['kullaniciMail'] . "</th>";
                    }
                    if (mb_strlen($rowEmail['emailKonu']) > 15) {
                        echo "<th title='" . $rowEmail['emailKonu'] . "'>" . mb_substr($rowEmail['emailKonu'], 0, 12) . "...</th>";
                    } else {
                        echo "<th>" . $rowEmail['emailKonu'] . "</th>";
                    }
                    echo "<th>" . date("d.m.Y H:i", $rowEmail['emailTarih']) . "</th>";
                    echo "<th><a href='index.php?sayfa=mail&email=$rowEmail[emailId]'>Oku</a></th>";
                    echo "<th><a href='index.php?sayfa=mail&email2=$rowEmail[emailId]'>Yanıtla</a></th>";
                    echo "<th><a href=\"index.php?sayfa=mail&email3=$rowEmail[emailId]\" OnClick=\"return confirm('Mesajı silmek istediğinize emin misiniz?');\">Sil</a></th>";
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr>";
            echo "<th>MESAJ YOK</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
        }
        if(isset($mesajVarAmaGosterilmiyor)) {
            if ($mesajVarAmaGosterilmiyor == 1) {
                echo "<tr>";
                echo "<th>MESAJ YOK</th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "</li>";
        echo "</ul>";
        echo "</li>";
        echo "</ul>";
        if (@$_GET['email3']) {
            $_SESSION['emailId'] = $_REQUEST['email3'];
            $emailOkuId = $_SESSION['emailId'];
            $emailiSilenKullanici = NULL;
            if($session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
                $emailOkuKullaniciId = $session->_read4($_SESSION["girisKullaniciId"]);
            } else {
                $emailOkuKullaniciId = $session->_read2($_SESSION["girisKullaniciId"]);
            }
            $emailOkuSorgu6 = $baglanti->prepare("SELECT e.emailSilindi FROM emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId WHERE e.alanId = :kullaniciId AND e.emailId = :emailId");
            $emailOkuSorgu6->bindParam(':emailId', $emailOkuId, PDO::PARAM_STR);
            $emailOkuSorgu6->bindParam(':kullaniciId', $emailOkuKullaniciId, PDO::PARAM_STR);
            $emailOkuSorgu6->execute();
            if ($emailOkuSorgu6->rowCount() > 0) {
                while ($rowKullanici = $emailOkuSorgu6->fetch(PDO::FETCH_ASSOC)) {
                    $emailiSilenKullanici = $rowKullanici['emailSilindi'];
                }
            }
            $emailiSilenKullanici .= $emailOkuKullaniciId . "|";
            $emailOkuSorgu7 = $baglanti->prepare("UPDATE emailler AS e INNER JOIN kullanicilar AS k ON e.gonderenId = k.kullaniciId SET e.emailSilindi = :silinenId WHERE e.alanId = :kullaniciId AND e.emailId = :emailId");
            $emailOkuSorgu7->bindParam(':silinenId', $emailiSilenKullanici, PDO::PARAM_STR);
            $emailOkuSorgu7->bindParam(':emailId', $emailOkuId, PDO::PARAM_STR);
            $emailOkuSorgu7->bindParam(':kullaniciId', $emailOkuKullaniciId, PDO::PARAM_STR);
            $emailOkuSorgu7->execute();
            header("Location: index.php?sayfa=mail");
        }

        $emailSorgu2->bindParam(':kullaniciId', $emailKullaniciId, PDO::PARAM_STR);
        $emailSorgu2->execute();
        echo "<ul id='emailGonderilen'>";
        echo "<li><a href='index.php?sayfa=mail&s=2' class='emailUlA'>Gönderilen Mesajlar</a>";
        echo "<ul>";
        echo "<li>";
        echo "<table class='emailtable2'>";
        echo "<tr>";
        echo "<th><a href='index.php?sayfa=mail&s=8'>Alıcı İsmi</a></th>";
        echo "<th><a href='index.php?sayfa=mail&s=9'>Alıcı Soyismi</a></th>";
        echo "<th><a href='index.php?sayfa=mail&s=10'>Alıcı E-Mail</a></th>";
        echo "<th><a href='index.php?sayfa=mail&s=11'>Konu</a></th>";
        echo "<th><a href='index.php?sayfa=mail&s=12'>Tarih</a></th>";
        echo "<th colspan='2'></th>";
        echo "</tr>";

        if ($emailSorgu2->rowCount() > 0) {
            $mesajVarAmaGosterilmiyor2 = 1;
            while ($rowEmail = $emailSorgu2->fetch(PDO::FETCH_ASSOC)) {
                $emailKullaniciEslesti = 0;
                $konferansKullanicilarDizi = str_split($rowEmail['emailSilindi']);
                $konferansKullanicilarkarakter = 0;
                $kullanici = NULL;
                if ($rowEmail['emailSilindi'] != NULL) {
                    foreach ($konferansKullanicilarDizi as $item) {
                        if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                            $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                        } else {
                            if($session->_read4($_SESSION['girisKullaniciId']) != NULL) {
                                if ($kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                    $emailKullaniciEslesti++;
                                }
                            } else {
                                if ($kullanici == $session->_read2($_SESSION['girisKullaniciId'])) {
                                    $emailKullaniciEslesti++;
                                }
                            }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                    if ($emailKullaniciEslesti == 0) {
                        $mesajVarAmaGosterilmiyor2--;
                        echo "<tr>";
                        if (mb_strlen($rowEmail['kullaniciIsim1']) > 16) {
                            echo "<th title='" . $rowEmail['kullaniciIsim1'] . "'>" . mb_substr($rowEmail['kullaniciIsim1'], 0, 13) . "...</th>";
                        } else {
                            echo "<th>" . $rowEmail['kullaniciIsim1'] . "</th>";
                        }
                        if (mb_strlen($rowEmail['kullaniciSoyisim']) > 16) {
                            echo "<th title='" . $rowEmail['kullaniciSoyisim'] . "'>" . mb_substr($rowEmail['kullaniciSoyisim'], 0, 13) . "...</th>";
                        } else {
                            echo "<th>" . $rowEmail['kullaniciSoyisim'] . "</th>";
                        }
                        if (mb_strlen($rowEmail['kullaniciMail']) > 32) {
                            echo "<th title='" . $rowEmail['kullaniciMail'] . "'>" . mb_substr($rowEmail['kullaniciMail'], 0, 29) . "...</th>";
                        } else {
                            echo "<th>" . $rowEmail['kullaniciMail'] . "</th>";
                        }
                        if (mb_strlen($rowEmail['emailKonu']) > 16) {
                            echo "<th title='" . $rowEmail['emailKonu'] . "'>" . mb_substr($rowEmail['emailKonu'], 0, 13) . "...</th>";
                        } else {
                            echo "<th>" . $rowEmail['emailKonu'] . "</th>";
                        }
                        echo "<th>" . date("d.m.Y H:i", $rowEmail['emailTarih']) . "</th>";
                        echo "<th><a href='index.php?sayfa=mail&email4=$rowEmail[emailId]'>Yanıtla</a></th>";
                        echo "<th><a href=\"index.php?sayfa=mail&email5=$rowEmail[emailId]\" OnClick=\"return confirm('Mesajı silmek istediğinize emin misiniz?');\">Sil</a></th>";
                        echo "</tr>";
                    }
                } else {
                    $mesajVarAmaGosterilmiyor2--;
                    echo "<tr>";
                    if (mb_strlen($rowEmail['kullaniciIsim1']) > 16) {
                        echo "<th title='" . $rowEmail['kullaniciIsim1'] . "'>" . mb_substr($rowEmail['kullaniciIsim1'], 0, 13) . "...</th>";
                    } else {
                        echo "<th>" . $rowEmail['kullaniciIsim1'] . "</th>";
                    }
                    if (mb_strlen($rowEmail['kullaniciSoyisim']) > 16) {
                        echo "<th title='" . $rowEmail['kullaniciSoyisim'] . "'>" . mb_substr($rowEmail['kullaniciSoyisim'], 0, 13) . "...</th>";
                    } else {
                        echo "<th>" . $rowEmail['kullaniciSoyisim'] . "</th>";
                    }
                    if (mb_strlen($rowEmail['kullaniciMail']) > 32) {
                        echo "<th title='" . $rowEmail['kullaniciMail'] . "'>" . mb_substr($rowEmail['kullaniciMail'], 0, 29) . "...</th>";
                    } else {
                        echo "<th>" . $rowEmail['kullaniciMail'] . "</th>";
                    }
                    if (mb_strlen($rowEmail['emailKonu']) > 16) {
                        echo "<th title='" . $rowEmail['emailKonu'] . "'>" . mb_substr($rowEmail['emailKonu'], 0, 13) . "...</th>";
                    } else {
                        echo "<th>" . $rowEmail['emailKonu'] . "</th>";
                    }
                    echo "<th>" . date("d.m.Y H:i", $rowEmail['emailTarih']) . "</th>";
                    echo "<th><a href='index.php?sayfa=mail&email4=$rowEmail[emailId]'>Yanıtla</a></th>";
                    echo "<th><a href=\"index.php?sayfa=mail&email5=$rowEmail[emailId]\" OnClick=\"return confirm('Mesajı silmek istediğinize emin misiniz?');\">Sil</a></th>";
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr>";
            echo "<th>MESAJ YOK</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
        }
        if(isset($mesajVarAmaGosterilmiyor2)) {
            if ($mesajVarAmaGosterilmiyor2 == 1) {
                echo "<tr>";
                echo "<th>MESAJ YOK</th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "<th></th>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "</li>";
        echo "</ul>";
        echo "</li>";
        echo "</ul>";
        if (@$_GET['email5']) {
            $_SESSION['emailId'] = $_REQUEST['email5'];
            $emailOkuId = $_SESSION['emailId'];
            $emailiSilenKullanici = NULL;
            if($session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
                $emailOkuKullaniciId = $session->_read4($_SESSION["girisKullaniciId"]);
            } else {
                $emailOkuKullaniciId = $session->_read2($_SESSION["girisKullaniciId"]);
            }
            $emailOkuSorgu8 = $baglanti->prepare("SELECT e.emailSilindi FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.gonderenId = :kullaniciId AND e.emailId = :emailId");
            $emailOkuSorgu8->bindParam(':emailId', $emailOkuId, PDO::PARAM_STR);
            $emailOkuSorgu8->bindParam(':kullaniciId', $emailOkuKullaniciId, PDO::PARAM_STR);
            $emailOkuSorgu8->execute();
            if ($emailOkuSorgu8->rowCount() > 0) {
                while ($rowKullanici = $emailOkuSorgu8->fetch(PDO::FETCH_ASSOC)) {
                    $emailiSilenKullanici = $rowKullanici['emailSilindi'];
                }
            }
            $emailiSilenKullanici .= $emailOkuKullaniciId . "|";
            $emailOkuSorgu9 = $baglanti->prepare("UPDATE emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId SET e.emailSilindi = :silinenId WHERE e.gonderenId = :kullaniciId AND e.emailId = :emailId");
            $emailOkuSorgu9->bindParam(':silinenId', $emailiSilenKullanici, PDO::PARAM_STR);
            $emailOkuSorgu9->bindParam(':emailId', $emailOkuId, PDO::PARAM_STR);
            $emailOkuSorgu9->bindParam(':kullaniciId', $emailOkuKullaniciId, PDO::PARAM_STR);
            $emailOkuSorgu9->execute();
            header("Location: index.php?sayfa=mail");
        }
    } else {
        echo "Erişim engellendi";
    }
} else {
    echo "Giriş yapınız";
}

?>