<?php
if(isset($_POST['ad2'])) {
    $adKontrolu = 0;
    $adHataMesaji = NULL;
    $ad = $_POST["ad2"];
    //Türkçe karakter analizi
    $adDizi = str_split($ad);
    $karakter = 0;
    foreach ($adDizi as $adDiziKarakter) {
        if (@ord($adDizi[$karakter]) == 195 && ord($adDizi[$karakter + 1]) == 167) {
            /*$adDizi[$karakter] = "c";
            $adDizi[$karakter + 1] = NULL;
            $karakter++;*/
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//ç
        if (@ord($adDizi[$karakter]) == 195 && ord($adDizi[$karakter + 1]) == 182) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//ö
        if (@ord($adDizi[$karakter]) == 195 && ord($adDizi[$karakter + 1]) == 188) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//ü
        if (@ord($adDizi[$karakter]) == 196 && ord($adDizi[$karakter + 1]) == 159) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//ğ
        if (@ord($adDizi[$karakter]) == 196 && ord($adDizi[$karakter + 1]) == 177) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//ı
        if (@ord($adDizi[$karakter]) == 197 && ord($adDizi[$karakter + 1]) == 159) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//ş
        if (@ord($adDizi[$karakter]) == 195 && ord($adDizi[$karakter + 1]) == 135) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//Ç
        if (@ord($adDizi[$karakter]) == 195 && ord($adDizi[$karakter + 1]) == 150) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//Ö
        if (@ord($adDizi[$karakter]) == 196 && ord($adDizi[$karakter + 1]) == 176) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//İ
        if (@ord($adDizi[$karakter]) == 197 && ord($adDizi[$karakter + 1]) == 158) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//Ş
        if (@ord($adDizi[$karakter]) == 195 && ord($adDizi[$karakter + 1]) == 156) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//Ü
        if (@ord($adDizi[$karakter]) == 196 && ord($adDizi[$karakter + 1]) == 158) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//Ğ
        if (@(ord($adDizi[$karakter]) < 48 || ((ord($adDizi[$karakter]) > 57) && (ord($adDizi[$karakter]) < 65))) || @(ord($adDizi[$karakter]) > 90 && (ord($adDizi[$karakter]) < 97)) || @(ord($adDizi[$karakter]) > 122)) {
            $adKontrolu = 1;
            $adHataMesaji = "Kullanıcı adı İngilizce harf ve rakamlardan oluşabilir.";
            break;
        }//harf, sayı hariç
        $karakter++;
    }

    if ((ord($adDizi[0]) > 47 && (ord($adDizi[0]) < 58))) {
        $adKontrolu = 1;
        $adHataMesaji = "Kullanıcı adı rakamla başlayamaz.";
    }

    $ad = implode($adDizi);
    if (strlen($ad) < 5) {
        $adKontrolu = 1;
        $adHataMesaji = "Kullanıcı adı 5 karakterden kısa olamaz.";
    }
    $adSorgusu = $baglanti->prepare("SELECT kullaniciAd FROM kullanicilar WHERE kullaniciId != ? AND kullaniciSilindi = 0");
    $adSorgusu->execute(array($_REQUEST['kGuncelle']));
    if ($adSorgusu->rowCount() > 0) {
        while ($row = $adSorgusu->fetch(PDO::FETCH_ASSOC)) {
            if ($row['kullaniciAd'] == $ad) {
                $adHataMesaji = "Bu kullanıcı adı başkası tarafından kullanılıyor.";
                $adKontrolu = 1;
                break;
            }
        }
    }
}
?>