var db_returnP = null;
var numSite = null;

function updateAptitude(){
    $(document).ready(function(){
        $.ajax({
            url: 'ListeAptitude',
            type: 'get',
            dataType: 'JSON',
            success: function(response1){
                db_returnP = response1;
                afficheSite(response1);
            }
        });
    });
}

$(document).ready(function () {
    $("#searchAptitude").keyup(function() {
        afficheSite(db_returnP);
    });
})

function afficheSite(db) {
    var output = [];
    var match = $("#searchAptitude").val().trim();

    $("#tableAptitude").empty();

    if (match == '') {
        output = db;
    } else {
        var i = 0;
        db.forEach((item) => {
            if ((item.APT_CODE.toLowerCase().indexOf(match.toLowerCase()) >= 0) || (item.APT_LIBELLE.toLowerCase().indexOf(match.toLowerCase()) >= 0)) {
                output[i] = item;
                i++;
            }
        })
    }

    var len = output.length;
    if (len == 0){
        $("#tableAptitude").html("Aucun résultat n'a été trouvé");
    }
    else {
        var tr_str = " <thead><tr> " +
            "<th width='30%'>Code</th> " +
            "<th width='30%'>Libelle</th> ";

        tr_str+="</tr> </thead> " +
            "<tbody></tbody>";

        $("#tableAptitude").append(tr_str);

        for (var i = 0; i < len; i++) {
            var code = output[i].APT_CODE;
            var libelle = output[i].APT_LIBELLE;

            tr_str = "<tr>" +
                "<td align='center'>" + code + "</td>" +
                "<td align='center'>" + libelle + "</td>";
            tr_str+= "<td align='center'><a class='waves-effect waves-light btn modal-trigger' onclick=''>Modifier</a></td>" + "</tr>";

            $("#tableAptitude tbody").append(tr_str);
        }
        $('.tooltipped').tooltip();
    }
}