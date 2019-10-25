function initAjoutPalanquee()
{
    var xhr = initXHR();

    xhr.open('POST', 'index.php?url=AjouterPlongeurPalanque', false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    $("#plongeurPalanquee").html(xhr.responseText);

    $(document).ready(function(){
        $('#newPalanqueeModal').modal('open');
    });
}