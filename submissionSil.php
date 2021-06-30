<?php
include_once ("veritabaniBaglantisi.php");
include_once ("Session.php");
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 3 || ($session->_read3($_SESSION["girisKullaniciId"]) == 3 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        $kId = $_REQUEST['koSubmission'];
        $erisim = 0;
        $sorgu = $baglanti->prepare("SELECT konferansAuthor FROM konferanslar WHERE konferansSilindi = 0 AND konferansId = :konferansId");
        $sorgu->bindParam(':konferansId', $kId, PDO::PARAM_STR);
        $sorgu->execute();
        if ($sorgu->rowCount() > 0) {
            while ($rowKonferans = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansAuthor']);
                $konferansKullanicilarkarakter = 0;
                $kullanici = NULL;
                if ($rowKonferans['konferansAuthor'] != NULL) {
                    foreach ($konferansKullanicilarDizi as $item) {
                        if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                            $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                        } else {
                            if ($kullanici == $session->_read2($_SESSION['girisKullaniciId']) || $kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                $erisim = 1;
                            }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                }
            }
        }
        if ($erisim == 1) {
            $kId = $_REQUEST['koSubmission'];
            $sId = $_REQUEST['sSil'];
            $sMd5 = "";
            $fileAd = NULL;
            $fileMd5 = NULL;
            $fileTip = NULL;
            if (!file_exists('submission')) {
                mkdir('submission', 0777, true);
            }
            if (!file_exists('submission/silinenler')) {
                mkdir('submission/silinenler', 0777, true);
            }
            if (!file_exists("submission/silinenler/$sId")) {
                mkdir("submission/silinenler/$sId", 0777, true);
            }
            $submissionSorgu = $baglanti->prepare("SELECT submissionTur, submissionMd5 FROM submissionlar WHERE submissionId = :submissionId AND submissionSilindi = 0");
            $submissionSorgu->bindParam(':submissionId', $sId, PDO::PARAM_STR);
            $submissionSorgu->execute();
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
                }
            }
            $fileAd .= $fileMd5;
            $fileAd .= $fileTip;
            @rename("submission/$fileAd", "submission/silinenler/$sId/$fileAd");
            $sSil = $baglanti->prepare("UPDATE submissionlar SET submissionSilindi = 1 WHERE submissionId = :submissionId");
            $sSil->bindParam(':submissionId', $sId, PDO::PARAM_STR);
            $guncelle = $sSil->execute();
            if ($guncelle == TRUE)
                header("Location: index.php?sayfa=review&koSubmission=$kId");
            else
                echo "Veritabanı hatası.";
        } else {
            echo "Erişim engellendi.";
        }
    }
}
?>