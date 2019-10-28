<div class="genModal modal" id="newPalanqueeModal">
    <div class="modal-content">
        <legend><b id="titreAjoutModifPal"></b></legend>
        <br />

        <div>
            <h6>Profondeur Max : </h6>
            <label>
                <input type="number" id="profMax" name="profMax" min="0" required><br />
            </label>
        </div>

        <div>
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
        <div class="erreur" id="erreurPalPlong"></div>
        <div id="addPlongeurPal" class="right"></div>

        <br />
        <input type="submit" name="EN" value="Envoyer" onclick="traitementAjoutPal()">
        <div class="erreur" id="erreurPal"></div>
    </div>
</div>
