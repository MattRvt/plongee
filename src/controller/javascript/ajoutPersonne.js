var personne = {
    nom: "",
    prenom: "",
    fonction: "",
    aptitude: ""
};

function addPersonne()
{
    personne.nom = document.getElementById('nom').value;
    personne.prenom = document.getElementById('prenom').value;
    personne.fonction = document.getElementById('fonction').value;
    personne.aptitude = document.getElementById('aptitude').value;

    $("#erreur").html("");

    var xhr = initXHR();

    if(personne.fonction != "" && personne.aptitude == "")
    {
        $("#erreur").html("Veuillez selectionner une aptitude");
    }
    else if(personne.fonction == "" && personne.aptitude != "")
    {
        $("#erreur").html("Veuillez selectionner une fonction");
    }
    else if(personne.fonction == "" && personne.aptitude == "")
    {
        xhr.open('POST', 'index.php?url=AddPersonneInBase', false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send('');
    }
    else
    {
        xhr.open('POST', 'index.php?url=AddPlongeurInBase', false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send('');
    }
}
