<style>
    .konferansOlustur a{display:inline-block; float:left; margin-right:10px; margin-top:5px;}
    .konferansOlustur i{margin-left:5px; color: firebrick}
    .geriButonuLink{border:1px solid #323232; border-radius:2px 2px; background-color:#323232;color:#ddd; padding:10px 20px; text-decoration:none;}
    .geriButonuLink:hover{border:1px solid #323232; background-color:#ddd; color:#323232;}
</style>
<?php
include("veritabaniBaglantisi.php");
include_once ("Session.php");
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1) {
        $konferansAdKontrolu = 0;
        $konferansIsimKontrolu = 0;
        $konferansIsimHataMesaji = NULL;
        $konferansOlusturulduMesaji = NULL;

        if (isset($_POST['konferansIsim2'])) {
            $konferansIsim = $_POST['konferansIsim2'];
            $konferansAdDizi = str_split(mb_strtolower($_POST['konferansIsim2']));
            $konferanskarakter = 0;
            $konferanskarakter2 = 0;
            foreach ($konferansAdDizi as $konferansAdDiziKarakter) {
                if (@ord($konferansAdDizi[$konferanskarakter]) == 195 && ord($konferansAdDizi[$konferanskarakter + 1]) == 167) {
                    $konferansAdDizi[$konferanskarakter] = 'c';
                }
                if (@ord($konferansAdDizi[$konferanskarakter]) == 195 && ord($konferansAdDizi[$konferanskarakter + 1]) == 182) {
                    $konferansAdDizi[$konferanskarakter] = 'o';
                }
                if (@ord($konferansAdDizi[$konferanskarakter]) == 195 && ord($konferansAdDizi[$konferanskarakter + 1]) == 188) {
                    $konferansAdDizi[$konferanskarakter] = 'u';
                }
                if (@ord($konferansAdDizi[$konferanskarakter]) == 196 && ord($konferansAdDizi[$konferanskarakter + 1]) == 159) {
                    $konferansAdDizi[$konferanskarakter] = 'g';
                }
                if (@ord($konferansAdDizi[$konferanskarakter]) == 196 && ord($konferansAdDizi[$konferanskarakter + 1]) == 177) {
                    $konferansAdDizi[$konferanskarakter] = 'i';
                }
                if (@ord($konferansAdDizi[$konferanskarakter]) == 197 && ord($konferansAdDizi[$konferanskarakter + 1]) == 159) {
                    $konferansAdDizi[$konferanskarakter] = 's';
                }

                if (@((ord($konferansAdDizi[$konferanskarakter]) > 47) && (ord($konferansAdDizi[$konferanskarakter]) < 58)) || ((ord($konferansAdDizi[$konferanskarakter]) > 96) && (ord($konferansAdDizi[$konferanskarakter]) < 123))) {
                    $konferansAdDizi[$konferanskarakter2] = $konferansAdDizi[$konferanskarakter];
                    $konferanskarakter2++;
                } else {
                    $konferansAdDizi[$konferanskarakter] = ' ';
                }
                $konferanskarakter++;
            }
            $konferansAd = implode($konferansAdDizi);
            $konferansAd = str_replace(' ', '', $konferansAd);
            $konferansAdDizi = str_split($konferansAd);
            for (; $konferanskarakter2 < count($konferansAdDizi); $konferanskarakter2++) {
                $konferansAdDizi[$konferanskarakter2] = ' ';
            }
            $konferansAd = implode($konferansAdDizi);
            $konferansAd = str_replace(' ', '', $konferansAd);

            $konferansSorgu = $baglanti->prepare("SELECT konferansAd, konferansIsim FROM konferanslar");
            $konferansSorgu->execute();
            if ($konferansSorgu->rowCount() > 0) {
                while ($rowKonferans = $konferansSorgu->fetch(PDO::FETCH_ASSOC)) {
                    if ($rowKonferans['konferansAd'] == $konferansAd) {
                        $konferansIsimHataMesaji = "Bu konferans ismi kullanılıyor. Konferansı başka isimde oluşturduktan sonra konferansın ismini değiştirin.";
                        $konferansAdKontrolu = 1;
                        break;
                    }
                    if ($rowKonferans['konferansIsim'] == $konferansIsim) {
                        $konferansIsimHataMesaji = "Bu konferans ismi kullanılıyor. Konferansı başka isimde oluşturduktan sonra konferansın ismini değiştirin.";
                        $konferansIsimKontrolu = 1;
                        break;
                    }
                }
            }
            if (mb_strlen($konferansAd) < 5) {
                $konferansIsimKontrolu = 1;
                $konferansIsimHataMesaji = "Konferans ismi 5 harften kısa olamaz.";
            }

            if ($konferansAdKontrolu == 0 && $konferansIsimKontrolu == 0) {
                $konferansEkle = $baglanti->prepare("INSERT INTO konferanslar (konferansAd, konferansIsim) VALUES(?,?)");
                $konferansEkle->execute(array($konferansAd, $konferansIsim));
                $konferansEkleBilgi = $baglanti->prepare("INSERT INTO konferanslarbilgi (konferansAd) VALUES(?)");
                $konferansEkleBilgi->execute(array($konferansAd));
                if ($konferansEkle == TRUE && $konferansEkleBilgi == TRUE)
                    $konferansOlusturulduMesaji = "Konferans oluşturuldu.";
                else
                    $konferansIsimHataMesaji = "Konferans oluşturma başarısız.";
            }
        }
        echo "<a href='index.php?sayfa=konferanslar' class='geriButonuLink'>Geri</a><br/><br/><br/>";
        echo "<div class='konferansOlustur'>";
        echo "<i>" . $konferansOlusturulduMesaji . "</i><br/>";
        echo "<form style='margin:20px;' action='' method='post'>";
        echo "<a style='padding:10px 0px;'>Konferans Adı: </a><input style='margin:5px 0px; padding:10px; width:500px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='konferansIsim2'/><i>" . $konferansIsimHataMesaji . "</i><br/><br/>";
        echo "<input style='padding:3px 15px; margin-top:5px' type='submit' name='kayit' value='Oluştur'  OnClick=\"return confirm('Konferans oluşturulsun mu?');\"/>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "Erişim engellendi.";
    }
} else {
    echo "Giriş yapınız.";
}

?>