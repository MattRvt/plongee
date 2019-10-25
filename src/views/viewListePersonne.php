<br/>


<a class="waves-effect waves-light btn modal-trigger" onclick="initModalAjoutPers(-1)">Ajouter Personne</a>

<fieldset>
    Plongeur<br>
    <div class="row">
        <div class="input-field col s3">
            <i class="material-icons prefix">search</i>
            <input type="text" id="search" autocomplete="off">
            <label for="search">Rechercher un plongeur</label>
        </div>
    </div>
    <div class="container">
        <table id="userTable" border="1" >
            <thead>
            <tr>
                <th width="10%">Rôle</th>
                <th width="5%">S.no</th>
                <th width="20%">Nom</th>
                <th width="20%">Prenom</th>
                <th width="5%">Actif</th>
                <th width="20%">Certif</th>
                <th width="20%">Apt-code</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <br/><br/>
    Non plongeur
    <div id="listNonPlongeur"></div>
    <br/><br/>
</fieldset><br/><br/><br/>
<a class="waves-effect waves-light btn modal-trigger" onclick="initModalAjoutPers(-1)">Ajouter Personne</a><br/>
<script type='text/javascript'>initListPers();</script>


