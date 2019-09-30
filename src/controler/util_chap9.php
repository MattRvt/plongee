<!--  E.Porcq	util_chap9.php 20/09/2010 -->
<?php 
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
	function cocherRadio($n)
		{
		if (isset($_POST["civilite"]))
		{
		  if ( $_POST["civilite"] == $n) 
			  echo "checked";
		}
	}
	function VerifSelect($n)
		{
		if (isset($_POST["pays"]))
		{
		  if ( $_POST["pays"] == $n) 
			  echo "selected";
		}
	}  
	function cocherCase ($n)
	{
		if (isset($_POST["preference"]))
			foreach($_POST["preference"] as $val)
			{
			  if ($n == $val)
			  {
				  echo "checked";
			  }
			}
	} 
?>
