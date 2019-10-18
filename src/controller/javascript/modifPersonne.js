function launchModalModifPersonne(num)
{
    $(document).ready(function(){
        $('#modifPersModal').modal('open');
    });

    $("#numIdentification").html("Numero d'identification : " + num);
    document.getElementById("numInput").value = num;
    document.getElementById("nom").value = getNom(num);

    $("#spannom").html("");
    $("#spanprenom").html("");

    document.getElementById("prenom").value = getPrenom(num);

    if(isPlongeur(num))
    {
        text = "aptitude : "+getAptitude(num);
        $("#aptitudePlong").html(text);
    }

    if (estActive(num))
    {
        document.getElementById("etat").value = "Activer";
    }
    else {
        document.getElementById("etat").value = "Désactiver";
    }
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

    xhr.open('POST', 'index.php?url=Aptitude', false);
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