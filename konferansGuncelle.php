<style>
    .kayitOl i{margin-left:5px; color: firebrick}
    .geriButonuLink{border:1px solid #323232; border-radius:2px 2px; background-color:#323232;color:#ddd; padding:10px 20px; text-decoration:none;}
    .geriButonuLink:hover{border:1px solid #323232; background-color:#ddd; color:#323232;}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="sayfaDuzeni/ckeditor/ckeditor.js"></script>
<script>
    $(function() {
        $("#datepicker1").datepicker({dateFormat: 'dd.mm.yy'});
        $("#datepicker2").datepicker({dateFormat: 'dd.mm.yy'});
        $("#datepicker3").datepicker({dateFormat: 'dd.mm.yy'});
        $("#datepicker4").datepicker({dateFormat: 'dd.mm.yy'});
    });
</script>
<?php
include("veritabaniBaglantisi.php");
include_once ("Session.php");
include_once ("siniflar/konferansTablosuDuzenle.php");
$kullaniciTablosu = new konferansTablosuDuzenle;

if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 2 || ($session->_read3($_SESSION["girisKullaniciId"]) == 2 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        $konferansBaslikKontrolu = 0;
        $konferansAcilisTarihiKontrolu = 0;
        $konferansKapanisTarihiKontrolu = 0;
        $submissionAcilisTarihiKontrolu = 0;
        $submissionKapanisTarihiKontrolu = 0;
        $konferansBaslikHataMesaji = NULL;
        $konferansAcilisTarihiHataMesaji = NULL;
        $konferansKapanisTarihiHataMesaji = NULL;
        $submissionAcilisTarihiHataMesaji = NULL;
        $submissionKapanisTarihiHataMesaji = NULL;
        $konferansGuncellendiMesaji = NULL;
        $konferansBilgiOlustur = 0;

        if (isset($_POST['kbaslik2']) && isset($_POST['editor1']) && isset($_POST['editor2']) && isset($_POST['editor3']) && isset($_POST['editor4']) && isset($_POST['kilktarih2']) && isset($_POST['ksontarih2']) && isset($_POST['silktarih2']) && isset($_POST['ssontarih2'])) {
            $konferansBaslik = $_POST['kbaslik2'];
            $konferansTanim = $_POST["editor1"];
            $konferansTarih = $_POST["editor2"];
            $konferansKonum = $_POST["editor3"];
            $konferansIletisim = $_POST["editor4"];
            $konferansIlkTarih = $_POST['kilktarih2'];
            $konferansSonTarih = $_POST['ksontarih2'];
            $konferansSubmissionIlkTarih = $_POST['silktarih2'];
            $konferansSubmissionSonTarih = $_POST['ssontarih2'];
            $konferansSorgu = $baglanti->prepare("SELECT konferansIsim FROM konferanslar WHERE konferansId != ? AND konferansSilindi = 0");
            $konferansSorgu->execute(array($_REQUEST['koGuncelle']));
            if ($konferansSorgu->rowCount() > 0) {
                while ($rowKonferans = $konferansSorgu->fetch(PDO::FETCH_ASSOC)) {
                    if ($rowKonferans['konferansIsim'] == $konferansBaslik) {
                        $konferansBaslikHataMesaji = "Bu konferans ismi zaten kullanılıyor.";
                        $konferansBaslikKontrolu = 1;
                        break;
                    }
                }
            }
            if (mb_strlen($konferansBaslik) < 5) {
                $konferansBaslikKontrolu = 1;
                $konferansBaslikHataMesaji = "Konferans ismi 5 harften kısa olamaz.";
            }

            if ($konferansBaslikKontrolu == 0 && $konferansAcilisTarihiKontrolu == 0 && $konferansKapanisTarihiKontrolu == 0 && $submissionAcilisTarihiKontrolu == 0 && $submissionKapanisTarihiKontrolu == 0) {
                $konferansSorgu = $baglanti->prepare("SELECT konferansAd FROM konferanslar WHERE konferansId = ? AND konferansSilindi = 0");
                $konferansSorgu->execute(array($_REQUEST['koGuncelle']));
                if ($konferansSorgu->rowCount() > 0) {
                    while ($rowKonferans = $konferansSorgu->fetch(PDO::FETCH_ASSOC)) {
                        $konferansAd = $rowKonferans['konferansAd'];
                    }
                }
                $konferansBilgiEkle1 = $baglanti->prepare("UPDATE konferanslar SET konferansIsim = ? WHERE konferansId = ?");
                $konferansBilgiEkle1->execute(array($konferansBaslik, $_REQUEST['koGuncelle']));
                if (isset($_POST['kerisim2'])) {
                    $konferansErisim = $_POST['kerisim2'];
                    $konferansBilgiEkle2 = $baglanti->prepare("UPDATE konferanslarbilgi SET konferansId = ?, konferansTanim = ?, konferansTarih = ?, konferansKonum = ?, konferansIletisim = ?, konferansIlkTarih = ?, konferansSonTarih = ?, konferansSubmissionIlkTarih = ?, konferansSubmissionSonTarih = ?, konferansErisim = ? WHERE konferansAd = ?");
                    $konferansBilgiEkle2->execute(array($_REQUEST['koGuncelle'], $konferansTanim, $konferansTarih, $konferansKonum, $konferansIletisim, $konferansIlkTarih, $konferansSonTarih, $konferansSubmissionIlkTarih, $konferansSubmissionSonTarih, $konferansErisim, $konferansAd));
                } else {
                    $konferansBilgiEkle2 = $baglanti->prepare("UPDATE konferanslarbilgi SET konferansId = ?, konferansTanim = ?, konferansTarih = ?, konferansKonum = ?, konferansIletisim = ?, konferansIlkTarih = ?, konferansSonTarih = ?, konferansSubmissionIlkTarih = ?, konferansSubmissionSonTarih = ?, konferansErisim = ? WHERE konferansAd = ?");
                    $konferansBilgiEkle2->execute(array($_REQUEST['koGuncelle'], $konferansTanim, $konferansTarih, $konferansKonum, $konferansIletisim, $konferansIlkTarih, $konferansSonTarih, $konferansSubmissionIlkTarih, $konferansSubmissionSonTarih, 0, $konferansAd));
                }
                if ($konferansBilgiEkle1 == TRUE && $konferansBilgiEkle2 == TRUE)
                    $konferansGuncellendiMesaji = "Güncelleme başarılı.";
                else
                    $konferansGuncellendiMesaji = "Güncelleme başarısız.";
            }
        }

        echo "<a href='index.php?sayfa=konferanslar' class='geriButonuLink'>Geri</a><br/><br/><br/>";
        $konferansGuncelleSorgu = $baglanti->prepare("SELECT konferansChair FROM konferanslar WHERE konferansId = :konferansId AND konferansSilindi = 0");
        $konferansGuncelleSorgu->bindParam(':konferansId', $_REQUEST['koGuncelle'], PDO::PARAM_STR);
        $konferansGuncelleSorgu->execute();
        $kullaniciErisim = 0;
        if ($konferansGuncelleSorgu->rowCount() > 0) {
            while ($rowKonferans = $konferansGuncelleSorgu->fetch(PDO::FETCH_ASSOC)) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansChair']);
                $konferansKullanicilarkarakter = 0;
                $kullanici = NULL;
                if ($rowKonferans['konferansChair'] != NULL) {
                    foreach ($konferansKullanicilarDizi as $item) {
                        if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                            $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                        } else {
                            if ($kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                $kullaniciErisim++;
                            }
                            else {
                                    if ($kullanici == $session->_read2($_SESSION['girisKullaniciId'])) {
                                        $kullaniciErisim++;
                                    }
                                }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                }
            }
        }
        if ($kullaniciErisim == 1) {
            $sorguKonferansBilgi = $baglanti->prepare("SELECT konferansAd FROM konferanslar WHERE konferansId = :konferansId AND konferansSilindi = 0");
            $sorguKonferansBilgi->bindParam(':konferansId', $_REQUEST['koGuncelle'], PDO::PARAM_STR);
            $sorguKonferansBilgi->execute();
            if ($sorguKonferansBilgi->rowCount() > 0) {
                while ($rowKullanici = $sorguKonferansBilgi->fetch(PDO::FETCH_ASSOC)) {
                    $konferansAd = $rowKullanici['konferansAd'];
                }
            }
            $sorguKonferansBilgi = $baglanti->prepare("SELECT ko.konferansIsim, k.konferansTanim, k.konferansTarih, k.konferansKonum, k.konferansIletisim, k.konferansIlkTarih, k.konferansSonTarih, k.konferansSubmissionIlkTarih, k.konferansSubmissionSonTarih, k.konferansErisim FROM konferanslarbilgi AS k INNER JOIN konferanslar AS ko ON k.konferansAd = ko.konferansAd WHERE k.konferansAd = :konferansAd AND ko.konferansSilindi = 0");
            $sorguKonferansBilgi->bindParam(':konferansAd', $konferansAd, PDO::PARAM_STR);
            $sorguKonferansBilgi->execute();
            if ($sorguKonferansBilgi->rowCount() > 0) {
                while ($rowKullanici = $sorguKonferansBilgi->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='kayitOl'>";
                    echo "<form action='' method='post'>";
                    echo "<i style='margin-left:0'>" . $konferansGuncellendiMesaji . "</i><br/><br/>";
                    echo "<a style='display:inline-block; float:left; width:150px; margin-right:10px; margin-top:5px;'>Konferans Başlığı:*</a><input class=\"kullaniciAdi\" style=\"padding:5px; width:500px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px\" type=\"text\" name=\"kbaslik2\" value=\"" . $rowKullanici['konferansIsim'] . "\"/><i>" . $konferansBaslikHataMesaji . "</i><br/><br/>";

                    echo "<a>Konferans Tanımı:</a><br/>";
                    echo "<textarea name='editor1' id='editor1' rows='10' cols='80'>" . $rowKullanici['konferansTanim'] . "</textarea><br/>";
                    echo "<script>CKEDITOR.replace('editor1');</script>";

                    echo "<a>Önemli Tarihler:</a><br/>";
                    echo "<textarea name='editor2' id='editor2' rows='10' cols='80'>" . $rowKullanici['konferansTarih'] . "</textarea><br/>";
                    echo "<script>CKEDITOR.replace('editor2');</script>";

                    echo "<a>Konferans Konumu:</a><br/>";
                    echo "<textarea name='editor3' id='editor3' rows='10' cols='80'>" . $rowKullanici['konferansKonum'] . "</textarea><br/>";
                    echo "<script>CKEDITOR.replace('editor3');</script>";

                    echo "<a>İletişim:</a><br/>";
                    echo "<textarea name='editor4' id='editor4' rows='10' cols='80'>" . $rowKullanici['konferansIletisim'] . "</textarea><br/>";
                    echo "<script>CKEDITOR.replace('editor4');</script>";


                    echo "<a style='display:inline-block; float:left; width:150px; margin-right:10px; margin-top:5px;'>Konferans Açılış Tarihi:</a><input style=\"padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px\" type=\"text\" id=\"datepicker1\" name=\"kilktarih2\" value=\"" . $rowKullanici['konferansIlkTarih'] . "\"><i>" . $konferansAcilisTarihiHataMesaji . "</i><br/><br/>";
                    echo "<a style='display:inline-block; float:left; width:150px; margin-right:10px; margin-top:5px;'>Konferans Kapanış Tarihi:</a><input style=\"padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px\" type=\"text\" id=\"datepicker2\" name=\"ksontarih2\" value=\"" . $rowKullanici['konferansSonTarih'] . "\"><i>" . $konferansKapanisTarihiHataMesaji . "</i><br/><br/>";
                    echo "<a style='display:inline-block; float:left; width:150px; margin-right:10px; margin-top:5px;'>Submission Açılış Tarihi:</a><input style=\"padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px\" type=\"text\" id=\"datepicker3\" name=\"silktarih2\" value=\"" . $rowKullanici['konferansSubmissionIlkTarih'] . "\"><i>" . $submissionAcilisTarihiHataMesaji . "</i><br/><br/>";
                    echo "<a style='display:inline-block; float:left; width:150px; margin-right:10px; margin-top:5px;'>Submission Kapanış Tarihi:</a><input style=\"padding:5px; width:150px; background-color:#fff; border:1px solid #323232; border-radius:2px 2px\" type=\"text\" id=\"datepicker4\" name=\"ssontarih2\" value=\"" . $rowKullanici['konferansSubmissionSonTarih'] . "\"><i>" . $submissionKapanisTarihiHataMesaji . "</i><br/><br/>";
                    if ($rowKullanici['konferansErisim'] == 1)
                        echo "<input style=\"zoom:1.2;\" type=\"checkbox\" name=\"kerisim2\" value=\"1\" checked/>Konferansa Herkes Erişebilsin<br><br/>";
                    else
                        echo "<input style=\"zoom:1.2;\" type=\"checkbox\" name=\"kerisim2\" value=\"1\"/>Konferansa Herkes Erişebilsin<br><br/>";
                    echo "<input style=\"padding:3px 15px;\" type=\"submit\" name=\"kayit\" value=\"Güncelle\" OnClick=\"return confirm('Konferansı güncellemek istediğinize emin misiniz?');\"/>";
                    echo "</form>";
                    echo "</div>";


                }
            }
        } else {
            echo "Erişim engellendi.";
        }
    } else {
        echo "Erişim engellendi.";
    }
} else {
    echo "Giriş yapınız.";
}

?>
