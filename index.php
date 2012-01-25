<?php include("../password_protect.php");  
 if (in_array($login, $staff)) {
  
    // set cookie if password was validated
    setcookie("verify", $login, $timeout, '/');
	
}
?>

<html>
	<head>
		<style type="text/css">
			body {background-color:#848684; color:#a45209;width:600px;}
			.main {float:left;width:180px;height:150px;margin:-15px 0px -10px -15px;display: block}
			.btext {position:relative;top:-130px;font-size:150%;width:122px;text-align: center;text-decoration:none;padding-left:40px;word-wrap: break-word;display: block}
			a:link{text-decoration:none; color:#a45209;}
			.other {float:left;margin-top:150px; margin-left:-480px;}
			.bor{border:none;}
		</style>
		
					<!--[if IE ]>
<link href="ie.css" rel="stylesheet" type="text/css">
<![endif]-->	

	</head>
	<body >
	<div id="content">
<?php
		extract($_POST);
	
		/*this is the function that creates the buttons. 
		The variables it takes are: 
		$a is the form id (which is just generic, but it has to be different for each iteration.
		$b is the name of the input field, which determines which column gets updated in the database
		$c is the text of the button. This is usually just a repeat of $a, but it can be modified to say whatever you want		
		*/
		function button ($a,$b,$c) 
			{
			echo "
				<a  href=\"javascript:document.mainform$a.submit()\" onmouseover=\"document.mainform$a.sub_but.src='blankb-1.png'\" onmouseout=\"document.mainform$a.sub_but.src='blankb-2.png'\" onclick=\"return val_form_this_page()\" >
					<span class=\"main\">
						<form name=\"mainform$a\" action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
							<input type=\"hidden\" name=\"update\" value=\"1\">
							<input type=\"hidden\"  name=\"$b\" value=\"1\">
							<img class=\"bor\" src=\"blankb-2.png\"   alt=\"Submit this form\" name=\"sub_but\" />
						</form>
						<span class=\"btext\">$c</span>
					</span>
				</a>";
		}
//login taken from cookie set in the password_protect.php file	
$login = $_COOKIE["verify"];

		/* database connector */
		$mysql_serveradress		= "";	// Address MySQL Server is located
		$mysql_username			= "";		// Username for your MySQL Server
		$mysql_password			= "";		// Password for your MySQL Server
		$connection = @mysql_connect("$mysql_serveradress","$mysql_username","$mysql_password");
		if (!$connection) die("Can't connect to database server");
		/* end connector */
		
if ($update == 1) 
	{		
		$insert = "INSERT INTO reference.questions (Date, Time, Research, Directional, Computer_Help, Print_Copy, eLearning, Consultation, Notes, Librarian) VALUES ( CURDATE(), NOW(), '$Research', '$Directional', '$Computer_Help', '$Print_Copy', '$eLearning', '$Consultation', '$Notes', '$login')";		
		mysql_query($insert,$connection) or die("<b>A fatal MySQL error occured<br />Please Alert Mr. Stephens</b>.\n<br />Query: " . $new_order . "<br />\nError: (" . mysql_errno() . ") " . mysql_error()); ;
	}		
$Research = "0";
$Directional = "0";
$Computer_Help = "0";
$Print_Copy = "0";
$eLearning = "0";
$Consultation = "0";
button($a="a", $b="Research", $c=$b);
button($a="b", $b="Directional",$c=$b);
button($a="c", $b="Computer_Help",$c="Computer<br>Help");
button($a="d", $b="Print_Copy",$c="Printing<br>Copying");
button($a="e", $b="eLearning",$c=$b);
button($a="f", $b="Consultation",$c=$b);
echo "<div class=\"other\"><h4><a href=\"results.php\">View Statistics</a></h4><br /><br />
	<form name=\"form\" action=\"".$_SERVER['PHP_SELF']."\" method=\"get\">
		<input type=\"hidden\" name=\"logout\" value=\"1\">
		<input type=\"submit\" name=\"Submit\" value=\"Logout\">
	</form></div>";


?>
</div>
</body>
</html>
