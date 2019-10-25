<?php
require_once("controller/controllerNewPalanquee.php");
$controller = new controllerNewPalanquee();
?>
<div class="modal" id="newPalanqueeModal">
    <div class="modal-content">
        <form>
            <legend><b>Créer une palanquée</b></legend>
		    <br />

            <div class="col s6">
                <h6>Profondeur Max : </h6>
                <label>
                    </label><input type="number" id="profMax" name="profMax" min="0" required><br />
                </label>
            </div>

            <div class="col s6">
                <h6>Duree Max : </h6>
                <label>
                     <input type="number" name="DurMax" name="DurMax" min="0" required><br />
                </label>
            </div>

            <div id="plongeurPalanquee"></div>

            <br />
		    <input type="submit" name="EN" value="Envoyer" onclick="return testerValid()"> 		&nbsp;&nbsp;&nbsp;
        </form>
        <div id="erreur"></div>
    </div>
</div>
