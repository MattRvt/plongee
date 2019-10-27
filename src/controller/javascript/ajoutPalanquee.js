function resetModalModifAjoutPal()
{
    $("#erreurPalPlong").html("");
    $('#addPlongeurPal').html("");
    $('#supprPlongeurPal').html("");
    document.getElementById("profMax").value = "";
    document.getElementById("DurMax").value = "";

    for(var i=1; i<=5; i++)
    {
        $("#plongeurPalanquee"+i).html("");
    }
}

function initAjoutPalanquee()
{
    $("#titreAjoutModifPal").html("Créer une palanquée");
    resetModalModifAjoutPal();

    $(document).ready(function(){
        $('#newPalanqueeModal').modal('open');
    });

    nbCasePlongeur(2);

    document.getElementById('addPlongeurPal').value = 2;
    $('#addPlongeurPal').html("<a class='waves-effect waves-light btn modal-trigger green' onclick='addCasePlongeur()'>Ajouter Plongeur</a>");
}

function initModifPalanquee(datePal, matMidSoi, num)
{
    $(document).ready(function(){
        $('#newPalanqueeModal').modal('open');
    });

    $("#titreAjoutModifPal").html("Modifier une palanquée");
    resetModalModifAjoutPal();

    var data = getDataPalanquee(datePal, matMidSoi, num);
    document.getElementById("profMax").value = data[4];
    document.getElementById("DurMax").value = data[5];

    var nb = getNbPlongeur(datePal, matMidSoi, num);

    document.getElementById('addPlongeurPal').value = nb;

    nbCasePlongeur(nb);

    if(nb < 5)
    {
        $('#addPlongeurPal').html("<a class='waves-effect waves-light btn modal-trigger green' onclick='addCasePlongeur()'>Ajouter Plongeur</a>");
    }
    if(nb > 2)
    {
        for(var i=1; i<=nb; i++)
        {
            $('#supprPlongeurPal'+i).html("<a class='center' onclick='supprCasePlongeur("+i+")'><i class='small material-icons red-text'>clear</i></a>");
        }
    }

    var Plongeur = getPlongeurPal(datePal, matMidSoi, num);
    for(var k = 1; k<=nb; k++)
    {
        document.getElementById('plongeur'+k).value = Plongeur[k];
    }
}


function nbCasePlongeur(nb)
{
    var depart=1;
    if(document.getElementById('plongeur1') || document.getElementById('plongeur2'))
    {
        depart = 3;
    }
    if(document.getElementById('plongeur3'))
    {
        depart = 4;
    }
    if(document.getElementById('plongeur4'))
    {
        depart = 5;
    }
    if(document.getElementById('plongeur5'))
    {
        depart = 6;
    }

    var Text="";

    for(depart; depart<=nb; depart++)
    {
        var xhr = initXHR();

        xhr.open('POST', 'index.php?url=AjouterPlongeurPalanque', false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("nb="+depart);

        $("#plongeurPalanquee"+depart).html(xhr.responseText);
    }
}

function addCasePlongeur()
{
    $("#erreurPalPlong").html("");
    var nb = document.getElementById('addPlongeurPal').value;
    if(nb < 5 && document.getElementById('plongeur'+nb).value != "")
    {
        document.getElementById('addPlongeurPal').value = ++nb;
    }
    else
    {
        $("#erreurPalPlong").html("Veuillez sélectionner des plongeurs avant d'en ajouter");
    }
    if(nb == 5)
    {
        $('#addPlongeurPal').html("");
    }
    nbCasePlongeur(nb);
    if(nb >= 3)
    {
        for(var i=1; i<=nb; i++)
        {
            $('#supprPlongeurPal'+i).html("<a class='center' onclick='supprCasePlongeur("+i+")'><i class='small material-icons red-text'>clear</i></a>");
        }
    }
}

function supprCasePlongeur(nbSuppr)
{
    var nbTot = document.getElementById('addPlongeurPal').value;

    var n = nbSuppr;
    for(n; n<nbTot; n++)
    {
        document.getElementById("plongeur"+n).value = document.getElementById("plongeur"+(n+1)).value;
    }

    $("#plongeurPalanquee"+nbTot).html("");
    document.getElementById('addPlongeurPal').value = --nbTot;

    if(nbTot == 2)
    {
        for(var i=1; i<=2; i++)
        {
            $('#supprPlongeurPal'+i).html("");
        }
    }
    if(nbTot == 4)
    {
        $('#addPlongeurPal').html("<a class='waves-effect waves-light btn modal-trigger green' onclick='addCasePlongeur()'>Ajouter Plongeur</a>");
    }
}

function getNbPlongeur(datePal, matMidSoi, num)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=GetNbPlongeur', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi+"&num="+num);

    return xhr.responseText;
}

function getDataPalanquee(datePal, matMidSoi, num)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=GetUnePalanquee', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi+"&num="+num);

    return xhr.responseText.split('|');
}

function getPlongeurPal(datePal, matMidSoi, num)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=GetPlongeurPal', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi+"&num="+num);

    return xhr.responseText.split('|');
}