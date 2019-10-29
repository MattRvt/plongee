function initListePalanquee(datePal, matMidSoi)
{
    setNbPlongeur(datePal, matMidSoi);

    var passerOuPas = estPasserOuPas(datePal, matMidSoi);

    if(passerOuPas)
    {
        $("#btnAjout").html("<a class='waves-effect waves-light btn modal-trigger' onclick='initAjoutPalanquee(\""+datePal+"\",\""+matMidSoi+"\")'>Ajouter Palanquee</a>");
    }
    else
    {
        $("#btnAjout").html("");
    }

    $(document).ready(function(){
        $.ajax({
            url: 'ListePalanqueePlongee',
            type: 'post',
            data: "date="+datePal+"&moment="+matMidSoi+"&passerOuPas="+passerOuPas,
            dataType: 'JSON',
            success: function(response1)
            {
                afficherPalanquee(response1);
            },
            error: function (response1) {
                alert("erreur de chargement des données");
                console.log(response1);
            }
        });
    });
}

function afficherPalanquee(data)
{
    $("#listePalanque").html("");
    var len = data.length;
    var plus = data[0].PAL_HEURE_IMMERSION;

    var tr_str = "<thead class='center'><tr> " +
        "<th>P.no</th> " +
        "<th>Profondeur Max</th> " +
        "<th>Duree Max</th> "+
        "<th>Nombre de plongeur</th>";

    if(plus != undefined)
    {
        tr_str+= "<th>Heure D'immersion</th> " +
            "<th>Heure de sortie</th> " +
            "<th>Profondeur reel</th> "+
            "<th>Duree au fond</th>";
    }

    tr_str+="</tr> </thead> " +
        "<tbody></tbody>";

    $("#listePalanque").append(tr_str);

    for (var i = 0; i < len; i++) {
        var num = data[i].PAL_NUM;
        var profondeurMax = data[i].PAL_PROFONDEUR_MAX;
        var dureeMax = data[i].PAL_DUREE_MAX;
        var nbPlongeur = data[i].nbPlongeur;
        var btn = data[i].btn;

        tr_str = "<tr>" +
            "<td align='center'>" + num + "</td>" +
            "<td align='center'>" + profondeurMax + "</td>" +
            "<td align='center'>" + dureeMax + "</td>"+
            "<td align='center'>" + nbPlongeur + "</td>";

        if(plus != undefined)
        {
            var heureImm = data[i].PAL_HEURE_IMMERSION;
            var heureSort = data[i].PAL_HEURE_SORTIE_EAU;
            var profReel = data[i].PAL_PROFONDEUR_REELLE;
            var durreFond = data[i].PAL_DUREE_FOND;

            tr_str +=
                "<td align='center'>" + heureImm + "</td>" +
                "<td align='center'>" + heureSort + "</td>" +
                "<td align='center'>" + profReel + "</td>"+
                "<td align='center'>" + durreFond + "</td>";
        }

        tr_str+= btn+"</tr>";
        $("#listePalanque tbody").append(tr_str);
    }
}

function initCompleterPal(datePal, matMidSoi, num)
{
    if(matMidSoi == 'M')
    {
        var moment = "matin"
    }
    else if(matMidSoi == 'A')
    {
        var moment = "midi"
    }
    else
    {
        var moment = "soir"
    }

    var data = getDataPalanquee(datePal, matMidSoi, num);

    $("#numPalPasse").html("numero : "+num);
    $("#datePalPasse").html(datePal+" le "+moment);
    $("#profMaxPalPasse").html("Profondeur Maximum : "+data[4]);
    $("#durMaxPalPasse").html("Duree Maximum : "+data[5]);

    var Plongeur = getPlongeurPal(datePal, matMidSoi, num);
    var Text = "Liste des plongeurs <br/>";
    Plongeur.forEach(function (element)
    {
        if(element != "")
        {
            Text = Text+"• "+element+"<br/>";
        }
    });

    $("#listPlongeurPalPasse").html(Text);

    document.getElementById("inpHeureImm").value = data[0];
    document.getElementById("inpHeureSor").value = data[1];
    document.getElementById("inpProfondeurReel").value = data[2];
    document.getElementById("inpDureeFond").value = data[3];

    $("#validerModifPal").html("<input type='submit' name='EN' value='Envoyer' onclick='modifierCompleterPalanquee(\""+datePal+"\",\""+matMidSoi+"\","+num+")'>");

    $(document).ready(function(){
        $('#modifierCompleterModal').modal('open');
    });
}

function modifierCompleterPalanquee(datePal, matMidSoi, num)
{
    var heureImm = document.getElementById("inpHeureImm").value;
    var HeureSor = document.getElementById("inpHeureSor").value;
    var ProfondeurReel = document.getElementById("inpProfondeurReel").value;
    var dureeFond = document.getElementById("inpDureeFond").value;

    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=ModifierPalanquee', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi+"&num="+num+"&heureImm="+heureImm+"&HeureSor="+HeureSor+"&ProfondeurReel="+ProfondeurReel+"&dureeFond="+dureeFond);

    closeModal("modifierCompleter");

    initListePalanquee(datePal, matMidSoi);
}

function supprimerPal(datePal, matMidSoi, num)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=SupprimerPal', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi+"&num="+num);

    initListePalanquee(datePal, matMidSoi);
}

function setNbPlongeur(datePal, matMidSoi)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=GetNbPlongeurPlongee', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi);

    $("#effectifs").html("effectifs: "+xhr.responseText);
}

function initInfoPal(datePal, matMidSoi, num)
{
    if(matMidSoi == 'M')
    {
        var moment = "matin"
    }
    else if(matMidSoi == 'A')
    {
        var moment = "midi"
    }
    else
    {
        var moment = "soir"
    }

    var data = getDataPalanquee(datePal, matMidSoi, num);

    $("#numPalDepasse").html("numero : "+num);
    $("#datePalDepasse").html(datePal+" le "+moment);
    $("#profMaxPalDepasse").html("Profondeur Maximum : "+data[4]);
    $("#durMaxPalDepasse").html("Duree Maximum : "+data[5]);
    $("#tempsImmersionDepasse").html("temps d'immersion :"+data[0]);
    $("#heureImmersionDepasse").html("Heure d'immersion :" +data[1]);
    $("#heureSortieDepasse").html("Heure de sortie de l'eau :"+data[2]);
    $("#profondeurDepasse").html("Profondeur Reel :"+data[3]);

    var Plongeur = getPlongeurPal(datePal, matMidSoi, num);
    var Text = "Liste des plongeurs <br/>";
    Plongeur.forEach(function (element)
    {
        if(element != "")
        {
            Text = Text+"• "+element+"<br/>";
        }
    });

    $("#listPlongeurPalDepasse").html(Text);

    $(document).ready(function(){
        $('#infoPalModal').modal('open');
    });
}

function estPasserOuPas(datePal, matMidSoi)
{
    var date = new Date();
    var dateMtn = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
    var momentActuel;
    var passerOuPas;

    if(date.getHours()<12)
    {
        momentActuel = "M";

        if(dateMtn >= datePal && momentActuel == matMidSoi)
        {
            passerOuPas = false;
        }
        else if(dateMtn <= datePal)
        {
            passerOuPas = true;
        }
        else
        {
            passerOuPas = false;
        }
    }
    else if(date.getHours()<18)
    {
        momentActuel = "A";

        if(dateMtn >= datePal && momentActuel == matMidSoi)
        {
            passerOuPas = false;
        }
        else if(dateMtn >= datePal && matMidSoi == "M")
        {
            passerOuPas = false;
        }
        else if(dateMtn <= datePal)
        {
            passerOuPas = true;
        }
        else
        {
            passerOuPas = false;
        }
    }
    else
    {
        if(dateMtn <= datePal)
        {
            passerOuPas = true;
        }
        else
        {
            passerOuPas = false;
        }
    }

    return passerOuPas;
}