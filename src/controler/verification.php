<meta charset="UTF-8">
<?php

$pattern="#[a-zA-Z][a-z 'A-Z]*-?[a-z 'A-Z]*-{0,2}[a-z 'A-Z]*-?[a-z 'A-Z]*#i"; //correction : il faut que l'on puisse mettre plusieurs tirets

verifierNom("Ébé-ébé",$pattern);


//https://murviel-info-beziers.com/fonction-php-supprimer-accents/
function skip_accents( $str, $charset='utf-8' ){

    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    $str = preg_replace('#&[^;]+;#', '', $str);

    return $str;
}

function convertNom($nom){
    preg_replace("^ *-* *","",$nom);
    preg_replace(" *-* *$","",$nom);
    preg_replace(" *- *","-",$nom);
    preg_replace(" *"," ",$nom);
    preg_replace("(æ|Æ)","AE",$nom);
    preg_replace("Ŭ","U",$nom);
    preg_replace("ø","o",$nom);
    preg_replace("(œ|Œ)","OE",$nom);

}

function verifierNom($nom, $pattern){
    $nom = skip_accents($nom);
    $nom = strtoupper($nom);
    if (preg_match($pattern,$nom,$tab) && strlen($nom)<=30){
        echo "OK : \"$nom\" modèle \"$pattern\"\n";
    }
    else{
        echo "KO : \"$nom\" modèle \"$pattern\"\n";
    }
}

function verifierPrenom($prenom){

}

?>