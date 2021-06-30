<?php
include_once ("veritabaniBaglantisi.php");
include_once ("Session.php");
$hataSubmissionYukleMesaj = NULL;

if (@$session->_read($_SESSION["girisKullaniciId"])) {
    if (@$session->_read($_SESSION["girisKullaniciId"]) == 3 || ($session->_read3($_SESSION["girisKullaniciId"]) == 3 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL)) {
        $kId = $_REQUEST['kSubmission'];
		$sId = $_REQUEST['sDuzenle'];
        $erisim = 0;
        $sorgu = $baglanti->prepare("SELECT konferansId, konferansAd, konferansIsim, konferansAuthor FROM konferanslar WHERE konferansSilindi = 0 AND konferansId = :konferansId");
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
                                if ($session->_read3($_SESSION["girisKullaniciId"]) == 3 && $session->_read4($_SESSION["girisKullaniciId"]) != NULL) {
                                    $authorId = $session->_read4($_SESSION["girisKullaniciId"]);
                                } else {
                                    $authorId = $session->_read2($_SESSION["girisKullaniciId"]);
                                }
								$erisim = 1;
                            }
                            $kullanici = NULL;
                        }
                        $konferansKullanicilarkarakter++;
                    }
                }
            }
        }
		if($erisim == 1) {
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
                                break;
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

								$fileAd2 = NULL;
								$fileMd52 = NULL;
								$fileTip2 = NULL;
								$submissionSorgu = $baglanti->prepare("SELECT submissionTur, submissionMd5 FROM submissionlar WHERE submissionId = :submissionId AND submissionSilindi = 0");
								$submissionSorgu->bindParam(':submissionId', $sId, PDO::PARAM_STR);
								$submissionSorgu->execute();
								if ($submissionSorgu->rowCount() > 0) {
									while ($rowSubmission = $submissionSorgu->fetch(PDO::FETCH_ASSOC)) {
										if ($rowSubmission['submissionTur'] == "application/pdf")
											$fileTip2 = ".pdf";
										if ($rowSubmission['submissionTur'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
											$fileTip2 = ".docx";
										if ($rowSubmission['submissionTur'] == "application/msword")
											$fileTip2 = ".doc";
										if ($rowSubmission['submissionTur'] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
											$fileTip2 = ".pptx";
										if ($rowSubmission['submissionTur'] == "application/vnd.ms-powerpoint")
											$fileTip2 = ".ppt";
										$fileMd52 = $rowSubmission['submissionMd5'];
									}
								}
								$fileAd2 = $fileMd52;
								$fileAd2 .= $fileTip2;

								$submissionEkle = $baglanti->prepare("UPDATE submissionlar SET submissionAd = ?, submissionTur = ?, submissionBoyut = ?, submissionMd5 = ?, submissionTitle = ?, submissionAbstract = ?, submissionKeyword = ?, submissionTarih = ?, submissionKabul = 0 WHERE submissionId = ? AND submissionKabul != 2");
								$submissionEkle->execute(array($fileAd, $fileTip, $fileBoyut, $fileMd5, $sTitle, $sAbstract, $sKeyword, $sTarih, $sId));
								if ($submissionEkle == TRUE) {
									$submissionG = $baglanti->prepare("UPDATE reviewler SET submissionDegisti = 1 WHERE submissionId = ? AND reviewSilindi = 0");
									$submissionG->execute(array($sId));
									
									if (!file_exists('submission')) {
										mkdir('submission', 0777, true);
										}
										if (!file_exists('submission/silinenler')) {
											mkdir('submission/silinenler', 0777, true);
										}
										if (!file_exists("submission/silinenler/$sId")) {
											mkdir("submission/silinenler/$sId", 0777, true);
										}
										@rename("submission/$fileAd2", "submission/silinenler/$sId/$fileAd2");
										$hataSubmissionYukleMesaj = "Submission güncellendi.";
								}
							} else {
								$hataSubmissionYukleMesaj = "2 MB den büyük dosya yükleyemezsiniz.";
							}
						} else {
							$hataSubmissionYukleMesaj = "Sadece PDF, DOCX, DOC, PPT türünde dosya yükleyebilirsiniz.";
						}
					}
				} else {
					$sTarih = time();
					$sTitle = $_POST['stitle2'];
					$sAbstract = $_POST['sabstract2'];
					$sKeyword = $_POST['skeyword2'];
					$submissionEkle = $baglanti->prepare("UPDATE submissionlar SET submissionTitle = ?, submissionAbstract = ?, submissionKeyword = ?, submissionTarih = ?, submissionKabul = 0 WHERE submissionId = ? AND submissionKabul != 2");
					$submissionEkle->execute(array($sTitle, $sAbstract, $sKeyword, $sTarih, $sId));
					if ($submissionEkle == TRUE) {
						$submissionG = $baglanti->prepare("UPDATE reviewler SET submissionDegisti = 1 WHERE submissionId = ? AND reviewSilindi = 0");
						$submissionG->execute(array($sId));
						$hataSubmissionYukleMesaj = "Submission güncellendi.";
					}
				}
			}
		}
		if ($erisim == 0) {
			$hataSubmissionYukleMesaj = "Erişim engellendi.";
		}
		echo "<script>alert('".$hataSubmissionYukleMesaj."');window.Location = history.go(-2);</script>";
	}
}