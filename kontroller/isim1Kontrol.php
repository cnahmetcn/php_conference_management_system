<?php
if(isset($_POST['isim12'])) {
    $isim1Kontrolu = 0;
    $isim1HataMesaji = NULL;
    $isim1 = $_POST['isim12'];
    $isim1Dizi = str_split($isim1);
    $isim1karakter = 0;
    foreach ($isim1Dizi as $isim1DiziKarakter) {
        if (@(ord($isim1Dizi[$isim1karakter]) < 65) || ((ord($isim1Dizi[$isim1karakter]) > 90) && (ord($isim1Dizi[$isim1karakter]) < 97))) {
            $isim1Kontrolu = 1;
            $isim1HataMesaji = "İsminiz sadece harflerden oluşabilir.";
            break;
        }
        if (@(ord($isim1Dizi[$isim1karakter]) > 122)) {
            if (@ord($isim1Dizi[$isim1karakter]) != 195 && ord($isim1Dizi[$isim1karakter]) != 167 && ord($isim1Dizi[$isim1karakter]) != 182 && ord($isim1Dizi[$isim1karakter]) != 188 && ord($isim1Dizi[$isim1karakter]) != 196 && ord($isim1Dizi[$isim1karakter]) != 159 && ord($isim1Dizi[$isim1karakter]) != 177 && ord($isim1Dizi[$isim1karakter]) != 197 && ord($isim1Dizi[$isim1karakter]) != 135 && ord($isim1Dizi[$isim1karakter]) != 150 && ord($isim1Dizi[$isim1karakter]) != 176 && ord($isim1Dizi[$isim1karakter]) != 158 && ord($isim1Dizi[$isim1karakter]) != 156) {
                $isim1Kontrolu = 1;
                $isim1HataMesaji = "İsminiz sadece harflerden oluşabilir.";
                break;
            }
        }
        $isim1karakter++;
    }
    $isim1 = implode($isim1Dizi);

    foreach ($isim1Dizi as $adDiziKarakter) {
        $isim1karakter = 0;
        if (@ord($isim1Dizi[$isim1karakter]) == 195 && ord($isim1Dizi[$isim1karakter + 1]) == 167) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 195 && ord($isim1Dizi[$isim1karakter + 1]) == 182) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 195 && ord($isim1Dizi[$isim1karakter + 1]) == 188) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 196 && ord($isim1Dizi[$isim1karakter + 1]) == 159) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 196 && ord($isim1Dizi[$isim1karakter + 1]) == 177) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 197 && ord($isim1Dizi[$isim1karakter + 1]) == 159) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 195 && ord($isim1Dizi[$isim1karakter + 1]) == 135) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 195 && ord($isim1Dizi[$isim1karakter + 1]) == 150) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 196 && ord($isim1Dizi[$isim1karakter + 1]) == 176) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 197 && ord($isim1Dizi[$isim1karakter + 1]) == 158) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 195 && ord($isim1Dizi[$isim1karakter + 1]) == 156) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        if (@ord($isim1Dizi[$isim1karakter]) == 196 && ord($isim1Dizi[$isim1karakter + 1]) == 158) {
            $isim1Dizi[$isim1karakter] = "c";
            $isim1Dizi[$isim1karakter + 1] = NULL;
            $isim1karakter++;
        }
        $isim1karakter++;
    }
    $isim1k = implode($isim1Dizi);
    if (strlen($isim1k) < 2) {
        $isim1Kontrolu = 1;
        $isim1HataMesaji = "İsminiz 2 harften kısa oluşamaz.";
    }
}
?>