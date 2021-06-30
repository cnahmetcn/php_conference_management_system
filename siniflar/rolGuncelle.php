<?php
class rolGuncelle
{
    public function guncelle($kullaniciRolDizi2, $kullaniciRolDiziId2, $baglanti2)
    {
        $kullaniciRolSayi2 = 0;
        foreach ($kullaniciRolDizi2 as $kullaniciRolDiziItem2) {
            $rolGuncelle = $baglanti2->prepare("UPDATE kullanicilar SET kullaniciRol = ? WHERE kullaniciId = ?");
            if(isset($_POST[$kullaniciRolSayi2])) {
				$guncelle = $rolGuncelle->execute(array($_POST[$kullaniciRolSayi2], $kullaniciRolDiziId2[$kullaniciRolSayi2]));
			}
            $kullaniciRolSayi2++;
        }
        if (isset($guncelle) == TRUE) {
            header("Location: index.php?sayfa=roller");
        }
    }
}
?>