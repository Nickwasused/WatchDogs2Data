<?php
include("../../snippets/head.php");
include("../../snippets/functions.php");
$weathername = getrequest($_REQUEST['weathername']);

foreach ($pdo->query("SELECT MAX(weatherid) FROM weather;") as $sumrow) 
{
    $sum = $sumrow[0];
}

$pagesneeded = getpagesneeded($sum, $items_per_page);
$page = pagesystem();

$searchoptions = array("weathername");
$valueneeded = array();
$offset = ($page - 1) * $items_per_page;

$nextpagebutton = nextpagebutton($offset, $items_per_page, $pagesneeded);

if (!empty($weathername)) {
    $command = "SELECT * FROM `weather` WHERE `weathername` LIKE '%".$weathername."%' AND `weatherid` >= $offset LIMIT $items_per_page;";
} else {
    $command = "SELECT * FROM `weather` WHERE `weatherid` >= $offset LIMIT $items_per_page;";
}

include("../../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/avif/background3.avif,/images/backgrounds/webp/background3.webp\">
<div class=\"imagefilter\">";

buttonscycle($searchoptions, "weather.php", $page, $valueneeded, $nextpagebutton);

echo "
<table>
<thead>
<tr>
    <td>weathername</td>
    <td>video</td>
</tr>
<tr>
    <td>
    <form action=\"#\" method=\"post\">
            <input type=text name=\"weathername\" value=\"".$weathername."\">
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
        echo "<img class=\"lozad placeholdericon\" data-src=\"/images/icons/placeholder.svg\"></img>";
    }
    echo "</tr>\n";
}

echo"
</tbody>
</table>";

buttonscycle($searchoptions, "weather.php", $page, $valueneeded, $nextpagebutton);

echo "
</div>
</div>
";
include("../../snippets/footer.php");
echo "</body>
</html>";
?>