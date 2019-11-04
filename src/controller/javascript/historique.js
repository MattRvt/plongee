function getHisto()
{
    $(document).ready(function(){
        $.ajax({
            url: 'Historique',
            type: 'post',
            data: 'histo=0',
            dataType: 'JSON',
            success: function(response1){
                afficheHisto(response1,"last");
            },
            error: function (response1) {
                alert("erreur de chargement des données");
                console.log(response1);
            }
        });
    });
    $(document).ready(function(){
        $.ajax({
            url: 'Historique',
            type: 'post',
            data: 'histo=1',
            dataType: 'JSON',
            success: function(response2){
                afficheHisto(response2,"next");
            },
            error: function (response2) {
                alert("erreur de chargement des données");
                console.log(response2);
            }
        });
    });
}

function afficheHisto(db, id) {
    var tr_str = " <thead><tr> " +
        "<th width='5%'></th> " +
        "<th width='25%'>Période</th> " +
        "<th width='20%'>Lieu</th> " +
        "<th width='20%'>Embarcation</th> ";

    tr_str += "</tr> </thead> " +
        "<tbody></tbody>";

    $("#"+id).append(tr_str);

    for (var i = 0; i < 3; i++) {
        var Date = db[i].PLO_DATE;
        var moment = db[i].PLO_MAT_MID_SOI;
        var Lieu = db[i].SIT_NUM;
        var embarcation = db[i].EMB_NUM;

        var momentModif = matMidSoi(moment);
        Lieu = getDataSiteProxy(Lieu);
        embarcation = getDataEmbarcationProxy(embarcation);

        tr_str = "";
        tr_str += "<tr>" +
            "<td align='center'>" + momentModif + "</td>" +
            "<td align='center'>" + Date + "</td>" +
            "<td align='center'>" + Lieu + "</td>" +
            "<td align='center'>" + embarcation + "</td>";
        tr_str += "</tr>";

        $("#"+id+" tbody").append(tr_str);
    }
    $('.tooltipped').tooltip();
}