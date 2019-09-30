<?php require_once("Header.php"); ?>
    <form name="palanquee" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><b>Ajouter un plonjeur</b></legend>
            <br/>
            <label for="nom">Nom: </label><input type="text" name="nom" size="30" maxlength="50"><br/>
            <label for="prenom">Prenom: </label><input type="text" name="Prénom" size="30" maxlength="50"><br/>
            <label for="aptitude">Aptitude: </label>
            <select id="aptitude">
                <option value="">--Please choose an option--</option>
                <?php
                include("../model/BDD/Reader/DbAptitudeReader.php");
                $Reader = new DbAptitudeReader();
                $aptitude = $Reader->getAllAptitude();

                foreach ($aptitude as $item) {
                    $labelle = $item["APT_LIBELLE"];

                    $code = $item["APT_CODE"];

                    $option = "<option value='$code'>$labelle</option>";
                    echo $option;
                }
                echo "</selcet>";
                ?>
            </select>


        </fieldset>
        <br/>
        <input type="submit" name="EN" value="Ajouter" onclick="return testerValid()"> &nbsp;&nbsp;&nbsp;
        <br/>
        <br/>
    </form>


<?php require_once("Footer.php"); ?>