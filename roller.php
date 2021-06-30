 <style>
     .kullaniciEkleLink{border:1px solid #323232; border-radius:2px 2px; background-color:#323232; color:#ddd; padding:10px; text-decoration:none;}
     .kullaniciEkleLink:hover{border:1px solid #323232; background-color:#ddd; color:#323232;}

     .roltable {font-family:aria, sans-serif; font-size:85%; border-collapse:collapse; width:100%;}
     .roltable td, .roltable th {border:1px solid #323232; text-align:left; padding:5px; width:auto; overflow:hidden;}
     .roltable tr:hover {background-color: #323232; color: #ddd;}
     .roltable tr:hover a{color:#ddd; text-decoration:none}
     .roltable tr:first-child {background-color:#ddd; word-wrap:break-word}
     .roltable tr:first-child:hover {background-color:#ddd;}
     .roltable tr:first-child:hover a:link{color:#0000EE; text-decoration:underline}
     .roltable tr:first-child:hover a:visited{color:#551A8B; text-decoration:underline}
 </style>
 <?php
 include("veritabaniBaglantisi.php");
 include_once ("Session.php");
 include_once ("siniflar/rolGuncelle.php");
 $rolGuncelle = new rolGuncelle;
 if (@$session->_read($_SESSION["girisKullaniciId"])) {
     if (@$session->_read($_SESSION["girisKullaniciId"]) == 1) {
         if (@$_GET['s'] == '1') {
             if ($_SESSION['kullaniciTabloSirala'] != 1)
                 $_SESSION['kullaniciTabloSirala'] = 1;
             else
                 $_SESSION['kullaniciTabloSirala'] = 11;
             header("Location: index.php?sayfa=roller");
         } else if (@$_GET['s'] == '2') {
             if ($_SESSION['kullaniciTabloSirala'] != 2)
                 $_SESSION['kullaniciTabloSirala'] = 2;
             else
                 $_SESSION['kullaniciTabloSirala'] = 22;
             header("Location: index.php?sayfa=roller");
         } else if (@$_GET['s'] == '3') {
             if ($_SESSION['kullaniciTabloSirala'] != 3)
                 $_SESSION['kullaniciTabloSirala'] = 3;
             else
                 $_SESSION['kullaniciTabloSirala'] = 33;
             header("Location: index.php?sayfa=roller");
         } else if (@$_GET['s'] == '4') {
             if ($_SESSION['kullaniciTabloSirala'] != 4)
                 $_SESSION['kullaniciTabloSirala'] = 4;
             else
                 $_SESSION['kullaniciTabloSirala'] = 44;
             header("Location: index.php?sayfa=roller");
         }
         if (@$_SESSION['kullaniciTabloSirala'] == 1) {
             $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciId != :kullaniciId AND kullaniciSilindi = 0 ORDER BY kullaniciAd");
         } else if (@$_SESSION['kullaniciTabloSirala'] == 11) {
             $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciId != :kullaniciId AND kullaniciSilindi = 0 ORDER BY kullaniciAd DESC");
         } else if (@$_SESSION['kullaniciTabloSirala'] == 2) {
             $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciId != :kullaniciId AND kullaniciSilindi = 0 ORDER BY kullaniciIsim1");
         } else if (@$_SESSION['kullaniciTabloSirala'] == 22) {
             $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciId != :kullaniciId AND kullaniciSilindi = 0 ORDER BY kullaniciIsim1 DESC");
         } else if (@$_SESSION['kullaniciTabloSirala'] == 3) {
             $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciId != :kullaniciId AND kullaniciSilindi = 0 ORDER BY kullaniciMail");
         } else if (@$_SESSION['kullaniciTabloSirala'] == 33) {
             $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciId != :kullaniciId AND kullaniciSilindi = 0 ORDER BY kullaniciMail DESC");
         } else if (@$_SESSION['kullaniciTabloSirala'] == 4) {
             $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciId != :kullaniciId AND kullaniciSilindi = 0 ORDER BY kullaniciRol");
         } else if (@$_SESSION['kullaniciTabloSirala'] == 44) {
             $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciId != :kullaniciId AND kullaniciSilindi = 0 ORDER BY kullaniciRol DESC");
         } else {
             $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciMail, kullaniciRol FROM kullanicilar WHERE kullaniciId != :kullaniciId AND kullaniciSilindi = 0 ORDER BY kullaniciAd");
         }
		 $kullanicininId = $session->_read2($_SESSION["girisKullaniciId"]);
		 $sorgu->bindParam(':kullaniciId', $kullanicininId, PDO::PARAM_STR);
         $sorgu->execute();
         $kullaniciRolDiziId = array($sorgu->rowCount());
         $kullaniciRolDizi = array($sorgu->rowCount());
         $kullaniciRolSayi = 0;

         echo "<a href='index.php?sayfa=kullaniciKullaniciEkle' class='kullaniciEkleLink'>Kullanıcı Ekle</a><br/><br/><br/>";
         echo "<form action='' method='post'>";
         echo "<table class='roltable'>";
         echo "<tr>";
         echo "<th><a href='roller.php?s=1'>KULLANICI ADI</a></th>";
         echo "<th><a href='roller.php?s=2'>İSİM</a></th>";
         echo "<th><a href='roller.php?s=2'>SOYİSİM</a></th>";
         echo "<th><a href='roller.php?s=3'>EPOSTA</a></th>";
         echo "<th><a href='roller.php?s=3'>ROL</a></th>";
         echo "<th></th>";
         echo "<th></th>";
         echo "<th></th>";
         echo "</tr>";
         if ($sorgu->rowCount() > 0) {
             while ($rowRol = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                     echo "<tr>";
                     echo "<th>" . $rowRol['kullaniciAd'] . "</th>";
                     echo "<th>" . $rowRol['kullaniciIsim1'] . "</th>";
                     echo "<th>" . $rowRol['kullaniciSoyisim'] . "</th>";
                     echo "<th>" . $rowRol['kullaniciMail'] . "</th>";
                     if ($rowRol['kullaniciRol'] == 1) {
                         echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='" . $kullaniciRolSayi . "'>";
                         echo "<option value='1'>Admin</option>";
                         echo "<option value='2'>Chair</option>";
                         echo "<option value='3'>Author</option>";
                         echo "<option value='4'>Reviewer</option>";
                         echo "<option value='5'>Reader</option>";
                         echo "<option value='6'>Boş</option>";
                         echo "</select></th>";
                     } else if ($rowRol['kullaniciRol'] == 2) {
                         echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='" . $kullaniciRolSayi . "'>";
                         echo "<option value='2'>Chair</option>";
                         echo "<option value='1'>Admin</option>";
                         echo "<option value='3'>Author</option>";
                         echo "<option value='4'>Reviewer</option>";
                         echo "<option value='5'>Reader</option>";
                         echo "<option value='6'>Boş</option>";
                         echo "</select></th>";
                     } else if ($rowRol['kullaniciRol'] == 3) {
                         echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='" . $kullaniciRolSayi . "'>";
                         echo "<option value='3'>Author</option>";
                         echo "<option value='1'>Admin</option>";
                         echo "<option value='2'>Chair</option>";
                         echo "<option value='4'>Reviewer</option>";
                         echo "<option value='5'>Reader</option>";
                         echo "<option value='6'>Boş</option>";
                         echo "</select></th>";
                     } else if ($rowRol['kullaniciRol'] == 4) {
                         echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='" . $kullaniciRolSayi . "'>";
                         echo "<option value='4'>Reviewer</option>";
                         echo "<option value='1'>Admin</option>";
                         echo "<option value='2'>Chair</option>";
                         echo "<option value='3'>Author</option>";
                         echo "<option value='5'>Reader</option>";
                         echo "<option value='6'>Boş</option>";
                         echo "</select></th>";
                     } else if ($rowRol['kullaniciRol'] == 5) {
                         echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='" . $kullaniciRolSayi . "'>";
                         echo "<option value='5'>Reader</option>";
                         echo "<option value='1'>Admin</option>";
                         echo "<option value='2'>Chair</option>";
                         echo "<option value='3'>Author</option>";
                         echo "<option value='4'>Reviewer</option>";
                         echo "<option value='6'>Boş</option>";
                         echo "</select></th>";
                     } else {
                         echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='" . $kullaniciRolSayi . "'>";
                         echo "<option value='6'>Boş</option>";
                         echo "<option value='1'>Admin</option>";
                         echo "<option value='2'>Chair</option>";
                         echo "<option value='3'>Author</option>";
                         echo "<option value='4'>Reviewer</option>";
                         echo "<option value='5'>Reader</option>";
                         echo "</select></th>";
                     }
                     echo "<th><a href='index.php?sayfa=kullaniciGuncelle&kGuncelle=$rowRol[kullaniciId]'>Düzenle</a></th>";
                     echo "<th><a href=\"kullaniciSil.php?kSil=$rowRol[kullaniciId]\" OnClick=\"return confirm('" . $rowRol['kullaniciAd'] . " kullanıcısını silmek istediğinize emin misiniz?');\">Sil</a></th>";
                     echo "<th><a href=\"girisKullaniciOlarak.php?kGiris=$rowRol[kullaniciRol]&kGiris2=$rowRol[kullaniciId]&kGiris3=$rowRol[kullaniciIsim1]\" OnClick=\"return confirm('" . $rowRol['kullaniciAd'] . " kullanıcısı olarak giriş yapmaya emin misiniz?');\">Giriş Yap</a></th>";
                     echo "</tr>";
                     $kullaniciRolDizi[$kullaniciRolSayi] = $rowRol['kullaniciRol'];
                     $kullaniciRolDiziId[$kullaniciRolSayi] = $rowRol['kullaniciId'];
                     $kullaniciRolSayi++;
                 
             }
         }
         echo "</table>";
         echo "<input id='kaydetbutonu' style='padding:3px 15px; margin-right:300px; margin-top:15px' onclick='" . $rolGuncelle->guncelle($kullaniciRolDizi, $kullaniciRolDiziId, $baglanti) . "' type='submit' name='kayit' value='Kaydet'/>";
         echo "</form>";
     } else {
         echo "Erişim engellendi.";
     }
 } else {
     echo "Giriş yapınız.";
 }
 ?>