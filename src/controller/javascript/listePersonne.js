function initListPers()
{
    updatePlongeur();
    updateNonPlongeur();
}

function updatePlongeur()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=ListePlongeur', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    $("#listPlongeur").html(xhr.responseText);
}

function updateNonPlongeur()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=ListeNonPlongeur', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    $("#listNonPlongeur").html(xhr.responseText);
}