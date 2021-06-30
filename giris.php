<style>
    .baslik{font-size:30px; margin:50px 10px 50px 50px; position:relative; top:10px;}
    .baslik{text-decoration:none; color:#eee}
    .kullaniciGiris{position:relative; float:right; margin:20px; z-index: 999;}
    .kullaniciGirisYazi{color:#eee;}
    .kullaniciGirisInput{width:100px; margin-right:10px; background-color:#eee; border:1px solid #eee; border-radius:2px 2px}
    .kullaniciGirisButon{padding:3px 10px; background-color:#eee; border:1px solid #eee; border-radius:2px 2px}
    .kullaniciGirisLink{position:relative; color:#ccc; text-decoration:none; font-size:13px; top:5px}

    #kullaniciGirisMenu{list-style-type:none; float:left; margin-top:10px; padding:0px;}
    #kullaniciGirisMenu li{position:relative; margin-right:20px; width:80px; text-align:center;}
    #kullaniciGirisMenu a{text-decoration:none; color:#eee; display:block; background-color:#323232; border:1px solid #323232; border-radius:2px 2px; padding:5px; cursor:pointer;}
    #kullaniciGirisMenu a:hover{background-color:#eee; color:#323232; border:1px solid #eee;}
    #kullaniciGirisMenu ul{list-style-type:none; padding:0px;}
    #kullaniciGirisMenu li:hover ul{position:absolute; display:block;}
    #kullaniciGirisMenu li ul{display:none; top:27px; z-index:999}

    .kullaniciOlarak{position:relative; left:-100px; top:3px; z-index:100;}
    .kullaniciOlarak a{width:140px}

</style>
<?php
include("veritabaniBaglantisi.php");
include_once("Session.php");
include_once ('sayfaDuzeni/securimage/securimage.php');
$securimage = new Securimage();
$girisHataMesaj = NULL;
if(isset($_POST['girisKullaniciAd2']) && isset($_POST['girisKullaniciSifre2'])) {
    if (isset($_POST['captchaCode2'])) {
        if ($securimage->check($_POST['captchaCode2']) == true) {
            $girisKullaniciAd = $_POST['girisKullaniciAd2'];
            $girisKullaniciSifre = $_POST['girisKullaniciSifre2'];
            $girisHataKontrol = 0;
            $girisHataMesaj = NULL;
            $izin = 0;
            $sorgu = $baglanti->prepare("SELECT kullaniciAd, kullaniciSifre, kullaniciKey FROM kullanicilar WHERE kullaniciAd = :kullaniciAd AND kullaniciSilindi = 0");
            $sorgu->bindParam(':kullaniciAd', $girisKullaniciAd, PDO::PARAM_STR);
            $sorgu->execute();
            if ($sorgu->rowCount() > 0) {
                while ($row = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    $check_password = hash('sha256', $girisKullaniciSifre . $row['kullaniciKey']);
                    for ($round = 0; $round < 65536; $round++) {
                        $check_password = hash('sha256', $check_password . $row['kullaniciKey']);
                    }
                    if ($row['kullaniciAd'] == $girisKullaniciAd && md5($check_password) == md5($row['kullaniciSifre'])) {
                        $izin = 1;
                    } else {
                        $girisHataMesaj = "Kullanıcı adı veya şifre yanlış.";
                        $girisHataKontrol = 1;
                    }
                }
            } else {
                $girisHataMesaj = "Kullanıcı adı veya şifre yanlış.";
                $girisHataKontrol = 1;
            }

            if ($izin == 1) {
                $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciIsim1, kullaniciRol FROM kullanicilar WHERE kullaniciAd = :kullaniciAd AND kullaniciSilindi = 0");
                $sorgu->bindParam(':kullaniciAd', $girisKullaniciAd, PDO::PARAM_STR);
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($row = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $_SESSION["girisKullaniciId"] = $row['kullaniciId'];
                        $_SESSION["girisKullaniciRol"] = $row['kullaniciRol'];
                        $_SESSION["girisKullaniciIsim1"] = $row['kullaniciIsim1'];
                        $_SESSION["girisKullaniciIsim1Yedek"] = $row['kullaniciIsim1'];
                        $session->_open();
                        $session->_write($row['kullaniciId'], $row['kullaniciRol'], $row['kullaniciId']);
                        header("Location: index.php");
                    }
                }
            }
        } else {
            $girisHataMesaj = "Captcha yanlış girdiniz.";
            $girisHataKontrol = 1;
        }
    }
}
echo "<a href='index.php' class='baslik'>Konferans Yönetim Sistemi</a>";
echo "<div class='kullaniciGiris'>";
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    header( "refresh:1200;url=cikisYap.php" );
    $kGuncelleId = $session->_read2($_SESSION["girisKullaniciId"]);
    echo "<a class='kullaniciGirisYazi' style='position:absolute; left:0px; top:0px;'>Hoş geldiniz " . mb_substr($_SESSION['girisKullaniciIsim1'], 0, 11) . "</a><br/>";
    echo "<ul id='kullaniciGirisMenu'>";
    echo "<li><a href='index.php?sayfa=kullaniciGuncelle&kGuncelle=$kGuncelleId'>Ayarlar</a></li>";
    echo "</li>";
    echo "</ul>";
    echo "<ul id='kullaniciGirisMenu'>";
    echo "<li><a href='cikisYap.php'>Çıkış Yap</a>";
    echo "</li>";
    if (@$session->_read3($_SESSION["girisKullaniciId"]) && @$session->_read4($_SESSION["girisKullaniciId"])) {
        echo "<li class=\"kullaniciOlarak\"><a href=\"cikisKullaniciOlarak.php\">Diğer Kullanıcı Çıkışı Yap</a>";
    }
    echo "</li>";
    echo "</ul>";
} else {
    echo "<form action='' method='post'>";
    echo "<a class='kullaniciGirisYazi'>Kullanıcı Adı:</a><a class='kullaniciGirisYazi' style='margin-left:40px'>Şifre:</a><br/>";
    echo "<input class='kullaniciGirisInput' type='text' name='girisKullaniciAd2'/>";
    echo "<input class='kullaniciGirisInput' type='password' name='girisKullaniciSifre2'/><br/>";
    echo "<input class='kullaniciGirisButon' type='submit' name='giris' value='Giriş' style='margin-top:5px'/><br/>";
    echo "<a class='kullaniciGirisLink' href='index.php?sayfa=kayitOl'>Kayıt Ol</a>";
    echo "<img id='captcha' src='sayfaDuzeni/securimage/securimage_show.php' width='150px' style='position:absolute; right:230px; top:-10px'/>";
    echo "<input type='text' name='captchaCode2' class='kullaniciGirisInput' style='position:absolute; right:220px; top:50px'/>";
    echo "<a class='kullaniciGirisLink' style='position:absolute; right:340px; top:47px' href='#' onclick=\"document.getElementById('captcha').src = 'sayfaDuzeni/securimage/securimage_show.php?' + Math.random(); return false\">Resmi Değiştir</a>";
    echo "</form>";
    echo "<i style='color:#eee'>" . $girisHataMesaj . "</i>";
}
echo "</div>";

?>