<?php $this->_title = "Accueil"?>
<?php
    echo "<h1 style='color:blue;' align='center'>Accueil</h1>";
    
    echo "<h3 style='color:blue;' align='center'>Dernières plongées</h3>";
    print_r($this->controller->afficherDernieresPlongee()); ?>
    <div class="container">
        <table class ="centered" border="1" >
        </table>
    </div>

    <?php echo "<h3 style='color:blue;' align='center'>Prochaines plongées</h3>";
    print_r($this->controller->afficherProchainesPlongee());?>



