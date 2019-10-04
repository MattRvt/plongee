<?php $this->_title = "historique des palanquées" ?>
historique des palanquees etant partie en mer:
<?php

$palanquee = $this->controller->selectPalanquee();

print_r ( $palanquee);
?>