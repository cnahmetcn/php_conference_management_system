<?php
if(isset($_POST['website2'])) {
    $websiteKontrolu = 0;
    $websiteHataMesaji = NULL;
    $website = $_POST["website2"];
    $websiteDizi = str_split($website);
    $websitekarakter = 0;
    foreach ($websiteDizi as $websiteDiziKarakter) {
        if ((ord($websiteDizi[0]) != 0)) {
            if (ord($websiteDizi[$websitekarakter]) < 45 || (ord($websiteDizi[$websitekarakter]) < 65 && ord($websiteDizi[$websitekarakter]) > 57) || (ord($websiteDizi[$websitekarakter]) > 90 && ord($websiteDizi[$websitekarakter]) < 97) || ord($websiteDizi[$websitekarakter]) > 122) {
                $websiteKontrolu = 1;
                $websiteHataMesaji = "Websitesi URL geçersiz.";
                break;
            }
            $websitekarakter++;
        }
    }
}
?>