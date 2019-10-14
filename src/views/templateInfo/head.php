<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<!-- materialize -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

<!-- Javascript Projet -->
<script src="controller/javascript/ajax.js"></script>
<script src="controller/javascript/ajoutPersonne.js"></script>
<script src="controller/javascript/verification.js"></script>

<!-- Css projet -->
<link rel="stylesheet" href="views/Css/modal.css">

<!-- Initialisation Materialize -->
<script>
    $(document).ready(function(){
        $('.modal').modal();
    });

    $(document).ready(function(){
        $('select').formSelect();
    });

    $(document).ready(function(){
        $('.datepicker').datepicker();
    });

    $(document).ready(function(){
        $('.collapsible').collapsible();
    });

    $(document).ready(function(){
        $('.datepicker').datepicker();
    });
</script>
