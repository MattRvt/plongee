var datePalanquee = null;
var momentPalanquee = null;
var numDir = null;
var numSecu = null;

function initListePalanqueeVide()
{
    $("#enrPlongee").html("<input type=\"button\" class=\"btn green\" value=\"Enregistrer plongée\" onclick=\"enregistrerPalanqueeBaseVide()\">");

    datePalanquee = null;
    momentPalanquee = null;

    palanquees = [];

    $("#btnAjout").html("<a class='waves-effect waves-light btn' onclick='initAjoutPalanqueeVide()'>Ajouter Palanquee</a>");
    afficherPalanquee(null,null);
    initDirecteurSecurite();
}

function initListePalanquee(datePal, matMidSoi)
{
    $("#enrPlongee").html("<input type=\"button\" class=\"btn green\" value=\"Enregistrer plongée\" onclick=\"enregistrerPalanqueeBase()\">");

    datePalanquee = datePal;
    momentPalanquee = matMidSoi;

    palanquees = [];

    setNbPlongeur(datePal, matMidSoi);

    var passerOuPas = estPasserOuPas(datePal, matMidSoi);

    if(passerOuPas)
    {
        $("#btnAjout").html("<a class='waves-effect waves-light btn' onclick='initAjoutPalanquee(\""+datePal+"\",\""+matMidSoi+"\")'>Ajouter Palanquee</a>");
    }
    else
    {
        $("#btnAjout").html("");
    }

    $.ajax({
        url: 'ListePalanqueePlongee',
        type: 'post',
        data: "date="+datePal+"&moment="+matMidSoi+"&passerOuPas="+passerOuPas,
        dataType: 'JSON',
        success: function(response1)
        {
            var len = response1.length;
            for (var i = 0; i < len; i++)
            {
                palanquees[i] = response1[i];
            }
            afficherPalanquee(datePal, matMidSoi);
            initDirecteurSecurite();
            },
        error: function (response1) {
            document.write(response1.responseText);
            alert("erreur de chargement des données");
            console.log(response1);
        }
    });
}

function afficherPalanquee(datePal, matMidSoi)
{
    $("#listePalanque").html("");
    var len = palanquees.length;

    if(datePal != null && matMidSoi != null)
    {
        var plus = estPasserOuPas(datePal, matMidSoi);
    }
    else
    {
        var plus = true;
    }

    var tr_str = "<thead class='center'><tr> " +
        "<th>Profondeur Max</th> " +
        "<th>Duree Max</th> "+
        "<th>Nombre de plongeur</th>";

    if(plus !== true)
    {
        if(plus === null)
        {
            var separation = true;
        }
        else
        {
            var separation = false;
        }
        tr_str+= "<th>Heure D'immersion</th> " +
            "<th>Heure de sortie</th> " +
            "<th>Profondeur reel</th> "+
            "<th>Duree au fond</th>";
    }

    tr_str+="</tr> </thead> " +
        "<tbody></tbody>";

    $("#listePalanque").append(tr_str);

    for (var i = 0; i < len; i++)
    {
        tr_str = "";

        var data = palanquees[i];

        if(plus !== true)
        {
            var heureImm = data.heureImm;
            var heureSort = data.heureSor;
            var profReel = data.profReel;
            var durreFond = data.durFond;

            if(separation && !((heureImm == null)||(heureSort == null)||(profReel == null)||(durreFond == null))) {
                tr_str += "<tr><td><td></tr>";
                separation = false;
            }
        }

        var num = data.num;
        var profondeurMax = data.profMax;
        var dureeMax = data.durMax;
        var nbPlongeur = data.nbPlongeur;
        //var btn = data[i].btn;

        tr_str += "<tr>" +
            "<td align='center'>" + profondeurMax + "</td>" +
            "<td align='center'>" + dureeMax + "</td>"+
            "<td align='center'>" + nbPlongeur + "</td>";

        if(plus !== true)
        {
            tr_str +=
                "<td align='center'>" + heureImm + "</td>" +
                "<td align='center'>" + heureSort + "</td>" +
                "<td align='center'>" + profReel + "</td>"+
                "<td align='center'>" + durreFond + "</td>";
        }

        tr_str+= getBtn(datePal, matMidSoi, num, heureImm, heureSort, profReel, durreFond)+"</tr>";
        $("#listePalanque tbody").append(tr_str);
    }
}

function getBtn(datePal, matMidSoi, num, heureImm, heureSort, profReel, durreFond)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=GetEtatPlongee', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi);

    if(datePal != null && matMidSoi != null)
    {
        var passerOuPas = estPasserOuPas(datePal, matMidSoi);
    }
    else
    {
        var passerOuPas = true;
    }

    if(xhr.responseText == "Dépassée")
    {
        var btn = "<td><a class='waves-effect waves-light' onclick='initInfoPal(\""+datePal+"\",\""+matMidSoi+"\","+num+")'><i class='material-icons black-text' >remove_red_eye</i></a></td>";
    }
    else
    {
        if(passerOuPas)
        {
            var btn = "<td><a class='waves-effect waves-light btn' onclick='initModifPalanquee("+num+")'>Modifier</a></td>" +
                "<td><a class='center' onclick='supprimerPal(\""+datePal+"\",\""+matMidSoi+"\","+num+")'><i class='small material-icons red-text'>clear</i></a></td>";
        }
        else
        {
            if(heureImm == null || heureSort == null || profReel == null || durreFond == null)
            {
                var btn = "<td><a class='waves-effect waves-light btn orange' onclick='initCompleterPal(\""+datePal+"\",\""+matMidSoi+"\","+num+")'>à compléter</a></td>"+
                "<td><a class='center' onclick='supprimerPal(\""+datePal+"\",\""+matMidSoi+"\","+num+")'><i class='small material-icons red-text'>clear</i></a></td>";
            }
            else
            {
                var btn = "<td><a class='waves-effect waves-light btn' onclick='initCompleterPal(\""+datePal+"\",\""+matMidSoi+"\","+num+")'>complète</a></td>";
            }
        }
    }

    return btn;
}

function initCompleterPal(datePal, matMidSoi, num)
{
    var pal = palanquees[num-1];

    if(matMidSoi == 'M')
    {
        var moment = "matin"
    }
    else if(matMidSoi == 'A')
    {
        var moment = "l'apres-midi"
    }
    else
    {
        var moment = "soir"
    }

    $("#datePalPasse").html(datePal+" le "+moment);
    $("#profMaxPalPasse").html("Profondeur Maximum : "+pal.profMax);
    $("#durMaxPalPasse").html("Duree Maximum : "+pal.durMax);

    document.getElementById("inpHeureImm").value = pal.heureImm;
    document.getElementById("inpHeureSor").value = pal.heureSor;
    document.getElementById("inpProfondeurReel").value = pal.profReel;
    document.getElementById("inpDureeFond").value = pal.durFond;

    var text = "Plongeur :<br/>";

    for(var k = 0; k<pal.nbPlongeur; k++)
    {
        text += "• "+pal.plongeur[k].PER_NOM+" "+pal.plongeur[k].PER_PRENOM+"<br/>";
    }

    $("#listPlongeurPalPasse").html(""+text);

    $("#validerModifPal").html("<button class=\"green waves-effect waves-light btn\" type=\"submit\" name=\"EN\" onclick='modifierCompleterPalanquee(\""+datePal+"\",\""+matMidSoi+"\","+num+")'><i class=\"material-icons right\">send</i>Valider</button>");

    $(document).ready(function(){
        $('#modifierCompleterModal').modal('open');
    });
}

function modifierCompleterPalanquee(datePal, matMidSoi, num)
{
    palanquees[num-1].heureImm = document.getElementById("inpHeureImm").value;
    palanquees[num-1].heureSor = document.getElementById("inpHeureSor").value;
    palanquees[num-1].profReel = document.getElementById("inpProfondeurReel").value;
    palanquees[num-1].durFond = document.getElementById("inpDureeFond").value;

    closeModal("modifierCompleter");

    afficherPalanquee(datePal, matMidSoi);
}

function supprimerPal(datePal,matMidSoi,num)
{
    if(confirm("Êtes-vous sur de supprimer cette palanquee ?")) {
        var len = palanquees.length;
        for (var i = num - 1; i < len; i++) {
            if (i == len - 1) {
                palanquees.splice(palanquees.indexOf(i), 1);
            } else {
                palanquees[i] = palanquees[i + 1];
                palanquees[i].num = i + 1;
            }
        }
        initDirecteurSecurite();
        afficherPalanquee(datePal, matMidSoi);
    }
}

function setNbPlongeur(datePal, matMidSoi)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=GetNbPlongeurPlongee', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi);

    $("#effectifs").html("Effectif total: "+xhr.responseText);
}


function initInfoPal(datePal, matMidSoi, num)
{
    var pal = palanquees[num];

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


    $("#numPalDepasse").html("numero : "+num);
    $("#datePalDepasse").html(datePal+" le "+moment);
    $("#profMaxPalDepasse").html("Profondeur Maximum : "+pal.profMax);
    $("#durMaxPalDepasse").html("Duree Maximum : "+pal.durMax);
    $("#tempsImmersionDepasse").html("temps d'immersion :"+pal.durFond);
    $("#heureImmersionDepasse").html("Heure d'immersion :" +pal.heureImm);
    $("#heureSortieDepasse").html("Heure de sortie de l'eau :"+pal.heureSor);
    $("#profondeurDepasse").html("Profondeur Reel :"+pal.profReel);

    $(document).ready(function(){
        $('#infoPalModal').modal('open');
    });
}

function estPasserOuPas(datePal, matMidSoi)
{
    var date = new Date();
    var dateP = new Date(datePal);

    if(matMidSoi == "M")
    {
        dateP.setHours(1);
    }
    else if(matMidSoi == "A")
    {
        dateP.setHours(12);
    }
    else
    {
        dateP.setHours(18);
    }

    return dateP>date;
}


function enregistrerPalanqueeBaseVide()
{
    datePalanquee = document.getElementById("date").value;
    momentPalanquee = document.getElementById("moment").value;
    var site = document.getElementById("site").value;
    var directeurDePlongee = document.getElementById("directeurDePlongee").value;
    var securiteDeSurface = document.getElementById("securiteDeSurface").value;
    var embarcation = document.getElementById("embarcation").value;
    var etat = document.getElementById("hidEtat").value;

    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=UpdatePlongee', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePalanquee+"&moment="+momentPalanquee+"&site="+site+"&directeurDePlongee="+directeurDePlongee+"&securiteDeSurface="+securiteDeSurface+"&embarcation="+embarcation+"&etat="+etat);


    if(xhr.responseText == "")
    {
        var len = palanquees.length;
        for(var i = 0; i < len; i++)
        {
            palanquees[i].date = datePalanquee;
            palanquees[i].moment = momentPalanquee;
        }
        enregistrerPalanqueeBase();
    }
    else
    {
        alert(xhr.responseText);
    }
}

function enregistrerPalanqueeBase()
{
    $(document).ready(function(){
        $.ajax({
            url: "EnregistrerPalanquee",
            dataType: 'json',
            type: 'post',
            data: "data="+JSON.stringify(palanquees)+"&dateAj="+datePalanquee+"&momentAj="+momentPalanquee,
            success: function(response)
            {
                document.getElementById("hidEtat").value = response.responseText;
                $("#moment").prop('disabled', false);
                $("#date").prop('disabled', false);
                $("#formPlongee").submit();
            },
            error: function(response)
            {
                document.getElementById("hidEtat").value = response.responseText;
                $("#moment").prop('disabled', false);
                $("#date").prop('disabled', false);
                $("#formPlongee").submit();
            }
        });
    });
}

function initDirecteurSecurite()
{
    var selectDir = document.getElementById("directeurDePlongee").value;
    var selectSecu = document.getElementById("securiteDeSurface").value;

    var plongeurNum = [];
    var compteur = 0;
    if(datePalanquee != "null" && momentPalanquee != "null")
    {
        var len = palanquees.length;
        for(var i = 0; i<len; i++)
        {
            var pal = palanquees[i];
            for (var k = 0; k < pal.nbPlongeur; k++)
            {
                plongeurNum[compteur] = pal.plongeur[k].PER_NUM;
                compteur++;
            }
        }
    }

    var refDir = $("#directeurDePlongee");
    var refSecu = $("#securiteDeSurface");
    
    refDir.load("SelectDirecteurSecurite",{
        date : datePalanquee,
        moment : momentPalanquee,
        plongeurNum : plongeurNum,
        selectDir : selectDir,
        selectSecu : selectSecu,
        dirSecu : true
    });
    refSecu.load("SelectDirecteurSecurite",{
        date : datePalanquee,
        moment : momentPalanquee,
        plongeurNum : plongeurNum,
        selectDir : selectDir,
        selectSecu : selectSecu,
        dirSecu : false
    });

    numDir = document.getElementById("directeurDePlongee").value;
    numSecu = document.getElementById("securiteDeSurface").value;
}