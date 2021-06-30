<?php
if(isset($_POST['mail2'])) {
    $mailKontrolu = 0;
    $mailHataMesaji = NULL;
    $mail = $_POST["mail2"];
    $mailDizi = str_split($mail);
    $mailkarakter = 0;
    $mailAtKontrol = 0;
    $mailBosKontrol = 0;
    $mailNoktaKontrol = 0;
    foreach ($mailDizi as $mailDiziKarakter) {
        if (ord($mailDizi[0]) != 0) {
            if ($mailAtKontrol == 0) {
                if (ord($mailDizi[$mailkarakter]) > 126 || (ord($mailDizi[$mailkarakter]) > 90 && ord($mailDizi[$mailkarakter]) < 94) || ord($mailDizi[$mailkarakter]) == 62 || (ord($mailDizi[$mailkarakter]) < 61 && ord($mailDizi[$mailkarakter]) > 57) || ord($mailDizi[$mailkarakter]) == 44 || ord($mailDizi[$mailkarakter]) == 41 || ord($mailDizi[$mailkarakter]) == 40 || ord($mailDizi[$mailkarakter]) == 34 || ord($mailDizi[$mailkarakter]) < 33) {
                    $mailKontrolu = 1;
                    $mailHataMesaji = "E-Posta adresinde yanlış karakter kullanıldı.";
                    break;
                }
            }
            if ($mailAtKontrol == 1) {
                if (ord($mailDizi[$mailkarakter]) > 122 || (ord($mailDizi[$mailkarakter]) < 97 && ord($mailDizi[$mailkarakter]) > 90) || (ord($mailDizi[$mailkarakter]) < 65 && ord($mailDizi[$mailkarakter]) > 57) || ord($mailDizi[$mailkarakter]) == 47 || (ord($mailDizi[$mailkarakter]) < 45)) {
                    $mailKontrolu = 1;
                    $mailHataMesaji = "E-Posta adresinde yanlış karakter kullanıldı.";
                    break;
                }
            }
            if (ord($mailDizi[$mailkarakter]) == 64) {
                $mailAtKontrol++;
                if (ord($mailDizi[$mailkarakter + 1]) == 46) {
                    $mailKontrolu = 1;
                    $mailHataMesaji = "E-Posta adresi hatalı.";
                    break;
                }
            }
            if (ord($mailDizi[$mailkarakter]) == 46) {
                $mailNoktaKontrol++;
            }
            if ($mailAtKontrol > 1) {
                $mailKontrolu = 1;
                $mailHataMesaji = "E-Posta adresi hatalı.";
                break;
            }
            $mailkarakter++;
        }
    }
    if (ord($mailDizi[0]) == 0) {
        $mailKontrolu = 1;
        $mailBosKontrol = 1;
    }
    if ($mailNoktaKontrol == 0) {
        $mailKontrolu = 1;
        $mailHataMesaji = "E-Posta adresi hatalı.";
    }
    if ($mailAtKontrol == 0 && $mailBosKontrol == 0) {
        $mailKontrolu = 1;
        $mailHataMesaji = "E-Posta adresi hatalı.";
    }
    if ($mailAtKontrol == 0 && $mailBosKontrol == 1) {
        $mailKontrolu = 1;
        $mailHataMesaji = "Geçerli bir E-Posta adresi girin.";
    }
    if (ord($mailDizi[0]) == 64) {
        $mailKontrolu = 1;
        $mailHataMesaji = "Geçerli bir E-Posta adresi girin.";
    }
    if (@ord($mailDizi[$mailkarakter - 1]) != 0) {
        if (ord($mailDizi[$mailkarakter - 1]) == 45 || ord($mailDizi[$mailkarakter - 1]) == 46) {
            $mailKontrolu = 1;
            $mailHataMesaji = "E-Posta adresi hatalı.";
        }
    }
    $mail = implode($mailDizi);
    $mailSorgusu = $baglanti->prepare("SELECT kullaniciMail FROM kullanicilar WHERE kullaniciId != ? AND kullaniciSilindi = 0");
    $mailSorgusu->execute(array($_REQUEST['kGuncelle']));
    if ($mailSorgusu->rowCount() > 0) {
        while ($rowMail = $mailSorgusu->fetch(PDO::FETCH_ASSOC)) {
            if ($rowMail['kullaniciMail'] == $mail) {
                $mailHataMesaji = "Bu email başkası tarafından kullanılıyor.";
                $mailKontrolu = 1;
                break;
            }
        }
    }
}
?>