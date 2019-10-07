<?php $this->_title = "historique des palanquées" ?>
historique des palanquees etant partie en mer:
<?php

$palanquee = $this->controller->selectPalanquee();
echo "<pre>";

print_r ( $palanquee);
echo "</pre>"
?>