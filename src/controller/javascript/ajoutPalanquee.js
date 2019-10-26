function initAjoutPalanquee()
{
    $("#erreurPalPlong").html("");
    $("#erreurPalPlong").html("");
    $('#addPlongeurPal').html("");
    $('#supprPlongeurPal').html("");
    for(var i=1; i<=5; i++)
    {
        $("#plongeurPalanquee"+i).html("");
    }

    $(document).ready(function(){
        $('#newPalanqueeModal').modal('open');
    });

    nbCasePlongeur(2);

    document.getElementById('addPlongeurPal').value = 2;
    $('#addPlongeurPal').html("<a class='waves-effect waves-light btn modal-trigger green' onclick='addCasePlongeur()'>Ajouter Plongeur</a>");
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
    if(nb == 3)
    {
        $('#supprPlongeurPal').html("<a class='waves-effect waves-light btn modal-trigger red' onclick='supprCasePlongeur()'>Supprimer Plongeur</a>");
    }
    nbCasePlongeur(nb);
}

function supprCasePlongeur()
{
    var nb = document.getElementById('addPlongeurPal').value;
    $("#plongeurPalanquee"+nb).html("");
    document.getElementById('addPlongeurPal').value = --nb;
    if(nb == 2)
    {
        $('#supprPlongeurPal').html("");
    }
    if(nb == 4)
    {
        $('#addPlongeurPal').html("<a class='waves-effect waves-light btn modal-trigger green' onclick='addCasePlongeur()'>Ajouter Plongeur</a>");
    }
}