<?php
include("../../snippets/head.php");

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

echo "
<style>
header {
	scroll-snap-align : none !important;
}
</style>
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
<div class=\"imagefilter\">
<table>
<thead>
<tr>
<td>modelname</td>
<td>image</td>
</tr>
</thead>
<tbody>";
	
$command = "SELECT * FROM `vehicles`";

foreach ($pdo->query($command) as $row)
{
    echo "<tr><td><p>".$row["vehiclename"]."</p></td><td>";
    if ($row['image'] === "1") {
        echo "<img class=\"lozad\" data-src=\"/images/vehicles/".$row["vehiclename"].".webp\"></img>";
    } else {
        echo "<img class=\"lozad\" data-src=\"/images/icons/placeholder.svg\"></img>";
    }
    echo "</td></tr>\n";
}

echo"
</tbody>
</table>
</div>
</div>

</body>
";
include("../../snippets/footer.php");
?>