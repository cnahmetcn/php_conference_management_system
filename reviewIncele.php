<style>
    .reviewAlani{width:100%;}
    .reviewAlani a{margin:5px 0px; margin-right:20px;}
    .reviewAlani i{margin-left:5px; font-size: small; color: firebrick}
    .reviewAlani2{border:1px solid; border-radius:2px 2px; padding:10px}
    .reviewIptalButonu{position:relative; border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#323232; color:#eee; text-decoration:none}
    .reviewIptalButonu:hover{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#ddd; color:#323232}

    .konferanstable {font-family:aria, sans-serif; font-size:85%; margin-top:20px; border-collapse:collapse; width:100%; margin-bottom:20px}
    .konferanstable td, .konferanstable th {border:1px solid #323232; text-align:left; padding:5px; width:18%; overflow:hidden;}
    .konferanstable tr:hover {background-color: #323232; color: #ddd;}
    .konferanstable tr:hover a{color:#ddd; text-decoration:none}

    .konferanstable2 {font-family:aria, sans-serif; font-size:85%; border-collapse:collapse; width:100%; margin-bottom:20px}
    .konferanstable2 td, .konferanstable2 th {border:1px solid #323232; text-align:left; padding:10px; width:auto; overflow:hidden;}
    .konferanstable2 tr:hover {background-color: #323232; color: #ddd;}
    .konferanstable2 tr:hover a{color:#ddd; text-decoration:none}
    .konferanstable2 tr:first-child {background-color:#ddd; word-wrap:break-word}
    .konferanstable2 tr:first-child:hover {background-color:#ddd; color:#000}

</style>
</script>
<?php
include("veritabaniBaglantisi.php");
include_once ("Session.php");
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 4 || ($session->_read3($_SESSION["girisKullaniciId"]) == 4 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        $kId = $_REQUEST['koSubmission'];
        $erisim = 0;
        if($session->_read3($_SESSION["girisKullaniciId"]) == 4 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)
            $reviewerId = $session->_read4($_SESSION["girisKullaniciId"]);
        else
            $reviewerId = $session->_read2($_SESSION["girisKullaniciId"]);
        $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansReviewer FROM konferanslar WHERE konferansSilindi = 0 AND konferansId = :konferansId");
        $sorgu->bindParam(':konferansId', $kId, PDO::PARAM_STR);
        $sorgu->execute();
        if ($sorgu->rowCount() > 0) {
            while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansReviewer']);
                $konferansKullanicilarkarakter = 0;
                $kullanici = NULL;
                if ($rowKonferans['konferansReviewer'] != NULL) {
                    foreach ($konferansKullanicilarDizi as $item) {
                        if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                            $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                        } else {
                            if ($kullanici == $session->_read2($_SESSION['girisKullaniciId']) || ($session->_read3($_SESSION['girisKullaniciId']) == 4 && $kullanici == $session->_read4($_SESSION['girisKullaniciId']))) {
                                $erisim = 1;
                                $kId = $_REQUEST['koSubmission'];
                                $sId = $_REQUEST['sIncele'];
                                echo "<div class='reviewAlani'>";
                                echo "<a href='index.php?sayfa=review&koSubmission=$kId' class='reviewIptalButonu'>Geri</a><br/><br/><br/>";
                                $reviewHataMesaji = NULL;
                                echo $reviewHataMesaji;
                                $submissionSorgu = $baglanti->prepare("SELECT submissionId, submissionAd, submissionTur, submissionBoyut, submissionMd5, submissionTarih, submissionTitle, submissionAbstract, submissionKeyword, submissionKabul, submissionYorumId FROM submissionlar WHERE konferansId = :konferansId AND submissionId = :submissionId AND submissionSilindi = 0 AND submissionKabul = 0");
                                $submissionSorgu->bindParam(':konferansId', $_REQUEST['koSubmission'], PDO::PARAM_STR);
                                $submissionSorgu->bindParam(':submissionId', $sId, PDO::PARAM_STR);
                                $submissionSorgu->execute();
                                $fileAd = NULL;
                                $izinVerildi = 0;
                                if ($submissionSorgu->rowCount() > 0) {
                                    while ($rowSubmission = $submissionSorgu->fetch(PDO::FETCH_ASSOC)) {
                                        $izinVerildi = 1;
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
                                        echo "<a>" . date("d.m.Y", $rowSubmission['submissionTarih']) . "</a><br/>";
                                        echo "<a href='submission/$fileAd'>" . $rowSubmission['submissionAd'] . "</a><br/><br/>";
                                        echo "Submission Title:<div class='reviewAlani2'>" . $rowSubmission['submissionTitle'] . "</div><br/><br/>";
                                        echo "Submission Abstract:<div class='reviewAlani2'>" . $rowSubmission['submissionAbstract'] . "</div><br/><br/>";
                                        echo "Submission Keyword:<div class='reviewAlani2'>" . $rowSubmission['submissionKeyword'] . "</div><br/><br/>";
                                    }
                                }
                                if ($session->_read3($_SESSION["girisKullaniciId"]) == 4 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)
                                    $rId = $session->_read4($_SESSION["girisKullaniciId"]);
                                else if ($session->_read($_SESSION["girisKullaniciId"]) == 4)
                                    $rId = $session->_read2($_SESSION["girisKullaniciId"]);
                                $sId = $_REQUEST['sIncele'];
                                $izin = 0;
                                $reviewerSubmission = array();
                                $konferansKullanicilarkarakter2 = 0;
                                $kullanici2 = NULL;
                                $reviewSorgu = $baglanti->prepare("SELECT s.submissionKabul, r.reviewPuan, r.reviewYorum, r.reviewerId, r.submissionId FROM reviewler AS r JOIN submissionlar AS s ON r.submissionId = s.submissionId WHERE r.reviewerId = :reviewerId AND r.submissionId = :submissionId AND r.reviewSilindi = 0 AND s.submissionKabul = 0");
                                $reviewSorgu->bindParam(':reviewerId', $rId, PDO::PARAM_STR);
                                $reviewSorgu->bindParam(':submissionId', $sId, PDO::PARAM_STR);
                                $reviewSorgu->execute();
                                if($izinVerildi == 1) {
                                    if ($reviewSorgu->rowCount() > 0) {
                                        while ($rowSubmission = $reviewSorgu->fetch(PDO::FETCH_ASSOC)) {
                                            if ($rowSubmission['submissionKabul'] == 0 && $rowSubmission['reviewerId'] == $reviewerId) {
                                                $reviewerSubmission = str_split($rowSubmission['reviewPuan']);
                                                echo "<form action='' method='post'>";
                                                echo "<table class='konferanstable'>";
                                                foreach ($reviewerSubmission as $item) {
                                                    if (ord($reviewerSubmission[$konferansKullanicilarkarakter2]) != 124) {
                                                        $kullanici2 .= $reviewerSubmission[$konferansKullanicilarkarakter2];
                                                    } else {
                                                        if ($konferansKullanicilarkarakter2 == 1) {
                                                            echo "<tr title='Context Quality'>";
                                                            echo "<th>Context Kalitesi:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='context2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='context2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='context2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='context2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='context2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='context2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='context2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='context2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='context2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='context2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 3) {
                                                            echo "<tr title='Technical Quality'>";
                                                            echo "<th>Teknik Kalitesi:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='teknik2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='teknik2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='teknik2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='teknik2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='teknik2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='teknik2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='teknik2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='teknik2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='teknik2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='teknik2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 5) {
                                                            echo "<tr title='Linguistic Quality'>";
                                                            echo "<th>Dilbilgisi Kalitesi:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='dilbilgisi2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 7) {
                                                            echo "<tr title='Accuracy of Abstract'>";
                                                            echo "<th>Abstract Doğruluğu:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='abstract2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='abstract2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='abstract2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='abstract2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='abstract2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='abstract2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='abstract2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='abstract2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='abstract2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='abstract2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 9) {
                                                            echo "<tr title='Revelance of Topic'>";
                                                            echo "<th>Konu Bütünlüğü:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='konu2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='konu2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='konu2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='konu2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='konu2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='konu2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='konu2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='konu2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='konu2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='konu2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 11) {
                                                            echo "<tr title='Reliability of References'>";
                                                            echo "<th>Referansların Güvenilirliği:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='referans2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='referans2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='referans2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='referans2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='referans2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='referans2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='referans2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='referans2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='referans2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='referans2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 13) {
                                                            echo "<tr title='Originality'>";
                                                            echo "<th>Özgünlük:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='ozgun2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='ozgun2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='ozgun2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='ozgun2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='ozgun2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='ozgun2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='ozgun2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='ozgun2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='ozgun2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='ozgun2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 15) {
                                                            echo "<tr title='Quality of Experimental Results'>";
                                                            echo "<th>Deneysel Sonuç Kalitesi:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='deney2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='deney2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='deney2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='deney2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='deney2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='deney2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='deney2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='deney2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='deney2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='deney2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 17) {
                                                            echo "<tr title='Reference to Prior Works'>";
                                                            echo "<th>Atıflar:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='atif2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='atif2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='atif2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='atif2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='atif2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='atif2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='atif2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='atif2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='atif2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='atif2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 19) {
                                                            echo "<tr title='Organization and Clarity'>";
                                                            echo "<th>Organizasyon ve Netlik:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='organizasyon2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='organizasyon2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='organizasyon2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='organizasyon2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='organizasyon2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='organizasyon2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='organizasyon2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='organizasyon2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='organizasyon2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='organizasyon2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        if ($konferansKullanicilarkarakter2 == 21) {
                                                            echo "<tr title='Importance of the Field'>";
                                                            echo "<th>Alanın Önemi:</th>";
                                                            if ($kullanici2 == 1)
                                                                echo "<th><input type='radio' name='alan2' value='1' checked='checked'>Çok Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='alan2' value='1'>Çok Kötü</th>";
                                                            if ($kullanici2 == 2)
                                                                echo "<th><input type='radio' name='alan2' value='2' checked='checked'>Kötü</th>";
                                                            else
                                                                echo "<th><input type='radio' name='alan2' value='2'>Kötü</th>";
                                                            if ($kullanici2 == 3)
                                                                echo "<th><input type='radio' name='alan2' value='3' checked='checked'>Kabul Edilebilir</th>";
                                                            else
                                                                echo "<th><input type='radio' name='alan2' value='3'>Kabul Edilebilir</th>";
                                                            if ($kullanici2 == 4)
                                                                echo "<th><input type='radio' name='alan2' value='4' checked='checked'>İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='alan2' value='4'>İyi</th>";
                                                            if ($kullanici2 == 5)
                                                                echo "<th><input type='radio' name='alan2' value='5' checked='checked'>Çok İyi</th>";
                                                            else
                                                                echo "<th><input type='radio' name='alan2' value='5'>Çok İyi</th>";
                                                            echo "</tr>";
                                                        }
                                                        $kullanici2 = NULL;
                                                    }
                                                    $konferansKullanicilarkarakter2++;
                                                }
                                                echo "</table>";
                                                echo "Paper Hakkında Yorumunuz:<br/><textarea rows='15' cols='80' name='yorum2'>" . $rowSubmission['reviewYorum'] . "</textarea><br/><br/>";
                                                echo "<input type='submit' name='kaydet' value='Gönder' style='padding:3px 15px' OnClick=\"return confirm('Değerlendirmeyi gönder istediğinize emin misiniz?');\"/>";
                                                echo "</form>";
                                            }
                                        }
                                    } else {
                                        $izin = 1;
                                        echo "<form action='' method='post'>";
                                        echo "<table class='konferanstable'>";
                                        echo "<tr title='Context Quality'>";
                                        echo "<th>Context Kalitesi:</th>";
                                        echo "<th><input type='radio' name='context2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='context2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='context2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='context2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='context2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Technical Quality'>";
                                        echo "<th>Teknik Kalitesi:</th>";
                                        echo "<th><input type='radio' name='teknik2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='teknik2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='teknik2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='teknik2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='teknik2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Linguistic Quality'>";
                                        echo "<th>Dilbilgisi Kalitesi:</th>";
                                        echo "<th><input type='radio' name='dilbilgisi2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='dilbilgisi2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='dilbilgisi2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='dilbilgisi2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='dilbilgisi2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Accuracy of Abstract'>";
                                        echo "<th>Abstract Doğruluğu:</th>";
                                        echo "<th><input type='radio' name='abstract2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='abstract2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='abstract2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='abstract2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='abstract2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Revelance of Topic'>";
                                        echo "<th>Konu Bütünlüğü:</th>";
                                        echo "<th><input type='radio' name='konu2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='konu2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='konu2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='konu2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='konu2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Reliability of References'>";
                                        echo "<th>Referansların Güvenilirliği:</th>";
                                        echo "<th><input type='radio' name='referans2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='referans2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='referans2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='referans2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='referans2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Originality'>";
                                        echo "<th>Özgünlük:</th>";
                                        echo "<th><input type='radio' name='ozgun2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='ozgun2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='ozgun2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='ozgun2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='ozgun2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Quality of Experimental Results'>";
                                        echo "<th>Deneysel Sonuç Kalitesi:</th>";
                                        echo "<th><input type='radio' name='deney2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='deney2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='deney2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='deney2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='deney2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Reference to Prior Works'>";
                                        echo "<th>Atıflar:</th>";
                                        echo "<th><input type='radio' name='atif2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='atif2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='atif2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='atif2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='atif2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Organization and Clarity'>";
                                        echo "<th>Organizasyon ve Netlik:</th>";
                                        echo "<th><input type='radio' name='organizasyon2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='organizasyon2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='organizasyon2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='organizasyon2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='organizasyon2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "<tr title='Importance of the Field'>";
                                        echo "<th>Alanın Önemi:</th>";
                                        echo "<th><input type='radio' name='alan2' value='1'>Çok Kötü</th>";
                                        echo "<th><input type='radio' name='alan2' value='2'>Kötü</th>";
                                        echo "<th><input type='radio' name='alan2' value='3'>Kabul Edilebilir</th>";
                                        echo "<th><input type='radio' name='alan2' value='4'>İyi</th>";
                                        echo "<th><input type='radio' name='alan2' value='5'>Çok İyi</th>";
                                        echo "</tr>";
                                        echo "</table>";
                                        echo "Paper Hakkında Yorumunuz:<br/><textarea rows='15' cols='80' name='yorum2'></textarea><br/><br/>";
                                        echo "<input type='submit' name='kaydet' value='Gönder' style='padding:3px 15px' OnClick=\"return confirm('Değerlendirmeyi gönder istediğinize emin misiniz?');\"/>";
                                        echo "</form>";
                                    }
                                    echo "</div>";


                                    if (@(isset($_POST['context2']) && isset($_POST['teknik2']) && isset($_POST['dilbilgisi2']) && isset($_POST['abstract2']) && isset($_POST['konu2']) && isset($_POST['referans2']) && isset($_POST['ozgun2']) && isset($_POST['deney2']) && isset($_POST['atif2']) && isset($_POST['organizasyon2']) && isset($_POST['alan2']))) {
                                        $context = $_POST['context2'];
                                        $teknik = $_POST['teknik2'];
                                        $dilbilgisi = $_POST['dilbilgisi2'];
                                        $abstract = $_POST['abstract2'];
                                        $konu = $_POST['konu2'];
                                        $referans = $_POST['referans2'];
                                        $ozgun = $_POST['ozgun2'];
                                        $deney = $_POST['deney2'];
                                        $atif = $_POST['atif2'];
                                        $organizasyon = $_POST['organizasyon2'];
                                        $alan = $_POST['alan2'];
                                        $toplamPuan = ($context + $teknik + $dilbilgisi + $abstract + $konu + $referans + $ozgun + $deney + $atif + $organizasyon + $alan) / 11;
                                        $toplamPuan = number_format($toplamPuan, 2);
                                        $yorum = $_POST['yorum2'];
                                        $tarih = time();
                                        $puanlar = NULL;
                                        $puanlar .= $context . "|" . $teknik . "|" . $dilbilgisi . "|" . $abstract . "|" . $konu . "|" . $referans . "|" . $ozgun . "|" . $deney . "|" . $atif . "|" . $organizasyon . "|" . $alan . "|";
                                        if ($izin == 1) {
                                            $reviewEkle = $baglanti->prepare("INSERT INTO reviewler (reviewYorum, reviewPuan, reviewToplamPuan, reviewerId, submissionId, konferansId, reviewTarih) VALUES(?,?,?,?,?,?,?)");
                                            $reviewEkle->execute(array($yorum, $puanlar, $toplamPuan, $rId, $sId, $kId, $tarih));
                                            if ($reviewEkle == TRUE) {
                                                $reviewHataMesaji = "Kayıt başarılı.";
                                                header("Location:index.php?sayfa=reviewIncele&koSubmission=$kId&sIncele=$sId");
                                            } else
                                                $reviewHataMesaji = "Kayıt hatası.";
                                        } else {
                                            $reviewEkle = $baglanti->prepare("UPDATE reviewler SET reviewYorum = ?, reviewPuan = ?, reviewToplamPuan = ?, reviewTarih = ?, submissionDegisti = 0 WHERE reviewerId = ? AND submissionId = ? AND reviewSilindi = 0");
                                            $reviewEkle->execute(array($yorum, $puanlar, $toplamPuan, $tarih, $rId, $sId));
                                            if ($reviewEkle == TRUE) {
                                                $reviewHataMesaji = "Kayıt başarılı.";
                                                header("Location:index.php?sayfa=reviewIncele&koSubmission=$kId&sIncele=$sId");
                                            } else
                                                $reviewHataMesaji = "Kayıt hatası.";
                                        }

                                    } else {
                                        echo "<i style='color:firebrick'>Lütfen hiçbir puanlamayı boş bırakmayınız.</i>";
                                    }
                                } else{
                                    echo "</div>";
                                }
                            }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                }
            }
        }
        if ($erisim == 0) {
            echo "Erişim engellendi";
        }
    } else if (@$session->_read($_SESSION["girisKullaniciId"]) == 2 || ($session->_read3($_SESSION["girisKullaniciId"]) == 2 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        $kId = $_REQUEST['koSubmission'];
        $erisim = 0;
        $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansChair FROM konferanslar WHERE konferansSilindi = 0 AND konferansId = :konferansId");
        $sorgu->bindParam(':konferansId', $kId, PDO::PARAM_STR);
        $sorgu->execute();
        if ($sorgu->rowCount() > 0) {
            while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansChair']);
                $konferansKullanicilarkarakter = 0;
                $kullanici = NULL;
                if ($rowKonferans['konferansChair'] != NULL) {
                    foreach ($konferansKullanicilarDizi as $item) {
                        if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                            $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                        } else {
                            if ($kullanici == $session->_read2($_SESSION['girisKullaniciId']) || $kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                $erisim = 1;
                                $kId = $_REQUEST['koSubmission'];
                                $sId = $_REQUEST['sIncele'];
                                echo "<div class='reviewAlani'>";
                                echo "<a href='index.php?sayfa=review&koSubmission=$kId' class='reviewIptalButonu'>Geri</a><br/><br/><br/>";
                                $reviewHataMesaji = NULL;
                                echo $reviewHataMesaji;
                                $submissionSorgu = $baglanti->prepare("SELECT submissionId, submissionAd, submissionTur, submissionBoyut, submissionMd5, submissionTarih, submissionTitle, submissionAbstract, submissionKeyword, submissionKabul, submissionYorumId FROM submissionlar WHERE konferansId = :konferansId AND submissionId = :submissionId AND submissionSilindi = 0");
                                $submissionSorgu->bindParam(':konferansId', $_REQUEST['koSubmission'], PDO::PARAM_STR);
                                $submissionSorgu->bindParam(':submissionId', $sId, PDO::PARAM_STR);
                                $submissionSorgu->execute();
                                $fileAd = NULL;
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
                                        echo "<a>" . date("d.m.Y", $rowSubmission['submissionTarih']) . "</a><br/>";
                                        echo "<a href='submission/$fileAd'>" . $rowSubmission['submissionAd'] . "</a><br/><br/>";
                                        echo "Submission Title:<div class='reviewAlani2'>" . $rowSubmission['submissionTitle'] . "</div><br/><br/>";
                                        echo "Submission Abstract:<div class='reviewAlani2'>" . $rowSubmission['submissionAbstract'] . "</div><br/><br/>";
                                        echo "Submission Keyword:<div class='reviewAlani2'>" . $rowSubmission['submissionKeyword'] . "</div><br/><br/>";
                                    }
                                }
                                if ($session->_read3($_SESSION["girisKullaniciId"]) == 2 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)
                                    $rId = $session->_read4($_SESSION["girisKullaniciId"]);
                                else if ($session->_read($_SESSION["girisKullaniciId"]) == 2)
                                    $rId = $session->_read2($_SESSION["girisKullaniciId"]);
                                $sId = $_REQUEST['sIncele'];
                                $toplamPuan = -1;
                                $puanSayisi = 0;
                                $reviewSorgu4 = $baglanti->prepare("SELECT r.reviewId, r.reviewYorum, r.reviewToplamPuan, r.reviewerId, r.reviewTarih, r.submissionDegisti FROM reviewler AS r JOIN submissionlar AS s ON r.submissionId = s.submissionId WHERE r.submissionId = :submissionId AND r.reviewSilindi = 0");
                                $reviewSorgu4->bindParam(':submissionId', $sId, PDO::PARAM_STR);
                                $reviewSorgu4->execute();
                                if(isset($_REQUEST['rIncele'])) {
                                    $submissionSorgu9 = $baglanti->prepare("SELECT reviewYorum FROM reviewler WHERE reviewId = :reviewId AND reviewSilindi = 0");
                                    $submissionSorgu9->bindParam(':reviewId', $_REQUEST['rIncele'], PDO::PARAM_STR);
                                    $submissionSorgu9->execute();
                                    if ($submissionSorgu9->rowCount() > 0) {
                                        while ($rowSubmission = $submissionSorgu9->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<div class='reviewAlani2'><i>Reviewer Yorumu: " . $rowSubmission['reviewYorum'] . "</i></div><br/>";
                                        }
                                    }
                                }
                                echo "<table class='konferanstable2'>";
                                echo "<tr>";
                                echo "<th>Reviewer Yorumu</th>";
                                echo "<th>Reviewer Puanı</th>";
                                echo "<th>Tarih</th>";
                                echo "<th></th>";
                                echo "</tr>";
                                $turReview = 0;
								
                                if ($reviewSorgu4->rowCount() > 0) {
                                    while ($rowSubmission = $reviewSorgu4->fetch(PDO::FETCH_ASSOC)) {
                                        if($rowSubmission['submissionDegisti'] == 0)
                                            echo "<style>.renklendir$turReview{background-color:#77EE77}</style>";
                                        echo "<tr class='renklendir$turReview' title='$rowSubmission[reviewYorum]'>";
                                        echo "<th>" . mb_substr($rowSubmission['reviewYorum'],0,60) . "</th>";
                                        echo "<th>" . $rowSubmission['reviewToplamPuan'] . "</th>";
                                        echo "<th>" . date("d/m/Y", $rowSubmission['reviewTarih']) . "</th>";
                                        $reviewId = $rowSubmission['reviewId'];
                                        echo "<th><a href='index.php?sayfa=reviewIncele&koSubmission=$kId&sIncele=$sId&rIncele=$reviewId'>İncele</a></th>";
                                        echo "</tr>";
                                        $toplamPuan += $rowSubmission['reviewToplamPuan'];
                                        $puanSayisi++;
                                        $turReview++;
                                    }
                                }
                                echo "</table>";
                                if($puanSayisi != 0)
									$toplamPuan = number_format(($toplamPuan + 1) / $puanSayisi, "2");
								else
									$toplamPuan = "Henüz oylanmamış";
                                $submissionSorgu6 = $baglanti->prepare("SELECT submissionAd, submissionTur, submissionBoyut, submissionTarih, submissionTitle, submissionAbstract, submissionKeyword, submissionKabul, submissionYorum FROM submissionlar WHERE submissionId = :submissionId AND submissionSilindi = 0");
                                $submissionSorgu6->bindParam(':submissionId', $sId, PDO::PARAM_STR);
                                $submissionSorgu6->execute();
                                echo "<form action='' method='post'>";
                                echo "<table class='konferanstable2'>";
                                echo "<tr>";
                                echo "<th>Submission Adı</th>";
                                echo "<th>Submission Türü</th>";
                                echo "<th>Submission Boyutu</th>";
                                echo "<th>Tarih</th>";
                                echo "<th>Toplam Puan</th>";
                                echo "<th></th>";
                                echo "</tr>";
                                if ($submissionSorgu6->rowCount() > 0) {
                                    while ($rowSubmission = $submissionSorgu6->fetch(PDO::FETCH_ASSOC)) {
                                        if ($rowSubmission['submissionYorum'] != NULL) {
                                            echo "<tr>";
                                            echo "<th>" . $rowSubmission['submissionAd'] . "</th>";
                                            echo "<th>" . $rowSubmission['submissionTur'] . "</th>";
                                            echo "<th>" . $rowSubmission['submissionBoyut'] . "</th>";
                                            echo "<th>" . $rowSubmission['submissionTarih'] . "</th>";
                                            echo "<th>" . $toplamPuan . "</th>";
                                            if ($rowSubmission['submissionKabul'] == 0) {
                                                echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='kabul2'>";
                                                echo "<option value='0'>İncelenmedi</option>";
                                                echo "<option value='1'>Revize</option>";
                                                echo "<option value='2'>Kabul</option>";
                                                echo "<option value='3'>Red</option>";
                                                echo "</select></th>";
                                            } else if ($rowSubmission['submissionKabul'] == 1) {
                                                echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='kabul2'>";
                                                echo "<option value='1'>Revize</option>";
                                                echo "<option value='0'>İncelenmedi</option>";
                                                echo "<option value='2'>Kabul</option>";
                                                echo "<option value='3'>Red</option>";
                                                echo "</select></th>";
                                            } else if ($rowSubmission['submissionKabul'] == 2) {
                                                echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='kabul2'>";
                                                echo "<option value='2'>Kabul</option>";
                                                echo "<option value='0'>İncelenmedi</option>";
                                                echo "<option value='1'>Revize</option>";
                                                echo "<option value='3'>Red</option>";
                                                echo "</select></th>";
                                            } else if ($rowSubmission['submissionKabul'] == 3) {
                                                echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='kabul2'>";
                                                echo "<option value='3'>Red</option>";
                                                echo "<option value='0'>İncelenmedi</option>";
                                                echo "<option value='1'>Revize</option>";
                                                echo "<option value='2'>Kabul</option>";
                                                echo "</select></th>";
                                            }
                                            echo "</tr>";
                                            echo "</table>";
                                            echo "<textarea rows='10' cols='80' name='yorum2'>" . $rowSubmission['submissionYorum'] . "</textarea><br/><br/>";
                                        } else {
                                            echo "<tr>";
                                            echo "<th>" . $rowSubmission['submissionAd'] . "</th>";
                                            echo "<th>" . $rowSubmission['submissionTur'] . "</th>";
                                            echo "<th>" . $rowSubmission['submissionBoyut'] . "</th>";
                                            echo "<th>" . $rowSubmission['submissionTarih'] . "</th>";
                                            echo "<th>" . $toplamPuan . "</th>";
                                            echo "<th><select style='background-color:#fff; border:1px solid #323232; border-radius:2px 2px' type='text' name='kabul2'>";
                                            echo "<option value='0'>İncelenmedi</option>";
                                            echo "<option value='1'>Revize</option>";
                                            echo "<option value='2'>Kabul</option>";
                                            echo "<option value='3'>Red</option>";
                                            echo "</select></th>";
                                            echo "</tr>";
                                            echo "</table>";
                                            echo "<textarea rows='10' cols='80' name='yorum2'></textarea><br/><br/>";
                                        }
                                    }
                                }
                                echo "<input style='padding:3px 15px' type='submit' name='kaydet' value='Kaydet'/>";
                                echo "</form>";
                                echo "<i>Submission durumunu güncellemeyi unutmayın.</i>";
                                echo "</div>";

                            }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                }
            }
        }
        if(isset($_POST['kabul2'])){
            $kabul = $_POST['kabul2'];
            $yorum = $_POST['yorum2'];
            if ($session->_read3($_SESSION["girisKullaniciId"]) == 2 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)
                $rId = $session->_read4($_SESSION["girisKullaniciId"]);
            else if ($session->_read($_SESSION["girisKullaniciId"]) == 2)
                $rId = $session->_read2($_SESSION["girisKullaniciId"]);
            $reviewKabul = $baglanti->prepare("UPDATE submissionlar SET submissionKabul = ?, submissionYorumId = ?, submissionYorum = ? WHERE submissionId = ? AND submissionSilindi = 0");
            $reviewKabul->execute(array($kabul, $rId, $yorum, $sId));
            if ($reviewKabul == TRUE)
                $reviewHataMesaji = "Kayıt başarılı.";
            else
                $reviewHataMesaji = "Kayıt hatası.";
            header("Location:index.php?sayfa=reviewIncele&koSubmission=$kId&sIncele=$sId");
        }
        if ($erisim == 0) {
            echo "Erişim engellendi";
        }
    } else {
        echo "Erişim engellendi.";
    }
} else {
    echo "Giriş yapınız.";
}