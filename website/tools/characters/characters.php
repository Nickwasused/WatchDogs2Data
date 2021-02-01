<?php
include("../../snippets/head.php");

$categoryid=$_REQUEST["categoryid"];
$modelname=$_REQUEST["modelname"];

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

if (!empty($modelname)) {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `modelname` LIKE '%".$modelname."%' AND `charactermodels`.`categoryid` = $categoryid AND `charactercategorys`.`categoryid` = $categoryid ";
} else {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `charactermodels`.`categoryid` = $categoryid AND `charactercategorys`.`categoryid` = $categoryid;";
}

include("../../snippets/blocksnap.php");
echo "
<a id=\"top\"></a>
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
<div class=\"imagefilter\">
<center><button class=\"button button1 resetbutton\"><a href=\"./characters.php?categoryid=".$categoryid."\">reset</a></button></center>
<table>
<thead>
<tr>
    <td>modelname</td>
    <td>image</td>
</tr>
<tr>
    <td>
        <form>
            <input type=hidden name=\"categoryid\" value=\"$categoryid\">
            <input type=text name=\"modelname\">
            <input class=\"button3\" type=submit>
        </form>
    </td>
    <td></td>
</tr>
</thead>
<tbody>";
	
foreach ($pdo->query($command) as $row)
{
    echo "<tr><td><p>".$row["modelname"]."</p></td><td>";
    if ($row['image'] === "1") {
        echo "<img class=\"lozad\" data-src=\"/images/models/".$row["categoryname"]."/".$row["modelname"].".webp\"></img>";
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