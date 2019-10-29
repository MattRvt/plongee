var db_returnSite = null;
var numSite = null;
var mapProxySite = new Map();

function updateSite(){
    if(mapProxySite.size == 0)
    {
        isAllUseSite();
    }
    $(document).ready(function(){
        $.ajax({
            url: 'ListeSite',
            type: 'get',
            dataType: 'JSON',
            success: function(response1){
                db_returnSite = response1;
                afficheSite(response1);
            },
            error: function (response1) {
                alert("erreur de chargement des données");
                console.log(response1);
            }
        });
    });
}

$(document).ready(function () {
    $("#searchSite").keyup(function() {
        afficheSite(db_returnSite);
    });
})

function afficheSite(db) {
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
            tr_str+= "<td align='center'><a class='waves-effect waves-light btn' onclick='initModifSite("+num+")'>Modifier</a></td>";

            if(!isUseSiteProxy(num))
            {
                tr_str+= "<td align='center'><a onclick='supprimerSite("+num+")'><i class='small material-icons red-text'>clear</i></a></td>"
            }

            tr_str+= "</tr>";

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

    numSite = null;

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

function getDataSite(num = numSite)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetDataSite', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num);

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
        alert("la site ne peut pas etre enregistré");
    }

    updateSite();
}

function isUseSiteProxy(num)
{
    if(mapProxySite.get(num) == undefined)
    {
        mapProxySite.set(num, isUseSite(num));
    }
    return mapProxySite.get(num);
}

function isUseSite(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=IsUse', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num+"&name=Site");

    return xhr.responseText;
}

function supprimerSite(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=Supprimer', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num+"&name=Site");

    updateSite();
}

function isAllUseSite()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=IsAllUse', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("name=Site&param=SIT_NUM");

    var res = xhr.responseText.split('|');
    var use = res[0].split(" ");
    var nonUse = res[1].split(" ");

    for (var i = 0; i < use.length; i++)
    {
        mapProxySite.set(use[i], true);
    }
    for (var i = 0; i < nonUse.length; i++)
    {
        mapProxySite.set(nonUse[i], false);
    }
}