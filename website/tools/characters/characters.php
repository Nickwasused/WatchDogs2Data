<?php
include("../../snippets/head.php");
include("../../snippets/functions.php");
$categoryid = getrequest($_REQUEST['categoryid']);
$modelname = getrequest($_REQUEST['modelname']);
$skip = "false";

$page = pagesystem();
$offset = ($page - 1) * $items_per_page;

$searchoptions = array("modelname");
$valueneeded = array("categoryid");

if (!empty($modelname)) {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `modelname` LIKE '%".$modelname."%' AND `charactermodels`.`categoryid` = $categoryid AND `charactercategorys`.`categoryid` = $categoryid AND `characterid` >= $offset LIMIT $items_per_page;";
    #define the filteroption for the page system
    $filteroption = "WHERE `modelname` LIKE '%".$modelname."%' AND `charactermodels`.`categoryid` = $categoryid AND `charactercategorys`.`categoryid` = $categoryid;";
} else if (!empty($categoryid)) {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `charactermodels`.`categoryid` = $categoryid AND `charactercategorys`.`categoryid` = $categoryid AND `characterid` >= $offset LIMIT $items_per_page;";
    $filteroption = "WHERE `charactermodels`.`categoryid` = $categoryid;";
} else {
    $filteroption = ";";
    $skip = "true";
}

#merge the count option with the filter
$normalfilter = "SELECT COUNT(characterid) FROM charactermodels " . $filteroption;
foreach ($pdo->query($normalfilter) as $sumrow) 
{
    $sum = $sumrow[0];
}

$pagesneeded = getpagesneeded($sum, $items_per_page);
$nextpagebutton = nextpagebutton($offset, $items_per_page, $pagesneeded);

include("../../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/avif/background3.avif,/images/backgrounds/webp/background3.webp\">
<div class=\"imagefilter\">";

buttonscycle($searchoptions, "characters.php", $page, $valueneeded, $nextpagebutton);

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
            <input type=text name=\"modelname\" value=\"".$modelname."\">
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

buttonscycle($searchoptions, "characters.php", $page, $valueneeded, $nextpagebutton);

echo "
</div>
</div>
";
include("../../snippets/footer.php");
echo "</body>
</html>";
?>