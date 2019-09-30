<?php
require_once ("Header.php");

include("../model/BDD/Reader/DbAptitudeReader.php");

$Reader = new DbAptitudeReader();
$suc = $Reader->getAllAptitude();
echo "<pre>";
print_r($suc);
echo "</pre>";
require_once ("Footer.php");
?>