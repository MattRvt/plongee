function initListePalanquee(datePal, matMidSoi)
{
    var date = new Date();
    var dateMtn = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
    var momentActuel;
    var passerOuPas;

    if(date.getHours()<12)
    {
        momentActuel = "M";

        if(dateMtn <= datePal && momentActuel == matMidSoi)
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

        if(dateMtn <= datePal && momentActuel == matMidSoi)
        {
            passerOuPas = false;
        }
        else if(dateMtn <= datePal && matMidSoi == "M")
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
    if(passerOuPas)
    {
        $("#btnAjout").html("<a class='waves-effect waves-light btn modal-trigger' onclick='initAjoutPalanquee(\""+datePal+"\",\""+matMidSoi+"\")'>Ajouter Palanquee</a>");
    }
    else
    {
        $("#btnAjout").html("");
    }

    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=ListePalanqueePlongee', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi+"&passerOuPas="+passerOuPas);

    $("#listePalanque").html("<fieldset>"+xhr.responseText+"</fieldset>");
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
