<?php
if(isset($_POST['isim22'])) {
    $isim2Kontrolu = 0;
    $isim2HataMesaji = NULL;
    $isim2 = $_POST['isim22'];
    $isim2Dizi = str_split($isim2);
    $isim2karakter = 0;
    foreach ($isim2Dizi as $isim2DiziKarakter) {
        if (@(ord($isim2Dizi[0]) != 0)) {
            if (@(ord($isim2Dizi[$isim2karakter]) < 65) || ((ord($isim2Dizi[$isim2karakter]) > 90) && (ord($isim2Dizi[$isim2karakter]) < 97))) {
                $isim2Kontrolu = 1;
                $isim2HataMesaji = "İkinci isminiz sadece harflerden oluşabilir.";
                break;
            }
            if (@(ord($isim2Dizi[$isim2karakter]) > 122)) {
                if (@ord($isim2Dizi[$isim2karakter]) != 195 && ord($isim2Dizi[$isim2karakter]) != 167 && ord($isim2Dizi[$isim2karakter]) != 182 && ord($isim2Dizi[$isim2karakter]) != 188 && ord($isim2Dizi[$isim2karakter]) != 196 && ord($isim2Dizi[$isim2karakter]) != 159 && ord($isim2Dizi[$isim2karakter]) != 177 && ord($isim2Dizi[$isim2karakter]) != 197 && ord($isim2Dizi[$isim2karakter]) != 135 && ord($isim2Dizi[$isim2karakter]) != 150 && ord($isim2Dizi[$isim2karakter]) != 176 && ord($isim2Dizi[$isim2karakter]) != 158 && ord($isim2Dizi[$isim2karakter]) != 156) {
                    $isim2Kontrolu = 1;
                    $isim2HataMesaji = "İkinci isminiz sadece harflerden oluşabilir.";
                    break;
                }
            }
            $isim2karakter++;
        }
    }
    $isim2 = implode($isim2Dizi);

    foreach ($isim2Dizi as $adDiziKarakter) {
        $isim2karakter = 0;
        if (@ord($isim2Dizi[$isim2karakter]) == 195 && ord($isim2Dizi[$isim2karakter + 1]) == 167) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 195 && ord($isim2Dizi[$isim2karakter + 1]) == 182) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 195 && ord($isim2Dizi[$isim2karakter + 1]) == 188) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 196 && ord($isim2Dizi[$isim2karakter + 1]) == 159) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 196 && ord($isim2Dizi[$isim2karakter + 1]) == 177) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 197 && ord($isim2Dizi[$isim2karakter + 1]) == 159) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 195 && ord($isim2Dizi[$isim2karakter + 1]) == 135) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 195 && ord($isim2Dizi[$isim2karakter + 1]) == 150) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 196 && ord($isim2Dizi[$isim2karakter + 1]) == 176) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 197 && ord($isim2Dizi[$isim2karakter + 1]) == 158) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 195 && ord($isim2Dizi[$isim2karakter + 1]) == 156) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        if (@ord($isim2Dizi[$isim2karakter]) == 196 && ord($isim2Dizi[$isim2karakter + 1]) == 158) {
            $isim2Dizi[$isim2karakter] = "c";
            $isim2Dizi[$isim2karakter + 1] = NULL;
            $isim2karakter++;
        }
        $isim2karakter++;
    }
    $isim2k = implode($isim2Dizi);
    if (strlen($isim2k) < 2 && strlen($isim2k) > 0) {
        $isim2Kontrolu = 1;
        $isim2HataMesaji = "İkinci isminiz 2 harften kısa oluşamaz.";
    }
}
?>