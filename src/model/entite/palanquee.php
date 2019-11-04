<?php

class palanquee
{
    private $date;
    private $moment;
    private $num;
    private $profMax;
    private $durMax;
    private $heureImm;
    private $heureSor;
    private $profReel;
    private $durFond;
    private $nbPlongeur;
    private $plongeur;

    public function __construct()
    {
        $ctp = func_num_args();
        $args = func_get_args();

        switch($ctp)
        {
            case 6:
                $this->creeNouveaux($args[0],$args[1],$args[2],$args[3],$args[4],$args[5]);
                break;
            case 7:
                $this->creeNouveauxNum($args[0],$args[1],$args[2],$args[3],$args[4],$args[5],$args[6]);
                break;
            case 9:
                $this->creeDepuisBdd($args[0],$args[1],$args[2],$args[3],$args[4],$args[5],$args[6],$args[7],$args[8]);
                break;
            default:
                break;
        }
    }

    public function creeNouveauxNum($date, $moment, $profMax, $durMax, $nbPlongeur, $plongeur, $num)
    {
        $this->num = $num;
        $this->creeNouveaux($date, $moment, $profMax, $durMax, $nbPlongeur, $plongeur);
    }

    public function creeNouveaux($date, $moment, $profMax, $durMax, $nbPlongeur, $plongeur)
    {
        $model = new modelPalanquee();
        if($this->num == null)
        {
            $this->num = $model->getNewNum($date,$moment);
        }
        $this->heureImm = null;
        $this->heureSor = null;
        $this->profReel = null;
        $this->durFond = null;
        $this->nbPlongeur = $nbPlongeur;
        $this->plongeur = Array();
        for($i = 0; $i<count($plongeur); $i+=3)
        {
            $this->plongeur[$i/3]= Array("PER_NUM" => $plongeur[$i],
            "PER_NOM" => $plongeur[$i+1],
            "PER_PRENOM" => $plongeur[$i+2]);
        }

        $this->modifier($date, $moment, $profMax, $durMax);
    }

    public function creeDepuisBdd($date, $moment, $profMax, $durMax, $heureImm, $heureSor, $profReel, $durFond, $num)
    {
        $model = new modelPalanquee();
        $this->num = $num;
        $this->heureImm = $heureImm;
        $this->heureSor = $heureSor;
        $this->profReel = $profReel;
        $this->durFond = $durFond;
        $this->nbPlongeur = $model->getNbPlongeur($date,$moment,$num)["count(*)"];
        $this->plongeur = $model->getPlongeur($date,$moment,$num);

        $this->modifier($date, $moment, $profMax, $durMax);
    }

    public function modifier($date, $moment, $profMax, $durMax)
    {
        $this->date = $date;
        $this->moment = $moment;
        $this->profMax = $profMax;
        $this->durMax = $durMax;
    }

    public function completer($heureImm, $heureSor, $profReel, $durFond)
    {
        $this->heureImm = $heureImm;
        $this->heureSor = $heureSor;
        $this->profReel = $profReel;
        $this->durFond = $durFond;
    }

    public function ajouterBase()
    {
        $model = new modelPalanquee();
        $this->num = $model->addPalanque($this->date,$this->moment,$this->profMax,$this->durMax);
    }

    public function completerBase()
    {
        $model = new modelPalanquee();
        $model->modifyPalanquee($this->num,$this->date,$this->moment,$this->profMax,$this->durMax,$this->heureImm,$this->heureSor,$this->profReel,$this->durFond);
    }

    public function getArray()
    {
        $return_arr = array("date" => $this->date,
            "moment" => $this->moment,
            "num" => $this->num,
            "profMax" => $this->profMax,
            "durMax" => $this->durMax,
            "heureImm" => $this->heureImm,
            "heureSor" => $this->heureSor,
            "profReel" => $this->profReel,
            "durFond" => $this->durFond,
            "nbPlongeur" => $this->nbPlongeur,
            "plongeur" => $this->plongeur);
        return $return_arr;
    }
}