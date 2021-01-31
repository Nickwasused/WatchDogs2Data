<?php
include("snippets/head.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background1.webp\">
	<div class=\"imagefilter\">
		<a id=\"home\"></a>
		<h1>Watch Dogs 2</h1>
		<h2>Game informations</h2>
	</div>
</div>

<div class=\"content lozad\" data-background-image=\"/images/backgrounds/background2.webp\">
	<div class=\"imagefilter\">
		<a id=\"characters\"></a>
		<h1>Character Models</h1>
		<h2>List of all Watch Dogs 2 Character Models</h2>
		<center><a href=\"./tools/characters/categorys.php\"><img class=\"icon\" src=\"/images/icons/char.svg\"></img></a></center>
	</div>
</div>

<div class=\"content lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
	<div class=\"imagefilter\">
		<a id=\"vehicles\"></a>
		<h1>Vehicles</h1>
		<h2>List of all Watch Dogs 2 Vehicles</h2>
		<center><a href=\"./tools/cars/vehicles.php\"><img class=\"icon\" src=\"/images/icons/cars.svg\"></img></a></center>
	</div>
</div>

</body>
";
include("snippets/footer.php");
?>