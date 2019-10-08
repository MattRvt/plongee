<br/>
<input type="button" value="Ajouter Personne" onclick="window.location.href='NewPlongeur'"><br/><br/><br/>

<fieldset>
    <p>Nom  -------------  Prenom  -------------  niveau  -------------  fonction  -------------  aptitude(liste si plongeur)</p>
</fieldset><br/><br/>

<fieldset>
    <?php
    $plongeur = $this->controller->selectAllPlongeur();
    $nonPlongeur = $this->controller->selectAllNonPlongeur();
    print_r($plongeur);
    ?>
    Plongeur
    <table>
        <?php
        foreach($plongeur as $key=>$content){
        
            echo '<tr>';
                
                
                    foreach($content as $key2=>$content2){
                        echo '<td>';   
                        echo $key2.' => '.$content2;
                        echo '</td>';
                    }
                    echo '<td> <input type="button" value="Modifier Plongeur" onclick="window.location.href=\'ModifierPlongeur\'"> </td>';
               
            echo '</tr>';
        }
        ?>
    </table><br/><br/>
    Non plongeur
    <table>
        <?php
        foreach($nonPlongeur as $key=>$content){
        
            echo '<tr>';
                
                
                    foreach($content as $key2=>$content2){
                        echo '<td>';   
                        echo $key2.' => '.$content2;
                        echo '</td>';
                    }
                    echo '<td> <input type="button" value="Modifier non Plongeur" onclick="window.location.href=\'ModifierPlongeur\'"> </td>';
               
            echo '</tr>';
        }
        ?>
    </table><br/><br/>
</fieldset><br/><br/><br/>

<input type="button" value="Ajouter Personne" onclick="window.location.href='NewPlongeur'"><br/>


