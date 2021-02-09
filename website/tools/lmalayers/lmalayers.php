<?php
include("../../snippets/head.php");
include("../../snippets/functions.php");
$lmalayer = getrequest($_REQUEST['lmalayer']);
$lmalayercategoryid = getrequest($_REQUEST['lmalayercategoryid']);

$page = pagesystem();
$offset = ($page - 1) * $items_per_page;

$searchoptions = array("lmalayer");
$valueneeded = array("lmalayercategoryid");

if (!empty($lmalayer)) {
    $command = "SELECT * FROM `lmalayers` WHERE `lmalayer` LIKE '%".$lmalayer."%' LIMIT $items_per_page OFFSET $offset;";
    $filteroption = "WHERE `lmalayer` LIKE '%".$lmalayer."%';";
} else if (!empty($lmalayercategoryid)) {
    $command = "SELECT * FROM `lmalayers` WHERE `lmalayercategory` = $lmalayercategoryid LIMIT $items_per_page OFFSET $offset;";
    $filteroption = "WHERE `lmalayercategory` = $lmalayercategoryid;";
} else {
    $command = "SELECT * FROM `lmalayers` LIMIT $items_per_page OFFSET $offset;";
    $filteroption = ";";
}

#merge the count option with the filter
$normalfilter = "SELECT COUNT(lmalayerid) FROM lmalayers " . $filteroption;
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

buttonscycle($searchoptions, "lmalayers.php", $page, $valueneeded, $nextpagebutton);

echo "
<table>
<thead>
<tr>
    <td>category</td>
    <td>layername</td>
    <td>location</td>
    <td>image</td>
</tr>
<tr>
    <td>
    <form>
        <select name=\"lmalayercategoryid\" id=\"lmalayercategoryid\">";
        $lmalayercategories = "SELECT * FROM `lmalayercategories`;";
        foreach ($pdo->query($lmalayercategories) as $rowcategories)
        {
            echo "<option value=\"".$rowcategories["lmalayercategoryid"]."\">".$rowcategories["lmacategoryname"]."</option>";
        }
        echo "</select>
        <input class=\"button3\" type=submit>
    </form>
    </td>
    <td>
        <form>
            <input type=hidden name=\"lmalayercategoryid\" value=\"$lmalayercategoryid\">
            <input type=text name=\"lmalayer\" value=\"".$lmalayer."\">
            <input class=\"button3\" type=submit>
        </form>
    </td>
    <td></td>
    <td></td>
</tr>
</thead>
<tbody>";
	
foreach ($pdo->query($command) as $row)
{
    $categoryname = "SELECT * FROM `lmalayercategories` WHERE `lmalayercategoryid` = ".$row["lmalayercategory"].";";
    foreach ($pdo->query($categoryname) as $rowcategoryname)
    {
        echo "<tr><td>".$rowcategoryname["lmacategoryname"]."</td>";
    }
    echo "<td><p>".$row["lmalayer"]."</p></td>";

    if (!empty($row["lmalocation"])) {
        echo "<td><p>".$row["lmalocation"]."</p></td>";
    } else {
        echo "<td></td>";
    }

    echo "<td>";

    if ($row['image'] === "1") {
    echo "<a href=\"/images/webp/lmalayers/".$rowcategoryname["lmacategoryname"]."/".$row["lmalayer"].".webp\" target=\"_blank\">
            <picture class=\"lozad\">
                    <source srcset=\"/images/avif/lmalayers/".$rowcategoryname["lmacategoryname"]."/".$row["lmalayer"].".avif\">
                    <source srcset=\"/images/webp/lmalayers/".$rowcategoryname["lmacategoryname"]."/".$row["lmalayer"].".webp\">
                    <img src=\"/images/webp/lmalayers/".$rowcategoryname["lmacategoryname"]."/".$row["lmalayer"].".webp\" alt=\"\"></noscript>
                </picture></a>";
    } else {
        echo "<img class=\"lozad placeholdericon\" data-src=\"/images/icons/placeholder.svg\"></img>";
    }
    echo "</td></tr>\n";
}

echo"
</tbody>
</table>";

buttonscycle($searchoptions, "lmalayers.php", $page, $valueneeded, $nextpagebutton);

echo "
</div>
</div>
";
include("../../snippets/footer.php");
echo "</body>
</html>";
?>