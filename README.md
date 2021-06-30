# Konferans Yönetim Sistemi

Php, Html, Sql (2017)

**KONFERANS YÖNETİM SİSTEMİNİN YAPISI**

Konferans yönetim sistemi projesi beş tür kullanıcıdan oluşmaktadır.

**1.1.** Konferans Yönetim Sistemi Kullanıcıları

**Sistem Yöneticisi (Admin):** Sistemin kurulumunu, bakımını sağlar. Kullanıcıların yaşadığı teknik aksaklıkları çözmekle ilgilenir. Konferans oluşturur. Oluşturduğu konferansı yönetecek konferans yöneticisi veya yöneticilerini sisteme kayıtlı kullanıcılardan atar ya da siler. Sistem yöneticisi, tüm kullanıcıların her türlü bilgisine erişebilir. Yetkilerine sahip olabilir. O kullanıcıymış gibi davranabilir. Bunu yapabilmesi için super user yetkisine sahiptir. Tüm kullanıcılara kullanıcıya özel e-mail gönderebilir.

**Konferans Yöneticisi (Chair):** Atandığı konferansın bilgilerini girer. Konferans sayfasını düzenler. Duyurularının yapılmasını sağlar. Konferans ile alakalı bildiri, makale ve sunumları gönderecek yazarları kullanıcılardan atar ya da siler. Yazarların gönderdiği bildiri, makale ve sunumların değerlendirmesi için hakemleri kullanıcılardan atar. Hakemlerin değerlendirmeleri sonucunda yazarların gönderilerini kabul ya da reddeder. Konferansa katılımcı olarak kullanıcılardan atama yapar ya da siler. Tüm kullanıcılara kullanıcıya özel e-mail gönderebilir.

**Yazar (Author):** Konferans yöneticisi tarafından atandığı konferans ile ilgili makale, bildiri ve sunumları ve bunlara ait özetleri sisteme gönderir. Bunlara submission denilmektedir. Sistem yöneticilerine ve konferans yöneticilerine kullanıcıya özel e-mail gönderebilir.

**Hakem (Reviewer):** Konferans yöneticisi tarafından atandığı konferans ile ilgili yazarların gönderdiği makale, bildiri, sunumları ve bunların özetlerini değerlendirerek puanlar. Sistem yöneticilerine ve konferans yöneticilerine kullanıcıya özel e-mail gönderebilir.

**Katılımcı (Reader):** Konferans yöneticisi tarafından atandığı konferansın bilgilerini görüntüler. Atandığı konferansa ait yazarlar tarafından gönderilmiş makale, bildiri ve sunumları konferans yöneticisi kabul etmiş ise görüntüler. Sistem yöneticilerine ve konferans yöneticilerine kullanıcıya özel e-mail gönderebilir.

**1.2.** Sisteme Giriş Yapma ve Üye Olma

Konferans yönetim sistemi projesinde herhangi bir konferansa doğrudan üye olmak gibi bir durum yoktur. Bunun yerine kullanıcı sisteme üye olur ve katılmak istediği konferansa ait konferans yöneticisine e-mail göndererek konferansa katılmak istediğini bildirir. E-mail gönderdiği konferans yöneticisi uygun gördüğü takdirde sisteme kayıt olan kullanıcıyı yazar, hakem ya da katılımcı olarak atayabilir[1].

1. Kullanıcı kullanıcı adını, şifresini ve captcha kontrolünü doğru bir şekilde girerek sisteme giriş yapabilir. Burada erişimi herkese açık konferanslar listelenir.

 ![](https://4.bp.blogspot.com/-TxozHPb9l84/WprLWml3nhI/AAAAAAAAAB4/IvAhYLtYWuAEmqHczkt3enm0QeJMDSXWgCLcBGAs/s1080/1.png)

Şekil 1. _Kullanıcı Girişi (_index.php_)_

1. Kullanıcı, istenen bilgilerin doğru şekilde girmesi ile sisteme kayıt olabilir.

 ![](https://4.bp.blogspot.com/-8_NiPD3s4W0/WprL4VywgWI/AAAAAAAAACA/l46FDvY1GhclNYcNadtwNHkofO668rVCwCLcBGAs/s1080/1.png)

Şekil 2. _Kullanıcı Kaydı (_index.php?sayfa=kayitOl_)_

**1.3.** Ana Sayfa

Kullanıcı giriş yaptıktan sonra yönlendirilen karşılama sayfasıdır. Burada erişimi giriş yapan kullanıcıya açık konferanslar listelenir.

 ![](https://4.bp.blogspot.com/-Aqpuo-lo9Ww/WprMNJtdIDI/AAAAAAAAACE/HqZX-fg7-aobVlukJSa_ocqdDCbBWT0WACLcBGAs/s1080/1.png)

Şekil 3. _Kullanıcı Karşılama Sayfası (_index.php_)_

**1.4.** Kullanıcı E-Mail Sistemi

Sisteme kayıt olan her kullanıcının e-mail gönderebilme özelliği vardır. Sistem yöneticisi ve konferans yöneticisi her kullanıcıya e-mail gönderebilir ve yanıtlayabilirken, yazar, hakem ve katılımcı sadece sistem yöneticisi ve konferans yöneticisine e-mail gönderebilir ve yanıtlayabilir. Kullanıcının henüz okumadığı e-mailleri ve bunların kaç tane olduğu görsel olarak belirtilir.

 ![](https://1.bp.blogspot.com/-Xt4nnLnexxo/WprMh7OdNUI/AAAAAAAAACI/FMI42S15RQkuYQ7tcVHcil60Gz6DpoLRACLcBGAs/s1080/1.png)

Şekil 4. _E-Mail Sistemi (index.php?sayfa=mail)_

Kullanıcı yeni e-mail göndermek için Yeni Mesaj butonuna tıklayarak ilgili alan görüntülenir.

 ![](https://1.bp.blogspot.com/-QTUZ9IJ1sis/WprNBMjhyuI/AAAAAAAAACU/gfnnfXqX-kUvMQM4BRTdFvWtdAh1XlUIQCLcBGAs/s1080/1.png)

Şekil 5. _Yeni E-Mail Gönderme (index.php?sayfa=mail&amp;s=13)_

Kullanıcı gelen e-mailleri okumak için Gelen Mesajlar altındaki tabloda, her bir e-mailin yanındaki Oku bağlantısından okuyabilir.

 ![](https://3.bp.blogspot.com/-hsoR-yiu6Q8/WprNOnznw4I/AAAAAAAAACY/qLbziYKTXQU2tqo9wlW7I3Wjp0Hhc0lcgCLcBGAs/s1080/1.png)

Şekil 6. _Gelen E-Maili Okuma (index.php?sayfa=mail&amp;email=_[emailId]_)_

Gelen ya da gönderilmiş e-mailleri tekrardan ekleme yaparak yanıtlamak için her bir e-mailin yanındaki Yanıtla bağlantısından gerçekleştirebilir. Gelen ya da gönderilmiş e-maili silmek için ise Sil bağlantısından gerçekleştirebilir.

 ![](https://1.bp.blogspot.com/-v-1d0C5QTG4/WprNfXtyx6I/AAAAAAAAACc/YPeic839DO8j-2we9UXwHCQHzwTStKhMgCLcBGAs/s1080/1.png)

Şekil 7. _Gelen ya da Gönderilmiş E-Mail Yanıtlamak (index.php?sayfa=mail&amp;email2=_[emailId]_)_

**1.5.** Kullanıcı Profilinin Düzenlenmesi

Kullanıcılar sisteme kayıt olduktan sonra sağ üstte Ayarlar butonuna tıklayarak profillerini düzenleyebilecekleri sayfaya yönlendirilirler.

 ![](https://1.bp.blogspot.com/-IsJ_93IshBk/WprN2AhJCLI/AAAAAAAAACo/ToB7GUupkskxI2j6vTh78cL-ERIVqCHnACLcBGAs/s1080/1.png)

Şekil 8. _Kullanıcı Profil Düzenleme (index.php?sayfa=kullaniciGuncelle&amp;kGuncelle=_[kullaniciId]_)_

**1.6.** Sistem Yöneticisinin Sistemdeki Görevleri

Konferans yönetim sistemi projesinde sistem yöneticisine aşağıdaki görevler verildi:

**1.6.1.** _Rolleri Ataması, Kullanıcı Oluşturması ve Silmesi_

Sistem yöneticisi kullanıcı girişini yaptıktan sonra sisteme kayıtlı kullanıcıları sistem yöneticisi, konferans yöneticisi, yazar, hakem ve katılımcı olarak combobox aracılığıyla atayabilir ya da görevlerini iptal edebilir. Kullanıcıları silebilir. Kullanıcıların sisteme kayıtlı bilgilerini değiştirebilir. Kullanıcı Ekle butonuna tıklayarak kullanıcı yaratabilir. Aynı zamanda bu sayfada super user özelliğini her kullanıcının sağında bulunan giriş yap bağlantısına tıklayarak aktif edebilir.

 ![](https://4.bp.blogspot.com/-WcyspUnw1IY/WprOOCkiLwI/AAAAAAAAACw/7Rd9Bp88WnUkiHTxohCQn_cmVb47qO2MACLcBGAs/s1080/1.png)

Şekil 9. _Sistem Yöneticisinin Rol Ataması (_index.php?sayfa=roller_)_

Sistem kullanıcısı super user özelliğinden çıkmak için sağ üstte bulunan Diğer Kullanıcı Çıkışı Yap butonuna tıklayabilir. Aşağıda sistem yöneticisinin Author9 isimli kullanıcısının yetkilerine erişmesi gösterilmiştir.

 ![](https://4.bp.blogspot.com/-EE7mQtHNYao/WprOcIyISiI/AAAAAAAAAC4/f5Si3Fg3ASAFWDc5_kBbloFpAvjKfl2pACLcBGAs/s1080/1.png)

Şekil 10. _Sistem Yöneticisinin Diğer Kullanıcı Yetkisine Erişmesi (kGiris=[kullaniciRol]&amp;kGiris2=[kullaniciId]&amp;kGiris3=_[kullaniciIsim1]_)_

**1.6.2.** _Oluşturulan Konferansları Listelemesi veya Silmesi_

Sistem yöneticisi oluşturulan tüm konferansları listeleyebilir ve bu konferanslara konferans yöneticisi rolüne sahip kullanıcılardan konferans yöneticisi atayabilir. Her oluşturulmuş konferansın sağında bulunan Sil bağlantısıyla oluşturulan konferanslar silinebilir.

 ![](https://1.bp.blogspot.com/-vE8fFq-PA4U/WprOtnEn_BI/AAAAAAAAADA/_a7oPoJxA94v19GD5PJyJv0KlBx-MirAwCLcBGAs/s1080/1.png)

Şekil 11. _Oluşturulan Konferansların Listelenmesi (index.php?sayfa=konferanslar)_

**1.6.3.** _Konferans Oluşturma_

Oluşturulan tüm konferansların listelendiği sayfada tablonun üstündeki Konferans Oluştur butonuna tıklayarak konferans oluşturma sayfasına yönlendirilir. Burada sistem yöneticisi konferans adını girerek konferans oluşturulmuş olur. Daha sonra bilgilerinin girilmesini oluşturulan konferansa atanacak konferans yöneticileri tarafından gerçekleştirilecektir.

 ![](https://3.bp.blogspot.com/-AJNGN25VHw4/WprO8IzFJqI/AAAAAAAAADI/1kX0CwWoUiYBzHyHxHD3lNwy21pXTPRjQCLcBGAs/s1080/1.png)

Şekil 12. _Konferans Oluşturma (index.php?sayfa=konferansOlustur)_

**1.6.4.** _Oluşturulan Konferansa Konferans Yöneticisinin Atanması veya Silinmesi_

Oluşturulan tüm konferansların listelendiği sayfada her konferansın sağındaki düzenle bağlantısına tıklayarak konferans yöneticisi atama sayfasına yönlendirilir. Burada iki tablo listelenir. Sol tabloda konferansa hali hazırda konferans yöneticisi görevi verilmiş kullanıcılar, sağ tabloda konferans yöneticisi verilebilecek kullanıcılar vardır. Her kullanıcının sağında bulunan sil ya da ekle bağlantılarına tıklayarak konferans yöneticiliğine atama görevi ya da bu görevinden alma işlemleri gerçekleştirilir.

 ![](https://4.bp.blogspot.com/-jP5ISAtXg5c/WprPIt4SyDI/AAAAAAAAADM/vP0-9Fpcrlg681tbSGy9QO9KR0Q_7zi_QCLcBGAs/s1080/1.png)

Şekil 13. _Konferansa Yönetici Atama veya Silme (index.php?sayfa=konferansKullaniciGuncelle__&amp;koGuncelle=_[konferansId]_)_

**1.7.** Konferans Yöneticisinin Sistemdeki Görevleri

Konferans yönetim sistemi projesinde sistem yöneticisi tarafından atanan konferans yöneticisine aşağıdaki görevler verildi:

 **1.7.1.** _Konferansları Listeleme ve Bilgilerini Düzenleme_

Konferans yöneticisi atandığı konferansları listeleyebilir.

 ![](https://4.bp.blogspot.com/-RKS13MqielM/WprPY9whn1I/AAAAAAAAADU/ZTSRapS9mQ85__wnTS3De1blX5EyxPNVACLcBGAs/s1080/1.png)

Şekil 14. _Konferans Yöneticisinin Atandığı Konferansları Listelemesi (index.php?sayfa=konferanslar)_

Bu konferansları her bir konferansın sağında bulunan Düzenle bağlantısıyla konferans bilgilerini düzenleyebileceği sayfaya yönlendirilir. Bu sayfada konferansın başlığı, tanımı, önemli tarihleri, konumu, iletişim bilgileri, konferans açılış ve kapanış tarihlerini, submission açılış ve kapanış tarihlerini ve bu bilgilerin herkes tarafından erişilip erişilmeyeceğini belirler. Konferans bilgilerini girerken HTML programlama dili ve CSS stil şablonu kodlarından yararlanarak esnek tasarımlı bir konferans sayfası oluşturabilir.

 ![](https://3.bp.blogspot.com/-NI1_mhQrFMw/WprPlsNwcII/AAAAAAAAADY/2mphP_2O4aQtSw3esggguuTi1V0wsV0gACLcBGAs/s1080/1.png)

Şekil 15. _Konferans Bilgilerinin Girilmesi veya Güncellenmesi (index.php?sayfa=konferansGuncelle&amp;koGuncelle=_[konferansId]_)_

 **1.7.2.** _Konferans Rollerini Belirleme_

Konferans yöneticisi, konferansların listelendiği sayfadaki tabloda her bir konferansın sağında bulunan Roller bağlantısından rolleri belirleyebileceği sayfaya ulaşabilir. Bu sayfada sistem yöneticisi tarafından rolü belirlenmiş konferans yöneticisi, yazar, hakem ve katılımcıların listesi sıralanır. Sol tabloda hali hazırda konferans da görev almış kullanıcıların listesi bulunurken, sağ tabloda henüz görev almamış kullanıcılar listelenir. Konferans yöneticisi her bir kullanıcının sağında bulunan bağlantılardan görevlere atama yapabilir veya görevden alabilir.

 ![](https://1.bp.blogspot.com/-XP71uhKHnso/WprP73hrGMI/AAAAAAAAADg/0G4LAUQGJvQ-AR-rRcAMCpXPk4ea7IgzACLcBGAs/s1080/1.png)

Şekil 16. _Konferans Rollerinin Belirlenmesi (index.php?sayfa=konferansKullaniciGuncelle&amp;koGuncelle=_[konferansId]_)_

 **1.7.3.** _Submission Kabul, Revize veya Reddetme_

Konferans yöneticisi yazarların gönderdiği konferans ile ilgili makale, bildiri, sunum ve bunlara ait özetleri ya kabul eder, ya reddeder ya da yazardan revize etmesini ister. Submission ile ilgili hakemlerin yaptığı değerlendirme ve puanları görür.

 ![](https://4.bp.blogspot.com/-FnPiwIXRIqc/WprQKPzEVQI/AAAAAAAAADo/nVsKOFuDNFwbJDGAFvr9q601W8FOFnVRACLcBGAs/s1080/1.png)

Şekil 17. _Konferansa Gönderilen Submissionların Listelenmesi (index.php?sayfa=review&amp;koSubmission=_[konferansId]_)_

Konferans yöneticisinin kabul ettiği submissionlar yeşil, reddettikleri kırmızı, revize istediği halde yazar tarafından güncellenmeyenler turuncu, yazar tarafından güncellenenler renksiz zeminde listelenir. Listelenen submissionlardan incelemek istediğinin sağında bulunan İncele bağlantısından submission inceleme sayfasına yönlendirilir. Bu sayfada hakemlerin submission için verdiği puanları görebilir, her bir hakem değerlendirmesinin sağında bulunan İncele bağlantısından hakemlerin submission ile ilgili değerlendirmelerini okuyabilir, submissionu kabul edebilir, reddedebilir ya da yazardan revize etmesini isteyebilir. Yazara submission hakkında mesaj notu bırakabilir. Değerlendirmede bulunan hakemin kimliğinin gizlenmesi de tarafsızlık açısından gereklidir.

 ![](https://2.bp.blogspot.com/-p-Zs72tJzMQ/WprQpOBouOI/AAAAAAAAAD4/C1lVM5vpAzw8ikpnP5ittzOqupY36sZ3gCLcBGAs/s1080/1.png)

Şekil 18. _Submission İncelemesi (index.php?sayfa=reviewIncele&amp;koSubmission=_[konferansId]_&amp;sIncele=_[submissionId]_)_

**1.8.** Yazarın Sistemdeki Görevleri

Konferans yönetim sistemi projesinde konferans yöneticisi tarafından atanan yazara aşağıdaki görevler verildi:

 **1.8.1.** _Konferansların ve Submissionların Listelenmesi_

Konferans yöneticisi tarafından yazar olarak atandığı konferansların listesi:

 ![](https://4.bp.blogspot.com/-CxY0kYwSKMI/WprQ1YvUwOI/AAAAAAAAAD8/WxMFL9mauzAPiShd681X_yp7g--7bEJPACLcBGAs/s1080/1.png)

Şekil 19. _Konferansların Listelenmesi (index.php?sayfa=konferanslar)_

Yazar, listelenen her bir konferansın sağında bulunan Submission bağlantısından konferans için submissionları yükleyebileceği, yüklediği submissionları görüntüleyebileceği ve güncelleyebileceği sayfaya yönlendirilir.

 ![](https://4.bp.blogspot.com/-ChnNUrAb_Ig/WprRCtatVqI/AAAAAAAAAEA/JDSXOOP3W_ocqPz2HBz2rjofuxryAWNJwCLcBGAs/s1080/1.png)

Şekil 20. _Submissionların Listelenmesi (index.php?sayfa=submission&amp;koSubmission=_[konferansId]_)_

Yazarın konferansa ait yüklemiş olduğu submissionların listelendiği sayfada her bir submissionun yanında bulunan bağlantılardan Sil bağlantısı submissionun silinmesini, Düzenle bağlantısı düzenlemek için sayfaya yönlendirilmesini, Kontrol Et bağlantısı konferans yöneticisinin submission ile ilgili düzeltme istediği notu gösterme işlemleri yapılır. Yazar yeni submission oluşturmak istediğinde Yeni Submission butonunu kullanır. Kabul edilen submissionlar yeşil, reddedilenler kırmızı, düzeltme istenenler turuncu ve konferans yöneticisinin henüz karar vermediği submissionlar renksiz zeminde gösterilir.

**1.8.2.** _Yeni Submission Oluşturulması_

Yazarın yükleyeceği dosyalar pdf, doc, docx, ppt, pptx olarak belirlenmiştir. Yazar submission dosyasını, başlığını, özetini ve keywordlerini doğru bir şekilde göndererek submissionu sisteme kaydedilir.

 ![](https://1.bp.blogspot.com/-BLapsPby9xU/WprVndEl_UI/AAAAAAAAAFk/13YcfcpQ1ZoN1rKZ_ar_z5qq_32ect_pQCLcBGAs/s1080/1.png)

Şekil 21. _Yeni Submission Oluşturma (index.php?sayfa=submission&amp;s=13&amp;koSubmission=_[konferansId]_)_

**1.8.3.** _Submissionun Güncellenmesi_

Yazar güncellemek istediği submissionun submissionlar listesinin her bir submissionun sağında bulunan Düzenle bağlantısından submission düzenleme sayfasına yönlendirilir. Yazar, gerekli düzenlemeleri doğru bir şekilde yaptığında submissionunu başarılı bir şekilde güncellenir.

 ![](https://2.bp.blogspot.com/-6iq9QH0yQlo/WprRilmkyFI/AAAAAAAAAEQ/x3OLWwrdGNkGg6xH6Ue5wBxvz3MJIRtYwCLcBGAs/s1080/1.png)

Şekil 22. _Submission Güncelleme (index.php?sayfa=submission&amp;koSubmission=[konferansId]&amp;sDuzenle=_[submissionId]_)_

**1.9.** Hakemin Sistemdeki Görevleri

Konferans yönetim sistemi projesinde konferans yöneticisi tarafından atanan hakeme aşağıdaki görevler verildi:

**1.9.1.** _Konferansların ve Submissionların Listelenmesi_

Konferans yöneticisi tarafından hakem olarak atandığı konferansların listesi:

 ![](https://4.bp.blogspot.com/-oLULqMFS3Q0/WprR2w7dDtI/AAAAAAAAAEY/R6UtwpYlfbAbTiwLQhLNKS-Cz7ruHMMQgCLcBGAs/s1080/1.png)

Şekil 23. _Konferansların Listelenmesi (index.php?sayfa=konferanslar)_

Hakem, listelenen her bir konferansın sağında bulunan Submission İncele bağlantısından konferans için submissionları görüntüleyebileceği, inceleyebileceği sayfaya yönlendirilir.

 ![](https://4.bp.blogspot.com/-GPhXddorH68/WprSJshN15I/AAAAAAAAAEg/LSCaGZfRRe0_cOpRZ-F6gaMGheWsb4WxgCLcBGAs/s1080/1.png)

Şekil 24. _Submissionların Listelenmesi (index.php?sayfa=review&amp;koSubmission=_[submissionId]_)_

Submissionların listelendiği sayfada hakemin inceleyip puanladığı submissionlar yeşil, henüz puanlamadıkları renksiz zeminde görüntülenir. Konferans yöneticisi tarafından kabul edilen ya da reddedilen submissionlar burada listelenmez. Submissionu incelemek için her bir submissionun sağında bulunan İncele bağlantısından inceleme sayfasına yönlendirilir.

**1.9.2.** _Submissionları Puanlama_

Hakem, submissionun dosyasını, başlığını, özetini ve keywordunu inceledikten sonra hakemden birden beşe kadar submissionu puanlaması beklenir. Submssionu puanladığı kriterler: context kalitesi, teknik kalitesi, dilbilgisi kalitesi, özet doğruluğu, konu bütünlüğü, referansların güvenilirliği, özgünlük, deneysel sonuç kalitesi, atıflar, organizasyon ve netlik, alanın önemi. Aynı zamanda submission hakkında yazabileceği değerlendirme konferans yöneticisine submissionu kabul etme ya da etmeme konusunda yardımcı olacaktır.

 ![](https://2.bp.blogspot.com/-mKLlw_4sPKA/WprSb8g11PI/AAAAAAAAAEo/GuyfuGb0eK8ZmdTa_2pRYlTkLry1PBU_wCLcBGAs/s1080/1.png)

Şekil 25. _Submissionları Puanlamak (index.php?sayfa=reviewIncele&amp;koSubmission=_[konferansId]_&amp;sIncele=_[submissionId]_)_

**1.10.** Katılımcının Sistemdeki Görevleri

Katılımcının konferans yönetim sistemi projesinde herhangi bir görevi yoktur. Konferans yöneticisi tarafından herhangi bir konferansa atandığı zaman o konferans için konferans yöneticisinin kabul ettiği submissionları görüntüleme hakkına sahip olur. Eğer atandığı konferans bilgileri herkese açık değilse bilgileri de görüntüleyebilir.

 ![](https://3.bp.blogspot.com/-VQyQBbAlM0U/WprSocViZNI/AAAAAAAAAEs/vfY8-Q-lOhoh08se-Vke9LxHov6oMgKagCLcBGAs/s1080/1.png)

Şekil 26. _Submissionların Listelenmesi (index?sayfa=submissionGoruntule&amp;kGiris=_[konferansId]_)_

Her bir submissionun sağındaki Görüntüle bağlantısından görüntülemek istediği submissionun bilgilerine erişebilir ve dosyayı indirebilir.

 ![](https://3.bp.blogspot.com/-eYc9jA_gQA4/WprS8KnGOPI/AAAAAAAAAE0/BMUsUgdxgmcMSHBQCrQg-B2xtlkYHaAWQCLcBGAs/s1080/1.png)

Şekil 27. _Submission Bilgilerinin Görüntülenmesi (index?sayfa=submissionGoruntule&amp;kGiris=_[konferansId]_&amp;sGiris=_[submissionId]_)_

Katılımcı tablonun sağ üstündeki Geri butonu ile konferans ana sayfasına dönebilir, Önemli Tarihler butonu ile konferansın önemli tarihlerini, Konum butonu ile konferansın nerede gerçekleştirildiğini, İletişim butonu ile konferans yöneticisi ve diğer iletişim bilgilerini görebilir.

 ![](https://2.bp.blogspot.com/-h06FluDvz6Y/WprTVGV68NI/AAAAAAAAAFA/kiulD6kLGzEqWqo8fP_SAOtm4lJegatOQCLcBGAs/s1080/1.png)

Şekil 28. _Konferans Bilgileri_

**1.11.** Konferans Yönetim Sistemi Projesinin Genel Şeması

 ![](https://1.bp.blogspot.com/-RTBiphwRNgc/WprTf7lNlhI/AAAAAAAAAFI/5EAEJMjR7Qk7x-GTv-5o1RDlvB7RGlVwQCLcBGAs/s1080/1.png)

Şekil 29. _Projenin Genel Şeması [3]_

**1.12.** Veri Tabanı Yapısı_

Konferans yönetim sistemi projesinin veri tabanı yedi tablodan oluşmaktadır. Bu tablolar; sisteme kayıt olan kullanıcıların kayıt olurken girdiği bilgilerin saklandığı kullanicilar tablosu, kullanıcıların giriş yaptığı zaman kötü niyetli kişilerce oturum çalma işlemini engellemek amaçlı session bilgilerinin saklandığı sessions tablosu, kullanıcıların birbiriyle haberleştiği e-maillerin saklandığı emailler tablosu, sistem yöneticisinin konferans oluşturduğu ve kimlerin konferansa erişim sağlayabildiği bilgilerinin saklandığı konferanslar tablosu, konferans bilgilerinin saklandığı konferanslarbilgi tablosu, yazarların göndermiş olduğu submissionların saklandığı submissionlar tablosu, hakemlerin submissionlara verdiği puanların ve değerlendirmelerin saklandığı reviewler tablosu.

 ![](https://4.bp.blogspot.com/-xK6GyejoD1M/WprTxEDxvpI/AAAAAAAAAFM/XmglCg3lYzk1roOZQcORYOKGEZGW3RynACLcBGAs/s1080/1.png)

Şekil 30. _Veri Tabanı Yapısı_

 ![](https://4.bp.blogspot.com/-cPZH4D89hi8/WprT_9XXf8I/AAAAAAAAAFU/tBii58EHP_weOiA_qxiJfi9CshM8YqU2gCLcBGAs/s1600/1.png)

Şekil 31. _Veri Tabanı ER Diyagramı_
