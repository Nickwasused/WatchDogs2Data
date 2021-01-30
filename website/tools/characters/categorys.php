<?php
include("../../snippets/head.php");
echo "
<body>
<div>
	<ul>
		<li>
			<a href=\"/.#home\">Home</a>
		</li>
		<li>
			<a href=\"/.#characters\">Characters</a>
		</li>
	</ul> 
</div>


<div class=\"content lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
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