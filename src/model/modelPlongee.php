<?php


class modelPlongee extends model
{
    public function getAll()
    {
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM PLO_PLONGEE WHERE PLO_DATE > DATE_SUB(NOW(), INTERVAL 1 YEAR) order by PLO_DATE desc, case `PLO_MAT_MID_SOI` when 'M' then 1 when 'A' then 2 when 'S' then 3 else 4 end";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function getAllArchive()
    {
        $pdo = $this->getBdd();

        $sql = "UPDATE PLO_PLONGEE SET PLO_ETAT = 'Dépassée' WHERE PLO_DATE < DATE_SUB(NOW(), INTERVAL 1 YEAR) and PLO_ETAT != 'Dépassée' order by PLO_DATE desc, case `PLO_MAT_MID_SOI` when 'M' then 1 when 'A' then 2 when 'S' then 3 else 4 end";

        $req = $pdo->prepare($sql);
        $req->execute();

        $sql = "SELECT * FROM PLO_PLONGEE WHERE PLO_ETAT = 'Dépassée'";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function plongeeExiste($PLO_DATE, $PLO_MAT_MID_SOI)
    {
        require_once('model/modelPlongee.php');
        $reader = new modelPlongee();
        $req = $reader->getMatch($PLO_DATE, $PLO_MAT_MID_SOI);
        $exist = (sizeof($req) > 0);
        return $exist;
    }

    /**
     * add data to DB
     * @param $PLO_DATE
     * @param $PLO_MATIN_APRESMIDI
     * @param $SIT_NUM
     * @param $EMB_NUM
     * @param $PER_NUM_DIR
     * @param $PER_NUM_SECU
     * @param $PLO_EFFECTIF_PLONGEURS
     * @param $PLO_EFFECTIF_BATEAU
     * @param $PLO_NB_PALANQUEES
     * @param $PLO_ETAT
     * @throws PDOException in case of write failur
     */
    public function addPlongee($PLO_DATE, $PLO_MATIN_APRESMIDI, $SIT_NUM, $EMB_NUM, $PER_NUM_DIR, $PER_NUM_SECU, $PLO_EFFECTIF_PLONGEURS, $PLO_EFFECTIF_BATEAU, $PLO_NB_PALANQUEES, $PLO_ETAT)
    {
        $statement = $this->getBdd()->prepare("
            INSERT INTO `PLO_PLONGEE`(
                `PLO_DATE`
                , `PLO_MAT_MID_SOI`
                , `SIT_NUM`
                , `EMB_NUM`
                , `PER_NUM_DIR`
                , `PER_NUM_SECU`
                , `PLO_EFFECTIF_PLONGEURS`
                , `PLO_EFFECTIF_BATEAU`
                , `PLO_NB_PALANQUEES`
                ,`PLO_ETAT`
            ) VALUES (
                :PLO_DATE
                ,:PLO_MATIN_APRESMIDI
                ,:SIT_NUM
                ,:EMB_NUM
                ,:PER_NUM_DIR
                ,:PER_NUM_SECU
                ,:PLO_EFFECTIF_PLONGEURS
                ,:PLO_EFFECTIF_BATEAU
                ,:PLO_NB_PALANQUEES
                ,:PLO_ETAT)
            ");

        $statement->bindParam(':PLO_DATE', $PLO_DATE);
        $statement->bindParam(':PLO_MATIN_APRESMIDI', $PLO_MATIN_APRESMIDI);
        $statement->bindParam(':SIT_NUM', $SIT_NUM);
        $statement->bindParam(':EMB_NUM', $EMB_NUM);
        $statement->bindParam(':PER_NUM_DIR', $PER_NUM_DIR);
        $statement->bindParam(':PER_NUM_SECU', $PER_NUM_SECU);
        $statement->bindParam(':PLO_EFFECTIF_PLONGEURS', $PLO_EFFECTIF_PLONGEURS);
        $statement->bindParam(':PLO_EFFECTIF_BATEAU', $PLO_EFFECTIF_BATEAU);
        $statement->bindParam(':PLO_NB_PALANQUEES', $PLO_NB_PALANQUEES);
        $statement->bindParam(':PLO_ETAT', $PLO_ETAT);

        set_error_handler(function ($severity, $message, $file, $line) {
            throw new ErrorException($message, $severity, $severity, $file, $line);
        });
        $statement->execute();
        restore_error_handler();

    }

    /**
     * mes a jours une plongee, la methode ne teste pas si la plongee existe
     * @param $PLO_DATE
     * @param $PLO_MATIN_APRESMIDI
     * @param $SIT_NUM
     * @param $EMB_NUM
     * @param $PER_NUM_DIR
     * @param $PER_NUM_SECU
     * @param $PLO_EFFECTIF_PLONGEURS
     * @param $PLO_EFFECTIF_BATEAU
     * @param $PLO_NB_PALANQUEES
     * @param $PLO_ETAT
     */
    public function updatePlongee($PLO_DATE, $PLO_MATIN_APRESMIDI, $SIT_NUM, $EMB_NUM, $PER_NUM_DIR, $PER_NUM_SECU, $PLO_EFFECTIF_PLONGEURS, $PLO_EFFECTIF_BATEAU, $PLO_NB_PALANQUEES)
    {
        $statement = $this->getBdd()->prepare("
            UPDATE `PLO_PLONGEE`
            SET 
                `SIT_NUM` = :SIT_NUM,
                `EMB_NUM` = :EMB_NUM,
                `PER_NUM_DIR` = :PER_NUM_DIR,
                `PER_NUM_SECU` = :PER_NUM_SECU,
                `PLO_EFFECTIF_PLONGEURS` = :PLO_EFFECTIF_PLONGEURS,
                `PLO_EFFECTIF_BATEAU` = :PLO_EFFECTIF_BATEAU,
                `PLO_NB_PALANQUEES` = :PLO_NB_PALANQUEES
            WHERE
                `PLO_DATE`= :PLO_DATE 
            and
                `PLO_MAT_MID_SOI` = :PLO_MATIN_APRESMIDI
           ");

        $statement->bindParam(':PLO_DATE', $PLO_DATE);
        $statement->bindParam(':PLO_MATIN_APRESMIDI', $PLO_MATIN_APRESMIDI);
        $statement->bindParam(':SIT_NUM', $SIT_NUM);
        $statement->bindParam(':EMB_NUM', $EMB_NUM);
        $statement->bindParam(':PER_NUM_DIR', $PER_NUM_DIR);
        $statement->bindParam(':PER_NUM_SECU', $PER_NUM_SECU);
        $statement->bindParam(':PLO_EFFECTIF_PLONGEURS', $PLO_EFFECTIF_PLONGEURS);
        $statement->bindParam(':PLO_EFFECTIF_BATEAU', $PLO_EFFECTIF_BATEAU);
        $statement->bindParam(':PLO_NB_PALANQUEES', $PLO_NB_PALANQUEES);

        set_error_handler(function ($severity, $message, $file, $line) {
            throw new ErrorException($message, $severity, $severity, $file, $line);
        });
        $statement->execute();
        restore_error_handler();
    }

    /**
     * format the data and choose whether to add or update a line
     * @param $data table of value from the controller
     */
    public function addOrModifyPlongee($data)
    {
        $PLO_DATE = $data['date'];
        $PLO_MATIN_APRESMIDI = $data['moment'];
        $SIT_NUM = $data['site'];
        $EMB_NUM = $data['embarcation'];
        $PER_NUM_DIR = $data['directeurDePlongee'];
        $PER_NUM_SECU = $data['securiteDeSurface'];
        $PLO_EFFECTIF_PLONGEURS = 0;
        $PLO_EFFECTIF_BATEAU = 0;
        $PLO_NB_PALANQUEES = 0;
        $PLO_ETAT = $data['etat'];

        $plongeeExiste = $this->plongeeExiste($PLO_DATE, $PLO_MATIN_APRESMIDI);
        if ($plongeeExiste) {
            $this->updatePlongee($PLO_DATE, $PLO_MATIN_APRESMIDI, $SIT_NUM, $EMB_NUM, $PER_NUM_DIR, $PER_NUM_SECU, $PLO_EFFECTIF_PLONGEURS, $PLO_EFFECTIF_BATEAU, $PLO_NB_PALANQUEES);
        } else {
            $this->addPlongee($PLO_DATE, $PLO_MATIN_APRESMIDI, $SIT_NUM, $EMB_NUM, $PER_NUM_DIR, $PER_NUM_SECU, $PLO_EFFECTIF_PLONGEURS, $PLO_EFFECTIF_BATEAU, $PLO_NB_PALANQUEES, $PLO_ETAT);
        }
    }

    public function setEtat($etat, $moment, $date)
    {
        $pdo = $this->getBdd();

        $sql = "
            UPDATE `PLO_PLONGEE`
            SET `PLO_ETAT` = \"".$etat."\"
            WHERE`PLO_DATE`= \"".$date."\" 
            and`PLO_MAT_MID_SOI` = \"".$moment."\"
           ";

        $req = $pdo->prepare($sql);
        $req->execute();

        $req->closeCursor();
    }

    public function getEtat($date, $moment)
    {
        $pdo = $this->getBdd();

        $sql = "
            SELECT PLO_ETAT FROM `PLO_PLONGEE`
            WHERE`PLO_DATE`= \"".$date."\" 
            and`PLO_MAT_MID_SOI` = \"".$moment."\"";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data["PLO_ETAT"];
    }

    /**
     * renvoie les plongée ayant eu lieux a une date et un moment données
     * @param $PLO_DATE
     * @param $PLO_MAT_MID_SOI
     * @return mixed
     */
    public
    function getMatch($PLO_DATE, $PLO_MAT_MID_SOI)
    {

        $pdo = $this->getBdd();

        $sql = "select * from PLO_PLONGEE where (PLO_DATE = '" . $PLO_DATE . "') and (upper(PLO_MAT_MID_SOI) = upper('" . $PLO_MAT_MID_SOI . "'))";
        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;

    }

    public
    function getNbPalanquee($date, $matMidSoir)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT count(*) FROM `PLO_PALANQUEE` WHERE plo_date = '" . $date . "' and plo_mat_mid_soi = '" . $matMidSoir . "'";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public
    function getNbPersonne($date, $matMidSoir)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT count(*) FROM `PLO_CONCERNER` WHERE plo_date = '" . $date . "' and plo_mat_mid_soi = '" . $matMidSoir . "'";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function get3LastPlongee(){
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM ( SELECT * FROM PLO_PLONGEE WHERE DATEDIFF(SYSDATE() , PLO_DATE) > 1 ORDER BY PLO_DATE DESC, case `PLO_MAT_MID_SOI` when 'M' then 1 when 'A' then 2 when 'S' then 3 else 4 end ) AS date LIMIT 3";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function get3NextPlongee(){
        $pdo = $this->getBdd();

        $sql = "SELECT * FROM ( SELECT * FROM PLO_PLONGEE WHERE DATEDIFF(SYSDATE() , PLO_DATE) < 1 ORDER BY PLO_DATE ASC, case `PLO_MAT_MID_SOI` when 'M' then 1 when 'A' then 2 when 'S' then 3 else 4 end ) AS date LIMIT 3";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

    public function verifierEtat($date, $moment)
    {
        $writer = new modelPlongee();
        $model = new modelPalanquee();

        $nbPal = $writer->getNbPalanquee($date,$moment)["count(*)"];
        $plongeePasAJour = $model->getDansPlongeePasAJour($date,$moment);

        if($plongeePasAJour==0&&$nbPal >= 1)
        {
            $writer->setEtat("Complète", $moment,$date);
        }
        else
        {
            $writer->setEtat("Paramétrée",  $moment,$date);
        }
    }

    public function supprimerAllPalanqueSup($date, $moment, $num)
    {
        $pdo = $this->getBdd();

        $sql = "DELETE FROM PLO_CONCERNER WHERE PLO_DATE=\"".$date."\" and PLO_MAT_MID_SOI=\"".$moment."\" and PAL_NUM>".$num;

        $req = $pdo->prepare($sql);
        $req->execute();
        $req->closeCursor();

        $sql = "DELETE FROM PLO_PALANQUEE WHERE PLO_DATE=\"".$date."\" and PLO_MAT_MID_SOI = \"".$moment."\" and PAL_NUM > ".$num;

        $req = $pdo->prepare($sql);
        $req->execute();
        $req->closeCursor();
    }
}