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

    public function modifyPalanquee($PAL_NUM, $PLO_DATE, $PLO_MAT_MID_SOI, $PAL_PROFONDEUR_MAX, $PAL_DUREE_MAX, $PAL_HEURE_IMMERSION, $PAL_HEURE_SORTIE_EAU, $PAL_PROFONDEUR_REELLE, $PAL_DUREE_FOND)
    {
        $statement = $this->getBdd()->prepare("UPDATE PLO_PALANQUEE SET PLO_DATE = :PLO_DATE, PLO_MAT_MID_SOI = :PLO_MAT_MID_SOI, PAL_PROFONDEUR_MAX = :PAL_PROFONDEUR_MAX, PAL_DUREE_MAX = :PAL_DUREE_MAX, PAL_HEURE_IMMERSION = :PAL_HEURE_IMMERSION, PAL_HEURE_SORTIE_EAU = :PAL_HEURE_SORTIE_EAU, PAL_PROFONDEUR_REELLE = :PAL_PROFONDEUR_REELLE, PAL_DUREE_FOND = :PAL_DUREE_FOND  WHERE PAL_NUM = :PAL_NUM");

        $statement->bindParam(':PLO_DATE', $PLO_DATE);
        $statement->bindParam(':PLO_MAT_MID_SOI', $PLO_MAT_MID_SOI);
        $statement->bindParam(':PAL_PROFONDEUR_MAX', $PAL_PROFONDEUR_MAX);
        $statement->bindParam(':PAL_DUREE_MAX', $PAL_DUREE_MAX);
        $statement->bindParam(':PAL_HEURE_IMMERSION', $PAL_HEURE_IMMERSION);
        $statement->bindParam(':PAL_HEURE_SORTIE_EAU', $PAL_HEURE_SORTIE_EAU);
        $statement->bindParam(':PAL_PROFONDEUR_REELLE', $PAL_PROFONDEUR_REELLE);
        $statement->bindParam(':PAL_DUREE_FOND', $PAL_DUREE_FOND);
        $statement->bindParam(':PAL_NUM', $PAL_NUM);

        $res = $statement->execute();
        return $res;
    }

    public function getDansPlongee($date,$moment){
        $pdo = $this->getBdd();

        $sql = "select * from PLO_PALANQUEE where (PLO_DATE = '".$date."') and (upper(PLO_MAT_MID_SOI) = upper('".$moment."'))";
        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function getNbPlongeur($date, $matMidSoir, $palNum)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT count(*) FROM `PLO_CONCERNER` WHERE plo_date = '".$date."' and plo_mat_mid_soi = '".$matMidSoir."' and pal_num = ".$palNum;

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function getPlongeur($date, $matMidSoir, $palNum)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM `PLO_CONCERNER` join `PLO_PLONGEUR` using(PER_NUM) join `PLO_PERSONNE` using(PER_NUM) WHERE plo_date = '".$date."' and plo_mat_mid_soi = '".$matMidSoir."' and pal_num = ".$palNum;

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function getDansPlongeePasAJour($date,$moment)
    {
        $pdo = $this->getBdd();

        $sql = "select * from PLO_PALANQUEE where (PLO_DATE = '".$date."') and (upper(PLO_MAT_MID_SOI) = upper('".$moment."'))
                and (isnull(PAL_HEURE_IMMERSION) or isnull(PAL_HEURE_SORTIE_EAU) or isnull(PAL_PROFONDEUR_REELLE) or isnull(PAL_DUREE_FOND))";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function getDansPlongeeAJour($date,$moment)
    {
        $pdo = $this->getBdd();

        $sql = "select * from PLO_PALANQUEE where (PLO_DATE = '".$date."') and (upper(PLO_MAT_MID_SOI) = upper('".$moment."'))
                and !isnull(PAL_HEURE_IMMERSION) and !isnull(PAL_HEURE_SORTIE_EAU) and !isnull(PAL_PROFONDEUR_REELLE) and !isnull(PAL_DUREE_FOND)";
        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function getPalanqueeByDateMomentNum($date,$moment,$num)
    {
        $pdo = $this->getBdd();

        $sql = "select * from PLO_PALANQUEE where (PLO_DATE = '".$date."') and (upper(PLO_MAT_MID_SOI) = upper('".$moment."')) and PAL_NUM = ".$num;
        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function deletePalanquee($date,$moment,$num)
    {
        $pdo = $this->getBdd();

        $sql = "DELETE FROM `PLO_CONCERNER` WHERE (PLO_DATE = '".$date."') and (upper(PLO_MAT_MID_SOI) = upper('".$moment."')) and PAL_NUM = ".$num;
        $req = $pdo->prepare($sql);
        $req->execute();

        $sql = "DELETE FROM `PLO_PALANQUEE` WHERE (PLO_DATE = '".$date."') and (upper(PLO_MAT_MID_SOI) = upper('".$moment."')) and PAL_NUM = ".$num;
        $req = $pdo->prepare($sql);
        $req->execute();

        $req->closeCursor();
    }
}