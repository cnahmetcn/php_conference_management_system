<style>
    .bilgiUl{background-color:#fff; padding:5px; border:1px solid #fff; margin-top:-10px; border-radius:2px 2px}
    .bilgiUl li{float:left; margin-left:25px}

    .yeniSubmissionButonu{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#323232; color:#eee; text-decoration:none}
    .yeniSubmissionButonu:hover{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#ddd; color:#323232}
    .yeniSubmissionIptalButonu{position:relative; left:120px; top:-15px; border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#323232; color:#eee; text-decoration:none}
    .yeniSubmissionIptalButonu:hover{border:1px solid #323232; border-radius:2px 2px; padding:10px; background-color:#ddd; color:#323232}
    .submissionGondermeAlani{display:none; width:100%}
    .submissionGondermeAlani a{margin:5px 0px; width:100px; margin-right:20px}
    .submissionGondermeAlani i{margin-left:5px; font-size: small; color: firebrick}

    .submissionKontrolAlani{display:none; width:100%}
    .submissionKontrolAlani a{margin:5px 0px; width:100px; margin-right:20px}
    .submissionKontrolAlani i{margin-left:5px; font-size: small; color: firebrick}

    .konferanstable {font-family:aria, sans-serif; font-size:85%; margin-top:20px; border-collapse:collapse; width:100%;}
    .konferanstable td, .konferanstable th {border:1px solid #323232; text-align:left; padding:5px; width:auto; overflow:hidden;}
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
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 3 || ($session->_read3($_SESSION["girisKullaniciId"]) == 3 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        $kId = $_REQUEST['koSubmission'];
        $erisim = 0;
        $sorgu = $baglanti->prepare("SELECT konferansAuthor FROM konferanslar WHERE konferansSilindi = 0 AND konferansId = :konferansId");
        $sorgu->bindParam(':konferansId', $kId, PDO::PARAM_STR);
        $sorgu->execute();
        $_SESSION['koSubmission'] = $kId;
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
            $_SESSION['koSubmission'] = $_REQUEST['koSubmission'];
            $yaziAlaniniGoster = 0;
            if (@$_GET['s'] == '13') {
                $yaziAlaniniGoster = 1;
            }
            if ($yaziAlaniniGoster == 1) {
                echo "<style>.submissionGondermeAlani{display:block;}</style>";
                echo "<style>.submissionKontrolAlani{display:none;}</style>";
            }

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
            } else if (@$_GET['s'] == '6') {
                if ($_SESSION['emialTabloSirala1'] != 6)
                    $_SESSION['emialTabloSirala1'] = 6;
                else
                    $_SESSION['emialTabloSirala1'] = 66;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            } else if (@$_GET['s'] == '6') {
                if ($_SESSION['emialTabloSirala1'] != 7)
                    $_SESSION['emialTabloSirala1'] = 7;
                else
                    $_SESSION['emialTabloSirala1'] = 77;
                header("Location: index.php?sayfa=submission&koSubmission=$kId");
            }

            echo "<ul class='bilgiUl' style='float:right;'><li>Gözden geçirilmedi</li><li style='color:#DA8028'>Revize bekliyor</li><li style='color:#77EE77'>Kabul edildi</li><li style='color:#C83939;'>Reddedildi</li></ul>";
            echo "<a href='index.php?sayfa=submission&s=13&koSubmission=$kId' class='yeniSubmissionButonu'>Yeni Submission</a>";
            echo "<div class='submissionGondermeAlani'>";
            echo "<a href='index.php?sayfa=submission&koSubmission=$kId' class='yeniSubmissionIptalButonu'>İptal</a><br/><br/><br/>";
            echo "<form action=\"submissionYukle.php?koSubmission=$kId\" method=\"post\" enctype=\"multipart/form-data\">";
            echo "<input type=\"file\" name=\"fileU\" id=\"fileU\"/>";
            echo "<br/><br/><br/><a>Submission Title:</a><br/><input style='border:1px solid; padding:5px; width:400px;' type='text' name='stitle2'/><br/><br/><br/>";
            echo "<a>Submission Abstract:</a><br/><textarea cols='80' rows='20' name='sabstract2'></textarea><br/><br/><br/>";
            echo "<a>Submission Keyword:</a><br/><textarea cols='80' rows='20' name='skeyword2'></textarea><br/><br/><br/>";
            echo "<input style='padding:3px 15px;' type=\"submit\" value=\"Gönder\" name=\"submit\"/>";
            echo "</form>";
            echo "</div>";

            if (isset($_REQUEST['koSubmission']) && isset($_REQUEST['sKontrol'])) {
                echo "<style>.submissionKontrolAlani{display:block;}</style>";
                echo "<style>.submissionGondermeAlani{display:none;}</style>";
                echo "<style>.submissionGondermeAlani2{display:none;}</style>";
                echo "<div class='submissionKontrolAlani'>";
                echo "<a href='index.php?sayfa=submission&koSubmission=$kId' class='yeniSubmissionIptalButonu'>İptal</a><br/><br/><br/>";
                $submissionSorgu2 = $baglanti->prepare("SELECT submissionYorumId, submissionYorum, submissionKabul FROM submissionlar WHERE submissionId = :submissionId AND submissionSilindi = 0");
                $submissionSorgu2->bindParam(':submissionId', $_REQUEST['sKontrol'], PDO::PARAM_STR);
                $submissionSorgu2->execute();
                if ($submissionSorgu2->rowCount() > 0) {
                    while ($rowSubmission = $submissionSorgu2->fetch(PDO::FETCH_ASSOC)) {
                        $yorumId = $rowSubmission['submissionYorumId'];
                        $yorum = $rowSubmission['submissionYorum'];
                    }
                    if ($yorum != NULL) {
                        $submissionSorgu4 = $baglanti->prepare("SELECT kullaniciIsim1, kullaniciSoyisim FROM kullanicilar WHERE kullaniciId = :kullaniciId AND kullaniciSilindi = 0");
                        $submissionSorgu4->bindParam(':kullaniciId', $yorumId, PDO::PARAM_STR);
                        $submissionSorgu4->execute();
                        if ($submissionSorgu4->rowCount() > 0) {
                            while ($rowSubmission = $submissionSorgu4->fetch(PDO::FETCH_ASSOC)) {
                                $yorumIsim = $rowSubmission['kullaniciIsim1'];
                                $yorumSoyisim = $rowSubmission['kullaniciSoyisim'];
                            }
                        }
                        echo "<div style='border:1px solid; padding:10px;'><a><i>" . $yorumIsim . " " . $yorumSoyisim . "</i><br/><br/>" . $yorum . "</a></div>";
                    }
                    echo "</div>";
                }
            }

            if (isset($_REQUEST['koSubmission']) && isset($_REQUEST['sDuzenle'])) {
                echo "<style>.submissionGondermeAlani2{display:block;}</style>";
                echo "<style>.submissionGondermeAlani{display:none;}</style>";
                echo "<style>.submissionKontrolAlani2{display:none;}</style>";
                echo "<div class='submissionGondermeAlani2'>";
                echo "<a href='index.php?sayfa=submission&koSubmission=$kId' class='yeniSubmissionIptalButonu'>İptal</a><br/><br/><br/>";
                $submissionSorgu2 = $baglanti->prepare("SELECT submissionAd, submissionId, submissionTitle, submissionAbstract, submissionKeyword FROM submissionlar WHERE submissionId = :submissionId AND submissionKabul != 2 AND submissionSilindi = 0");
                $submissionSorgu2->bindParam(':submissionId', $_REQUEST['sDuzenle'], PDO::PARAM_STR);
                $submissionSorgu2->execute();
                $sId = $_REQUEST['sDuzenle'];
                echo "<form action=\"submissionGuncelle.php?kSubmission=$kId&sDuzenle=$sId\" method=\"post\" enctype=\"multipart/form-data\">";
                if ($submissionSorgu2->rowCount() > 0) {
                    while ($rowSubmission = $submissionSorgu2->fetch(PDO::FETCH_ASSOC)) {
                        echo "<input type=\"file\" name=\"fileU\" id=\"fileU\"/>";
                        echo "<br/><br/><br/><a>Submission Title:</a><br/><input style='border:1px solid; padding:5px; width:400px;' type='text' name='stitle2' value='$rowSubmission[submissionTitle]'/><br/><br/><br/>";
                        echo "<a>Submission Abstract:</a><br/><textarea cols='80' rows='20' name='sabstract2'>" . $rowSubmission['submissionAbstract'] . "</textarea><br/><br/><br/>";
                        echo "<a>Submission Keyword:</a><br/><textarea cols='80' rows='20' name='skeyword2'>" . $rowSubmission['submissionKeyword'] . "</textarea><br/><br/><br/>";
                        echo "<input style=\"padding:3px 15px;\" type=\"submit\" value=\"Gönder\" name=\"submit\" OnClick=\"return confirm('" . $rowSubmission['submissionAd'] . " submission düzenlemek istediğinize emin misiniz?');\"/>";
                        echo "</form>";
                        echo "</div>";
                    }
                }
            }

            if ($session->_read3($_SESSION["girisKullaniciId"]) == 3 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
                $authorId = $session->_read4($_SESSION["girisKullaniciId"]);
            } else {
                $authorId = $session->_read2($_SESSION["girisKullaniciId"]);
            }
            $submissionSorgu = $baglanti->prepare("SELECT submissionId, submissionAd, submissionTur, submissionBoyut, submissionMd5, submissionTarih, submissionTitle, submissionAbstract, submissionKeyword, submissionKabul, submissionYorumId FROM submissionlar WHERE kullaniciId = :kullaniciId AND konferansId = :konferansId AND submissionSilindi = 0");
            $submissionSorgu->bindParam(':kullaniciId', $authorId, PDO::PARAM_STR);
            $submissionSorgu->bindParam(':konferansId', $_REQUEST['koSubmission'], PDO::PARAM_STR);
            $submissionSorgu->execute();
            echo "<table class='konferanstable'>";
            echo "<tr>";
            echo "<th><a href='index.php?sayfa=submission&s=1&koSubmission=$kId'>SUBMISSION ADI</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=2&koSubmission=$kId'>TÜRÜ</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=3&koSubmission=$kId'>BOYUTU</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=4&koSubmission=$kId'>TARİH</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=5&koSubmission=$kId'>TITLE</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=6&koSubmission=$kId'>ABSTRACT</a></th>";
            echo "<th><a href='index.php?sayfa=submission&s=7&koSubmission=$kId'>KEYWORD</a></th>";
            echo "<th colspan='3'></th>";
            echo "</tr>";
            $tur = 0;
            $fileAd = NULL;
            $fileTip = NULL;
            $fileMd5 = NULL;
            if ($submissionSorgu->rowCount() > 0) {
                while ($rowSubmission = $submissionSorgu->fetch(PDO::FETCH_ASSOC)) {
                    if ($rowSubmission['submissionKabul'] == 1 && $rowSubmission['submissionYorumId'] != 0)
                        echo "<style>.renklendir$tur{background-color:#DA8028}</style>";
                    if ($rowSubmission['submissionKabul'] == 2)
                        echo "<style>.renklendir$tur{background-color:#77EE77}</style>";
                    else if ($rowSubmission['submissionKabul'] == 3)
                        echo "<style>.renklendir$tur{background-color:#C83939 }</style>";
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
                    echo "<tr class='renklendir$tur'>";
                    echo "<th class='renklendirtd'><a href='submission/$fileAd'>" . $rowSubmission['submissionAd'] . "</a></th>";
                    echo "<th class='renklendirtd'>" . $rowSubmission['submissionTur'] . "</th>";
                    echo "<th class='renklendirtd'>" . $rowSubmission['submissionBoyut'] . "</th>";
                    echo "<th class='renklendirtd'>" . date("d/m/y", "$rowSubmission[submissionTarih]") . "</th>";
                    echo "<th class='renklendirtd'>" . $rowSubmission['submissionTitle'] . "</th>";
                    echo "<th class='renklendirtd'>" . $rowSubmission['submissionAbstract'] . "</th>";
                    echo "<th class='renklendirtd'>" . $rowSubmission['submissionKeyword'] . "</th>";
                    if ($rowSubmission['submissionKabul'] == 0) {
                        echo "<th><a href='index.php?sayfa=submissionSil&koSubmission=$kId&sSil=$rowSubmission[submissionId]' OnClick=\"return confirm('" . $rowSubmission['submissionAd'] . " silmek istediğinize emin misiniz?');\">Sil</a></th>";
                        echo "<th><a href='index.php?sayfa=submission&koSubmission=$kId&sDuzenle=$rowSubmission[submissionId]'>Düzenle</a></th>";
                        echo "<th></th>";
                        echo "</tr>";
                    } else if ($rowSubmission['submissionKabul'] == 1) {
                        echo "<th><a href='index.php?sayfa=submissionSil&koSubmission=$kId&sSil=$rowSubmission[submissionId]' OnClick=\"return confirm('" . $rowSubmission['submissionAd'] . " silmek istediğinize emin misiniz?');\">Sil</a></th>";
                        echo "<th><a href='index.php?sayfa=submission&koSubmission=$kId&sDuzenle=$rowSubmission[submissionId]'>Düzenle</a></th>";
                        echo "<th><a href='index.php?sayfa=submission&koSubmission=$kId&sKontrol=$rowSubmission[submissionId]'>Kontrol Et</a></th>";
                        echo "</tr>";
                    } else {
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "</tr>";
                    }
                    $tur++;
                }
                if ($tur == 0) {
                    echo "<tr><th>Submission Yok</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
                }
            } else {
                echo "<tr><th>Submission Yok</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
            }
            echo "</table>";
        }
        if($erisim == 0){
            echo "Erişim engellendi";
        }
    } else {
        echo "Erişim engellendi.";
    }
} else {
    echo "Giriş yapınız.";
}