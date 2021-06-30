<style>
    .altMenuler{position:relative; top:13px;}
    #altMenu{list-style-type:none; padding:0px;}
    #altMenu ul{list-style-type:none; padding:0px;}
    #altMenu li{position:relative; float:left; margin:0px 5px; text-align:center;}
    #altMenu a{text-decoration:none; color:#eee; padding:13px 5px; cursor: pointer;}
    #altMenu a:hover{background-color:#eee; color:#323232;}

    .emailMenu{position:absolute; right:5px; top:-13px; text-decoration:none; color:#eee; padding:13px 5px; cursor: pointer;}
    .emailMenu:hover{background-color:#eee; color:#323232;}

    .aramaInput{background-color:#eee; padding:5px; border:1px solid #323232; border-radius:2px 2px;}
    .aramaButon{background-color:#eee; padding:5px 10px; border:1px solid #323232; border-radius:2px 2px;}

</style>
<?php
echo "<div class='altMenuler'>";
echo "<ul id='altMenu'>";
echo "<li><a href='index.php'>Ana Sayfa</a></li>";

if (@$session->_read($_SESSION["girisKullaniciId"])) {
    echo "<style>.arama{position:absolute; top:-5px; right:80px; text-decoration:none; color:#eee;}</style>";
    $okunmayanEmailSayisi = 0;
    $emailOkunmayanSorgu = $baglanti->prepare("SELECT e.emailSilindi, e.emailOkundu FROM emailler AS e INNER JOIN kullanicilar AS k ON e.alanId = k.kullaniciId WHERE e.alanId = :kullaniciId");
    if ($session->_read4($_SESSION['girisKullaniciId'])) {
        $emailKullaniciId = $session->_read4($_SESSION["girisKullaniciId"]);
    } else {
        $emailKullaniciId = $session->_read2($_SESSION["girisKullaniciId"]);
    }
    $emailOkunmayanSorgu->bindParam(':kullaniciId', $emailKullaniciId, PDO::PARAM_STR);
    $emailOkunmayanSorgu->execute();
    if ($emailOkunmayanSorgu->rowCount() > 0) {
        while ($rowEmailOkunmayan = $emailOkunmayanSorgu->fetch(PDO::FETCH_ASSOC)) {
            $konferansKullanicilarDizi = str_split($rowEmailOkunmayan['emailSilindi']);
            $konferansKullanicilarkarakter = 0;
            $kullanici = NULL;
            $emailKullaniciEslesti = 0;
            if ($rowEmailOkunmayan['emailSilindi'] != NULL) {
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
                    if ($rowEmailOkunmayan['emailOkundu'] == 0)
                        $okunmayanEmailSayisi++;
                }
            } else {
                if ($rowEmailOkunmayan['emailOkundu'] == 0)
                    $okunmayanEmailSayisi++;
            }
        }
    }

    $sayfaRoller = "roller";
    $sayfaKonferans = "konferanslar";
    $sayfaMail = "mail";

    if ($session->_read($_SESSION["girisKullaniciId"]) == 1) {
        echo "<li><a href='index.php?sayfa=$sayfaRoller'>Roller</a></li>";
        echo "<li><a href='index.php?sayfa=$sayfaKonferans'>Konferanslar</a></li>";
        echo "</ul>";
        echo "<a href='index.php?sayfa=$sayfaMail' class='emailMenu'>E-Mail ( " . $okunmayanEmailSayisi . " )</a>";

    } else if ($session->_read($_SESSION["girisKullaniciId"]) == 2 || ($session->_read3($_SESSION["girisKullaniciId"]) == 2 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        echo "<li><a href='index.php?sayfa=$sayfaKonferans'>Konferanslar</a></li>";
        echo "</ul>";
        echo "<a href='index.php?sayfa=$sayfaMail' class='emailMenu'>E-Mail ( " . $okunmayanEmailSayisi . " )</a>";

    } else if ($session->_read($_SESSION["girisKullaniciId"]) == 3 || ($session->_read3($_SESSION["girisKullaniciId"]) == 3 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        echo "<li><a href='index.php?sayfa=$sayfaKonferans'>Konferanslar</a></li>";
        echo "</ul>";
        echo "<a href='index.php?sayfa=$sayfaMail' class='emailMenu'>E-Mail ( " . $okunmayanEmailSayisi . " )</a>";

    } else if ($session->_read($_SESSION["girisKullaniciId"]) == 4 || ($session->_read3($_SESSION["girisKullaniciId"]) == 4 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        echo "<li><a href='index.php?sayfa=$sayfaKonferans'>Konferanslar</a></li>";
        echo "</ul>";
        echo "<a href='index.php?sayfa=$sayfaMail' class='emailMenu'>E-Mail ( " . $okunmayanEmailSayisi . " )</a>";

    } else if ($session->_read($_SESSION["girisKullaniciId"]) == 5 || ($session->_read3($_SESSION["girisKullaniciId"]) == 5 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        echo "</ul>";
        echo "<a href='index.php?sayfa=$sayfaMail' class='emailMenu'>E-Mail ( " . $okunmayanEmailSayisi . " )</a>";

    } else{
        echo "</ul>";
        echo "<a href='index.php?sayfa=$sayfaMail' class='emailMenu'>E-Mail ( " . $okunmayanEmailSayisi . " )</a>";

    }
} else {
    echo "<style>.arama{position:absolute; top:-5px; right:5px; text-decoration:none; color:#eee;}</style>";
    echo "</ul>";

}
echo "</div>";
?>