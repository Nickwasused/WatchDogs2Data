<?php
include("../../snippets/head.php");
include("../../snippets/functions.php");
$weathername = getrequest($_REQUEST['weathername']);
$page = pagesystem();
$offset = ($page - 1) * $items_per_page;

$setfiltermode = 0;

if (!empty($weathername)) {
    $command = "SELECT * FROM `weather` WHERE `weathername` LIKE :weathername LIMIT $items_per_page OFFSET $offset;";
    #define the filteroption for the page system
    $filteroption = "WHERE `weathername` LIKE :weathername;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':weathername' => '%'.$weathername.'%'));
    $setfiltermode = 1;
} else {
    $command = "SELECT * FROM `weather` LIMIT $items_per_page OFFSET $offset;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute();
    #define the filteroption for the page system
    $filteroption = ";";
}

#merge the count option with the filter
$normalfilter = "SELECT COUNT(weatherid) FROM weather " . $filteroption;
$sth2 = $pdo->prepare($normalfilter, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if ($setfiltermode === 1) {
    $sth2->execute(array(':weathername' => '%'.$weathername.'%'));
} else {
    $sth2->execute();
}

while ($sumrow = $sth2->fetch()) {
    $sum = $sumrow[0];
}


$searchoptions = array("weathername");
$valueneeded = array();

$pagesneeded = getpagesneeded($sum, $items_per_page);
$nextpagebutton = nextpagebutton($offset, $items_per_page, $pagesneeded);

include("../../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/avif/backgrounds/background5.avif,/images/webp/backgrounds/background5.webp\">
<div class=\"imagefilter\">";

buttonscycle($searchoptions, "weather.php", $page, $valueneeded, $nextpagebutton);

echo "
<link type='text/css' rel='stylesheet' href='/css/table.css' media=\"none\" onload=\"if(media!='all')media='all'\">
<table>
<thead>
<tr>
    <td>weathername</td>
    <td>video</td>
</tr>
<tr>
    <td>
    <form>
            <input type=text name=\"weathername\" value=\"".$weathername."\">
            <input class=\"button3\" type=submit>
        </form>
    </td>
    <td></td>
</tr>
</thead>
<tbody>";
	
while ($row = $sth->fetch()) {
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