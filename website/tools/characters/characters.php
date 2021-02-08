<?php
include("../../snippets/head.php");
include("../../snippets/functions.php");
$categoryid=$_REQUEST["categoryid"];
$modelname=$_REQUEST["modelname"];
$skip = "false";

$page = pagesystem();

$searchoptions = array("modelname", "categoryid");
$offset = ($page - 1) * $items_per_page;

if (!empty($modelname)) {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `modelname` LIKE '%".$modelname."%' AND `characterid` >= $offset LIMIT $items_per_page;";
} else if (!empty($categoryid)) {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `charactermodels`.`categoryid` = $categoryid AND `charactercategorys`.`categoryid` = $categoryid AND `characterid` >= $offset LIMIT $items_per_page;";
} else {
    $skip = "true";
}

include("../../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/avif/background3.avif,/images/backgrounds/webp/background3.webp\">
<div class=\"imagefilter\">";

buttonscycle($searchoptions, "characters.php", $page);

echo "
<table>
<thead>
<tr>
    <td>category</td>
    <td>modelname</td>
    <td>image</td>
</tr>
<tr>
    <td>
    <form>
        <select name=\"categoryid\" id=\"categoryid\">";
        $charactercategories = "SELECT * FROM `charactercategorys`;";
        foreach ($pdo->query($charactercategories) as $rowcategories)
        {
            echo "<option value=\"".$rowcategories["categoryid"]."\">".$rowcategories["categoryname"]."</option>";
        }
        echo "</select>
        <input class=\"button3\" type=submit>
    </form>
    </td>
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
if ($skip == "false") {
    foreach ($pdo->query($command) as $row)
    {
        $categoryname = "SELECT * FROM `charactercategorys` WHERE `categoryid` = ".$row["categoryid"].";";
        foreach ($pdo->query($categoryname) as $rowcategoryname)
        {
            echo "<tr><td>".$rowcategoryname["categoryname"]."</td>";
        }
        echo "<td><p>".$row["modelname"]."</p></td><td>";
        if ($row['image'] === "1") {
            echo "<picture class=\"lozad\">
                    <source srcset=\"/images/avif/models/".$row["categoryname"]."/".$row["modelname"].".avif\">
                    <source srcset=\"/images/webp/models/".$row["categoryname"]."/".$row["modelname"].".webp\">
                    <img src=\"/images/webp/models/".$row["categoryname"]."/".$row["modelname"].".webp\" alt=\"\"></noscript>
                </picture>";
        } else {
            echo "<img class=\"lozad placeholdericon\" data-src=\"/images/icons/placeholder.svg\"></img>";
        }
        echo "</td></tr>\n";
    }
} else {
    echo "<tr><td>Please filter the result!</td><td></td><td></td></tr>";
}


echo"
</tbody>
</table>";

buttonscycle($searchoptions, "characters.php", $page);

echo "
</div>
</div>
";
include("../../snippets/footer.php");
echo "</body>
</html>";
?>