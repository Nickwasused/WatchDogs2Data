<?php
include("../../snippets/head.php");
include("../../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
<div class=\"imagefilter\">
<div class=\"row\">";
	
$categorys = "SELECT * FROM `charactercategorys`";

foreach ($pdo->query($categorys) as $row)
{
	echo "<div class=\"categorycolumn\"><div class=\"category\"><table><tr><td><a href=\"./characters.php?categoryid=".$row["categoryid"]."\">".$row["categoryname"]."</a></td><td>
	<img class=\"lozad\" data-src=\"/images/models/categorys/".$row["categoryname"].".webp\"></td></tr></table></div></div>\n";
}

echo"	
</div>
</div>
</div>

</body>
";
include("../../snippets/footer.php");
?>