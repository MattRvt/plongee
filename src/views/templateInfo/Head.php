<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<!-- materialize -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="views/Css/materialize.min.css"  media="screen,projection"/>

<!-- Javascript Projet -->
<script src="controller/javascript/listePersonne.js"></script>
<script src="controller/javascript/ajax.js"></script>
<script src="controller/javascript/ajoutPersonne.js"></script>
<script src="controller/javascript/ajoutPalanquee.js"></script>
<script src="controller/javascript/verification.js"></script>
<script src="controller/javascript/modal.js"></script>
<script src="controller/javascript/listePalanquee.js"></script>
<script src="controller/javascript/Site.js"></script>
<script src="controller/javascript/Embarcation.js"></script>
<script src="controller/javascript/Aptitude.js"></script>
<script src="controller/javascript/listePlongee.js"></script>

<!-- Css projet -->
<link rel="stylesheet" href="views/Css/modal.css">
<link rel="stylesheet" href="views/Css/navbar.css">

<!-- Initialisation Materialize -->
<script>
    $(document).ready(function(){
        $('.modal').modal();
    });

    $(document).ready(function(){
        $('select').formSelect();
    });

    $(document).ready(function(){
        $(".dropdown-trigger").dropdown();
    });

    $(document).ready(function(){
        $('.sidenav').sidenav();
    });

    $(document).ready(function(){
        $('.tooltipped').tooltip();
    });

    $(document).ready(function(){
        $('.datepicker').datepicker();
    });
</script>
