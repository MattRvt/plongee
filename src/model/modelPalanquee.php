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

    public function addPalanque($PLO_DATE,$PLO_MATIN_APRESMIDI,$PAL_PROFONDEUR_MAX,$PAL_DUREE_MAX)
    {
        $Bdd = $this->getBdd();

        $PAL_NUM = $this->getNewNum($PLO_DATE,$PLO_MATIN_APRESMIDI);

        $sql = "INSERT INTO `PLO_PALANQUEE`(`PLO_DATE`, `PLO_MAT_MID_SOI`, `PAL_NUM`, `PAL_PROFONDEUR_MAX`, `PAL_DUREE_MAX`) VALUES (\"".$PLO_DATE."\",\"".$PLO_MATIN_APRESMIDI."\",\"".$PAL_NUM."\",\"".$PAL_PROFONDEUR_MAX."\",\"".$PAL_DUREE_MAX."\")";

        $statement = $Bdd->prepare($sql);

        $statement->execute();


        $statement->closeCursor();

        return $PAL_NUM;
    }

    public function addPalanqueWithNum($PLO_DATE,$PLO_MATIN_APRESMIDI,$PAL_PROFONDEUR_MAX,$PAL_DUREE_MAX,$PAL_NUM)
    {
        $Bdd = $this->getBdd();


        $sql = "INSERT INTO `PLO_PALANQUEE`(`PLO_DATE`, `PLO_MAT_MID_SOI`, `PAL_NUM`, `PAL_PROFONDEUR_MAX`, `PAL_DUREE_MAX`) VALUES (\"".$PLO_DATE."\",\"".$PLO_MATIN_APRESMIDI."\",\"".$PAL_NUM."\",\"".$PAL_PROFONDEUR_MAX."\",\"".$PAL_DUREE_MAX."\")";

        $statement = $Bdd->prepare($sql);

        $statement->execute();

        $statement->closeCursor();
    }

    public function modifyPalanquee($PAL_NUM, $PLO_DATE, $PLO_MAT_MID_SOI, $PAL_PROFONDEUR_MAX, $PAL_DUREE_MAX, $PAL_HEURE_IMMERSION, $PAL_HEURE_SORTIE_EAU, $PAL_PROFONDEUR_REELLE, $PAL_DUREE_FOND)
    {
        if($PAL_HEURE_IMMERSION != null)
        {
            $PAL_HEURE_IMMERSION = ", PAL_HEURE_IMMERSION = \"$PAL_HEURE_IMMERSION\"";
        }

        if($PAL_HEURE_SORTIE_EAU != null)
        {
            $PAL_HEURE_SORTIE_EAU = ", PAL_HEURE_SORTIE_EAU = \"$PAL_HEURE_SORTIE_EAU\"";
        }

        if($PAL_PROFONDEUR_REELLE != null)
        {
            $PAL_PROFONDEUR_REELLE = ", PAL_PROFONDEUR_REELLE = \"$PAL_PROFONDEUR_REELLE\"";
        }

        if($PAL_DUREE_FOND != null)
        {
            $PAL_DUREE_FOND = ", PAL_DUREE_FOND = \"$PAL_DUREE_FOND\"";
        }

        $statement = $this->getBdd()->prepare("UPDATE PLO_PALANQUEE SET PAL_PROFONDEUR_MAX = ".$PAL_PROFONDEUR_MAX.", PAL_DUREE_MAX = ".$PAL_DUREE_MAX.$PAL_HEURE_IMMERSION.$PAL_HEURE_SORTIE_EAU.$PAL_PROFONDEUR_REELLE.$PAL_DUREE_FOND."  WHERE PLO_DATE = \"".$PLO_DATE."\" and PLO_MAT_MID_SOI = \"".$PLO_MAT_MID_SOI."\" and PAL_NUM = ".$PAL_NUM);

        $statement->execute();
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
    
    public function deletePlongeurConcernerPalanquee($date,$moment,$num)
    {
        $pdo = $this->getBdd();

        $sql = "DELETE FROM `PLO_CONCERNER` WHERE (PLO_DATE = '".$date."') and (upper(PLO_MAT_MID_SOI) = upper('".$moment."')) and PAL_NUM = ".$num;
        $req = $pdo->prepare($sql);
        $req->execute();

        $req->closeCursor();
    }

    public function deletePalanquee($date,$moment,$num)
    {
        $this->deletePlongeurConcernerPalanquee($date,$moment,$num);

        $pdo = $this->getBdd();

        $sql = "DELETE FROM `PLO_PALANQUEE` WHERE (PLO_DATE = '".$date."') and (upper(PLO_MAT_MID_SOI) = upper('".$moment."')) and PAL_NUM = ".$num;
        $req = $pdo->prepare($sql);
        $req->execute();

        $req->closeCursor();
    }

    public function getNewNum($PLO_DATE,$PLO_MATIN_APRESMIDI)
    {
        $Bdd = $this->getBdd();

        $sql = "select max(PAL_NUM) FROM PLO_PALANQUEE where PLO_DATE=\"".$PLO_DATE."\" and PLO_MAT_MID_SOI=\"".$PLO_MATIN_APRESMIDI."\"";
        $statement = $Bdd->prepare($sql);
        $statement->execute();
        $num = $statement->fetch(PDO::FETCH_ASSOC);
        $PAL_NUM = $num["max(PAL_NUM)"]+1;

        if($PAL_NUM == "NULL")
        {
            $PAL_NUM = 1;
        }

        return $PAL_NUM;
    }

    public function existe($num,$date,$moment)
    {
        $Bdd = $this->getBdd();

        $sql = "select count(*) FROM PLO_PALANQUEE where PLO_DATE=\"".$date."\" and PLO_MAT_MID_SOI=\"".$moment."\" and PAL_NUM=".$num;
        $statement = $Bdd->prepare($sql);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        return $data["count(*)"];
    }
}