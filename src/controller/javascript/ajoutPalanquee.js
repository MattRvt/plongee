var db_plongeur;

var palanquee = {
    datePal: null,
    matMidSoi: null,
    num: null,
};

var palanquees = [];


$(document).ready(function(){
    $.ajax({
        url: 'ListePlongeur',
        type: 'get',
        dataType: 'JSON',
        success: function(response){
            db_plongeur = response;
        }
    });
});

function autocomplete(){
    var str = {};
    db_plongeur.forEach((item) => {
        if(!verifierPlongeurDejaPresent(1,item.PER_NUM))
        {
            str[item.PER_NUM+" | "+item.PER_NOM+" "+item.PER_PRENOM] = null;
        }
    });
    $(document).ready(function(){
        $('input.autocomplete').autocomplete({
            data: str,
        });
    });
}

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

function initAjoutPalanqueeVide()
{
    palanquee.datePal = null;
    palanquee.matMidSoi = null;
    palanquee.num = null;
    initAjoutPalanqueeCommun();
}

function initAjoutPalanqueeCommun()
{
    for(var n = 0; n<5; n++)
    {
        $("#erreurPlongeur"+n).html("");
    }
    $("#titreAjoutModifPal").html("Créer une palanquée");
    resetModalModifAjoutPal();

    $(document).ready(function(){
        $('#newPalanqueeModal').modal('open');
    });

    nbCasePlongeur(2);

    document.getElementById('addPlongeurPal').value = 2;
    $('#addPlongeurPal').html("<a class='waves-effect waves-light btn green' onclick='addCasePlongeur()'>Ajouter Plongeur</a>");
}

function initAjoutPalanquee(datePal, matMidSoi)
{
    palanquee.datePal = datePal;
    palanquee.matMidSoi = matMidSoi;
    palanquee.num = null;
    initAjoutPalanqueeCommun();
}

function initModifPalanquee(num)
{
    for(var n = 0; n<5; n++)
    {
        $("#erreurPlongeur"+n).html("");
    }

    var pal = palanquees[num-1];
    palanquee.datePal = pal.date;
    palanquee.matMidSoi = pal.moment;
    palanquee.num = num;

    $(document).ready(function(){
        $('#newPalanqueeModal').modal('open');
    });

    $("#titreAjoutModifPal").html("Modifier une palanquée");
    resetModalModifAjoutPal();

    document.getElementById("profMax").value = pal.profMax;
    document.getElementById("DurMax").value = pal.durMax;

    document.getElementById('addPlongeurPal').value = pal.nbPlongeur;

    nbCasePlongeur(pal.nbPlongeur);

    if(pal.nbPlongeur < 5)
    {
        $('#addPlongeurPal').html("<a class='waves-effect waves-light btn green' onclick='addCasePlongeur()'>Ajouter Plongeur</a>");
    }
    if(pal.nbPlongeur > 2)
    {
        for(var i=1; i<=pal.nbPlongeur; i++)
        {
            $('#supprPlongeurPal'+i).html("<a class='center' onclick='supprCasePlongeur("+i+")'><i class='small material-icons red-text'>clear</i></a>");
        }
    }

    for(var k = 0; k<pal.nbPlongeur; k++)
    {
        var text = pal.plongeur[k].PER_NUM+" | "+pal.plongeur[k].PER_NOM+" "+pal.plongeur[k].PER_PRENOM;
        document.getElementById('plongeur'+(k+1)).value = text;
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
    autocomplete();
}

function addCasePlongeur()
{
    $("#erreurPalPlong").html("");
    var nb = document.getElementById('addPlongeurPal').value;
    if(nb < 5 && document.getElementById('plongeur'+nb).value != "")
    {
        if(!verifierPlongeurDejaPresent(nb))
        {
            document.getElementById('addPlongeurPal').value = ++nb;
        }
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
        $('#addPlongeurPal').html("<a class='waves-effect waves-light btn green' onclick='addCasePlongeur()'>Ajouter Plongeur</a>");
    }
}

function traitementAjoutPal()
{
    var nb = document.getElementById('addPlongeurPal').value;
    if(!verifierPlongeurDejaPresent(nb)) {
        var plongeur = [];

        for (var n = 0; n < nb; n++) {
            var plongNum = document.getElementById("plongeur" + (n + 1)).value.split('|')[0];
            var plongNom = document.getElementById("plongeur" + (n + 1)).value.split('|')[1].split(" ")[1];
            var plongPrenom = document.getElementById("plongeur" + (n + 1)).value.split('|')[1].split(" ")[2];

            plongeur[n] = Array(plongNum, plongNom, plongPrenom);
        }

        if (palanquee.num != null) {
            var send = "&num=" + palanquee.num;
        } else {
            var len = palanquees.length;
            var send = "&num=" + (len + 1);
        }
        var profMax = document.getElementById("profMax").value;
        var DurMax = document.getElementById("DurMax").value;

        $.ajax({
            url: "AjoutPalanquee",
            type: 'post',
            data: "date=" + palanquee.datePal + "&moment=" + palanquee.matMidSoi + "&profMax=" + profMax + "&durMax=" + DurMax + "&nb=" + nb + "&plongeur=" + plongeur + send,
            dataType: 'JSON',
            success: function (response1) {
                palanquees[response1.num - 1] = response1;
                initDirecteurSecurite();
                afficherPalanquee(palanquee.datePal, palanquee.matMidSoi);
            },
            error: function (response1) {
                document.write(response1.responseText);
                alert("erreur de création de la palanquee");
                console.log(response1);
            }
        });
        closeModal("newPalanquee");
    }
}

function verifierPlongeurDejaPresent(nb,num = null)
{
    var plongeur = [];
    var bool = false;

    for(var n=0; n<5; n++)
    {
        if(n<nb)
        {
            if(num == null) {
                var plongNum = document.getElementById("plongeur" + (n + 1)).value.split('|')[0];
                plongeur[n] = Array(plongNum);
            }
            else
            {
                plongeur[n] = Array(num);
            }
            for(var k = 0; k<plongeur.length; k++)
            {
                if(Number(plongeur[n]) == Number(plongeur[k]) && n != k)
                {
                    $("#erreurPlongeur"+(n+1)).html("Le plongeur est déjà dans la palanquee");
                    $("#erreurPlongeur"+(k+1)).html("Le plongeur est déjà dans la palanquee");
                    bool = true;
                }
            }
        }
        else
        {
            plongeur[n] = -1;
        }
    }

    var len = palanquees.length;
    for(var i = 0; i<len; i++)
    {
        if(i+1 != palanquee.num)
        {
            var pal = palanquees[i];
            for(var k = 0; k<pal.nbPlongeur; k++)
            {
                var palNum = Number(pal.plongeur[k].PER_NUM);
                for (var n = 0; n < 5; n++) {
                    var numeroPlongeur = Number(plongeur[n]);
                    if (palNum == numeroPlongeur || numeroPlongeur == Number(numSecu) || numeroPlongeur== Number(numDir)) {
                        if (num == null) {
                            $("#erreurPlongeur" + (n + 1)).html("Le plongeur est déjà dans la plongée");
                            bool = true;
                            break;
                        } else {
                            return true;
                        }
                    }
                }
            }
        }
    }
    return bool;
}