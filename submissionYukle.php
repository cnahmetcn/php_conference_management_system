<?php
include_once ("veritabaniBaglantisi.php");
include_once ("Session.php");
$hataSubmissionYukleMesaj = NULL;
$hata = 0;
if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 3 || ($session->_read3($_SESSION["girisKullaniciId"]) == 3 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        $konferansGuncelleSorgu = $baglanti->prepare("SELECT konferansAuthor FROM konferanslar WHERE konferansId = :konferansId AND konferansSilindi = 0");
        $konferansGuncelleSorgu->bindParam(':konferansId', $_REQUEST['koSubmission'], PDO::PARAM_STR);
        $konferansGuncelleSorgu->execute();
        $kullaniciErisim = 0;
        if ($konferansGuncelleSorgu->rowCount() > 0) {
            while ($rowKonferans = $konferansGuncelleSorgu->fetch(PDO::FETCH_ASSOC)) {
                $konferansKullanicilarDizi = str_split($rowKonferans['konferansAuthor']);
                $konferansKullanicilarkarakter = 0;
                $kullanici = NULL;
                if ($rowKonferans['konferansAuthor'] != NULL) {
                    foreach ($konferansKullanicilarDizi as $item) {
                        if (ord($konferansKullanicilarDizi[$konferansKullanicilarkarakter]) != 124) {
                            $kullanici .= $konferansKullanicilarDizi[$konferansKullanicilarkarakter];
                        } else {
                            if ($kullanici == $session->_read2($_SESSION['girisKullaniciId']) || $kullanici == $session->_read4($_SESSION['girisKullaniciId'])) {
                                $kullaniciErisim = 1;
                            }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                }
            }
        }
        if ($kullaniciErisim != 0) {
            $kId = $_SESSION['koSubmission'];
            if ($session->_read3($_SESSION["girisKullaniciId"]) == 3 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
                $authorId = $session->_read4($_SESSION["girisKullaniciId"]);
            } else {
                $authorId = $session->_read2($_SESSION["girisKullaniciId"]);
            }
            if (isset($_FILES['fileU'])) {
                if ($_FILES['fileU']['error'] == 0) {
                    $hata = 0;
                    $fileTmp = $_FILES['fileU']['tmp_name'];
                    $fileMd5 = md5_file($_FILES['fileU']['tmp_name']);
                    $fileAd = $_FILES['fileU']['name'];
                    $fileTip = $_FILES['fileU']['type'];
                    $fileBoyut = $_FILES['fileU']['size'];
                    $uploadEdilecekYer = "submission/";
                    $target_file = $uploadEdilecekYer . basename($_FILES["fileU"]["name"]);
                    $sorgu = $baglanti->prepare("SELECT submissionAd, submissionMd5 FROM submissionlar WHERE submissionSilindi = 0");
                    $sorgu->execute();
                    if ($sorgu->rowCount() > 0) {
                        while ($rowSubmission = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                            if ($rowSubmission['submissionMd5'] == $fileMd5) {
                                $hataSubmissionYukleMesaj = "Aynı dosya önceden yüklenmiş. Daha önceden gönderdiğiniz submissionları kontrol ediniz. Problemin devam etmesi halinde yöneticiye başvurunuz.";
								$hata = 1;
                            }
                        }
                    }
                    if ($hata == 0) {
                        if ($_FILES['fileU']['type'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $_FILES['fileU']['type'] == "application/pdf" || $_FILES['fileU']['type'] == "application/vnd.ms-powerpoint" || $_FILES['fileU']['type'] == "application/vnd.openxmlformats-officedocument.presentationml.presentation" || $_FILES['fileU']['type'] == "application/msword") {
                            if ($_FILES['fileU']['size'] < 9000000) {
                                if (!file_exists('submission')) {
                                    mkdir('submission', 0777, true);
                                }
                                move_uploaded_file($_FILES["fileU"]["tmp_name"], $target_file);
                                if ($fileTip == "application/pdf")
                                    rename("submission/$fileAd", "submission/$fileMd5.pdf");
                                if ($fileTip == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                                    rename("submission/$fileAd", "submission/$fileMd5.docx");
                                if ($fileTip == "application/msword")
                                    rename("submission/$fileAd", "submission/$fileMd5.doc");
                                if ($fileTip == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
                                    rename("submission/$fileAd", "submission/$fileMd5.pptx");
                                if ($fileTip == "application/vnd.ms-powerpoint")
                                    rename("submission/$fileAd", "submission/$fileMd5.ppt");
                                $sTarih = time();
                                $sTitle = $_POST['stitle2'];
                                $sAbstract = $_POST['sabstract2'];
                                $sKeyword = $_POST['skeyword2'];
                                $submissionEkle = $baglanti->prepare("INSERT INTO submissionlar (submissionAd, submissionTur, submissionBoyut, submissionMd5, submissionTitle, submissionAbstract, submissionKeyword, submissionTarih, kullaniciId, konferansId) VALUES(?,?,?,?,?,?,?,?,?,?)");
                                $submissionEkle->execute(array($fileAd, $fileTip, $fileBoyut, $fileMd5, $sTitle, $sAbstract, $sKeyword, $sTarih, $authorId, $kId));
                                if ($submissionEkle == TRUE) {
                                    $hataSubmissionYukleMesaj = "Submission başarılı bir şekilde gönderildi.";
								}
                                echo "<script>alert('" . $hataSubmissionYukleMesaj . "');window.Location = history.go(-2);</script>";
                            } else {
                                $hataSubmissionYukleMesaj = "2 MB den büyük dosya yükleyemezsiniz.";
								$hata = 1;
                            }
                        } else {
                            $hataSubmissionYukleMesaj = "Sadece PDF, DOCX, DOC, PPT türünde dosya yükleyebilirsiniz.";
							$hata = 1;
                        }
                    }
                } else {
                    $hataSubmissionYukleMesaj = "Dosya karşıya yüklenirken hata oluştu.";
					$hata = 1;
                }
            } else {
                $hataSubmissionYukleMesaj = "2 MB den büyük dosya yükleyemezsiniz.";
				$hata = 1;
            }
        }
        if($hata == 1)
        echo "<script>alert('".$hataSubmissionYukleMesaj."');window.Location = history.go(-1);</script>";
    }
}
