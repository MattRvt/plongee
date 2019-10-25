var db_return = null;

function initListPers()
{
    updateNonPlongeur();
}


$(document).ready(function(){
    $.ajax({
        url: 'ListePlongeur',
        type: 'get',
        dataType: 'JSON',
        success: function(response){
            db_return = response;
            affichePlongeur(response);
        }
    });
});

$(document).ready(function () {
    $("#search").keyup(function() {
        affichePlongeur(db_return);
    });
})

function affichePlongeur(db) {
    var output = [];
    var match = $("#search").val().trim();
    $("#userTable tbody").empty();
    if (match == '') {
        output = db;
    } else {
        var i = 0;
        db.forEach((item) => {
            if ((item.PER_NUM.toLowerCase().indexOf(match.toLowerCase()) >= 0) || (item.PER_NOM.toLowerCase().indexOf(match.toLowerCase()) >= 0) || (item.PER_PRENOM.toLowerCase().indexOf(match.toLowerCase()) >= 0)) {
                output[i] = item;
                i++;
            }
        })
    }

    var len = output.length;
    for (var i = 0; i < len; i++) {
        var num = output[i].PER_NUM;
        var nom = output[i].PER_NOM;
        var prenom = output[i].PER_PRENOM;

        var actif = output[i].PER_ACTIVE;
        var certif = output[i].PER_DATE_CERTIF_MED;
        var aptcode = output[i].APT_CODE;

        var dir = output[i].DIR;
        var secu = output[i].SECU;

        dir = dir.replace("dir","<i class='tooltipped material-icons' data-position='left' data-tooltip='Directeur'>assignment</i>");
        secu = secu.replace("secu","<i class='material-icons tooltipped' data-position='left' data-tooltip='Sécurité de surface'>pan_tool</i>");

        var tr_str = "<tr>" +
            "<td align='center'> " + dir + secu +"</td>" +
            "<td align='center'>" + num + "</td>" +
            "<td align='center'>" + nom + "</td>" +
            "<td align='center'>" + prenom + "</td>" +
            "<td align='center'>" + actif + "</td>" +
            "<td align='center'>" + certif + "</td>" +
            "<td align='center'>" + aptcode + "</td>" +
            "<td align='center'> <a class='waves-effect waves-light btn modal-trigger' onclick='initModalAjoutPers(" + num + ")'>Modifier</a> </td>" +
            "</tr>";

        $("#userTable tbody").append(tr_str);
        $('.tooltipped').tooltip();

    }
}

function updateNonPlongeur()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=ListeNonPlongeur', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    $("#listNonPlongeur").html(xhr.responseText);
}