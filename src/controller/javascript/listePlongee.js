var db_returnPlongee = null;
var mapProxyPlongeeLieu = new Map();
var mapProxyPlongeeEmbarcation = new Map();

function updatePlongee()
{
    if(mapProxyPlongeeLieu.size == 0)
    {
        getAllSite();
    }
    if(mapProxyPlongeeEmbarcation.size == 0)
    {
        getAllEmbarcation();
    }
    $(document).ready(function(){
        $.ajax({
            url: 'ListPlongee',
            type: 'post',
            data: 'archive='+$("#archive").is(':checked'),
            dataType: 'JSON',
            success: function(response1){
                db_returnPlongee = response1;
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
        affichePlongee(db_returnPlongee);
    });
})

function affichePlongee(db) {
    var separation = !$("#archive").is(':checked');
    var output = [];
    var match = $("#searchPlongee").val().trim();

    $("#tablePlongee").empty();

    if (match == '') {
        output = db;
    } else {
        var i = 0;
        db.forEach((item) => {
            if ((matMidSoi(item.PLO_MAT_MID_SOI).toLowerCase().indexOf(match.toLowerCase()) >= 0)||(item.PLO_ETAT.toLowerCase().indexOf(match.toLowerCase()) >= 0)||(item.PLO_DATE.toLowerCase().indexOf(match.toLowerCase()) >= 0)||(getDataSiteProxy(item.SIT_NUM).toLowerCase().indexOf(match.toLowerCase()) >= 0)||(getDataEmbarcationProxy(item.EMB_NUM).toLowerCase().indexOf(match.toLowerCase()) >= 0)) {
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
            "<th width='20%'>Etats</th> "+
            "<th width='20%'></th> ";

        tr_str+="</tr> </thead> " +
            "<tbody></tbody>";

        $("#tablePlongee").append(tr_str);

        for (var i = 0; i < len; i++) {
            var Date = output[i].PLO_DATE;
            var moment = output[i].PLO_MAT_MID_SOI;
            var Lieu = output[i].SIT_NUM;
            var embarcation = output[i].EMB_NUM;
            var etat = output[i].PLO_ETAT;

            var momentModif = matMidSoi(moment);
            Lieu = getDataSiteProxy(Lieu);
            embarcation = getDataEmbarcationProxy(embarcation);

            tr_str = "";

            if(separation && !estPasserOuPas(Date,moment))
            {
                tr_str += "<tr><td><td></tr>";
                separation = false;
            }

            tr_str += "<tr>" +
                "<td align='center'>" + momentModif + "</td>"+
                "<td align='center'>" + Date  + "</td>" +
                "<td align='center'>" + Lieu + "</td>" +
                "<td align='center'>" + embarcation + "</td>"+
                "<td align='center'>" + etat + "</td>";

            if(!$("#archive").is(':checked'))
            {
                tr_str+= "<td align='center'><a class='waves-effect waves-light btn' onclick='redirectionPlongee(\""+Date+"\",\""+moment+"\")'>Modifier</a></td>";
            }
            else
            {
                tr_str+= "<td align='center'><a class='waves-effect waves-light' href='Plongee&date="+Date+"&matMidSoi="+moment+"'><i class='material-icons black-text' >remove_red_eye</i></a></td>";
            }
            tr_str+= "</tr>";

            $("#tablePlongee tbody").append(tr_str);
        }
        $('.tooltipped').tooltip();
    }
}

function redirectionPlongee(date, moment)
{
    var form = $('<form action="Plongee" method="post">' +
        '<input type="text" name="date" value="' + date + '" />' +
        '<input type="text" name="moment" value="' + moment + '" />' +
        '</form>');

    $("body").append(form);
    form.submit();
}

function matMidSoi(moment)
{
    if(moment == 'A')
    {
        return "<i class='tooltipped material-icons' data-position='left' data-tooltip='Après-midi'>brightness_5</i>";
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

function getDataSiteProxy(num)
{
    if(mapProxyPlongeeLieu.get(num) == undefined)
    {
        mapProxyPlongeeLieu.set(num, getDataSite(num)[0]);
    }
    return mapProxyPlongeeLieu.get(num);
}

function getDataEmbarcationProxy(num)
{
    if(mapProxyPlongeeEmbarcation.get(num) == undefined)
    {
        mapProxyPlongeeEmbarcation.set(num, getDataEmbarcation(num)[0]);
    }
    return mapProxyPlongeeEmbarcation.get(num);
}

function getAllSite()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetAllDataSite', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    var res = xhr.responseText.split('|');

    for (var i = 0; i < res.length-1; i++)
    {
        var data = res[i].split(';');
        mapProxyPlongeeLieu.set(data[0], data[1]);
    }
}

function getAllEmbarcation()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetAllDataEmbarcation', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    var res = xhr.responseText.split('|');

    for (var i = 0; i < res.length-1; i++)
    {
        var data = res[i].split(';');
        mapProxyPlongeeEmbarcation.set(data[0], data[1]);
    }
}