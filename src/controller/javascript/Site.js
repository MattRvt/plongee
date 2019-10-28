var db_returnP = null;
var numSite = null;

function updateSite(){
    $(document).ready(function(){
        $.ajax({
            url: 'ListeSite',
            type: 'get',
            dataType: 'JSON',
            success: function(response1){
                db_returnP = response1;
                afficheSite(response1,0);
            }
        });
    });
}

$(document).ready(function () {
    $("#searchSite").keyup(function() {
        afficheSite(db_returnP,0);
    });
})

function afficheSite(db,type) {
    var output = [];
    var match = $("#searchSite").val().trim();

    $("#tableSite").empty();

    if (match == '') {
        output = db;
    } else {
        var i = 0;
        db.forEach((item) => {
            if ((item.SIT_NOM.toLowerCase().indexOf(match.toLowerCase()) >= 0) || (item.SIT_LOCALISATION.toLowerCase().indexOf(match.toLowerCase()) >= 0)) {
                output[i] = item;
                i++;
            }
        })
    }

    var len = output.length;
    if (len == 0){
        $("#tableSite").html("Aucun résultat n'a été trouvé");
    }
    else {
        var tr_str = " <thead><tr> " +
            "<th width='10%'>S.no</th> " +
            "<th width='30%'>Nom</th> " +
            "<th width='30%'>Localisation</th> ";

        tr_str+="</tr> </thead> " +
            "<tbody></tbody>";

        $("#tableSite").append(tr_str);

        for (var i = 0; i < len; i++) {
            var num = output[i].SIT_NUM;
            var nom = output[i].SIT_NOM;
            var localisation = output[i].SIT_LOCALISATION;

            tr_str = "<tr>" +
                "<td align='center'>" + num + "</td>" +
                "<td align='center'>" + nom + "</td>" +
                "<td align='center'>" + localisation + "</td>";
            tr_str+= "<td align='center'><a class='waves-effect waves-light btn modal-trigger' onclick='initModifSite("+num+")'>Modifier</a></td>" + "</tr>";

            $("#tableSite tbody").append(tr_str);
        }
        $('.tooltipped').tooltip();
    }
}

function initAjoutSite()
{
    $(document).ready(function(){
        $('#siteModal').modal('open');
    });

    $("#titreAjoutModifSite").html("Ajouter Site");
    $("#numSite").html("");
    document.getElementById("nomSite").value = "";
    document.getElementById("localisationSite").value = "";
}

function initModifSite(num)
{
    $(document).ready(function(){
        $('#siteModal').modal('open');
    });

    numSite = num;

    $("#titreAjoutModifSite").html("Modifier Site");
    $("#numSite").html("Numero : "+numSite);

    var data = getDataSite();
    document.getElementById("nomSite").value = data[0];
    document.getElementById("localisationSite").value = data[1];
}

function getDataSite()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetDataSite', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+numSite);

    return xhr.responseText.split('|');
}

function traitementSite()
{
    var nom = document.getElementById("nomSite").value;
    var localisation = document.getElementById("localisationSite").value;

    if(numSite != null)
    {
        var controller = "UpdateDataSite";
        var send = "&num="+numSite;
    }
    else
    {
        var controller = "AjoutDataSite";
        var send = "";
    }
    var xhr = initXHR();
    var siteValide = (nom.length>0) && (localisation.length>0);
    if (siteValide) {
        alert("Site enregistré");
        xhr.open('POST', 'index.php?url=' + controller, false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("nom=" + nom + "&localisation=" + localisation + send);

        closeModal("site");
    } else {
        alert("la site   ne peut pas etre enregistré");
    }

    updateSite();
}
