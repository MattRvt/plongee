<meta charset="utf-8" />
Numero d'identification: <?php $Personne = $this->controller->selectPersonne(4); //Apres recup $_POST['PER_NUM'] et echo
            $numPersonne = $Personne['PER_NUM'];
            echo $numPersonne;?> <br/>
Nom: <?php $nomPersonne = $Personne['PER_NOM'];;
            echo $nomPersonne;?> <br/>
Prénom: <?php $prenomPersonne = $Personne['PER_PRENOM'];;
            echo $prenomPersonne;?> <br/>
Aptitude: <?php  $Plongeur = $this->controller->selectPlongeur($numPersonne);
                $aptitudePlongeur = $Plongeur['APT_CODE'];
            echo $aptitudePlongeur;?> <br/>