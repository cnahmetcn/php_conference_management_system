<?php
class konferansTablosuDuzenle
{
    function kullaniciSayisi($kullanicilar, $baglanti)
    {
        $konferansKullaniciDizi = str_split($kullanicilar);
        $konferansKullanicikarakter = 0;
        $kullaniciSayisi = 0;
        $kullanici = NULL;
        foreach ($konferansKullaniciDizi as $item) {
            if (ord($konferansKullaniciDizi[$konferansKullanicikarakter]) != 124) {
                $kullanici .= $konferansKullaniciDizi[$konferansKullanicikarakter];
            } else {
                $sorgu2 = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1 FROM kullanicilar WHERE kullaniciId = :kullaniciId");
                $sorgu2->bindParam(':kullaniciId', $kullanici, PDO::PARAM_STR);
                $sorgu2->execute();
                if ($sorgu2->rowCount() > 0) {
                    while ($rowChair = $sorgu2->fetch(PDO::FETCH_ASSOC)) {
                        $kullaniciSayisi++;
                        $kullanici = NULL;
                    }
                }
                $kullanici = NULL;
            }
            $konferansKullanicikarakter++;
        }
        if ($kullaniciSayisi != 0)
            return ++$kullaniciSayisi;
        else if ($kullaniciSayisi == 0)
            return 2;
    }

    function kullaniciAd($kullanicilar, $baglanti, $siralama, $siralamaTur)
    {
        $konferansKullanicilarDizi = str_split($kullanicilar);
        $konferansKullanicilarkarakter = 0;
        $kullanici = NULL;
        $kullaniciSonuc = array();
        foreach ($konferansKullanicilarDizi as $item) {
            if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
            } else {
                $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1 FROM kullanicilar WHERE kullaniciId = :kullaniciId");
                $sorgu->bindParam(':kullaniciId', $kullanici, PDO::PARAM_STR);
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanicilar = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $kullaniciSonuc[] = $rowKullanicilar['kullaniciAd'];
                        $kullanici = NULL;
                    }
                }
                $kullanici = NULL;
            }
            $konferansKullanicilarkarakter++;
        }
        return $kullaniciSonuc;
    }

    function kullaniciIsim1($kullanicilar, $baglanti, $siralama, $siralamaTur)
    {
        $konferansKullanicilarDizi = str_split($kullanicilar);
        $konferansKullanicilarkarakter = 0;
        $kullanici = NULL;
        $kullaniciSonuc = array();
        foreach ($konferansKullanicilarDizi as $item) {
            if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
            } else {
                $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1 FROM kullanicilar WHERE kullaniciId = :kullaniciId");
                $sorgu->bindParam(':kullaniciId', $kullanici, PDO::PARAM_STR);
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanicilar = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $kullaniciSonuc[] = $rowKullanicilar['kullaniciIsim1'];
                        $kullanici = NULL;
                    }
                }
                $kullanici = NULL;
            }
            $konferansKullanicilarkarakter++;
        }
        return $kullaniciSonuc;
    }

    function kullaniciSoyisim($kullanicilar, $baglanti, $siralama, $siralamaTur)
    {
        $konferansKullanicilarDizi = str_split($kullanicilar);
        $konferansKullanicilarkarakter = 0;
        $kullanici = NULL;
        $kullaniciSonuc = array();
        foreach ($konferansKullanicilarDizi as $item) {
            if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
            } else {
                $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciSoyisim FROM kullanicilar WHERE kullaniciId = :kullaniciId");
                $sorgu->bindParam(':kullaniciId', $kullanici, PDO::PARAM_STR);
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanicilar = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $kullaniciSonuc[] = $rowKullanicilar['kullaniciSoyisim'];
                        $kullanici = NULL;
                    }
                }
                $kullanici = NULL;
            }
            $konferansKullanicilarkarakter++;
        }
        return $kullaniciSonuc;
    }

    function kullaniciAdIsim1Soyisim($kullanicilar, $baglanti, $siralama, $siralamaTur)
    {
        $adlar = $this->kullaniciAd($kullanicilar, $baglanti ,$siralama, $siralamaTur);
        $isimler = $this->kullaniciIsim1($kullanicilar, $baglanti, $siralama, $siralamaTur);
        $soyisimler = $this->kullaniciSoyisim($kullanicilar, $baglanti, $siralama, $siralamaTur);
        $sonucAd = NULL;
        $sonucIsim1 = NULL;
        $sonucSoyisim = NULL;
        if ($siralama == 2 && $siralamaTur == 1)
            array_multisort($adlar, SORT_ASC, $isimler, $soyisimler);
        if ($siralama == 22 && $siralamaTur == 1)
            array_multisort($adlar, SORT_DESC, $isimler, $soyisimler);
        if ($siralama == 3 && $siralamaTur == 1)
            array_multisort($isimler, SORT_ASC, $adlar, $soyisimler);
        if ($siralama == 33 && $siralamaTur == 1)
            array_multisort($isimler, SORT_DESC, $adlar, $soyisimler);
        if ($siralama == 4 && $siralamaTur == 1)
            array_multisort($soyisimler, SORT_ASC, $adlar, $isimler);
        if ($siralama == 44 && $siralamaTur == 1)
            array_multisort($soyisimler, SORT_DESC, $adlar, $isimler);
        if ($siralama == 5 && $siralamaTur == 1)
            array_multisort($adlar, SORT_ASC, $isimler, $soyisimler);
        if ($siralama == 55 && $siralamaTur == 1)
            array_multisort($adlar, SORT_DESC, $isimler, $soyisimler);
        if ($siralama == 6 && $siralamaTur == 1)
            array_multisort($isimler, SORT_ASC, $adlar, $soyisimler);
        if ($siralama == 66 && $siralamaTur == 1)
            array_multisort($isimler, SORT_DESC, $adlar, $soyisimler);
        if ($siralama == 7 && $siralamaTur == 1)
            array_multisort($soyisimler, SORT_ASC, $adlar, $isimler);
        if ($siralama == 77 && $siralamaTur == 1)
            array_multisort($soyisimler, SORT_DESC, $adlar, $isimler);
        if ($siralama == 8 && $siralamaTur == 1)
            array_multisort($adlar, SORT_ASC, $isimler, $soyisimler);
        if ($siralama == 88 && $siralamaTur == 1)
            array_multisort($adlar, SORT_DESC, $isimler, $soyisimler);
        if ($siralama == 9 && $siralamaTur == 1)
            array_multisort($isimler, SORT_ASC, $adlar, $soyisimler);
        if ($siralama == 99 && $siralamaTur == 1)
            array_multisort($isimler, SORT_DESC, $adlar, $soyisimler);
        if ($siralama == 10 && $siralamaTur == 1)
            array_multisort($soyisimler, SORT_ASC, $adlar, $isimler);
        if ($siralama == 100 && $siralamaTur == 1)
            array_multisort($soyisimler, SORT_DESC, $adlar, $isimler);
        if ($siralama == 11 && $siralamaTur == 1)
            array_multisort($adlar, SORT_ASC, $isimler, $soyisimler);
        if ($siralama == 111 && $siralamaTur == 1)
            array_multisort($adlar, SORT_DESC, $isimler, $soyisimler);
        if ($siralama == 12 && $siralamaTur == 1)
            array_multisort($isimler, SORT_ASC, $adlar, $soyisimler);
        if ($siralama == 122 && $siralamaTur == 1)
            array_multisort($isimler, SORT_DESC, $adlar, $soyisimler);
        if ($siralama == 13 && $siralamaTur == 1)
            array_multisort($soyisimler, SORT_ASC, $adlar, $isimler);
        if ($siralama == 133 && $siralamaTur == 1)
            array_multisort($soyisimler, SORT_DESC, $adlar, $isimler);

        for ($indeks = 0; $indeks < count($adlar); $indeks++) {
            $sonucAd .= $adlar[$indeks] . "<br/><br/>";
            $sonucIsim1 .= $isimler[$indeks] . "<br/><br/>";
            $sonucSoyisim .= $soyisimler[$indeks] . "<br/><br/>";
        }
        return "<th>" . $sonucAd . "</th><th>" . $sonucIsim1 . "</th><th>" . $sonucSoyisim . "</th>";
    }

    function kullaniciKonferansGuncelle($kullanicilar, $baglanti, $data, $siralama, $siralamaTur, $konferansId)
    {
        $konferansKullanicilarDizi = str_split($kullanicilar);
        $konferansKullanicilarkarakter = 0;
        $kullanici = NULL;
        $sonuc = NULL;
        $kullaniciSonucAd = array();
        $kullaniciSonucIsim1 = array();
        $kullaniciSonucSoyisim = array();
        $kullaniciSonucSil = array();
        $kullaniciSonucId = array();
        foreach ($konferansKullanicilarDizi as $item) {
            if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
            } else {
                $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim, kullaniciRol FROM kullanicilar WHERE kullaniciId = :kullaniciId");
                $sorgu->bindParam(':kullaniciId', $kullanici, PDO::PARAM_STR);
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanicilar = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        if ($rowKullanicilar['kullaniciId'] != $data) {
                            $kullaniciSonucAd[] = $rowKullanicilar['kullaniciAd'];
                            $kullaniciSonucIsim1[] = $rowKullanicilar['kullaniciIsim1'];
                            $kullaniciSonucSoyisim[] = $rowKullanicilar['kullaniciSoyisim'];
                            $kullaniciSonucSil[] .= "<a href=\"konferansKullaniciSil.php?kKuSil=$rowKullanicilar[kullaniciId]&kKuSil2=$rowKullanicilar[kullaniciRol]&koGuncelle=$konferansId\" OnClick=\"return confirm('" . $rowKullanicilar['kullaniciAd'] . " kullanıcısını silmek istediğinize emin misiniz?');\">Sil</a>";
                            $kullanici = NULL;
                        }
                    }
                }
                $kullanici = NULL;
            }
            $konferansKullanicilarkarakter++;
        }
        if ($siralama == 2 && $siralamaTur == 1)
            array_multisort($kullaniciSonucAd, SORT_ASC, $kullaniciSonucIsim1, $kullaniciSonucSoyisim, $kullaniciSonucSil);
        if ($siralama == 22 && $siralamaTur == 1)
            array_multisort($kullaniciSonucAd, SORT_DESC, $kullaniciSonucIsim1, $kullaniciSonucSoyisim, $kullaniciSonucSil);
        if ($siralama == 3 && $siralamaTur == 1)
            array_multisort($kullaniciSonucIsim1, SORT_ASC, $kullaniciSonucAd, $kullaniciSonucSoyisim, $kullaniciSonucSil);
        if ($siralama == 33 && $siralamaTur == 1)
            array_multisort($kullaniciSonucIsim1, SORT_DESC, $kullaniciSonucAd, $kullaniciSonucSoyisim, $kullaniciSonucSil);
        if ($siralama == 4 && $siralamaTur == 1)
            array_multisort($kullaniciSonucSoyisim, SORT_ASC, $kullaniciSonucAd, $kullaniciSonucIsim1, $kullaniciSonucSil);
        if ($siralama == 44 && $siralamaTur == 1)
            array_multisort($kullaniciSonucSoyisim, SORT_DESC, $kullaniciSonucAd, $kullaniciSonucIsim1, $kullaniciSonucSil);

        for ($indeks = 0; $indeks < count($kullaniciSonucAd); $indeks++) {
            $sonuc .= "<tr><th>" . $kullaniciSonucAd[$indeks] . "</th>" . "<th>" . $kullaniciSonucIsim1[$indeks] . "</th>" . "<th>" . $kullaniciSonucSoyisim[$indeks] . "</th>" . "<th>" . $kullaniciSonucSil[$indeks] . "</th></tr>";
        }
        if ($sonuc != NULL) {
            return $sonuc;
        } else {
            return "<tr><th><a style='color: white;'>.</a></th><th><a style='color: white;'>.</a></th><th><a style='color: white;'>.</a></th><th><a style='color: white;'>.</a></th></tr>";
        }
    }

    function kullaniciId($kullanicilar, $baglanti)
    {
        $konferansKullanicilarDizi = str_split($kullanicilar);
        $konferansKullanicilarkarakter = 0;
        $kullanici = NULL;
        $kullaniciSonuc = array();
        foreach ($konferansKullanicilarDizi as $item) {
            if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
            } else {
                $sorgu = $baglanti->prepare("SELECT kullaniciId, kullaniciAd, kullaniciIsim1, kullaniciSoyisim FROM kullanicilar WHERE kullaniciId = :kullaniciId");
                $sorgu->bindParam(':kullaniciId', $kullanici, PDO::PARAM_STR);
                $sorgu->execute();
                if ($sorgu->rowCount() > 0) {
                    while ($rowKullanicilar = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        $kullaniciSonuc[] = $rowKullanicilar['kullaniciId'];
                        $kullanici = NULL;
                    }
                }
                $kullanici = NULL;
            }
            $konferansKullanicilarkarakter++;
        }
        return $kullaniciSonuc;
    }

    function kullaniciKonferansKayitliOlmayan($kayitliOlmayanKullaniciSayisi, $kayitliOlmayanKullanicilarRol, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, $column, $rolDegeri, $siralama, $siralamaTur, $konferansGuncellenenId)
    {
        if ($siralama == 5 && $siralamaTur == 1)
            array_multisort($kayitliOlmayanKullanicilarAd, SORT_ASC, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, $kayitliOlmayanKullanicilarRol);
        if ($siralama == 55 && $siralamaTur == 1)
            array_multisort($kayitliOlmayanKullanicilarAd, SORT_DESC, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, $kayitliOlmayanKullanicilarRol);
        if ($siralama == 6 && $siralamaTur == 1)
            array_multisort($kayitliOlmayanKullanicilarIsim1, SORT_ASC, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, $kayitliOlmayanKullanicilarRol);
        if ($siralama == 66 && $siralamaTur == 1)
            array_multisort($kayitliOlmayanKullanicilarIsim1, SORT_DESC, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarSoyisim, $kayitliOlmayanKullanicilarId, $kayitliOlmayanKullanicilarRol);
        if ($siralama == 7 && $siralamaTur == 1)
            array_multisort($kayitliOlmayanKullanicilarSoyisim, SORT_ASC, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarId, $kayitliOlmayanKullanicilarRol);
        if ($siralama == 77 && $siralamaTur == 1)
            array_multisort($kayitliOlmayanKullanicilarSoyisim, SORT_DESC, $kayitliOlmayanKullanicilarAd, $kayitliOlmayanKullanicilarIsim1, $kayitliOlmayanKullanicilarId, $kayitliOlmayanKullanicilarRol);

        $sonuc = NULL;
        $sonuc2 = NULL;
        $kullaniciYok = 0;
        $baslik = 1;
        if ($kayitliOlmayanKullaniciSayisi == 1) {
            $kayitliOlmayanKullaniciSayisi = 2;
            $kullaniciYok = 1;
        }
        if ($baslik == 1) {
            $sonuc .= "<tr><th rowspan=\"$kayitliOlmayanKullaniciSayisi\" style='background-color:#dddddd'>" . $column . "</th></tr>";
            $baslik = 0;
        }
        for ($indeks = 0; $indeks < count($kayitliOlmayanKullanicilarRol); $indeks++) {
            if ($kayitliOlmayanKullanicilarRol[$indeks] == $rolDegeri) {
                $sonuc2 .= "<tr><th>" . $kayitliOlmayanKullanicilarAd[$indeks] . "</th><th>" . $kayitliOlmayanKullanicilarIsim1[$indeks] . "</th><th>" . $kayitliOlmayanKullanicilarSoyisim[$indeks] . "</th><th><a href='konferansKullaniciEkle.php?kOlmayanId=$kayitliOlmayanKullanicilarId[$indeks]&kOlmayanRol=$kayitliOlmayanKullanicilarRol[$indeks]&koGuncelle=$konferansGuncellenenId' OnClick=\"return confirm('" . $kayitliOlmayanKullanicilarAd[$indeks] . " kullanıcısını eklemek istediğinize emin misiniz?');\">Ekle</a></th></tr>";
            }
        }
        if ($kullaniciYok == 1) {
            $sonuc2 = "<tr><th><a style='color: white;'>.</a></th><th><a style='color: white;'>.</a></th><th><a style='color: white;'>.</a></th><th><a style='color: white;'>.</a></th></tr>";
        }
        $sonuc .= $sonuc2;
        return $sonuc;
    }



}
?>