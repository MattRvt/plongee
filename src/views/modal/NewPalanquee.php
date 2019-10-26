<div class="modal" id="newPalanqueeModal">
    <div class="modal-content">
        <legend><b>Créer une palanquée</b></legend>
        <br />

        <div class="col s6">
            <h6>Profondeur Max : </h6>
            <label>
                <input type="number" id="profMax" name="profMax" min="0" required><br />
            </label>
        </div>

        <div class="col s6">
            <h6>Duree Max : </h6>
            <label>
                <input type="number" id="DurMax" name="DurMax" min="0" required><br />
            </label>
        </div>

        <div id="plongeurPalanquee1"></div>
        <div id="plongeurPalanquee2"></div>
        <div id="plongeurPalanquee3"></div>
        <div id="plongeurPalanquee4"></div>
        <div id="plongeurPalanquee5"></div>
        <div class="row">
            <div id="supprPlongeurPal" class="left col s3"></div>
            <div id="addPlongeurPal" class="right col s2"></div>
        </div>

        <br />
        <input type="submit" name="EN" value="Envoyer">
        <div class="erreur" id="erreurPal"></div>
    </div>
</div>
