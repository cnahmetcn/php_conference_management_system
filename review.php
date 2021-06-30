<style>
    .bilgiUl{background-color:#fff; padding:5px; border:1px solid #fff; margin-top:-10px; border-radius:2px 2px}
    .bilgiUl li{float:left; margin-left:25px}
    .reviewIptalButonu{position:relative; border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#323232; color:#eee; text-decoration:none}
    .reviewIptalButonu:hover{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#ddd; color:#323232}

    .konferanstable {font-family:aria, sans-serif; font-size:85%; margin-top:20px; border-collapse:collapse; width:100%;}
    .konferanstable td, .konferanstable th {border:1px solid #323232; text-align:left; padding:10px; width:auto; overflow:hidden;}
    .konferanstable tr:hover {background-color: #323232; color: #ddd;}
    .konferanstable tr:hover a{color:#ddd; text-decoration:none}
    .konferanstable tr:first-child {background-color:#ddd; word-wrap:break-word}
    .konferanstable tr:first-child:hover {background-color:#ddd;}
    .konferanstable tr:first-child:hover a:link{color:#0000EE; text-decoration:underline}
    .konferanstable tr:first-child:hover a:visited{color:#551A8B; text-decoration:underline}
</style>
</script>
<?php
include("veritabaniBaglantisi.php");
include_once ("Session.php");
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 4 || ($session->_read3($_SESSION["girisKullaniciId"]) == 4 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        $kId = $_REQUEST['koSubmission'];
        if($session->_read3($_SESSION["girisKullaniciId"]) == 4 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)
            $reviId = $session->_read4($_SESSION["girisKullaniciId"]);
        else
            $reviId = $session->_read2($_SESSION["girisKullaniciId"]);
        $erisim = 0;
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
            $_SESSION['koSubmission'] = $_REQUEST['koSubmission'];
            if (@$_GET['s'] == '1') {
                if ($_SESSION['emialTabloSirala1'] != 1)
                    $_SESSION['emialTabloSirala1'] = 1;
                else
                    $_SESSION['emialTabloSirala1'] = 11;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            } else if (@$_GET['s'] == '2') {
                if ($_SESSION['emialTabloSirala1'] != 2)
                    $_SESSION['emialTabloSirala1'] = 2;
                else
                    $_SESSION['emialTabloSirala1'] = 22;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            } else if (@$_GET['s'] == '3') {
                if ($_SESSION['emialTabloSirala1'] != 3)
                    $_SESSION['emialTabloSirala1'] = 3;
                else
                    $_SESSION['emialTabloSirala1'] = 33;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            } else if (@$_GET['s'] == '4') {
                if ($_SESSION['emialTabloSirala1'] != 4)
                    $_SESSION['emialTabloSirala1'] = 4;
                else
                    $_SESSION['emialTabloSirala1'] = 44;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            } else if (@$_GET['s'] == '5') {
                if ($_SESSION['emialTabloSirala1'] != 5)
                    $_SESSION['emialTabloSirala1'] = 5;
                else
                    $_SESSION['emialTabloSirala1'] = 55;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            }

            echo "<ul class='bilgiUl' style='float:right;'><li>İncelenmedi</li><li style='color:#77EE77'>İncelendi</li></ul>";
            $submissionSorgu = $baglanti->prepare("SELECT submissionId, submissionAd, submissionTur, submissionBoyut, submissionMd5, submissionTarih, submissionTitle, submissionAbstract, submissionKeyword, submissionKabul, submissionYorumId, submissionKabul FROM submissionlar WHERE konferansId = :konferansId AND submissionSilindi = 0");
            $submissionSorgu->bindParam(':konferansId', $_REQUEST['koSubmission'], PDO::PARAM_STR);
            $submissionSorgu->execute();

            echo "<a href='index.php?sayfa=konferanslar' class='reviewIptalButonu'>Geri</a><br/>";
            echo "<table class='konferanstable'>";
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=submission&s=1&koSubmission=$kId'>SUBMISSION ADI</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=2&koSubmission=$kId'>TARİH</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=3&koSubmission=$kId'>TITLE</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=4&koSubmission=$kId'>ABSTRACT</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=5&koSubmission=$kId'>KEYWORD</a></th>";
            echo "<th></th>";
            echo "</tr>";
            $tur = 0;
            $fileAd = NULL;
            $fileTip = NULL;
            $fileMd5 = NULL;
            if ($submissionSorgu->rowCount() > 0) {
                while ($rowSubmission = $submissionSorgu->fetch(PDO::FETCH_ASSOC)) {
                    if ($rowSubmission['submissionKabul'] == 0) {
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
                        $fileAd = $fileMd5;
                        $fileAd .= $fileTip;
                        if ($session->_read3($_SESSION["girisKullaniciId"]) == 4 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)
                            $rId = $session->_read4($_SESSION["girisKullaniciId"]);
                        else
                            $rId = $session->_read2($_SESSION["girisKullaniciId"]);
                        $submissionSorgu2 = $baglanti->prepare("SELECT * FROM reviewler WHERE konferansId = :konferansId AND submissionId = :submissionId AND reviewerId = :reviewerId AND reviewSilindi = 0");
                        $submissionSorgu2->bindParam(':konferansId', $_REQUEST['koSubmission'], PDO::PARAM_STR);
                        $submissionSorgu2->bindParam(':submissionId', $rowSubmission['submissionId'], PDO::PARAM_STR);
                        $submissionSorgu2->bindParam(':reviewerId', $rId, PDO::PARAM_STR);
                        $submissionSorgu2->execute();
                        if ($submissionSorgu2->rowCount() > 0) {
                            while ($rowSubmission2 = $submissionSorgu2->fetch(PDO::FETCH_ASSOC)) {
                                if($rowSubmission['submissionKabul'] == 0)
                                    echo "<style>.renklendir$tur{background-color:#77EE77}</style>";
                            }
                        }
                        echo "<tr class='renklendir$tur'>";
                        echo "<th class='renklendirtd' title='" . $rowSubmission['submissionAd'] . "'><a href='submission/$fileAd'>" . $rowSubmission['submissionAd'] . "</a></th>";
                        echo "<th class='renklendirtd'>" . date("d/m/y", "$rowSubmission[submissionTarih]") . "</th>";
                        echo "<th class='renklendirtd' title='" . $rowSubmission['submissionTitle'] . "'>" . mb_substr($rowSubmission['submissionTitle'],0,20) . "</th>";
                        echo "<th class='renklendirtd' title='" . $rowSubmission['submissionAbstract'] . "'>" . mb_substr($rowSubmission['submissionAbstract'],0,20) . "</th>";
                        echo "<th class='renklendirtd' title='" . $rowSubmission['submissionKeyword'] . "'>" . mb_substr($rowSubmission['submissionKeyword'],0,20) . "</th>";
                        echo "<th><a href='index.php?sayfa=reviewIncele&koSubmission=$kId&sIncele=$rowSubmission[submissionId]'>İncele</a></th>";
                        echo "</tr>";
                        $tur++;
                    }
                }
                if ($tur == 0) {
                    echo "<tr><th>Submission Yok</th><th></th><th></th><th></th><th></th><th></th></tr>";
                }
            } else {
                echo "<tr><th>Submission Yok</th><th></th><th></th><th></th><th></th><th></th></tr>";
            }
            echo "</table>";
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
            $_SESSION['koSubmission'] = $_REQUEST['koSubmission'];
            if (@$_GET['s'] == '1') {
                if ($_SESSION['emialTabloSirala1'] != 1)
                    $_SESSION['emialTabloSirala1'] = 1;
                else
                    $_SESSION['emialTabloSirala1'] = 11;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            } else if (@$_GET['s'] == '2') {
                if ($_SESSION['emialTabloSirala1'] != 2)
                    $_SESSION['emialTabloSirala1'] = 2;
                else
                    $_SESSION['emialTabloSirala1'] = 22;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            } else if (@$_GET['s'] == '3') {
                if ($_SESSION['emialTabloSirala1'] != 3)
                    $_SESSION['emialTabloSirala1'] = 3;
                else
                    $_SESSION['emialTabloSirala1'] = 33;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            } else if (@$_GET['s'] == '4') {
                if ($_SESSION['emialTabloSirala1'] != 4)
                    $_SESSION['emialTabloSirala1'] = 4;
                else
                    $_SESSION['emialTabloSirala1'] = 44;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            } else if (@$_GET['s'] == '5') {
                if ($_SESSION['emialTabloSirala1'] != 5)
                    $_SESSION['emialTabloSirala1'] = 5;
                else
                    $_SESSION['emialTabloSirala1'] = 55;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            }

            echo "<ul class='bilgiUl' style='float:right;'><li>Gözden geçirilmedi</li><li style='color:#DA8028'>Revize bekliyor</li><li style='color:#77EE77'>Kabul edildi</li><li style='color:#C83939;'>Reddedildi</li></ul>";
            $submissionSorgu = $baglanti->prepare("SELECT submissionId, submissionAd, submissionTur, submissionBoyut, submissionMd5, submissionTarih, submissionTitle, submissionAbstract, submissionKeyword, submissionKabul, submissionYorumId FROM submissionlar WHERE konferansId = :konferansId AND submissionSilindi = 0");
            $submissionSorgu->bindParam(':konferansId', $_REQUEST['koSubmission'], PDO::PARAM_STR);
            $submissionSorgu->execute();

            echo "<a href='index.php?sayfa=konferanslar' class='reviewIptalButonu'>Geri</a><br/>";
            echo "<table class='konferanstable'>";
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=submission&s=1&koSubmission=$kId'>SUBMISSION ADI</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=2&koSubmission=$kId'>TARİH</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=3&koSubmission=$kId'>TITLE</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=4&koSubmission=$kId'>ABSTRACT</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=5&koSubmission=$kId'>KEYWORD</a></th>";
            echo "<th colspan='2'></th>";
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
                    $fileAd = $fileMd5;
                    $fileAd .= $fileTip;
                    if ($session->_read3($_SESSION["girisKullaniciId"]) == 2 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)
                        $rId = $session->_read4($_SESSION["girisKullaniciId"]);
                    else
                        $rId = $session->_read2($_SESSION["girisKullaniciId"]);
                    $submissionSorgu2 = $baglanti->prepare("SELECT * FROM submissionlar WHERE konferansId = :konferansId AND submissionId = :submissionId AND submissionSilindi = 0");
                    $submissionSorgu2->bindParam(':konferansId', $_REQUEST['koSubmission'], PDO::PARAM_STR);
                    $submissionSorgu2->bindParam(':submissionId', $rowSubmission['submissionId'], PDO::PARAM_STR);
                    $submissionSorgu2->execute();
                    if ($submissionSorgu2->rowCount() > 0) {
                        while ($rowSubmission2 = $submissionSorgu2->fetch(PDO::FETCH_ASSOC)) {
                            if ($rowSubmission['submissionKabul'] == 1 && $rowSubmission['submissionYorumId'] != 0)
                                echo "<style>.renklendir$tur{background-color:#DA8028}</style>";
                            if ($rowSubmission['submissionKabul'] == 2)
                                echo "<style>.renklendir$tur{background-color:#77EE77}</style>";
                            else if ($rowSubmission['submissionKabul'] == 3)
                                echo "<style>.renklendir$tur{background-color:#C83939 }</style>";
                        }
                    }
                    echo "<tr class='renklendir$tur'>";
                    echo "<th class='renklendirtd' title='" . $rowSubmission['submissionAd'] . "'><a href='submission/$fileAd'>" . $rowSubmission['submissionAd'] . "</a></th>";
                    echo "<th class='renklendirtd'>" . date("d/m/y", "$rowSubmission[submissionTarih]") . "</th>";
                    echo "<th class='renklendirtd' title='" . $rowSubmission['submissionTitle'] . "'>" . mb_substr($rowSubmission['submissionTitle'], 0, 20) . "</th>";
                    echo "<th class='renklendirtd' title='" . $rowSubmission['submissionAbstract'] . "'>" . mb_substr($rowSubmission['submissionAbstract'], 0, 20) . "</th>";
                    echo "<th class='renklendirtd' title='" . $rowSubmission['submissionKeyword'] . "'>" . mb_substr($rowSubmission['submissionKeyword'], 0,20) . "</th>";
                    echo "<th><a href='index.php?sayfa=reviewIncele&koSubmission=$kId&sIncele=$rowSubmission[submissionId]'>İncele</a></th>";
                    echo "<th><a href='index.php?sayfa=reviewSil&koSubmission=$kId&sSil=$rowSubmission[submissionId]' OnClick=\"return confirm('" . $rowSubmission['submissionAd'] . " silmek istediğinize emin misiniz?');\">Sil</a></th>";
                    echo "</tr>";
                    $tur++;
                }
                if ($tur == 0) {
                    echo "<tr><th>Submission Yok</th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
                }
            } else {
                echo "<tr><th>Submission Yok</th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
            }
            echo "</table>";
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