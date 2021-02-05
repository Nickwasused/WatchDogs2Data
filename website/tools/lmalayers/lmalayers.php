<?php
include("../../snippets/head.php");

$lmalayer=$_REQUEST["lmalayer"];

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

if (!empty($lmalayer)) {
    $command = "SELECT * FROM `lmalayers` WHERE `lmalayer` LIKE '%".$lmalayer."%';";
} else {
    $command = "SELECT * FROM `lmalayers`;";
}

include("../../snippets/blocksnap.php");
echo "
<a id=\"top\"></a>
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
<div class=\"imagefilter\">
<center><button class=\"button button1 resetbutton\"><a href=\"./lmalayers.php\">reset</a></button></center>
<table>
<thead>
<tr>
    <td>layername</td>
    <td>location</td>
    <td>image</td>
</tr>
<tr>
    <td>
        <form>
            <input type=text name=\"lmalayer\">
            <input class=\"button3\" type=submit>
        </form>
    </td>
    <td></td>
</tr>
</thead>
<tbody>";
	
foreach ($pdo->query($command) as $row)
{
    echo "<tr><td><p>".$row["lmalayer"]."</p></td><td>";
    if (!empty($row["location"])) {
        echo "<p>".$row["location"]."</p></td>";
    } else {
        echo "<td></td>";
    }

    echo "<td>";

    if ($row['image'] === "1") {
        echo "<img class=\"lozad\" data-src=\"/images/lmalayers/".$row["lmalayer"].".webp\"></img>";
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