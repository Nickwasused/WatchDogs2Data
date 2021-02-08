<?php
include("../../snippets/head.php");
include("../../snippets/functions.php");
$modelname=$_REQUEST["modelname"];

$page = pagesystem();

$searchoptions = array("modelname");
$offset = ($page - 1) * $items_per_page;

if (!empty($modelname)) {
    $command = "SELECT * FROM `vehicles` WHERE `vehiclename` LIKE '%".$modelname."%' AND `vehicleid` >= $offset LIMIT $items_per_page;";
} else {
    $command = "SELECT * FROM `vehicles` WHERE `vehicleid` >= $offset LIMIT $items_per_page;";
}

include("../../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/avif/background3.avif,/images/backgrounds/webp/background3.webp\">
<div class=\"imagefilter\">";

buttonscycle($searchoptions, "vehicles.php", $page);

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
            <input type=text name=\"modelname\">
            <input class=\"button3\" type=submit>
        </form>
    </td>
    <td></td>
</thead>
<tbody>";

foreach ($pdo->query($command) as $row)
{
    echo "<tr><td><p>".$row["vehiclename"]."</p></td><td>";
    if ($row['image'] === "1") {
        echo "
        <picture class=\"lozad\">
            <source srcset=\"/images/avif/vehicles/".$row["vehiclename"].".avif\">
            <source srcset=\"/images/webp/vehicles/".$row["vehiclename"].".webp\">
            <img src=\"/images/webp/vehicles/".$row["vehiclename"].".webp\" alt=\"\"></noscript>
        </picture>";
    } else {
        echo "<img class=\"lozad\" data-src=\"/images/icons/placeholder.svg\"></img>";
    }
    echo "</td></tr>\n";
}

echo"
</tbody>
</table>
<center><a href=\"#top\"><button class=\"button button3 topbutton\">top</button></a></center>";

buttonscycle($searchoptions, "vehicles.php", $page);

echo "
</div>
</div>
";
include("../../snippets/footer.php");
echo "</body>
</html>";
?>