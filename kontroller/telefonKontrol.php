<?php
if(isset($_POST['telefon2'])) {
    $telefonKontrolu = 0;
    $telefonHataMesaji = NULL;
    $telefon = $_POST["telefon2"];
    $telefonDizi = str_split($telefon);
    $telefonkarakter = 0;
    foreach ($telefonDizi as $telefonDiziKarakter) {
        if (@(ord($telefonDizi[$telefonkarakter]) != 0)) {
            if (@ord($telefonDizi[$telefonkarakter]) < 48 || @ord($telefonDizi[$telefonkarakter]) > 57) {
                $telefonKontrolu = 1;
                $telefonHataMesaji = "Telefon numarası rakamlardan oluşabilir.";
                break;
            }
            $telefonkarakter++;
        }
    }
}
?>