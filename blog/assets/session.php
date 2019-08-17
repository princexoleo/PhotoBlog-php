<?php

//any functions that use session should be here
	session_start();

	function sessionMessages(){
		$output="";
		if(isset($_SESSION["message"]))
		{
			$msg=$_SESSION["message"];
			$output.=$msg;

			$_SESSION["message"]=NULL;
		}

		return $output;

	}
?>
