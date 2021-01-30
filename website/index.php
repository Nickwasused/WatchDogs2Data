<?php
include("snippets/head.php");
echo "
<a id=\"home\"></a>
<body>
<div>
	<ul>
		<li>
			<a href=\"#home\">Home</a>
		</li>
		<li>
			<a href=\"#characters\">Characters</a>
		</li>
	</ul> 
</div>


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

</body>
";
include("snippets/footer.php");
?>