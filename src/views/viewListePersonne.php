<br/>
<input type="button" value="Ajouter Personne" onclick="window.location.href='NewPlongeur'"><br/><br/><br/>

<fieldset>
    <p>Nom  -------------  Prenom  -------------  niveau  -------------  fonction  -------------  aptitude(liste si plongeur)</p>
</fieldset><br/><br/>

<fieldset>
    <?php

    $personne = $this->controller->selectAllNonPlongeur();
    print_r($personne);
    $personne = $this->controller->selectAllPlongeur();
    print_r($personne);

    ?>
</fieldset><br/><br/><br/>

<input type="button" value="Ajouter Personne" onclick="window.location.href='NewPlongeur'"><br/>