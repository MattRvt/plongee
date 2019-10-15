var personne = {
    nom: "",
    prenom: "",
    plongeur: "",
    directeur: "",
    secuSurface: "",
    aptitude: ""
};

function addPersonne() {
    personne.nom = document.getElementById('nom').value;
    personne.prenom = document.getElementById('prenom').value;
    personne.plongeur = document.getElementById('Plongeur').checked;
    personne.directeur = document.getElementById('Directeur').checked;
    personne.secuSurface = document.getElementById('SecuriteSurface').checked;

    $("#erreur").html("");

    if (personne.nom == "" || personne.prenom == "") {
        $("#erreur").html("Une personne a obligatoirement un nom et un prenom");
    } else {
        if(personne.plongeur && document.getElementById('aptitude').value == "rien")
        {
            $("#erreur").html("Un plongeur a obligatoirement une aptitude");
        }
        else {
            var xhr = initXHR();
            xhr.open('POST', 'index.php?url=NewPlongeur', false);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var text = "personne=personne&nom=" + personne.nom + "&prenom=" + personne.prenom;
            if (personne.plongeur) {
                personne.aptitude = document.getElementById('aptitude').value;
                text = text + "&plongeur=plongeur&aptitude=" + personne.aptitude;
            }
            if (personne.directeur) {
                text = text + "&directeur=directeur";
            }
            if (personne.secuSurface) {
                text = text + "&securiteSurface=securiteSurface";
            }


            xhr.send(text);
            alert("personne Ajouté");

            document.getElementById('nom').value = "";
            document.getElementById('prenom').value = "";
            document.getElementById('Plongeur').checked = false;
            document.getElementById('Directeur').checked = false;
            document.getElementById('SecuriteSurface').checked = false;
            $("#selectAptitude").html("");
            $("#newPlongeurModal").modal("close");
        }
    }
}

function selectAptitude() {
    personne.plongeur = document.getElementById('Plongeur').checked;

    if (personne.plongeur == false) {
        $("#selectAptitude").html("");
    } else {
        var xhr = initXHR();
        xhr.open('POST', 'index.php?url=SelectAptitude', false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send();

        var text = xhr.responseText;
        $("#selectAptitude").html(text);
    }
}