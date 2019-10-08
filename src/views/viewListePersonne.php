<br/>
<input type="button" value="Ajouter Personne" onclick="window.location.href='NewPlongeur'"><br/><br/><br/>

<fieldset>
    <p>Nom  -------------  Prenom  -------------  niveau  -------------  fonction  -------------  aptitude(liste si plongeur)</p>
</fieldset><br/><br/>

<fieldset>
<pre>
    <?php
    $personne = $this->controller->selectAllPersonne();
    ?>
    <table>
    <?php
    for($i=0;$i<sizeof($personne);$i++){
    ?>
        <tr>
            <?php
            for($j=0;$j<5;$j++){
            ?>
                <td>    <?php if ($j < 5)
                                print_r($personne[$i][$j]);
                            else ?>
                            <input type="button" value="Modifier Personne" onclick="window.location.href='ModifierPlongeur'">
                </td>
            <?php
            }
            ?>
        </tr>
    <?php
    }
    ?>
 </pre>
</fieldset><br/><br/><br/>

<input type="button" value="Ajouter Personne" onclick="window.location.href='NewPlongeur'"><br/>