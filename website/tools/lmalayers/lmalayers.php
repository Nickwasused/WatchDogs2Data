<?php
include("../../snippets/head.php");
include("../../snippets/functions.php");
$lmalayer = getrequest($_REQUEST['lmalayer']);
$lmalayercategoryid = getrequest($_REQUEST['lmalayercategoryid']);

$page = pagesystem();
$offset = ($page - 1) * $items_per_page;

$searchoptions = array("lmalayer");
$valueneeded = array("lmalayercategoryid");

$setfiltermode = 0;

if (!empty($lmalayer)) {
    $command = "SELECT * FROM `lmalayers` WHERE `lmalayer` LIKE :lmalayer LIMIT $items_per_page OFFSET $offset;";
    $filteroption = "WHERE `lmalayer` LIKE :lmalayer;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':lmalayer' => '%'.$lmalayer.'%'));
    $setfiltermode = 1;
} else if (!empty($lmalayercategoryid)) {
    $command = "SELECT * FROM `lmalayers` WHERE `lmalayercategory` = :lmalayercategoryid LIMIT $items_per_page OFFSET $offset;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':lmalayercategoryid' => $lmalayercategoryid));
    $filteroption = "WHERE `lmalayercategory` = :lmalayercategoryid;";
    $setfiltermode = 2;
} else {
    $command = "SELECT * FROM `lmalayers` LIMIT $items_per_page OFFSET $offset;";
    $filteroption = ";";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute();
}

#merge the count option with the filter
$normalfilter = "SELECT COUNT(lmalayerid) FROM lmalayers " . $filteroption;
$sth2 = $pdo->prepare($normalfilter, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if ($setfiltermode === 1) {
    $sth2->execute(array(':lmalayer' => '%'.$lmalayer.'%'));
} else if ($setfiltermode === 2) {
    $sth2->execute(array(':lmalayercategoryid' => $lmalayercategoryid));
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
	
while ($row = $sth->fetch()) {
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