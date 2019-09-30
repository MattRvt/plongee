<?php
require_once("Header.php");

include("../model/BDD/Reader/DbAptitudeReader.php");
$Reader = new DbAptitudeReader();
$aptitude = $Reader->getAllAptitude();
echo "<pre>";
//print_r($aptitude);
echo "</pre>";
?>
<select id=\"aptitude\">
                <option value=\"\">--Please choose an option--</option>
    <?php
foreach ($aptitude as $item) {
    $labelle = $item["APT_LIBELLE"];

    $code = $item["APT_CODE"];

    $option = "<option value='$code'>$labelle</option>";
    echo $option;
}
echo "</selcet>";

require_once("Footer.php");
?>