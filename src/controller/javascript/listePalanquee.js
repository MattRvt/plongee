function initListePalanquee(datePal, matMidSoi)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=ListePalanqueePlongee', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi);

    $("#listePalanque").html(xhr.responseText);
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

    var data = getDataPalanquee();

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

    $(document).ready(function(){
        $('#modifierCompleterModal').modal('open');
    });
}

function supprimerPal(datePal, matMidSoi, num)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=SupprimerPal', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("date="+datePal+"&moment="+matMidSoi+"&num="+num);

    initListePalanquee(datePal, matMidSoi);
}

