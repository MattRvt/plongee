/**
 *
 * @param type
 */
function validation(type)
{
    var ans = verification(type,0);
    var item = itemType(type);

    if (ans==1)
        item.style.boxShadow = "0px 0px 40px 0px rgba(0,242,24,1)";
    else
        item.style.boxShadow = "0px 0px 40px 0px rgba(255,8,8,1)";
}

/**
 *
 * @param actif
 * @param val
 * @returns {string}
 */
function verification(actif,val)
{
    var xhr = initXHR();
    var item;
    xhr.open('POST', 'index.php?url=Verification', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    item = itemType(actif);

    xhr.send('type='+actif+'&string='+item.value+'&getstr='+val);
    var resp = xhr.responseText;

    return resp;
}

function verification2(string, actif, val)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=Verification', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send('type='+actif+'&string='+string+'&getstr='+val);
    var resp = xhr.responseText;
    return resp;
}

/**
 *
 * @param type
 * @returns {HTMLElement}
 */
function itemType(type)
{
    var id = getType(type);

    var item = document.getElementById(id);

    return item;

}

/**
 *
 * @param type
 * @returns {string}
 */
function getType(type){
    if (type == 0)
        id = "nomPlongeur";
    else
        id = "prenomPlongeur";
    return id;
}



function unfocus(id) {
    document.getElementById(id).style.boxShadow = "0px 0px 0px 0px rgba(0,0,0,1)";
}

function verifSubmitPersonne()
{
    var form = document.getElementById('send');
    if (verification(0,0)==1 && verification(1,0)==1){
        form.action = "ListePersonne";
        document.getElementById("nom").value = verification(0,1);
        document.getElementById("prenom").value = verification(1,1);
    }
    else {
        form.action = "";
    }
}

function afficheErreur(id){
    var type = getType(id);
    var res = verification(id,0);
    if (res==0){
        var span = "span"+type;
        document.getElementById(span).innerHTML = "Erreur : le "+type+" contient des caractères non-autorisés. <br/><br/>";
    }
}

function exist(nom, prenom) {
    var t_nom = verification2(nom,0,1);
    var t_prenom = verification2(prenom,1,1);

    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=ExistePersonne', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send('nom='+t_nom+'&prenom='+t_prenom);
    var personne= xhr.responseText;

    if (!(personne>= 1)){
        return false;
    }
    else {
        return true;
    }
}