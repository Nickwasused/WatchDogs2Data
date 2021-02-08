<?php
include("../../snippets/head.php");

$weathername=$_REQUEST["weathername"];

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

$searchoptions = array("weathername");
$offset = ($page - 1) * $items_per_page;

if (!empty($weathername)) {
    $command = "SELECT * FROM `weather` WHERE `weathername` LIKE '%".$weathername."%' AND `weatherid` >= $offset LIMIT $items_per_page;";
} else {
    $command = "SELECT * FROM `weather` WHERE `weatherid` >= $offset LIMIT $items_per_page;";
}

include("../../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
<div class=\"imagefilter\">
<center><button class=\"button button1 resetbutton\"><a href=\"./weather.php\">reset</a></button></center>";

$number = 0;
foreach ($searchoptions as $value) {
	if (!empty(${$value})) {
		if ($page==1) {
			echo "<center><button class=\"button button2\"><a href=\"./weather.php?".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		} else {
			echo "<center><button class=\"button button1\"><a href=\"./weather.php?".$value."=".${$value}."&page=".($page-1)."\">previous page</a></button><button class=\"button button2\"><a href=\"./weather.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		}
		$number++;
	}
}

if ($number===1) {}
else {
	if ($page===1) {
		echo "<center><button class=\"button button2\"><a href=\"./weather.php?page=".($page+1)."\">next page</a></button></center>";
	} else {
		echo "<center><button class=\"button button1\"><a href=\"./weather.php?page=".($page-1)."\">previous page</a></button>  <button class=\"button button2\"><a href=\"./weather.php?categoryid=$categoryid&page=".($page+1)."\">next page</a></button></center>";
	}
}

echo "
<table>
<thead>
<tr>
    <td>weathername</td>
    <td>video</td>
</tr>
<tr>
    <td>
    <form>
            <input type=text name=\"weathername\">
            <input class=\"button3\" type=submit>
        </form>
    </td>
    <td></td>
</tr>
</thead>
<tbody>";
	
foreach ($pdo->query($command) as $row)
{
    echo "<tr><td>".$row["weathername"]."</td>";
    if ($row['weathervideo'] === "1") {
       echo "<td>
        <video class=\"lozad\" controls muted>
            <source data-src=\"/videos/webm/weather/".$row["weathername"].".webm\" type=\"video/webm\">
            <source data-src=\"/videos/mp4/weather/".$row["weathername"].".avi\" type=\"video/mp4\">
        </video></td>";

    } else {
        echo "<td></td>";
    }
    echo "</tr>\n";
}

echo"
</tbody>
</table>
<center><a href=\"#top\"><button class=\"button button3 topbutton\">top</button></a></center>";

$number2 = 0;
foreach ($searchoptions as $value) {
	if (!empty(${$value})) {
		if ($page==1) {
			echo "<center><button class=\"button button2\"><a href=\"./weather.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		} else {
			echo "<center><button class=\"button button1\"><a href=\"./weather.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page-1)."\">previous page</a></button><button class=\"button button2\"><a href=\"./weather.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		}
		$number2++;
	}
}

if ($number2===1) {}
else {
	if ($page===1) {
		echo "<center><button class=\"button button2\"><a href=\"./weather.php?categoryid=$categoryid&page=".($page+1)."\">next page</a></button></center>";
	} else {
		echo "<center><button class=\"button button1\"><a href=\"./weather.php?categoryid=$categoryid&page=".($page-1)."\">previous page</a></button>  <button class=\"button button2\"><a href=\"./weather.php?categoryid=$categoryid&page=".($page+1)."\">next page</a></button></center>";
	}
}

echo "
</div>
</div>
";
include("../../snippets/footer.php");
echo "</body>
</html>";
?>