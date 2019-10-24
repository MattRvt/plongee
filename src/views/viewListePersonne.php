<br/>

<fieldset>
    <p>Nom  -------------  Prenom  -------------  niveau  -------------  fonction  -------------  aptitude(liste si plongeur)</p>
</fieldset><br/><br/>

<a class="waves-effect waves-light btn modal-trigger" href="#newPlongeurModal" onclick="initModalAjoutPers()">Ajouter Personne</a>

<fieldset>
    Plongeur<br>
    <div class="row">
        <div class="col s3">Rechercher un plongeur : <input type="text" id="search" placeholder="Nom ou prénom du plongeur..."></div>
    </div>
    <div class="container">
        <table id="userTable" border="1" >
            <thead>
            <tr>
                <th width="5%">S.no</th>
                <th width="20%">Nom</th>
                <th width="20%">Prenom</th>
                <th width="5%">Actif</th>
                <th width="30%">Certif</th>
                <th width="30%">Apt-code</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div id="listPlongeur"></div>
    <br/><br/>
    Non plongeur
    <div id="listNonPlongeur"></div>
    <br/><br/>
</fieldset><br/><br/><br/>
<a class="waves-effect waves-light btn modal-trigger" href="#newPlongeurModal" onclick="initModalAjoutPers()">Ajouter Personne</a><br/>
<script type='text/javascript'>initListPers();</script>


