<?php


class modelPalanquee extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_palanquee');
    }

    public function getPalanquee($numPalanquee){
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM PLO_PALANQUEE where PAL_NUM = :numPalanquee";

        $req = $pdo->prepare($sql);
        $req->bindParam(":numPalanquee",$numPalanquee);
        $req->execute();

        $palanquee = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $palanquee[0];
    }

    public function addPalanque($PLO_DATE,$PLO_MATIN_APRESMIDI,$PAL_NUM,$PAL_PROFONDEUR_MAX,$PAL_DUREE_MAX,$PAL_HEURE_IMMERSION,$PAL_HEURE_SORTIE_EAU,$PAL_PROFONDEUR_REELLE,$PAL_DUREE_FOND)
    {
        $statement = $this->getBdd()->prepare("INSERT INTO `PLO_PALANQUEE`(`PLO_DATE`, `PLO_MATIN_APRESMIDI`, `PAL_NUM`, `PAL_PROFONDEUR_MAX`, `PAL_DUREE_MAX`, `PAL_HEURE_IMMERSION`, `PAL_HEURE_SORTIE_EAU`, `PAL_PROFONDEUR_REELLE`, `PAL_DUREE_FOND`) VALUES (:PLO_DATE,:PLO_MATIN_APRESMIDI,:PAL_NUM,:PAL_PROFONDEUR_MAX,:PAL_DUREE_MAX,:PAL_HEURE_IMMERSION,:PAL_HEURE_SORTIE_EAU,:PAL_PROFONDEUR_REELLE,:PAL_DUREE_FOND)");

        $statement->bindParam(':PLO_DATE', $PLO_DATE);
        $statement->bindParam(':PLO_MATIN_APRESMIDI', $PLO_MATIN_APRESMIDI);
        $statement->bindParam(':PAL_NUM', $PAL_NUM);
        $statement->bindParam(':PAL_PROFONDEUR_MAX', $PAL_PROFONDEUR_MAX);
        $statement->bindParam(':PAL_DUREE_MAX', $PAL_DUREE_MAX);
        $statement->bindParam(':PAL_HEURE_IMMERSION', $PAL_HEURE_IMMERSION);
        $statement->bindParam(':PAL_HEURE_SORTIE_EAU', $PAL_HEURE_SORTIE_EAU);
        $statement->bindParam(':PAL_PROFONDEUR_REELLE', $PAL_PROFONDEUR_REELLE);
        $statement->bindParam(':PAL_DUREE_FOND', $PAL_DUREE_FOND);

        $res = $statement->execute();
        return $res;
    }

    public function modifyPersonne($PER_NUM, $PER_NOM, $PER_PRENOM)
    {
        $statement = $this->getBdd()->prepare("UPDATE PLO_PERSONNE SET PER_NOM = :PER_NOM, PER_PRENOM = :PER_PRENOM WHERE PER_NUM = :PER_NUM");

        $statement->bindParam(':PER_NUM', $PER_NUM);
        $statement->bindParam(':PER_NOM', $PER_NOM);
        $statement->bindParam(':PER_PRENOM', $PER_PRENOM);

        $res = $statement->execute();
        return $res;
    }

    public function statePersonne($PER_NUM, $VAL)
    {
        $statement = $this->getBdd()->prepare("UPDATE PLO_PERSONNE SET PER_ACTIVE = :VAL WHERE PER_NUM = :PER_NUM");

        $statement->bindParam(':PER_NUM', $PER_NUM);
        $statement->bindParam(':VAL', $VAL);

        $res = $statement->execute();
        return $res;
    }
}