<br/>

<fieldset>
    <p>Date  -------------  Séance  -------------  Num palanquée  -------------  Profondeur max  -------------  Duree max ------------- Heure immersion ------------- Heure sortie de l'eau ------------- Profondeur réelle ------------- Durée du fond</p>
</fieldset><br/><br/>

<a class="waves-effect waves-light btn modal-trigger" href="#newPalanquee">Ajouter Palanquee</a>
<input type="button" value="Ajouter Palanquee" onclick="window.location.href='modal/NewPalanquee'"><br/>

<fieldset>
    <?php
    $palanquee = $this->controller-> getAll();
    ?>
    Palanquée
    <table>
        <?php
        foreach($palanquee as $key=>$content){
        
            echo '<tr>';
                
                
                    foreach($content as $key2=>$content2){
                        echo '<td>';   
                        echo $key2.' => '.$content2;
                        echo '</td>';
                    }
                    //echo '<td><input type="button" value="Modifier Palanquee" onclick="window.location.href=\'ModifierPalanquee&param='.$content["PER_NUM"].'\'"> </td>';
               
            echo '</tr>';
        }
        ?>
    </table><br/><br/>
</fieldset><br/><br/><br/>

<input type="button" value="Ajouter Palanquee" onclick="window.location.href='NewPalanquee'"><br/>


