<?php
if(isset($_POST['sifre2']) && isset($_POST['sifretekrar2'])) {
    if ($_POST['sifre2'] != NULL || $_POST['sifretekrar2'] != NULL) {
        $sifreKontrolu = 0;
        $sifreHataMesaji = NULL;
        $sifre = $_POST["sifre2"];
        $sifretekrar = $_POST['sifretekrar2'];
        $sifreDizi = str_split($sifre);
        $sifrekarakter = 0;
        if ($sifre == $sifretekrar) {
            foreach ($sifreDizi as $sifreDiziKarakter) {
                if (@ord($sifreDizi[$sifrekarakter]) == 195 && ord($sifreDizi[$sifrekarakter + 1]) == 167) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//ç
                if (@ord($sifreDizi[$sifrekarakter]) == 195 && ord($sifreDizi[$sifrekarakter + 1]) == 182) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//ö
                if (@ord($sifreDizi[$sifrekarakter]) == 195 && ord($sifreDizi[$sifrekarakter + 1]) == 188) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//ü
                if (@ord($sifreDizi[$sifrekarakter]) == 196 && ord($sifreDizi[$sifrekarakter + 1]) == 159) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//ğ
                if (@ord($sifreDizi[$sifrekarakter]) == 196 && ord($sifreDizi[$sifrekarakter + 1]) == 177) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//ı
                if (@ord($sifreDizi[$sifrekarakter]) == 197 && ord($sifreDizi[$sifrekarakter + 1]) == 159) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//ş
                if (@ord($sifreDizi[$sifrekarakter]) == 195 && ord($sifreDizi[$sifrekarakter + 1]) == 135) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//Ç
                if (@ord($sifreDizi[$sifrekarakter]) == 195 && ord($sifreDizi[$sifrekarakter + 1]) == 150) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//Ö
                if (@ord($sifreDizi[$sifrekarakter]) == 196 && ord($sifreDizi[$sifrekarakter + 1]) == 176) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//İ
                if (@ord($sifreDizi[$sifrekarakter]) == 197 && ord($sifreDizi[$sifrekarakter + 1]) == 158) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//Ş
                if (@ord($sifreDizi[$sifrekarakter]) == 195 && ord($sifreDizi[$sifrekarakter + 1]) == 156) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//Ü
                if (@ord($sifreDizi[$sifrekarakter]) == 196 && ord($sifreDizi[$sifrekarakter + 1]) == 158) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//Ğ
                if (@(ord($sifreDizi[$sifrekarakter]) < 48 || ((ord($sifreDizi[$sifrekarakter]) > 57) && (ord($sifreDizi[$sifrekarakter]) < 65))) || @(ord($sifreDizi[$sifrekarakter]) > 90 && (ord($sifreDizi[$sifrekarakter]) < 97)) || @(ord($sifreDizi[$sifrekarakter]) > 122)) {
                    $sifreKontrolu = 1;
                    $sifreHataMesaji = "Şifre İngilizce harf ve rakamlardan oluşabilir.";
                    break;
                }//harf, sayı hariç
                $sifrekarakter++;
            }

            $sifre = implode($sifreDizi);
            if (strlen($sifre) < 6) {
                $sifreKontrolu = 1;
                $sifreHataMesaji = "Şifre 6 karakterden kısa olamaz.";
            }
        } else {
            $sifreKontrolu = 1;
            $sifreHataMesaji = "Şifreler eşleşmiyor.";
        }
    }
}
?>