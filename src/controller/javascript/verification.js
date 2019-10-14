

function verification(type)
{
    var xhr = initXHR();
    xhr.open('POST', 'index.php?url=Verification', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var id;
    if (type == 0)
        id = "nom";
    else
        id = "prenom";

    var item = document.getElementById(id)

    xhr.send('type='+type+'&string='+item.value+'');
    var resp = xhr.responseText;

    if (resp == 1){
        item.style.boxShadow = "0px 0px 40px 0px rgba(0,242,24,1)";
    }
    else {
        item.style.boxShadow = "0px 0px 40px 0px rgba(255,8,8,1)";
    }
    return resp;
}

function unfocus(id) {
    document.getElementById(id).style.boxShadow = "0px 0px 0px 0px rgba(0,242,24,1)";
}

