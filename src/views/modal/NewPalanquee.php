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
        <div class="erreur" id="erreurPlongeur1"></div>
        <div id="plongeurPalanquee2"></div>
        <div class="erreur" id="erreurPlongeur2"></div>
        <div id="plongeurPalanquee3"></div>
        <div class="erreur" id="erreurPlongeur3"></div>
        <div id="plongeurPalanquee4"></div>
        <div class="erreur" id="erreurPlongeur4"></div>
        <div id="plongeurPalanquee5"></div>
        <div class="erreur" id="erreurPlongeur5"></div>

        <div class="erreur" id="erreurPalPlong"></div>
        <div id="addPlongeurPal" class="right"></div>

        <br />
        <button class="green waves-effect waves-light btn" type="submit" name="EN" onclick="traitementAjoutPal()"><i class="material-icons right">send</i>Valider</button>
        <div class="erreur" id="erreurPal"></div>
    </div>
</div>
