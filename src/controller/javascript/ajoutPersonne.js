var personne = {
    nom: "",
    prenom: "",
    plongeur: "",
    directeur: "",
    secuSurface: "",
    aptitude: "",
    dateCertif: "",
    active: "",
};


function addPersonne() {
    personne.nom = document.getElementById('nomPlongeur').value;
    personne.prenom = document.getElementById('prenomPlongeur').value;
    personne.dateCertif = document.getElementById('date').value;
    personne.plongeur = document.getElementById('Plongeur').checked;
    personne.directeur = document.getElementById('Directeur').checked;
    personne.secuSurface = document.getElementById('SecuriteSurface').checked;
    personne.active = document.getElementById("estActive").checked;
    personne.aptitude = document.getElementById("aptitude").value;
    var modif = document.getElementById('modfiAjout').value;

    $("#erreurN").html("");
    $("#erreurP").html("");
    $("#erreur").html("");

    var valid = true;

    $("#erreur").html("");

    if (verification(0,0) == 0){
        $("#erreurN").html("Le nom ne correspond pas à un format adapté.");
        valid = false;
    }
    if (verification(1,0) == 0){
        $("#erreurP").html("Le prénom ne correspond pas à un format adapté.");
        valid = false;
    }
    if (personne.nom == "" || personne.prenom == "") {
        $("#erreur").html("Une personne a obligatoirement un nom, un prénom.");
        valid = false;
    }
    if (exist(personne.nom, personne.prenom)){
        $("#erreur").html("Cette personne existe déjà.");
        valid = false;
    }
    if (valid) {
        if(personne.plongeur && personne.aptitude == "rien")
        {
            $("#erreur").html("Un plongeur a obligatoirement une aptitude");
        }
        else {
            personne.nom = verification(0,1);
            personne.prenom = verification(1,1);
            var text = "personne=personne&nom=" + personne.nom + "&prenom=" + personne.prenom+"&dateCertif="+personne.dateCertif+"&active="+personne.active;

            if(modif != -1)
            {
                fichier = "ModifierPersonne";
                text = text + "&num="+document.getElementById("modfiAjout").value;
            }
            else
            {
                fichier = "NewPlongeur";
            }

            var xhr = initXHR();
            xhr.open('POST', 'index.php?url='+fichier, false);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

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
            if(!xhr.responseText)
            {
                if(modif != -1) {
                    var num = document.getElementById("modfiAjout").value;
                    if (isPlongeur(num)) {
                        document.getElementById("Plongeur").checked = true;
                        selectAptitude();
                        document.getElementById('aptitude').value = getAptitude(num);
                    }
                    document.getElementById("Directeur").checked = isDirecteur(num);
                    document.getElementById("SecuriteSurface").checked = isSecuriteSurface(num);
                }
                $("#erreur").html(xhr.responseText);
            }
            else
            {
                update();
                document.getElementById('nomPlongeur').value = "";
                document.getElementById('prenomPlongeur').value = "";
                document.getElementById('date').value = "";
                document.getElementById('Plongeur').checked = true;
                document.getElementById('Directeur').checked = false;
                document.getElementById('SecuriteSurface').checked = false;
                $("#selectAptitude").html("");
                if(modif != -1)
                {
                    M.toast({html: 'Personne modifée'})
                }
                else
                {
                    M.toast({html: 'Personne enregistrée'})
                }
                closeModal("newPlongeur");

            }
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

function initModalAjoutPers(num)
{
    $("#erreur").html("");
    document.getElementById('nomPlongeur').value = "";
    document.getElementById('prenomPlongeur').value = "";
    document.getElementById('date').value = "";
    document.getElementById('Plongeur').checked = true;
    document.getElementById('Directeur').checked = false;
    document.getElementById('SecuriteSurface').checked = false;
    document.getElementById("estActive").checked = true;
    $('#supprime').html("");
    selectAptitude();

    document.getElementById("modfiAjout").value = -1;
    $("#modfiAjout").html("Ajouter une personne");

    if(num != -1)
    {
        document.getElementById("modfiAjout").value = num;
        $("#modfiAjout").html("Modifier une personne");

        $("#numIdentification").html("Numero d'identification : " + num);

        personne.nom = getNom(num);
        personne.prenom = getPrenom(num);
        personne.active = estActive(num);
        personne.dateCertif = getDateCertif(num);
        personne.plongeur = isPlongeur(num);
        personne.directeur = isDirecteur(num);
        personne.secuSurface = isSecuriteSurface(num);

        document.getElementById('nomPlongeur').value = personne.nom;

        document.getElementById("prenomPlongeur").value = personne.prenom;

        if (personne.active)
        {
            document.getElementById("pasActive").checked = true;
        }
        else {
            document.getElementById("estActive").checked = true;
        }

        document.getElementById("date").value = personne.dateCertif;

        if(personne.plongeur)
        {
            document.getElementById("Plongeur").checked = true;
            selectAptitude();
            personne.aptitude = getAptitude(num);
            document.getElementById('aptitude').value = personne.aptitude;
        }

        document.getElementById("Directeur").checked = personne.directeur;
        document.getElementById("SecuriteSurface").checked = personne.secuSurface;

        $('#supprime').append("<a class='waves-effect red waves-light center btn' id='delete' onclick='supprimer("+num+")'><i class='material-icons right'>delete</i>Supprimer</a>");
        estConcerne();
    }


    $(document).ready(function(){
        $('#newPlongeurModal').modal('open');
    });
}

function getNom(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetNom', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num);

    return xhr.responseText;
}

function getPrenom(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetPrenom', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num);

    return xhr.responseText;
}

function estActive(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=EstActive', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num);

    return (xhr.responseText==0);
}

function getDateCertif(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=DateCertif', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num);

    return (xhr.responseText);
}

function isPlongeur(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=IsPlongeur', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num);

    return xhr.responseText;
}

function getAptitude(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetAptitude', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num);

    return xhr.responseText;
}


function isDirecteur(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=IsDirecteur', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num);

    return (xhr.responseText==1);
}

function isSecuriteSurface(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=IsSecuriteSurface', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num);

    return (xhr.responseText==1);
}

function estConcerne(){
    var btn = $('#delete');
    var num = document.getElementById("modfiAjout").value;
    var directeur;
    var secusurf;
    personne.directeur ? directeur = 1 : directeur = 0;
    personne.secuSurface ? secusurf = 1 : secusurf = 0;

    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=IsConcerne', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num+"&directeur="+directeur+"&secusurf="+secusurf);

    var resp = xhr.responseText;

    if(resp!=1){
        btn.addClass("disabled");
    }
}

function supprimer(num)
{
    if(confirm("Êtes-vous sur de supprimer cette personne ?"))
    {
        var plongeur;
        var directeur;
        var secusurf;
        personne.plongeur ? plongeur = 1 : plongeur = 0;
        personne.directeur ? directeur = 1 : directeur = 0;
        personne.secuSurface ? secusurf = 1 : secusurf = 0;

        var xhr = initXHR();

        xhr.open('POST', 'index.php?url=SupprimerPersonne', false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("num="+num+"&plongeur="+plongeur+"&directeur="+directeur+"&secusurf="+secusurf);
        M.toast({html: 'Personne suprimée'});
        update();
    }
    closeModal("newPlongeur");
}
