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