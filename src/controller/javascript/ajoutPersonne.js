var personne = {
    nom: "",
    prenom: "",
    plongeur: "",
    directeur: "",
    secuSurface: "",
    aptitude: ""
};

function addPersonne()
{
    personne.nom = document.getElementById('nom').value;
    personne.prenom = document.getElementById('prenom').value;
    personne.fonction1 = document.getElementById('fonction1').value;
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

function selectAptitude()
{
    personne.plongeur = document.getElementById('Plongeur').checked;

    if(personne.plongeur == false)
    {
        $("#selectAptitude").html("");
    }
    else
    {
        var xhr = initXHR();
        xhr.open('POST', 'index.php?url=SelectAptitude', false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send();

        var text = xhr.responseText;
        $("#selectAptitude").html(text);
    }
}