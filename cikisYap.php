<?php
include_once ("Session.php");
$session->_destroy($_SESSION["girisKullaniciId"]);

unset($_SESSION["girisKullaniciId"]);
unset($_SESSION["girisKullaniciRol"]);
unset($_SESSION["girisKullaniciIsim1"]);
unset($_SESSION['kullaniciTabloSirala']);
session_destroy();

$baglanti = NULL;
header("Location: index.php");

?>