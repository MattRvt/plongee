/**
 *
 * @param modal
 */
function closeModal(modal)
{
    var ref = '#'+modal+"Modal";
    $(document).ready(function(){
        $(ref).modal('close');
    });
}