<?php


class modelPlongee extends model
{
    public function getAll()
    {
        return $this->selectAll('plo_plongee');
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
    public function updatePlongee($PLO_DATE, $PLO_MATIN_APRESMIDI, $SIT_NUM, $EMB_NUM, $PER_NUM_DIR, $PER_NUM_SECU, $PLO_EFFECTIF_PLONGEURS, $PLO_EFFECTIF_BATEAU, $PLO_NB_PALANQUEES, $PLO_ETAT)
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
                `PLO_NB_PALANQUEES` = :PLO_NB_PALANQUEES,
                `PLO_ETAT` = :PLO_ETAT
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
        $statement->bindParam(':PLO_ETAT', $PLO_ETAT);

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
            $this->updatePlongee($PLO_DATE, $PLO_MATIN_APRESMIDI, $SIT_NUM, $EMB_NUM, $PER_NUM_DIR, $PER_NUM_SECU, $PLO_EFFECTIF_PLONGEURS, $PLO_EFFECTIF_BATEAU, $PLO_NB_PALANQUEES, $PLO_ETAT);
        } else {
            $this->addPlongee($PLO_DATE, $PLO_MATIN_APRESMIDI, $SIT_NUM, $EMB_NUM, $PER_NUM_DIR, $PER_NUM_SECU, $PLO_EFFECTIF_PLONGEURS, $PLO_EFFECTIF_BATEAU, $PLO_NB_PALANQUEES, $PLO_ETAT);
        }
    }

    /**
     * renvoie les plongée ayant eu lieux a une date et un moment données
     * @param $PLO_DATE
     * @param $PLO_MAT_MID_SOI
     * @return mixed
     */
    public function getMatch($PLO_DATE, $PLO_MAT_MID_SOI)
    {

        $pdo = $this->getBdd();

        $sql = "select * from plo_plongee where (PLO_DATE = '".$PLO_DATE."') and (upper(PLO_MAT_MID_SOI) = upper('".$PLO_MAT_MID_SOI."'))";
        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;

    }

    public function getNbPalanquee($date,$matMidSoir)
    {
        $pdo = $this->getBdd();

        $sql = "SELECT count(*) FROM `plo_palanquee` WHERE plo_date = '".$date."' and plo_mat_mid_soi = '".$matMidSoir."'";

        $req = $pdo->prepare($sql);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $data;
    }

}