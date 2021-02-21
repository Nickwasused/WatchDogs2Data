<?php
include("../../snippets/head.php");
include("../../snippets/functions.php");
$modelname = getrequest($_REQUEST['modelname']);
$page = pagesystem();
$offset = ($page - 1) * $items_per_page;

$searchoptions = array("modelname");
$valueneeded = array();

$setfiltermode = 0;

if (!empty($modelname)) {
    $command = "SELECT * FROM `vehicles` WHERE `vehiclename` LIKE :modelname LIMIT $items_per_page OFFSET $offset;";
    $filteroption = " WHERE `vehiclename` LIKE :modelname;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute([':modelname' => '%'.$modelname.'%']);
    $setfiltermode = 1;
} else {
    $command = "SELECT * FROM `vehicles` LIMIT $items_per_page OFFSET $offset;";
    $filteroption = ";";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute();
}

#merge the count option with the filter
$normalfilter = "SELECT COUNT(vehicleid) FROM vehicles" . $filteroption;
$sth2 = $pdo->prepare($normalfilter, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if ($setfiltermode === 1) {
    $sth2->execute([':modelname' => '%'.$modelname.'%']);
} else {
    $sth2->execute();
}
while ($sumrow = $sth2->fetch()) {
    $sum = $sumrow[0];
}

$pagesneeded = getpagesneeded($sum, $items_per_page);
$nextpagebutton = nextpagebutton($offset, $items_per_page, $pagesneeded);
include("../../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/avif/backgrounds/background3.avif,/images/webp/backgrounds/background3.webp\">
<div class=\"imagefilter\">";

buttonscycle($searchoptions, "vehicles.php", $page, $valueneeded, $nextpagebutton);

echo "
<table>
<thead>
<tr>
<td>modelname</td>
<td>image</td>
</tr>
<tr>
    <td>
        <form>
            <input type=text name=\"modelname\" value=\"".$modelname."\">
            <input class=\"button3\" type=submit>
        </form>
    </td>
    <td></td>
</thead>
<tbody>";

while ($row = $sth->fetch()) {
    echo "<tr><td><p>".strtolower($row["vehiclename"])."</p></td><td>";
    if ($row['image'] === "1") {
        echo "
        <picture class=\"lozad\">
            <source srcset=\"/images/avif/vehicles/".$row["vehiclename"].".avif\">
            <source srcset=\"/images/webp/vehicles/".$row["vehiclename"].".webp\">
            <img src=\"/images/webp/vehicles/".$row["vehiclename"].".webp\" alt=\"\"></noscript>
        </picture>";
    } else {
        echo "<img class=\"lozad placeholdericon\" data-src=\"/images/icons/placeholder.svg\"></img>";
    }
    echo "</td></tr>\n";
}

echo"
</tbody>
</table>
<center><a href=\"#top\"><button class=\"button button3\">top</button></a></center>";

buttonscycle($searchoptions, "vehicles.php", $page, $valueneeded, $nextpagebutton);

echo "
</div>
</div>
";
include("../../snippets/footer.php");
echo "</body>
</html>";
?>