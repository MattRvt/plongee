var db_returnP = null;
var db_returnNP = null;
var db_actifP = [];
var db_actifNP = [];

/**
 *
 */
function update(){
    $(document).ready(function(){
        $.ajax({
            url: 'ListePlongeur',
            type: 'get',
            dataType: 'JSON',
            success: function(response1){
                db_returnP = response1;
                affichePlongeur(response1,0);
            }
        });
    });

    $(document).ready(function(){
        $.ajax({
            url: 'ListeNonPlongeur',
            type: 'get',
            dataType: 'JSON',
            success: function(response2){
                db_returnNP = response2;
                affichePlongeur(response2,1);
            }
        });
    });
}

$(document).ready(function () {
    $("#search").keyup(function() {
        if ($("#checkactif").is(':checked')){
            affichePlongeur(db_returnP,0);
            affichePlongeur(db_returnNP,1);
        }
        else {
            affichePlongeur(db_actifP,0);
            affichePlongeur(db_actifNP,1);
        }
    });
});

$(document).ready(function () {
    $("#checkactif").change(function () {
        if (!$("#checkactif").is(':checked')) {
            if (db_actifP.length === 0) {
                db_returnP.forEach((item) => {
                    if (item.PER_ACTIVE == 1) {
                        db_actifP.push(item);
                    }
                });
                db_returnNP.forEach((item) => {
                    if (item.PER_ACTIVE == 1) {
                        db_actifNP.push(item);
                    }
                });
            }
            affichePlongeur(db_actifP, 0);
            affichePlongeur(db_actifNP, 1);
        } else {
            affichePlongeur(db_returnP, 0);
            affichePlongeur(db_returnNP, 1);
        }
    })
});

/**
 *
 * @param db
 * @param type
 */
function affichePlongeur(db,type) {
    var output = [];
    var match = $("#search").val().trim();

    if (!type)  $("#tablePlongeur").empty();
    else  $("#tableNonPlongeur").empty();

    if (match == '') {
        output = db;
    } else {
        db.forEach((item) => {
            if ((item.PER_NUM.toLowerCase().indexOf(match.toLowerCase()) >= 0) || (item.PER_NOM.toLowerCase().indexOf(match.toLowerCase()) >= 0) || (item.PER_PRENOM.toLowerCase().indexOf(match.toLowerCase()) >= 0)) {
                output.push(item);
            }
        })
    }

    var len = output.length;
    if (len == 0){
        if (!type) $("#tablePlongeur").html("Aucun résultat n'a été trouvé");
        else $("#tableNonPlongeur").html("Aucun résultat n'a été trouvé");
    }
    else {
        var tr_str = " <thead><tr> " +
            "<th width='10%'>Rôle</th> " +
            "<th width='5%'>S.no</th> " +
            "<th width='20%'>Nom</th> " +
            "<th width='20%'>Prenom</th> " +
            "<th width='5%'>Actif</th> " ;
        if (!type) tr_str+="<th width='20%'>Certif</th> <th width='20%'>Apt-code</th> ";
        else  tr_str+="<th width='40%'>Certif</th>";
             tr_str+="</tr> </thead> " +
                 "<tbody></tbody>";

        if (!type)   $("#tablePlongeur").append(tr_str);
        else   $("#tableNonPlongeur").append(tr_str);

        for (var i = 0; i < len; i++) {
            var num = output[i].PER_NUM;
            var nom = output[i].PER_NOM;
            var prenom = output[i].PER_PRENOM;

            var actif = output[i].PER_ACTIVE;
            var certif = output[i].PER_DATE_CERTIF_MED;
            if (!type) var aptcode = output[i].APT_CODE;

            var dir = output[i].DIR;
            var secu = output[i].SECU;

            if (actif == 1) {
                actif = "<i class='small material-icons green-text'>check</i>";
            } else {
                actif = "<i class='small material-icons red-text'>clear</i>"
            }

            dir = dir.replace("dir", "<i class='tooltipped material-icons' data-position='left' data-tooltip='Directeur'>assignment</i>");
            secu = secu.replace("secu", "<i class='material-icons tooltipped' data-position='left' data-tooltip='Sécurité de surface'>pan_tool</i>");
            var today = new Date();
            var dateDebutCertif = new Date(certif);
            var dateFinCertif = new Date(dateDebutCertif.getFullYear() + 1, dateDebutCertif.getMonth(), dateDebutCertif.getDate());
            var certifValide = dateFinCertif > today;
            tr_str = "<tr>" +
                "<td align='center'> " + dir + secu + "</td>" +
                "<td align='center'>" + num + "</td>" +
                "<td align='center'>" + nom + "</td>" +
                "<td align='center'>" + prenom + "</td>" +
                "<td align='center'>" + actif + "</td>";
            if (certifValide) {
                tr_str = tr_str + "<td align='center'>" + certif + "</td>";
            }
            else if (certif == "0000-00-00"){
                tr_str = tr_str + "<td align='center' class='red'> <strong>Aucun certificat</strong></td>";
            }
            else {
                tr_str = tr_str +"<td align='center' class='red' > <strong>" + certif + "</strong></td>";
            }

            if (!type) tr_str += "<td align='center'>" + aptcode + "</td>";
            tr_str += "<td align='center'> <a class='waves-effect waves-light btn' onclick='initModalAjoutPers(" + num + ")'>Modifier</a> </td>" +
                "</tr>";

            if (!type) $("#tablePlongeur tbody").append(tr_str);
            else $("#tableNonPlongeur tbody").append(tr_str);
        }
        $('.tooltipped').tooltip();
    }
}
