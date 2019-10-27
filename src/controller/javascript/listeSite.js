var db_returnP = null;
var db_returnNP = null;

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
            tr_str+= "<td align='center'><a class='waves-effect waves-light btn modal-trigger' onclick=''>Modifier</a></td>" + "</tr>";

            $("#tableSite tbody").append(tr_str);
        }
        $('.tooltipped').tooltip();
    }
}
