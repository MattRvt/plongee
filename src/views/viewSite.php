<?php $this->_title = "Site" ?>

    <div class="fixed-action-btn">
        <a class="waves-effect waves-light btn-large btn-floating pulse" onclick="initAjoutSite()">
            <i class="large material-icons">add</i>
        </a>
    </div>

    <div class="row">
        <a class="waves-effect waves-light btn-large col s2" onclick="initAjoutSite()">Ajouter Site</a>
        <div class="input-field col s3">
            <i class="material-icons prefix">search</i>
            <input type="text" id="searchSite" autocomplete="off">
            <label for="searchSite">Rechercher un site</label>
        </div>
    </div>
<br/>
    <div class="container">
        <table class ="centered" id="tableSite" border="1" >
        </table>
    </div>
