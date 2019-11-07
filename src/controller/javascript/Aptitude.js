var db_returnAptitude = null;
var codeApt = null;
var mapProxyAptitude = new Map();

function updateAptitude(){
    if(mapProxyAptitude.size == 0)
    {
        isAllUseAptitude();
    }
    $(document).ready(function(){
        $.ajax({
            url: 'ListeAptitude',
            type: 'get',
            dataType: 'JSON',
            success: function(response1){
                db_returnAptitude = response1;
                afficheAptitude(response1);
            }
        });
    });
}

$(document).ready(function () {
    $("#searchAptitude").keyup(function() {
        afficheAptitude(db_returnAptitude);
    });
});

function afficheAptitude(db) {
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

            tr_str+= "<td align='center'><a class='waves-effect waves-light btn' onclick='initModifAptitude(\""+code+"\")'>Modifier</a></td>";

            if(!isUseAptitudeProxy(code))
            {
                tr_str+= "<td align='center'><a onclick='supprimerAptitude(\""+code+"\")'><i class='small material-icons red-text'>clear</i></a></td>"
            }

            tr_str += "</tr>";

            $("#tableAptitude tbody").append(tr_str);
        }
        $('.tooltipped').tooltip();
    }
}

function initAjoutAptitude()
{
    $(document).ready(function(){
        $('#aptitudeModal').modal('open');
    });

    codeApt = null;

    $("#titreAjoutModifAptitude").html("Ajouter Aptitude");
    $("#aptCode").html("<input type='text' id='codeAptitude' name='codeAptitude' required><br />");
    document.getElementById("codeAptitude").value = "";
    document.getElementById("libelleAptitude").value = "";
}

function initModifAptitude(code)
{

    $(document).ready(function(){
        $('#aptitudeModal').modal('open');
    });

    codeApt = code;

    $("#titreAjoutModifAptitude").html("modifier Aptitude");

    var data = getDataAptitude();
    $("#aptCode").html("Code : "+codeApt);
    document.getElementById("libelleAptitude").value = data[1];
}

function getDataAptitude()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=GetDataAptitude', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("code="+codeApt);

    return xhr.responseText.split('|');
}

function traitementAptitude()
{
    var libelle = document.getElementById("libelleAptitude").value;
    var code = "";

    if(codeApt != null)
    {
        var controller = "UpdateDataAptitude";
        code = codeApt;
    }
    else
    {
        var controller = "AjoutDataAptitude";
        code = document.getElementById("codeAptitude").value;
    }

    var xhr = initXHR();
    var aptitudeValide = (code.length>0) && (libelle.length>0);
    if (aptitudeValide) {
        M.toast({html: 'Aptitude enregistré'});
        xhr.open('POST', 'index.php?url=' + controller, false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("newCode=" + code + "&libelle=" + libelle);

        closeModal("aptitude");
    } else {
        alert("L'aptitude ne peut pas être enregistré");
    }

    updateAptitude();
}

function isUseAptitudeProxy(code)
{
    if(mapProxyAptitude.get(code) == undefined)
    {
        mapProxyAptitude.set(code, isUseAptitude(code));
    }
    return mapProxyAptitude.get(code);
}

function isUseAptitude(code)
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=IsUse', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("num="+code+"&name=Aptitude");

    return xhr.responseText;
}

function supprimerAptitude(code)
{
    if(confirm("Êtes-vous sur de supprimer cette aptitude ?")) {
        var xhr = initXHR();

        xhr.open('POST', 'index.php?url=Supprimer', false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("num=" + code + "&name=Aptitude");

        updateAptitude();
    }
}

function isAllUseAptitude()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=IsAllUse', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("name=Aptitude&param=APT_CODE");

    var res = xhr.responseText.split('|');
    var use = res[0].split(" ");
    var nonUse = res[1].split(" ");

    for (var i = 0; i < use.length; i++)
    {
        mapProxyAptitude.set(use[i], true);
    }
    for (var i = 0; i < nonUse.length; i++)
    {
        mapProxyAptitude.set(nonUse[i], false);
    }
}