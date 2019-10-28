var db_returnPlongee = null;

function updatePlongee(){
    $(document).ready(function(){
        $.ajax({
            url: 'ListPlongee',
            type: 'get',
            dataType: 'JSON',
            success: function(response1){
                db_returnSite = response1;
                affichePlongee(response1);
            },
            error: function (response1) {
                alert("erreur de chargement des données");
                console.log(response1);
            }
        });
    });
}

$(document).ready(function () {
    $("#searchPlongee").keyup(function() {
        affichePlongee(db_returnSite);
    });
})

function affichePlongee(db) {
    var output = [];
    var match = $("#searchPlongee").val().trim();

    $("#tablePlongee").empty();

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
        $("#tablePlongee").html("Aucun résultat n'a été trouvé");
    }
    else {
        var tr_str = " <thead><tr> " +
            "<th width='0%'></th> "+
            "<th width='13%'>Période</th> " +
            "<th width='20%'>Lieu</th> " +
            "<th width='20%'>Embarcation</th> "+
            "<th width='20%'>Directeur</th> "+
            "<th width='20%'>Sécurité de surface</th> ";

        tr_str+="</tr> </thead> " +
            "<tbody></tbody>";

        $("#tablePlongee").append(tr_str);

        for (var i = 0; i < len; i++) {
            var Date = output[i].PLO_DATE;
            var moment = output[i].PLO_MAT_MID_SOI;
            var Lieu = output[i].SIT_NUM;
            var embarcation = output[i].EMB_NUM;
            var directeur = output[i].PER_NUM_DIR;
            var securite = output[i].PER_NUM_SECU;

            var momentModif = matMidSoi(moment);
            Lieu = getDataSite(Lieu)[0];
            embarcation = getDataEmbarcation(embarcation)[0];
            directeur = getPrenom(directeur);
            securite = getPrenom(securite);

            tr_str = "<tr>" +
                "<td align='center'>" + momentModif + "</td>"+
                "<td align='center'>" + Date  + "</td>" +
                "<td align='center'>" + Lieu + "</td>" +
                "<td align='center'>" + embarcation + "</td>"+
                "<td align='center'>" + directeur + "</td>" +
                "<td align='center'>" + securite + "</td>";
            tr_str+= "<td align='center'><a class='waves-effect waves-light btn modal-trigger' href='Plongee&date="+Date+"&matMidSoi="+moment+"'>Modifier</a></td>";
            tr_str+= "</tr>";

            $("#tablePlongee tbody").append(tr_str);
        }
        $('.tooltipped').tooltip();
    }
}

function matMidSoi(moment)
{
    if(moment == 'A')
    {
        return "<i class='tooltipped material-icons' data-position='left' data-tooltip='Aprés-Midi'>brightness_5</i>";
    }
    else if(moment == 'M')
    {
        return "<i class='tooltipped material-icons' data-position='left' data-tooltip='Matin'>brightness_1</i>";
    }
    else if(moment == 'S')
    {
        return "<i class='tooltipped material-icons' data-position='left' data-tooltip='Soir'>brightness_3</i>";
    }
}