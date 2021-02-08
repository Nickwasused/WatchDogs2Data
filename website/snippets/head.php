<!DOCTYPE html>
<?php
$items_per_page = 10;
$version = "alpha";
#disable page errors
error_reporting(E_ERROR);
#connect to database
require("login.php");
echo "<html>
<head>
	<a id=\"top\"></a>
	<title>Watch Dogs 2 Data | Nickwasused</title>
	<meta charset=\"UTF-8\">
	<meta name=\"description\" content=\"Watch Dogs 2 data\">
	<meta name=\"keywords\" content=\"Watch Dogs 2, Data, modding\">
	<meta name=\"author\" content=\"Nickwasused\">
	<meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">
	<link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"/images/favicon/apple-touch-icon.png\">
	<link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"/images/favicon/favicon-32x32.png\">
	<link rel=\"icon\" type=\"image/png\" sizes=\"192x192\" href=\"/images/favicon/android-chrome-192x192.png\">
	<link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"/images/favicon/favicon-16x16.png\">
	<link rel=\"manifest\" href=\"/images/favicon/site.webmanifest\">
	<link rel=\"mask-icon\" href=\"/images/favicon/safari-pinned-tab.svg\" color=\"#000000\">
	<link rel=\"shortcut icon\" href=\"/images/favicon/favicon.ico\">
	<meta name=\"msapplication-TileColor\" content=\"#da532c\">
	<meta name=\"msapplication-TileImage\" content=\"/images/favicon/mstile-144x144.png\">
	<meta name=\"msapplication-config\" content=\"/images/favicon/browserconfig.xml\">
	<meta name=\"theme-color\" content=\"#ffffff\">
	<!-- async css loading -->
	<link type='text/css' rel='stylesheet' href='/css/main.css' media=\"none\" onload=\"if(media!='all')media='all'\">
	<!-- version : ".$version." -->
</head>
<a id=\"home\"></a>
<header>
	<ul>
		<li>
			<a href=\"/#home\">Home</a>
		</li>
		<li>
			<a href=\"/#characters\">Characters</a>
		</li>
		<li>
			<a href=\"/#vehicles\">Vehicles</a>
		</li>
		<li>
			<a href=\"/#lmalayers\">LMALayers</a>
		</li>
		<li>
			<a href=\"/#weathertypes\">Weather Types</a>
		</li>
	</ul> 
</header>
<body>
";
?>