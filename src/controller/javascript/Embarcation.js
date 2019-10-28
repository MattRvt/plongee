var mapProxyEmbarcation = new Map();
var numEmbarcation = null;
var db_returnEmbarcation  = null;

function updateEmbarcation() {

    $(document).ready(function () {
        $.ajax({
            url: 'ListeEmbarcation',
            type: 'get',
            dataType: 'JSON',
            success: function (response1) {
                db_returnEmbarcation  = response1;
                afficheEmbarcation(response1);
            },
            error: function (response1) {
                alert("erreur de chargement des données");
                console.log(response1);
            }
        });
    });
}

$(document).ready(function () {
    $("#searchEmbarcation").keyup(function() {
        afficheEmbarcation(db_returnEmbarcation );
    });
})

function afficheEmbarcation(db) {
    var output = [];
    var match = $("#searchEmbarcation").val().trim();

    $("#tableEmbarcation").empty();

    if (match == '') {
        output = db;
    } else {
        var i = 0;
        db.forEach((item) => {
            if (item.EMB_NOM.toLowerCase().indexOf(match.toLowerCase()) >= 0) {
                output[i] = item;
                i++;
            }
        })
    }

    var len = output.length;


    if (len == 0) {
        $("#tableEmbarcation").html("Aucun résultat n'a été trouvé");
    } else {
        var tr_str = " <thead><tr> " +
            "<th width='10%'>Emb.no</th> " +
            "<th width='30%'>Nom</th> ";

        tr_str += "</tr> </thead> " +
            "<tbody></tbody>";

        $("#tableEmbarcation").append(tr_str);

        for (var i = 0; i < len; i++) {
            var num = output[i].EMB_NUM;
            var nom = output[i].EMB_NOM;

            tr_str = "<tr>" +
                "<td align='center'>" + num + "</td>" +
                "<td align='center'>" + nom + "</td>";
            tr_str += "<td align='center'><a class='waves-effect waves-light btn modal-trigger' onclick='initModifEmbarcation(" + num + ")'>Modifier</a></td>";

            if(!isUseEmbarcationProxy(num))
            {
                tr_str+= "<td align='center'><a onclick=''><i class='small material-icons red-text'>clear</i></a></td>"
            }

            tr_str += "</tr>";

            $("#tableEmbarcation tbody").append(tr_str);
        }
        $('.tooltipped').tooltip();
    }
}

function initAjoutEmbarcation() {
    $(document).ready(function () {
        $('#embarcationModal').modal('open');
    });

    numEmbarcation = null;

    $("#titreAjoutModifEmbarcation").html("Ajouter Embarcation");
    $("#numEmbarcation").html("");
    document.getElementById("nomEmbarcation").value = "";
}

function initModifEmbarcation(num) {
    $(document).ready(function () {
        $('#embarcationModal').modal('open');
    });

    numEmbarcation = num;

    $("#titreAjoutModifEmbarcation").html("Modifier Embarcation");
    $("#numEmbarcation").html("Numero : " + numEmbarcation);

    var data = getDataEmbarcation();
    document.getElementById("nomEmbarcation").value = data[0];
}

function getDataEmbarcation() {
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetDataEmbarcation', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num=" + numEmbarcation);

    return xhr.responseText.split('|');
}

function traitementEmbarcation() {

    var nom = document.getElementById("nomEmbarcation").value;

    if (numEmbarcation != null) {
        var controller = "UpdateDataEmbarcation";
        var send = "&num=" + numEmbarcation;
    } else {
        var controller = "AjoutDataEmbarcation";
        var send = "";
    }
    var xhr = initXHR();
    //test si les champs sont rempli
    var embarcationValide = (nom.length > 0);
    if (embarcationValide) {

        alert("Embarcation enregistré");
        xhr.open('POST', 'index.php?url=' + controller, false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("nom=" + nom + send);

        closeModal("embarcation");
    } else {
        alert("l'embarcation   ne peut pas etre enregistré");
    }

    updateEmbarcation();
}

function isUseEmbarcationProxy(num)
{
    if(mapProxyEmbarcation.get(num) == undefined)
    {
        mapProxyEmbarcation.set(num, isUseEmbarcation(num));
    }
    return mapProxyEmbarcation.get(num);
}

function isUseEmbarcation(num)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=isUse', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+num+"&name=Embarcation");

    return xhr.responseText;
}
