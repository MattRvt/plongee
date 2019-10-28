<?php $this->_title = "Liste des plongées" ?>
<fieldset>
    <div class="fixed-action-btn">
        <a class="waves-effect waves-light btn-large btn-floating modal-trigger pulse" onclick="window.location.href='Plongee'">
            <i class="large material-icons">add</i>
        </a>
    </div>

    <div class="row">
        <a class="waves-effect waves-light btn-large modal-trigger col s2" onclick="window.location.href='Plongee'">Ajouter Site</a>
        <div class="input-field col s3">
            <i class="material-icons prefix">search</i>
            <input type="text" id="searchPlongee" autocomplete="off">
            <label for="searchPlongee">Rechercher un site</label>
        </div>
    </div>
    <br/>
    <div class="container">
        <table class ="centered" id="tablePlongee" border="1" >
        </table>
    </div>
</fieldset>