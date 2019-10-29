<?php $this->_title = "Embarcation" ?>

    <div class="fixed-action-btn">
        <a class="waves-effect waves-light btn-large btn-floating pulse" onclick="initAjoutEmbarcation()">
            <i class="large material-icons">add</i>
        </a>
    </div>

    <div class="row">
        <a class="waves-effect waves-light btn-large col s2" onclick="initAjoutEmbarcation()">Ajouter une embarcation</a>
        <div class="input-field col s3">
            <i class="material-icons prefix">search</i>
            <input type="text" id="searchEmbarcation" autocomplete="off">
            <label for="searchEmbarcation">Rechercher une embarcation</label>
        </div>
    </div>
    <br/>
    <div class="container">
        <table class ="centered" id="tableEmbarcation" border="1" >

        </table>
    </div>
