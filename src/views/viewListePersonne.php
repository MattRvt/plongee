<?php $this->_title = "Liste des persones" ?>
    <div class="fixed-action-btn">
        <a class="waves-effect waves-light btn-large btn-floating pulse" onclick="initModalAjoutPers(-1)">
            <i class="large material-icons">add</i>
        </a>
    </div>

    <div class="row">
        <a class="waves-effect waves-light btn-large col s2" onclick="initModalAjoutPers(-1)">Ajouter Personne</a>
        <div class="input-field col s3">
            <i class="material-icons prefix">search</i>
            <input type="text" id="search" autocomplete="off">
            <label for="search">Rechercher une personne</label>
        </div>
    </div>
    <div class="row">
        <h3 class="col s2">Plongeur</h3>
        <h3 class="col s5">
            <label>
                <input type="checkbox" id="checkactif" class="filled-in" checked="checked" />
                <span>Afficher les personnes inactives</span>
            </label>
        </h3>
    </div>
    <div class="container">
        <table class ="centered" id="tablePlongeur" border="1" >
        </table>
    </div>

    <br/><br/>
    <hr/>
    <div class="row">
        <h3 class="col s2">Non plongeur</h3>
    </div>
    <div class="container">
        <table class ="centered" id="tableNonPlongeur" border="1" >
        </table>
    </div>
    <br/><br/>



