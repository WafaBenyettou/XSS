<!DOCTYPE html>
<html>
<title> XSS Tutorial #2 </title>
<body>
<h1 align="center"> Try My New Search Feature! </h1>
<table align="center">
<tr><td>
<form action="index.php" method="get">
	<input type="text" name="search" placeholder="search" />
	<input type="submit" value="Search" />
</form>
</td></tr>
</table>
<br />
<br />
<p align="center">
<?php
if(isset($_GET["search"]))
{
	echo "The results of your search for: ".$_GET["search"];
	echo "<br /><br /> <i>Sorry No Results Found! </i>";
}
?>
</p>
<h3 align="center"> This website was made by me! I hope you really really like it! </h3>
</body>
</html> 