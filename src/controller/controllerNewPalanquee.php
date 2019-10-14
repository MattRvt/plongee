<?php

class controllerNewPalanquee extends controller
{

    function verifierRempli($n)
    {  
        if (isset($_POST[$n]))
        {
        	$var = $_POST[$n];
        	if ($var <> "")
            	echo $var; 
        }
        else 
        echo ""; 
    }

    function VerifSelectSeance($n)
    	{
    		if (isset($_POST["seance"]))
    		{
    		  if ( $_POST["seance"] == $n) 
    			  echo "selected";
    		}
    	}

    	function VerifSelectEmbarcation($n)
    	{
    	if (isset($_POST["embarcation"]))
    	{
    	  if ( $_POST["embarcation"] == $n) 
    		  echo "selected";
    	}
    }
}
?>

