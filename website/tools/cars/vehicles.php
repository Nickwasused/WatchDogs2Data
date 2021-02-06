<?php
include("../../snippets/head.php");

$modelname=$_REQUEST["modelname"];

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

if (!empty($modelname)) {
    $command = "SELECT * FROM `vehicles` WHERE `vehiclename` LIKE '%".$modelname."%' ";
} else {
    $command = "SELECT * FROM `vehicles`";
}

include("../../snippets/blocksnap.php");
echo "
<a id=\"top\"></a>
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
<div class=\"imagefilter\">
<center><button class=\"button button1 resetbutton\"><a href=\"./vehicles.php\">reset</a></button></center>
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
<center><a href=\"#top\"><button class=\"button button3 topbutton\">top</button></a></center>
</div>
</div>

</body>
";
include("../../snippets/footer.php");
?>