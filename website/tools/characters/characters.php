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

$setfiltermode = 0;

if (!empty($modelname)) {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `modelname` LIKE :modelname AND `charactermodels`.`categoryid` = :categoryid AND `charactercategorys`.`categoryid` = :categoryid LIMIT $items_per_page OFFSET $offset;";
    #define the filteroption for the page system
    $filteroption = "WHERE `modelname` LIKE :modelname AND `charactermodels`.`categoryid` = :categoryid;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':modelname' => '%'.$modelname.'%', ':categoryid' => $categoryid));
    $setfiltermode = 1;
} else if (!empty($categoryid)) {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `charactermodels`.`categoryid` = :categoryid AND `charactercategorys`.`categoryid` = :categoryid LIMIT $items_per_page OFFSET $offset;";
    $filteroption = "WHERE `charactermodels`.`categoryid` = :categoryid;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':categoryid' => $categoryid));
    $setfiltermode = 2;
} else {
    $filteroption = ";";
    $command = "";
    $skip = "true";
}


#merge the count option with the filter
$normalfilter = "SELECT COUNT(characterid) FROM charactermodels " . $filteroption;
$sth2 = $pdo->prepare($normalfilter, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if ($setfiltermode === 1) {
    $sth2->execute(array(':modelname' => '%'.$modelname.'%', ':categoryid' => $categoryid));
} else if ($setfiltermode === 2) {
    $sth2->execute(array(':categoryid' => $categoryid));
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
<div class=\"contentstart lozad\" data-background-image=\"/images/avif/backgrounds/background2.avif,/images/webp/backgrounds/background2.webp\">
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
    while ($row = $sth->fetch()) {
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