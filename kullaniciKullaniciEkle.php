<style>
    .kayitOl a{display:inline-block; float:left; width:80px; margin-right:10px; margin-top:5px;}
    .kayitOl i{margin-left:5px; color: firebrick}
    .geriButonuLink{border:1px solid #323232; border-radius:2px 2px; background-color:#323232;color:#ddd; padding:10px 20px; text-decoration:none;}
    .geriButonuLink:hover{border:1px solid #323232; background-color:#ddd; color:#323232;}
</style>
<?php
include("veritabaniBaglantisi.php");
include_once ("Session.php");
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1) {
        $adKontrolu = 0;
        $sifreKontrolu = 0;
        $isim1Kontrolu = 0;
        $isim2Kontrolu = 0;
        $soyisimKontrolu = 0;
        $mailKontrolu = 0;
        $websiteKontrolu = 0;
        $telefonKontrolu = 0;
        $adHataMesaji = NULL;
        $sifreHataMesaji = NULL;
        $isim1HataMesaji = NULL;
        $isim2HataMesaji = NULL;
        $soyisimHataMesaji = NULL;
        $mailHataMesaji = NULL;
        $websiteHataMesaji = NULL;
        $telefonHataMesaji = NULL;
        $kullaniciGuncellendiMesaji = NULL;

        if (isset($_POST['ad2']) && isset($_POST['sifre2']) && isset($_POST['isim12']) && isset($_POST['isim22']) && isset($_POST['soyisim2']) && isset($_POST['cinsiyet2']) && isset($_POST['mail2']) && isset($_POST['website2']) && isset($_POST['telefon2']) && isset($_POST['adres2']) && isset($_POST['universite2']) && isset($_POST['unvan2']) && isset($_POST['biyografi2'])) {
            include("kontroller/kullaniciAdiKontrol.php");
            include("kontroller/sifreKontrol.php");
            include("kontroller/mailKontrol.php");
            include("kontroller/isim1Kontrol.php");
            include("kontroller/isim2Kontrol.php");
            include("kontroller/soyisimKontrol.php");
            include("kontroller/websiteKontrol.php");
            include("kontroller/telefonKontrol.php");
            $cinsiyet = $_POST['cinsiyet2'];
            $adres = $_POST['adres2'];
            $universite = $_POST['universite2'];
            $unvan = $_POST['unvan2'];
            $biyografi = $_POST['biyografi2'];

            if ($adKontrolu == 0 && $isim1Kontrolu == 0 && $isim2Kontrolu == 0 && $soyisimKontrolu == 0 && $mailKontrolu == 0 && $websiteKontrolu == 0 && $telefonKontrolu == 0) {
                $key = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
                $sifre = hash('sha256', $sifre . $key);
                for ($round = 0; $round < 65536; $round++) {
                    $sifre = hash('sha256', $sifre . $key);
                }
                $kullaniciEkle = $baglanti->prepare("INSERT INTO kullanicilar (kullaniciAd, kullaniciSifre, kullaniciIsim1, kullaniciIsim2, kullaniciSoyisim, kullaniciCinsiyet, kullaniciMail, kullaniciWebsite, kullaniciTelefon, kullaniciAdres, kullaniciUniversite, kullaniciUnvan, kullaniciBiyografi, kullaniciKey) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $kullaniciEkle->execute(array($ad, $sifre, $isim1, $isim2, $soyisim, $cinsiyet, $mail, $website, $telefon, $adres, $universite, $unvan, $biyografi, $key));
                if ($kullaniciEkle == TRUE)
                    $kullaniciGuncellendiMesaji = "Kayıt başarılı.";
                else
                    $kullaniciGuncellendiMesaji = "Kayıt hatası.";
            }
        }

        echo "<a href='index.php?sayfa=roller' class='geriButonuLink'>Geri</a><br/><br/><br/>";
        echo "<div class='kayitOl'>";
        echo "<form action='' method='post'>";
        echo "<i style='margin-left:0'>" . $kullaniciGuncellendiMesaji . "</i><br/><br/>";
        echo "<a>Kullanıcı Adı:*</a><input class='kullaniciAdi' style='padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='ad2'/><i>" . $adHataMesaji . "</i><br/><br/>";
        echo "<a>Şifre:*</a><input style='padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='password' name='sifre2'/><i>" . $sifreHataMesaji . "</i><br/><br/>";
        echo "<a>Şifre Tekrar:*</a><input style='padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='password' name='sifretekrar2'/><br/><br/>";
        echo "<a>İsim:*</a><input style='padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='isim12'/><i>" . $isim1HataMesaji . "</i><br/><br/>";
        echo "<a>İkinci İsim:</a><input style='padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='isim22'/><i>" . $isim2HataMesaji . "</i><br/><br/>";
        echo "<a>Soyisim:*</a><input style='padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='soyisim2'/><i>" . $soyisimHataMesaji . "</i><br/><br/>";
        echo "<a>Cinsiyet:</a><select style='padding:5px; width:75px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='cinsiyet2'>";
        echo "<option value='Erkek\'>Erkek</option>";
        echo "<option value='Kadin'>Kadın</option>";
        echo "</select><br/><br/>";
        echo "<a>E-Posta:*</a><input style='padding:5px; width:200px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='mail2'/><i>" . $mailHataMesaji . "</i><br/><br/>";
        echo "<a>Websitesi:</a><input style='padding:5px; width:200px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='website2'/><i>" . $websiteHataMesaji . "</i><br/><br/>";
        echo "<a>Telefon:</a><input style='padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='telefon2'/><i>" . $telefonHataMesaji . "</i><br/><br/>";
        echo "<a>Adres:</a><textarea rows='3' cols='30' style='padding:5px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='adres2'></textarea><br/><br/>";
        echo "<a>Üniversite:</a><input style='padding:5px; width:200px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='universite2'/><br/><br/>";
        echo "<a>Ünvan:</a><input style='padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='unvan2'/><br/><br/>";
        echo "<a>Biyografi:</a><textarea rows='8' cols='30' style='padding:5px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='biyografi2'></textarea><br/><br/>";
        echo "<input style='padding:3px 15px;' type='submit' name='kayit' value='Kayıt Ol'/>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "Erişim engellendi.";
    }
} else {
    echo "Giriş yapınız.";
}

?>