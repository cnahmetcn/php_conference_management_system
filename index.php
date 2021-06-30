<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body{background-image:url("sayfaDuzeni/background.png"); width:80%; margin:0px 10%; min-width:650px; font-family:Candara; font-size:small; overflow-y:scroll}
        .header{position:relative; width:100%; background-color:darkred; height:105px;}
        .altMenu{position:relative; width:100%; background-color:#323232; height:40px; top:-13px; z-index:100;}
        .main{position:relative; width:98%; padding:2% 1% 2% 1%; top:-13px;}
        .orta{min-width:100%; min-height:65%}
        .footer{float:right; min-width:98%; height:15px; padding:5px 1%; background-color:darkred; color:#eee;}

    </style>
    <script src="sayfaDuzeni/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="header">
    <?php
    ob_start();
    include_once ("giris.php");
    ?>
</div>
<div class="altMenu">
    <?php
    include_once ("sayfaDuzeni/menu.php");
    ?>
</div>
<div class="main">
    <div class="orta">
        <?php
        if(@$_REQUEST['sayfa'] == NULL) include ("anasayfa.php");
        if(@$_REQUEST['sayfa'] == "anasayfa") include ("anasayfa.php");
        if(@$_REQUEST['sayfa'] == "kayitOl") include ("kayitOl.php");
        if(@$_REQUEST['sayfa'] == "konferansGoruntule") include ("konferansGoruntule.php");
        if(@$_REQUEST['sayfa'] == "konferansGoruntuleKonum") include ("konferansGoruntuleKonum.php");
        if(@$_REQUEST['sayfa'] == "konferansGoruntuleIletisim") include ("konferansGoruntuleIletisim.php");
        if(@$_REQUEST['sayfa'] == "konferansGoruntuleOnemliTarih") include ("konferansGoruntuleOnemliTarih.php");
        if(@$_REQUEST['sayfa'] == "submissionGoruntule") include ("submissionGoruntule.php");
        if(@$_REQUEST['sayfa'] == "roller") include ("roller.php");
        if(@$_REQUEST['sayfa'] == "kullaniciKullaniciEkle") include ("kullaniciKullaniciEkle.php");
        if(@$_REQUEST['sayfa'] == "kullaniciGuncelle") include ("kullaniciGuncelle.php");
        if(@$_REQUEST['sayfa'] == "konferanslar") include ("konferanslar.php");
        if(@$_REQUEST['sayfa'] == "konferansOlustur") include ("konferansOlustur.php");
        if(@$_REQUEST['sayfa'] == "konferansGuncelle") include ("konferansGuncelle.php");
        if(@$_REQUEST['sayfa'] == "konferansKullaniciGuncelle") include ("konferansKullaniciGuncelle.php");
        if(@$_REQUEST['sayfa'] == "submission") include ("submission.php");
        if(@$_REQUEST['sayfa'] == "submissionSil") include ("submissionSil.php");
        if(@$_REQUEST['sayfa'] == "review") include ("review.php");
        if(@$_REQUEST['sayfa'] == "reviewIncele") include ("reviewIncele.php");
        if(@$_REQUEST['sayfa'] == "reviewSil") include ("reviewSil.php");
        if(@$_REQUEST['sayfa'] == "mail") include ("email.php");

        ?>
    </div>
</div>
<?php
echo "<div class='footer'>" . date("Y", time()) . " &copy;</div>";
?>
</body>
</html>