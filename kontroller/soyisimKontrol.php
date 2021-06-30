<?php
if(isset($_POST['soyisim2'])) {
    $soyisimKontrolu = 0;
    $soyisimHataMesaji = NULL;
    $soyisim = $_POST['soyisim2'];
    $soyisimDizi = str_split($soyisim);
    $soyisimkarakter = 0;
    foreach ($soyisimDizi as $soyisimDiziKarakter) {
        if (@(ord($soyisimDizi[$soyisimkarakter]) < 65) || ((ord($soyisimDizi[$soyisimkarakter]) > 90) && (ord($soyisimDizi[$soyisimkarakter]) < 97))) {
            $soyisimKontrolu = 1;
            $soyisimHataMesaji = "Soyisminiz sadece harflerden oluşabilir.";
            break;
        }
        if (@(ord($soyisimDizi[$soyisimkarakter]) > 122)) {
            if (@ord($soyisimDizi[$soyisimkarakter]) != 195 && ord($soyisimDizi[$soyisimkarakter]) != 167 && ord($soyisimDizi[$soyisimkarakter]) != 182 && ord($soyisimDizi[$soyisimkarakter]) != 188 && ord($soyisimDizi[$soyisimkarakter]) != 196 && ord($soyisimDizi[$soyisimkarakter]) != 159 && ord($soyisimDizi[$soyisimkarakter]) != 177 && ord($soyisimDizi[$soyisimkarakter]) != 197 && ord($soyisimDizi[$soyisimkarakter]) != 135 && ord($soyisimDizi[$soyisimkarakter]) != 150 && ord($soyisimDizi[$soyisimkarakter]) != 176 && ord($soyisimDizi[$soyisimkarakter]) != 158 && ord($soyisimDizi[$soyisimkarakter]) != 156) {
                $soyisimKontrolu = 1;
                $soyisimHataMesaji = "Soyisminiz sadece harflerden oluşabilir.";
                break;
            }
        }
        $soyisimkarakter++;
    }
    $soyisim = implode($soyisimDizi);

    foreach ($soyisimDizi as $adDiziKarakter) {
        $soyisimkarakter = 0;
        if (@ord($soyisimDizi[$soyisimkarakter]) == 195 && ord($soyisimDizi[$soyisimkarakter + 1]) == 167) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 195 && ord($soyisimDizi[$soyisimkarakter + 1]) == 182) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 195 && ord($soyisimDizi[$soyisimkarakter + 1]) == 188) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 196 && ord($soyisimDizi[$soyisimkarakter + 1]) == 159) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 196 && ord($soyisimDizi[$soyisimkarakter + 1]) == 177) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 197 && ord($soyisimDizi[$soyisimkarakter + 1]) == 159) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 195 && ord($soyisimDizi[$soyisimkarakter + 1]) == 135) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 195 && ord($soyisimDizi[$soyisimkarakter + 1]) == 150) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 196 && ord($soyisimDizi[$soyisimkarakter + 1]) == 176) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 197 && ord($soyisimDizi[$soyisimkarakter + 1]) == 158) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 195 && ord($soyisimDizi[$soyisimkarakter + 1]) == 156) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        if (@ord($soyisimDizi[$soyisimkarakter]) == 196 && ord($soyisimDizi[$soyisimkarakter + 1]) == 158) {
            $soyisimDizi[$soyisimkarakter] = "c";
            $soyisimDizi[$soyisimkarakter + 1] = NULL;
            $soyisimkarakter++;
        }
        $soyisimkarakter++;
    }
    $soyisimk = implode($soyisimDizi);
    if (strlen($soyisimk) < 2) {
        $soyisimKontrolu = 1;
        $soyisimHataMesaji = "Soyisminiz 2 harften kısa oluşamaz.";
    }
}
?>