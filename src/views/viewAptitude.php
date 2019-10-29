<?php $this->_title = "Aptitude" ?>
    <div class="fixed-action-btn">
        <a class="waves-effect waves-light btn-large btn-floating modal-trigger pulse" onclick="initAjoutAptitude()">
            <i class="large material-icons">add</i>
        </a>
    </div>

    <div class="row">
        <a class="waves-effect waves-light btn-large modal-trigger col s2" onclick="initAjoutAptitude()">Ajouter Aptitude</a>
        <div class="input-field col s3">
            <i class="material-icons prefix">search</i>
            <input type="text" id="searchAptitude" autocomplete="off">
            <label for="searchAptitude">Rechercher une Aptitude</label>
        </div>
    </div>

    <br/>
    <div class="container">
        <table class ="centered" id="tableAptitude" border="1" >
        </table>
    </div>