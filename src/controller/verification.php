<meta charset="UTF-8">
<?php

$pattern="#[a-zA-Z][a-z 'A-Z]*-?[a-z 'A-Z]*-{0,2}[a-z 'A-Z]*-?[a-z 'A-Z]*#i"; //Pour noms
$illegal = "#€$%^&*()+=[];,./{}|:!<>?~";

$tab = array("Ébé-ébé","ébé-ébé","ébé-Ébé","éÉé-Ébé",
"'éÉ'é-É'bé'",
"'éæé-É'bé'",
"'éæé-É'Ŭé'",
"'é !é-É'Ŭé'",
"éé''éé--uù'  gg",
"Éééé--gg--gg",
"DE LA TR€UC",
"DE LA TRUC",
"ééééééééééééééééééééééééééééééééééééééééééééééé",
"ùùùùùùùùùùùùùùùùùùùù",
"-péron-de - la   branche-",
"pied-de-biche",
"Ferdinand--SaintMalo ALAnage",
"Ferdinand--SaintMalo-ALAnage",
"aa--bb--cc",
"A' ' b",
"Añ'",
"'",
"x~",
"A '' b",
"bénard     ébert",
"ÆøœŒøñ",
"\a",
"\\a",
"b\\a",
"b\a",
"Æ'-'nO",
"çççç ççç ÇÇÇÇ ÇÇÇ",
"àâ-äé-èê-ëïî-ôöù-ûü-ÿç",
"ÀÂÄÉÈÊËÏÎÔÖÙÛÜŸÇ"
);
foreach ($tab as $clé=>$contenu){
    echo " \$clé:$clé   \$mot: $contenu \n";
    verifierPrenom($contenu,$pattern,$illegal);
    echo "\n <hr> \n";
}



//https://murviel-info-beziers.com/fonction-php-supprimer-accents/
function skip_accents( $str, $type, $charset='utf-8' ){

    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&('.$type.')(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&('.$type.'{2})(?:lig);#', '\1', $str);
    $str = preg_replace('#&[^;]+;#', '', $str);

    return $str;
}

function convertNom($nom){
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

function verif_illegal ($s, $illegal){
    return strpbrk($s, $illegal) == false;
}

function mb_ucfirst($s) {   //http://phpfunction.net/pl/php-function-mb_ucfirst
    return mb_strtoupper(mb_substr($s,0,1,"UTF-8"),"UTF-8").mb_substr($s,1, strlen($s)-1,"UTF-8");
}

function skip_ucaccent($s){
    return skip_accents(mb_substr($s,0,1,"UTF-8"),"[A-Z]").mb_substr($s,1, strlen($s)-1,"UTF-8");
}


function verifTiret($nom){
    $tab = explode("--",$nom);
    return sizeof($tab);
}

function verifierNom($nom, $pattern, $illegal){

    $nom = convertNom($nom);
    $nom = skip_accents($nom,"[A-Za-z]");
    $nom = strtoupper($nom);
    if (preg_match($pattern,$nom,$tab) && !verif_illegal($nom,$illegal) && verifTiret($nom)<3 && strlen($nom)<=30){
        echo "OK : \"$nom\"\n";
    }
    else{
        echo "KO : \"$nom\" \n";
    }
}

function verifierPrenom($prenom, $pattern, $illegal){
    $prenom = convertNom($prenom);
    $prenom = mb_strtolower($prenom,"UTF-8");

    $explodedspace = explode(" ",$prenom);
    foreach ($explodedspace as &$content){
        $content= mb_ucfirst($content);
        $content = skip_ucaccent($content);
    }
    $prenom2 = implode(" ",$explodedspace);

    $explodeddash = explode("-",$prenom2);
    foreach ($explodeddash as &$content){
        $content= mb_ucfirst($content);
        $content = skip_ucaccent($content);
    }
    $prenom3 = implode("-",$explodeddash);

    $explodedquote = explode("'",$prenom3);
    foreach ($explodedquote as &$content){
        $content= mb_ucfirst($content);
        $content = skip_ucaccent($content);
    }
    $prenom4 = implode("'",$explodedquote);


    if (preg_match($pattern,$prenom4,$tab)&& verif_illegal($prenom4,$illegal)  && verifTiret($prenom4)==1 && strlen($prenom4)<=30){
        echo "OK : \"$prenom4\"\n";
    }
    else{
        echo "KO : \"$prenom4\" \n";
    }
}

?>