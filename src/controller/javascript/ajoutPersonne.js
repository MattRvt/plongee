var personne = {
    nom: "",
    prenom: "",
    fonction: "",
    aptitude: ""
};

function addPersonne()
{
    personne.nom = document.getElementById('nom').value;
    personne.nom = document.getElementById('prenom').value;
    personne.nom = document.getElementById('fonction').value;
    personne.nom = document.getElementById('aptitude').value;

    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=AddPlongeurInBase', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('pseudo=' + tabConn.pseudo + '&mdp=' + tabConn.mdp);

    //reset des messages
    $("#erreur").html("");
}
