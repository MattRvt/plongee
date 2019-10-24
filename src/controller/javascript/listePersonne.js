function initListPers()
{
    updatePlongeur();
    updateNonPlongeur();
}

function updatePlongeur()
{
    $(document).ready(function(){
        $.ajax({
            url: 'ListePlongeur',
            type: 'get',
            dataType: 'JSON',
            success: function(response){
                var len = response.length;
                for(var i=0; i<len; i++){
                    var num = response[i].PER_NUM;
                    var nom = response[i].PER_NOM;
                    var prenom = response[i].PER_PRENOM;

                    var actif = response[i].PER_ACTIVE;
                    var certif = response[i].PER_DATE_CERTIF_MED;
                    var aptcode = response[i].APT_CODE;

                    var tr_str = "<tr>" +
                        "<td align='center'>" + num + "</td>" +
                        "<td align='center'>" + nom + "</td>" +
                        "<td align='center'>" + prenom + "</td>" +
                        "<td align='center'>" + actif + "</td>" +
                        "<td align='center'>" + certif + "</td>" +
                        "<td align='center'>" + aptcode + "</td>" +
                        "<td align='center'> <input type='button' value='Modifier Plongeur' onclick=\"window.location.href='ModifierPlongeur&param=" + num + "'\"> </td>" +
                        "</tr>";

                    $("#userTable tbody").append(tr_str);
                }

            }
        });
    });
}

function updateNonPlongeur()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=ListeNonPlongeur', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    $("#listNonPlongeur").html(xhr.responseText);
}