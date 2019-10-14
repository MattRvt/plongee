
<?php



class controllerVerification extends controller
{

    private $type;
    private $string;
    private $pattern;
    private $illegal;

    public function __construct()
    {
      $this->type = $_POST['type'];
      $this->string = $_POST['string'];
      $this->pattern = "#^['A-Za-z]+(([- ]['A-Za-z ])?['A-Za-z]*)*-{0,2}(([- ]['A-Za-z ])?['A-Za-z]*)*$#i"; //Pour noms
      $this->illegal = "#€$%^&*()+=[];,./{}|:!<>?~";
      if ($this->type == 0){
          $res = $this->verifierNom($this->string,$this->pattern,$this->illegal);
      }
      else {
          $res = $this->verifierPrenom($this->string, $this->pattern, $this->illegal);
      }
      echo $res;
    }


    //https://murviel-info-beziers.com/fonction-php-supprimer-accents/
    public function skip_accents( $str, $type, $charset='utf-8' ){

        $str = htmlentities($str, ENT_NOQUOTES, $charset);

        $str = preg_replace('#&('.$type.')(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&('.$type.'{2})(?:lig);#', '\1', $str);
        $str = preg_replace('#&[^;]+;#', '', $str);

        return $str;
    }

    public function convertNom($nom){
        $nom=preg_replace("#^ *-* *#","",$nom);
        $nom=preg_replace("# *-* *$#","",$nom);
        $nom=preg_replace("# *- *#","-",$nom);
        $nom=preg_replace('#"#',"''",$nom);
        $nom=preg_replace("#' *#","'",$nom);
        $nom=preg_replace("#\b *'' *\b#","' '",$nom);
        $nom=preg_replace("#(æ|Æ)#","AE",$nom);
        $nom=preg_replace("#Ŭ#","U",$nom);
        $nom=preg_replace("#ø#","o",$nom);
        $nom=preg_replace("#(œ|Œ)#","OE",$nom);
        $nom=preg_replace("#€#","!",$nom);
        $nom=preg_replace("#ñ#","n",$nom);
        return $nom;

    }

    public function verif_illegal ($s, $illegal){
        return strpbrk($s, $illegal) == false;
    }

    public function mb_ucfirst($s) {   //http://phpfunction.net/pl/php-function-mb_ucfirst
        return mb_strtoupper(mb_substr($s,0,1,"UTF-8"),"UTF-8").mb_substr($s,1, strlen($s)-1,"UTF-8");
    }

    public function skip_ucaccent($s){
        return $this->skip_accents(mb_substr($s,0,1,"UTF-8"),"[A-Z]").mb_substr($s,1, strlen($s)-1,"UTF-8");
    }


    public function verifierNom($nom, $pattern, $illegal){

        $nom = $this->convertNom($nom);
        $nom = $this->skip_accents($nom,"[A-Za-z]");
        $nom = strtoupper($nom);
        if (preg_match($pattern,$nom,$tab) && $this->verif_illegal($nom,$illegal) && strlen($nom)<=30){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function verifierPrenom($prenom, $pattern, $illegal){
        $prenom = $this->convertNom($prenom);
        $prenom = mb_strtolower($prenom,"UTF-8");

        $explodedspace = explode(" ",$prenom);
        foreach ($explodedspace as &$content){
            $content= $this->mb_ucfirst($content);
            $content = $this->skip_ucaccent($content);
        }
        $prenom2 = implode(" ",$explodedspace);

        $explodeddash = explode("-",$prenom2);
        foreach ($explodeddash as &$content){
            $content=$this-> mb_ucfirst($content);
            $content = $this->skip_ucaccent($content);
        }
        $prenom3 = implode("-",$explodeddash);

        $explodedquote = explode("'",$prenom3);
        foreach ($explodedquote as &$content){
            $content= $this->mb_ucfirst($content);
            $content = $this->skip_ucaccent($content);
        }
        $prenom4 = implode("'",$explodedquote);

        $prenom5 = $this->skip_accents($prenom4,"[A-Za-z]");


        if (preg_match($pattern,$prenom5,$tab)&& $this->verif_illegal($prenom5,$illegal)  &&  strlen($prenom5)<=30){
            return 1;
        }
        else{
            return 0;
        }
    }

}
?>