<?php
include("../../snippets/head.php");
echo "
<style>
header {
	scroll-snap-align : none !important;
}
</style>
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
<div class=\"imagefilter\">";
	
$categorys = "SELECT * FROM `charactercategorys`";

foreach ($pdo->query($categorys) as $row)
{
	echo "<h3><a href=\"./characters.php?categoryid=".$row["categoryid"]."\">".$row["categoryname"]."</a></h3>\n";
}

echo"	
	</div>
</div>

</body>
";
include("../../snippets/footer.php");
?>