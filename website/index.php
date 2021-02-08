<?php
include("snippets/head.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/avif/background1.avif,/images/backgrounds/webp/background1.webp\">
	<div class=\"imagefilter\">
		<a id=\"home\"></a>
		<h1>Watch Dogs 2</h1>
		<h2>Game informations</h2>
		<h3>By Nickwasused</h3>
	</div>
</div>

<div class=\"content lozad\" data-background-image=\"/images/backgrounds/avif/background2.avif,/images/backgrounds/webp/background2.webp\">
	<div class=\"imagefilter\">
		<a id=\"characters\"></a>
		<h1>Character Models</h1>
		<h2>List of all Watch Dogs 2 Character Models</h2>
		<center><a href=\"./tools/characters/characters.php\"><img class=\"icon\" src=\"/images/icons/char.svg\"></img></a></center>
	</div>
</div>

<div class=\"content lozad\" data-background-image=\"/images/backgrounds/avif/background3.avif,/images/backgrounds/webp/background3.webp\">
	<div class=\"imagefilter\">
		<a id=\"vehicles\"></a>
		<h1>Vehicles</h1>
		<h2>List of all Watch Dogs 2 Vehicles</h2>
		<center><a href=\"./tools/cars/vehicles.php\"><img class=\"icon\" src=\"/images/icons/cars.svg\"></img></a></center>
	</div>
</div>

<div class=\"content lozad\" data-background-image=\"/images/backgrounds/avif/background4.avif,/images/backgrounds/webp/background4.webp\">
	<div class=\"imagefilter\">
		<a id=\"lmalayers\"></a>
		<h1>LMA Layers</h1>
		<h2>List of all Watch Dogs 2 LMA Layers</h2>
		<center><a href=\"./tools/lmalayers/lmalayers.php\"><img class=\"icon\" src=\"/images/icons/layers.svg\"></img></a></center>
	</div>
</div>

<div class=\"content lozad\" data-background-image=\"/images/backgrounds/avif/background5.avif,/images/backgrounds/webp/background5.webp\">
	<div class=\"imagefilter\">
		<a id=\"weathertypes\"></a>
		<h1>Weather Types</h1>
		<h2>List of all Watch Dogs 2 Weather Types</h2>
		<center><a href=\"./tools/weather/weather.php\"><img class=\"icon\" src=\"/images/icons/weather.svg\"></img></a></center>
	</div>
</div>
";
include("snippets/footer.php");
echo "</body>
</html>";
?>