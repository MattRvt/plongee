<br/>

<fieldset>
    <p>Date  ----- Matin/Aprés-Midi ----- Site ----- Embarcation  ----- Directeur ----- Securité De Surface</p>
</fieldset><br/><br/>

<input type="button" value="Nouvelle plongée" onclick="window.location.href='Plongee'">

<fieldset>
    <table>
        <?php $this->controller->listePlongee() ?>
    </table><br/><br/>
</fieldset><br/><br/><br/>

