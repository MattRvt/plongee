var db_returnP = null;
var numEmbarcation = null;

function updateEmbarcation(){
    $(document).ready(function(){
        $.ajax({
            url: 'ListeEmbarcation',
            type: 'get',
            dataType: 'JSON',
            success: function(response1){
                db_returnP = response1;
                afficheEmbarcation(response1,0);
            }
        });
    });
}

$(document).ready(function () {
    $("#searchEmbarcation").keyup(function() {
        afficheEmbarcation(db_returnP,0);
    });
})

function afficheEmbarcation(db,type) {
    var output = [];
    var match = $("#searchEmbarcation").val().trim();

    $("#tableEmbarcation").empty();

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
        $("#tableEmbarcation").html("Aucun résultat n'a été trouvé");
    }
    else {
        var tr_str = " <thead><tr> " +
            "<th width='10%'>S.no</th> " +
            "<th width='30%'>Nom</th> " +
            "<th width='30%'>Localisation</th> ";

        tr_str+="</tr> </thead> " +
            "<tbody></tbody>";

        $("#tableEmbarcation").append(tr_str);

        for (var i = 0; i < len; i++) {
            var num = output[i].SIT_NUM;
            var nom = output[i].SIT_NOM;
            var localisation = output[i].SIT_LOCALISATION;

            tr_str = "<tr>" +
                "<td align='center'>" + num + "</td>" +
                "<td align='center'>" + nom + "</td>" +
                "<td align='center'>" + localisation + "</td>";
            tr_str+= "<td align='center'><a class='waves-effect waves-light btn modal-trigger' onclick='initModifEmbarcation("+num+")'>Modifier</a></td>" + "</tr>";

            $("#tableEmbarcation tbody").append(tr_str);
        }
        $('.tooltipped').tooltip();
    }
}

function initAjoutEmbarcation()
{
    console.log("coucou");
    $(document).ready(function(){
        $('#embarcationModal').modal('open');
    });

    $("#titreAjoutModifEmbarcation").html("Ajouter Embarcation");
    $("#numEmbarcation").html("");
    document.getElementById("nomEmbarcation").value = "";
    document.getElementById("localisationEmbarcation").value = "";
}

function initModifEmbarcation(num)
{
    $(document).ready(function(){
        $('#embarcationModal').modal('open');
    });

    numEmbarcation = num;

    $("#titreAjoutModifEmbarcation").html("Modifier Embarcation");
    $("#numEmbarcation").html("Numero : "+numEmbarcation);

    var data = getDataEmbarcation();
    document.getElementById("nomEmbarcation").value = data[0];
    document.getElementById("localisationEmbarcation").value = data[1];
}

function getDataEmbarcation()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetDataEmbarcation', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+numEmbarcation);

    return xhr.responseText.split('|');
}

function traitementEmbarcation()
{
    var nom = document.getElementById("nomEmbarcation").value;
    var localisation = document.getElementById("localisationEmbarcation").value;

    if(numEmbarcation != null)
    {
        var controller = "UpdateDataEmbarcation";
        var send = "&num="+numEmbarcation;
    }
    else
    {
        var controller = "AjoutDataEmbarcation";
        var send = "";
    }
    var xhr = initXHR();
    var embarcationValide = (nom.length>0) && (localisation.length>0);
    if (embarcationValide) {
        alert("Embarcation enregistré");
        xhr.open('POST', 'index.php?url=' + controller, false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("nom=" + nom + "&localisation=" + localisation + send);

        closeModal("embarcation");
    } else {
        alert("la embarcation   ne peut pas etre enregistré");
    }

    updateEmbarcation();
}
