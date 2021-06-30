<style>
    .iptalButonu2{position:relative; float:right; margin-bottom:10px; margin-left:10px; border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#323232; color:#eee; text-decoration:none}
    .iptalButonu2:hover{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#ddd; color:#323232}

    .konferanstable {font-family:aria, sans-serif; font-size:85%; margin-top:20px; border-collapse:collapse; width:100%;}
    .konferanstable td, .konferanstable th {border:1px solid #323232; text-align:left; padding:5px; width:auto; overflow:hidden;}
    .konferanstable tr:hover {background-color: #323232; color: #ddd;}
    .konferanstable tr:hover a{color:#ddd; text-decoration:none}
    .konferanstable tr:first-child {background-color:#ddd; word-wrap:break-word}
    .konferanstable tr:first-child:hover {background-color:#ddd;}
    .konferanstable tr:first-child:hover a:link{color:#0000EE; text-decoration:underline}
    .konferanstable tr:first-child:hover a:visited{color:#551A8B; text-decoration:underline}

    .yeniSubmissionIptalButonu{position:relative; top:10px; border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#323232; color:#eee; text-decoration:none}
    .yeniSubmissionIptalButonu:hover{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#ddd; color:#323232}
    .submissionGondermeAlani{display:none; margin-top:20px;}
    .submissionGondermeAlani i{color:firebrick}

</style>
<?php
if(@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 1 || @$session->_read($_SESSION["girisKullaniciId"]) == 2 || @$session->_read($_SESSION["girisKullaniciId"]) == 3 || @$session->_read($_SESSION["girisKullaniciId"]) == 4 || @$session->_read($_SESSION["girisKullaniciId"]) == 5) {
        $erisim = 0;
        if($session->_read($_SESSION["girisKullaniciId"]) == 1 && $session->_read3($_SESSION["girisKullaniciId"]) == NULL) {
            $erisim = 1;
        }
        $kullaniciDizi = NULL;
        $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair, konferansAuthor, konferansReviewer, konferansReader FROM konferanslar WHERE konferansId = :konferansId AND konferansSilindi = 0");
        $sorgu->bindParam(':konferansId', $_REQUEST['kGiris'], PDO::PARAM_STR);
        $sorgu->execute();
        if ($sorgu->rowCount() > 0) {
            while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                if ($session->_read($_SESSION["girisKullaniciId"]) == 2 || $session->_read3($_SESSION["girisKullaniciId"]) == 2) {
                    $kullaniciDizi = $rowKonferans['konferansChair'];
                    $konferansKullanicilarDizi = str_split($rowKonferans['konferansChair']);
                } else if ($session->_read($_SESSION["girisKullaniciId"]) == 3 || $session->_read3($_SESSION["girisKullaniciId"]) == 3) {
                    $kullaniciDizi = $rowKonferans['konferansAuthor'];
                    $konferansKullanicilarDizi = str_split($rowKonferans['konferansAuthor']);
                } else if ($session->_read($_SESSION["girisKullaniciId"]) == 4 || $session->_read3($_SESSION["girisKullaniciId"]) == 4) {
                    $kullaniciDizi = $rowKonferans['konferansReviewer'];
                    $konferansKullanicilarDizi = str_split($rowKonferans['konferansReviewer']);
                } else if ($session->_read($_SESSION["girisKullaniciId"]) == 5 || $session->_read3($_SESSION["girisKullaniciId"]) == 5) {
                    $kullaniciDizi = $rowKonferans['konferansReader'];
                    $konferansKullanicilarDizi = str_split($rowKonferans['konferansReader']);
                }
                $konferansKullanicilarkarakter = 0;
                $kullanici = NULL;
                if ($kullaniciDizi != NULL) {
                    foreach ($konferansKullanicilarDizi as $item) {
                        if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                            $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                        } else {
                            if ($kullanici == $session->_read2($_SESSION['girisKullaniciId']) || ($kullanici == $session->_read4($_SESSION['girisKullaniciId']) && $session->_read($_SESSION['girisKullaniciId']) == 1)) {
                                $erisim = 1;
                            }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                }
            }
        }
        $kId = $_REQUEST['kGiris'];
        echo "<a href='index?sayfa=submissionGoruntule&kGiris=$kId' class='iptalButonu2'>Submission</a>";
        echo "<a href='index?sayfa=konferansGoruntuleIletisim&kGiris=$kId' class='iptalButonu2'>İletişim</a>";
        echo "<a href='index?sayfa=konferansGoruntuleKonum&kGiris=$kId' class='iptalButonu2'>Konum</a>";
        echo "<a href='index?sayfa=konferansGoruntuleOnemliTarih&kGiris=$kId' class='iptalButonu2'>Önemli Tarihler</a>";
        echo "<a href='index.php?sayfa=konferansGoruntule&kGiris=$kId' class='iptalButonu2'>Geri</a>";

        if($erisim == 1) {
            $sorgu = $baglanti->prepare("SELECT k.konferansId, k.konferansAd, k.konferansIsim, kb.konferansTanim, kb.konferansTarih, kb.konferansKonum, kb.konferansIletisim FROM konferanslar AS k INNER JOIN konferanslarbilgi AS kb ON k.konferansId = kb.konferansId WHERE k.konferansId = :konferansId AND k.konferansSilindi = 0");
            $sorgu->bindParam(':konferansId', $_REQUEST['kGiris'], PDO::PARAM_STR);
            $sorgu->execute();
            if ($sorgu->rowCount() > 0) {
                while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='konferansGoruntule'>" . $rowKonferans['konferansIsim'] . "</div><br/><br/>";
                }
            }
            if (isset($_REQUEST['sGiris'])) {
                echo "<style>.submissionGondermeAlani{display:block;}</style>";
                echo "<a href='index?sayfa=submissionGoruntule&kGiris=$kId' class='yeniSubmissionIptalButonu'>İptal</a><br/><br/>";
                echo "<div class='submissionGondermeAlani'>";
                $submissionSorgu2 = $baglanti->prepare("SELECT submissionTitle, submissionAbstract, submissionKeyword FROM submissionlar WHERE submissionKabul = 2 AND submissionId = :submissionId AND submissionSilindi = 0");
                $submissionSorgu2->bindParam(':submissionId', $_REQUEST['sGiris'], PDO::PARAM_STR);
                $submissionSorgu2->execute();
                if ($submissionSorgu2->rowCount() > 0) {
                    while ($rowSubmission = $submissionSorgu2->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div style='border:1px solid; border-radius:2px 2px; padding:10px'><i>Submission Title: </i>" . $rowSubmission['submissionTitle'] . "</div><br/>";
                        echo "<div style='border:1px solid; border-radius:2px 2px; padding:10px'><i>Submission Abstract: </i>" . $rowSubmission['submissionAbstract'] . "</div><br/>";
                        echo "<div style='border:1px solid; border-radius:2px 2px; padding:10px'><i>Submission Keywords: </i>" . $rowSubmission['submissionKeyword'] . "</div><br/>";
                    }
                }
                echo "</div>";
            }
            $submissionSorgu = $baglanti->prepare("SELECT submissionId, submissionAd, submissionTur, submissionBoyut, submissionMd5, submissionTarih, submissionTitle, submissionAbstract, submissionKeyword FROM submissionlar WHERE submissionKabul = 2 AND konferansId = :konferansId AND submissionSilindi = 0");
            $submissionSorgu->bindParam(':konferansId', $kId, PDO::PARAM_STR);
            $submissionSorgu->execute();
            echo "<table class='konferanstable'>";
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=submission&s=1&koSubmission=$kId'>SUBMISSION ADI</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=3&koSubmission=$kId'>BOYUT</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=4&koSubmission=$kId'>TARİH</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=5&koSubmission=$kId'>TITLE</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=6&koSubmission=$kId'>ABSTRACT</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=7&koSubmission=$kId'>KEYWORD</a></th>";
            echo "<th></th>";
            echo "</tr>";
            $tur = 0;
            $fileAd = NULL;
            $fileTip = NULL;
            $fileMd5 = NULL;
            if ($submissionSorgu->rowCount() > 0) {
                while ($rowSubmission = $submissionSorgu->fetch(PDO::FETCH_ASSOC)) {
                    if ($rowSubmission['submissionTur'] == "application/pdf")
                        $fileTip = ".pdf";
                    if ($rowSubmission['submissionTur'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                        $fileTip = ".docx";
                    if ($rowSubmission['submissionTur'] == "application/msword")
                        $fileTip = ".doc";
                    if ($rowSubmission['submissionTur'] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
                        $fileTip = ".pptx";
                    if ($rowSubmission['submissionTur'] == "application/vnd.ms-powerpoint")
                        $fileTip = ".ppt";
                    $fileMd5 = $rowSubmission['submissionMd5'];
                    $fileAd .= $fileMd5;
                    $fileAd .= $fileTip;
                    echo "<tr>";
                    echo "<th title='".$rowSubmission['submissionAd']."'><a href='submission/$fileAd'>" . $rowSubmission['submissionAd'] . "</a></th>";
                    echo "<th>" . $rowSubmission['submissionBoyut'] . " KB</th>";
                    echo "<th>" . date("d/m/y", "$rowSubmission[submissionTarih]") . "</th>";
                    echo "<th title='".$rowSubmission['submissionTitle']."'>" . $rowSubmission['submissionTitle'] . "</th>";
                    echo "<th title='".$rowSubmission['submissionAbstract']."'>" . $rowSubmission['submissionAbstract'] . "</th>";
                    echo "<th title='".$rowSubmission['submissionKeyword']."'>" . $rowSubmission['submissionKeyword'] . "</th>";
                    $sId = $rowSubmission['submissionId'];
                    echo "<th><a href='index?sayfa=submissionGoruntule&kGiris=$kId&sGiris=$sId'>Görüntüle</a></th>";
                    echo "</tr>";
                    $tur++;
                }
            }
            if ($tur == 0) {
                echo "<tr><th>Submission Yok</th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
            }
            echo "</table>";
        }
        if($erisim == 0){
            echo "Submission görüntüleyebilmek için konferans chair ile iletişime geçin.";
        }
    } else {
        echo "Erişim engellendi";
    }
} else {
    echo "Erişim engellendi";
}

?>